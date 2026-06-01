<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function index()
    {
        $products = Product::where('is_active', true)
            ->with('images')
            ->latest()
            ->take(8)
            ->get();

        $categories = Category::whereNull('parent_id')->get();

        return view('welcome', compact('products', 'categories'));
    }

public function products(Request $request)
{
    $categories = Category::whereNull('parent_id')
        ->with('children')
        ->get();

    $query = Product::query()
        ->where('is_active', true)
        ->with(['images', 'category']);

    // category filter (parent + children)
    if ($request->filled('category')) {
        $categorySlug = $request->category;

        $category = Category::where('slug', $categorySlug)->first();

        if ($category) {
            $categoryIds = collect([$category->id]);

            $childrenIds = Category::where('parent_id', $category->id)->pluck('id');

            $categoryIds = $categoryIds->merge($childrenIds);

            $query->whereIn('category_id', $categoryIds);
        }
    }

    // search
    if ($request->filled('q')) {
        $q = trim($request->q);

        $query->where(function ($sub) use ($q) {
            $sub->where('name', 'like', "%{$q}%")
                ->orWhere('slug', 'like', "%{$q}%");
            // اگر description هم داری:
            // ->orWhere('description', 'like', "%{$q}%");
        });
    }

    // sort
    $sort = $request->get('sort', 'newest');

    if ($sort === 'price_asc') {
        $query->orderBy('price', 'asc');
    } elseif ($sort === 'price_desc') {
        $query->orderBy('price', 'desc');
    } else {
        // newest (default)
        $query->latest();
    }

    $products = $query->paginate(12)->withQueryString();

    return view('products.index', compact('products', 'categories', 'sort'));
}


    public function show(Product $product)
    {
        abort_if(!$product->is_active, 404);

        $product->load(['images', 'category']);

        return view('products.show', compact('product'));
    }
}
