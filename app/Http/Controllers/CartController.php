<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);

        $subtotal = collect($cart)->sum(function ($item) {
            return $item['price'] * $item['quantity'];
        });

        return view('cart.index', compact('cart', 'subtotal'));
    }

    public function add(Request $request, Product $product)
    {
        abort_if(!$product->is_active, 404);

        if ($product->stock < 1) {
            return redirect()
                ->route('products.show', $product->slug)
                ->with('error', 'این محصول موجود نیست.');
        }

        $cart = session()->get('cart', []);

        $currentQuantity = isset($cart[$product->id])
            ? $cart[$product->id]['quantity']
            : 0;

        if ($currentQuantity >= $product->stock) {
            return redirect()
                ->route('products.show', $product->slug)
                ->with('error', 'تعداد درخواستی بیشتر از موجودی انبار است.');
        }

        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity']++;
        } else {
            $cart[$product->id] = [
                'product_id' => $product->id,
                'name' => $product->name,
                'slug' => $product->slug,
                'price' => $product->price,
                'quantity' => 1,
                'image' => $product->thumbnail_url,
                'stock' => $product->stock,
            ];
        }

        session()->put('cart', $cart);

        return redirect()
            ->route('cart.index')
            ->with('success', 'محصول به سبد خرید اضافه شد.');
    }
    public function update(Request $request, Product $product)
{
    $request->validate([
        'quantity' => ['required', 'integer', 'min:1'],
    ]);

    $cart = session()->get('cart', []);

    if (!isset($cart[$product->id])) {
        return redirect()->route('cart.index')->with('error', 'این محصول در سبد خرید نیست.');
    }

    $quantity = (int) $request->input('quantity');

    if ($quantity > $product->stock) {
        return redirect()
            ->route('cart.index')
            ->with('error', 'تعداد درخواستی بیشتر از موجودی انبار است.');
    }

    $cart[$product->id]['quantity'] = $quantity;

    session()->put('cart', $cart);

    return redirect()->route('cart.index')->with('success', 'سبد خرید بروزرسانی شد.');
}

public function remove(Product $product)
{
    $cart = session()->get('cart', []);

    if (isset($cart[$product->id])) {
        unset($cart[$product->id]);
        session()->put('cart', $cart);
    }

    return redirect()->route('cart.index')->with('success', 'آیتم از سبد خرید حذف شد.');
}

public function clear()
{
    session()->forget('cart');

    return redirect()->route('cart.index')->with('success', 'سبد خرید خالی شد.');
}
}
