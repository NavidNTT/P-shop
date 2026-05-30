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
            ->with(['images', 'category'])
            ->latest();

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

        $products = $query->paginate(12)->withQueryString();

        return view('products.index', compact('products', 'categories'));
    }

    public function show(Product $product)
    {
        abort_if(!$product->is_active, 404);

        $product->load(['images', 'category']);

        return view('products.show', compact('product'));
    }
}
