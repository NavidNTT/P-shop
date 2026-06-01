<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function show()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'سبد خرید خالی است.');
        }

        $subtotal = collect($cart)->sum(fn ($item) => $item['price'] * $item['quantity']);

        return view('checkout.show', compact('cart', 'subtotal'));
    }

    public function store(Request $request)
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'سبد خرید خالی است.');
        }

        $productIds = collect($cart)->pluck('product_id')->all();

        try {
            DB::transaction(function () use ($cart, $productIds, &$order) {

                // قفل کردن ردیف محصولات برای جلوگیری از race condition
                $products = Product::query()
                    ->whereIn('id', $productIds)
                    ->lockForUpdate()
                    ->get()
                    ->keyBy('id');

                // اعتبارسنجی موجودی + محاسبه مبلغ بر اساس دیتابیس (نه session)
                $subtotal = 0;

                foreach ($cart as $item) {
                    $p = $products->get($item['product_id']);

                    if (!$p || !$p->is_active) {
                        throw new \RuntimeException('یکی از محصولات دیگر قابل خرید نیست.');
                    }

                    if ($item['quantity'] > $p->stock) {
                        throw new \RuntimeException("موجودی «{$p->name}» کافی نیست.");
                    }

                    $subtotal += ($p->price * $item['quantity']);
                }

                $order = Order::create([
                    'user_id' => auth()->id(),
                    'subtotal' => $subtotal,
                    'total' => $subtotal,
                    'status' => 'pending',
                ]);

                // ذخیره آیتم‌ها + کسر موجودی
                foreach ($cart as $item) {
                    $p = $products->get($item['product_id']);

                    $order->items()->create([
                        'product_id' => $p->id,
                        'price' => $p->price,
                        'quantity' => $item['quantity'],
                        'line_total' => $p->price * $item['quantity'],
                    ]);

                    $p->decrement('stock', $item['quantity']);
                }
            });
        } catch (\Throwable $e) {
            return redirect()->route('checkout.show')->with('error', $e->getMessage());
        }

        session()->forget('cart');

        return redirect()
            ->route('orders.show', $order)
            ->with('success', 'سفارش با موفقیت ثبت شد.');
    }
}