@extends('layouts.store')

@section('content')
    <div class="mb-6 flex items-center justify-between">
        <h1 class="text-2xl font-bold">سبد خرید</h1>
        <div class="flex items-center gap-3">
            <a href="{{ route('products.index') }}" class="text-blue-600 hover:underline">
                ادامه خرید
            </a>

            @if(count($cart))
                <form action="{{ route('cart.clear') }}" method="POST"
                      onsubmit="return confirm('سبد خرید خالی شود؟')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-600 hover:underline">
                        خالی کردن سبد
                    </button>
                </form>
            @endif
        </div>
    </div>

    @if(session('success'))
        <div class="mb-4 rounded-lg bg-green-100 px-4 py-3 text-green-700">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="mb-4 rounded-lg bg-red-100 px-4 py-3 text-red-700">
            {{ session('error') }}
        </div>
    @endif

    @if(count($cart))
        <div class="overflow-x-auto rounded-xl bg-white shadow">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                <tr class="text-right text-sm font-semibold text-gray-600">
                    <th class="px-4 py-3">محصول</th>
                    <th class="px-4 py-3">قیمت واحد</th>
                    <th class="px-4 py-3">تعداد</th>
                    <th class="px-4 py-3">جمع</th>
                    <th class="px-4 py-3"></th>
                </tr>
                </thead>

                <tbody class="divide-y divide-gray-100">
                @foreach($cart as $item)
                    <tr>
                        <td class="px-4 py-4">
                            <div class="flex items-center gap-4">
                                <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}"
                                     class="h-16 w-16 rounded object-cover">
                                <div>
                                    <a href="{{ route('products.show', $item['slug']) }}"
                                       class="font-semibold hover:text-blue-600">
                                        {{ $item['name'] }}
                                    </a>
                                    <div class="text-xs text-gray-500">
                                        موجودی: {{ $item['stock'] }}
                                    </div>
                                </div>
                            </div>
                        </td>

                        <td class="px-4 py-4">
                            {{ number_format($item['price']) }} تومان
                        </td>

                        <td class="px-4 py-4">
                            <div class="flex items-center gap-2">
                                {{-- minus --}}
                                <form action="{{ route('cart.update', $item['product_id']) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="quantity" value="{{ max(1, $item['quantity'] - 1) }}">
                                    <button type="submit"
                                            class="h-9 w-9 rounded border bg-white hover:bg-gray-50">
                                        -
                                    </button>
                                </form>

                                <span class="min-w-10 text-center font-semibold">
                                    {{ $item['quantity'] }}
                                </span>

                                {{-- plus --}}
                                <form action="{{ route('cart.update', $item['product_id']) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="quantity" value="{{ $item['quantity'] + 1 }}">
                                    <button type="submit"
                                            class="h-9 w-9 rounded border bg-white hover:bg-gray-50">
                                        +
                                    </button>
                                </form>
                            </div>
                        </td>

                        <td class="px-4 py-4 font-semibold">
                            {{ number_format($item['price'] * $item['quantity']) }} تومان
                        </td>

                        <td class="px-4 py-4 text-left">
                            <form action="{{ route('cart.remove', $item['product_id']) }}" method="POST"
                                  onsubmit="return confirm('این آیتم حذف شود؟')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline">
                                    حذف
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>

                <tfoot class="bg-gray-50">
                <tr>
                    <td colspan="3" class="px-4 py-4 text-left font-bold">
                        جمع کل:
                    </td>
                    <td class="px-4 py-4 font-extrabold text-blue-700">
                        {{ number_format($subtotal) }} تومان
                    </td>
                    <td class="px-4 py-4"></td>
                </tr>
                </tfoot>
            </table>
        </div>
        <div class="mt-6">
    <a href="{{ route('checkout.show') }}"
       class="inline-block rounded-lg bg-green-600 px-5 py-3 text-white hover:bg-green-700">
        رفتن به تسویه حساب
    </a>
</div>
    @else
        <div class="rounded-xl bg-white p-8 text-center shadow">
            <p class="mb-4 text-gray-600">سبد خرید شما خالی است.</p>
            <a href="{{ route('products.index') }}"
               class="inline-block rounded-lg bg-blue-600 px-5 py-3 text-white hover:bg-blue-700">
                مشاهده محصولات
            </a>
        </div>
    @endif
@endsection
