@extends('layouts.store')

@section('title', 'سبد خرید')

@section('content')
    <section class="space-y-6">
        {{-- سربرگ صفحه --}}
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-xl sm:text-2xl font-bold text-gray-900">
                    سبد خرید
                </h1>
                <p class="mt-1 text-sm text-gray-500">
                    @if(!empty($cart))
                        {{ count($cart) }} محصول در سبد شما قرار دارد.
                    @else
                        سبد خرید شما در حال حاضر خالی است.
                    @endif
                </p>
            </div>

            <div class="flex flex-wrap items-center gap-3">
                {{-- ادامه خرید --}}
                <a href="{{ route('products.index') }}"
                   class="inline-flex items-center justify-center rounded-lg border border-gray-200 bg-white px-3.5 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 hover:border-gray-300">
                    ادامه خرید
                </a>

                @if(!empty($cart))
                    {{-- خالی کردن سبد --}}
                    <form action="{{ route('cart.clear') }}" method="POST"
                          onsubmit="return confirm('آیا از خالی کردن سبد خرید اطمینان دارید؟');">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="inline-flex items-center justify-center rounded-lg border border-red-100 bg-red-50 px-3.5 py-2 text-sm font-medium text-red-700 hover:bg-red-100 hover:border-red-200">
                            خالی کردن سبد
                        </button>
                    </form>
                @endif
            </div>
        </div>

        {{-- پیام‌های موفقیت / خطا --}}
        @if (session('success'))
            <div class="rounded-xl border border-green-100 bg-green-50 px-4 py-3 text-sm text-green-800 flex items-start gap-3">
                <span class="mt-0.5">✅</span>
                <p>{{ session('success') }}</p>
            </div>
        @endif

        @if (session('error'))
            <div class="rounded-xl border border-red-100 bg-red-50 px-4 py-3 text-sm text-red-800 flex items-start gap-3">
                <span class="mt-0.5">⚠️</span>
                <p>{{ session('error') }}</p>
            </div>
        @endif

        @if(empty($cart))
            {{-- حالت خالی بودن سبد --}}
            <div class="mt-6 rounded-2xl border border-dashed border-gray-300 bg-white px-6 py-10 text-center">
                <div class="mx-auto mb-4 h-12 w-12 rounded-full bg-gray-100 flex items-center justify-center text-gray-400 text-2xl">
                    🛒
                </div>
                <h2 class="text-base font-semibold text-gray-900 mb-1">
                    سبد خرید شما خالی است
                </h2>
                <p class="text-sm text-gray-500 mb-5">
                    برای شروع خرید، به صفحه محصولات بروید و محصولات مورد نظر خود را به سبد اضافه کنید.
                </p>
                <a href="{{ route('products.index') }}"
                   class="inline-flex items-center justify-center rounded-lg bg-indigo-600 px-4 py-2.5 text-sm font-medium text-white shadow-sm hover:bg-indigo-700">
                    رفتن به فروشگاه
                </a>
            </div>
        @else
            {{-- محتوای سبد --}}
            <div class="grid grid-cols-1 xl:grid-cols-[minmax(0,2fr),minmax(260px,1fr)] gap-6">
                {{-- جدول اقلام سبد --}}
                <div class="rounded-2xl bg-white shadow-sm ring-1 ring-gray-100 overflow-hidden">
                    <div class="border-b border-gray-100 bg-gray-50/70 px-4 py-3">
                        <h2 class="text-sm font-semibold text-gray-800">
                            اقلام موجود در سبد
                        </h2>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-100">
                            <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-4 py-3 text-right text-xs font-semibold text-gray-500">
                                    محصول
                                </th>
                                <th scope="col" class="px-4 py-3 text-right text-xs font-semibold text-gray-500">
                                    قیمت واحد
                                </th>
                                <th scope="col" class="px-4 py-3 text-center text-xs font-semibold text-gray-500">
                                    تعداد
                                </th>
                                <th scope="col" class="px-4 py-3 text-right text-xs font-semibold text-gray-500">
                                    جمع
                                </th>
                                <th scope="col" class="px-4 py-3 text-center text-xs font-semibold text-gray-500">
                                    عملیات
                                </th>
                            </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100 bg-white">
                            @foreach($cart as $productId => $item)
                                @php
                                    $lineTotal = $item['price'] * $item['quantity'];
                                @endphp
                                <tr>
                                    {{-- محصول --}}
                                    <td class="px-4 py-4 align-top">
                                        <div class="flex items-start gap-3">
                                            <a href="{{ route('products.show', $item['slug']) }}"
                                               class="block h-16 w-16 flex-shrink-0 overflow-hidden rounded-xl border border-gray-100 bg-gray-50">
                                                <img
                                                    src="{{ $item['image'] }}"
                                                    alt="{{ $item['name'] }}"
                                                    class="h-full w-full object-cover"
                                                >
                                            </a>
                                            <div class="space-y-1">
                                                <a href="{{ route('products.show', $item['slug']) }}"
                                                   class="text-sm font-semibold text-gray-900 hover:text-indigo-600 line-clamp-2">
                                                    {{ $item['name'] }}
                                                </a>
                                                <p class="text-xs text-gray-500">
                                                    موجودی: {{ $item['stock'] }}
                                                </p>
                                            </div>
                                        </div>
                                    </td>

                                    {{-- قیمت واحد --}}
                                    <td class="px-4 py-4 align-top text-sm text-gray-700 whitespace-nowrap">
                                        <div class="text-sm font-semibold text-gray-900">
                                            {{ number_format($item['price']) }}
                                            <span class="text-xs font-normal text-gray-500">تومان</span>
                                        </div>
                                    </td>

                                    {{-- تعداد --}}
                                    <td class="px-4 py-4 align-top">
                                        <form action="{{ route('cart.update', $item['product_id']) }}" method="POST"
                                                      class="flex items-center justify-center gap-2">
                                            @csrf
                                            @method('PATCH')

                                            <button type="button"
                                                    class="inline-flex h-8 w-8 items-center justify-center rounded-full border border-gray-200 bg-white text-gray-600 text-sm font-medium hover:bg-gray-50"
                                                    onclick="var input = this.parentElement.querySelector('input[name=quantity]'); var val = parseInt(input.value) || 1; if(val > 1){ input.value = val - 1; this.form.submit(); }">
                                                -
                                            </button>

                                            <input type="number"
                                                   name="quantity"
                                                   min="1"
                                                   max="{{ $item['stock'] }}"
                                                   value="{{ $item['quantity'] }}"
                                                   class="w-16 rounded-md border-gray-200 text-center text-sm focus:border-indigo-500 focus:ring-indigo-500">

                                            <button type="button"
                                                    class="inline-flex h-8 w-8 items-center justify-center rounded-full border border-gray-200 bg-white text-gray-600 text-sm font-medium hover:bg-gray-50"
                                                    onclick="var input = this.parentElement.querySelector('input[name=quantity]'); var val = parseInt(input.value) || 1; if(val < {{ $item['stock'] }}){ input.value = val + 1; this.form.submit(); }">
                                                +
                                            </button>
                                        </form>

                                        @if($item['quantity'] >= $item['stock'])
                                            <p class="mt-1 text-[11px] text-amber-600 text-center">
                                                حداکثر موجودی این محصول در سبد شما است.
                                            </p>
                                        @endif
                                    </td>

                                    {{-- جمع --}}
                                    <td class="px-4 py-4 align-top text-right text-sm text-gray-900 whitespace-nowrap">
                                        <div class="font-semibold">
                                            {{ number_format($lineTotal) }}
                                            <span class="text-xs font-normal text-gray-500">تومان</span>
                                        </div>
                                    </td>

                                    {{-- عملیات --}}
                                    <td class="px-4 py-4 align-top text-center">
                                        <form action="{{ route('cart.remove', $item['product_id']) }}" method="POST"
                                              onsubmit="return confirm('این محصول از سبد حذف شود؟');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="inline-flex items-center justify-center rounded-full border border-red-100 bg-red-50 px-3 py-1.5 text-xs font-medium text-red-700 hover:bg-red-100 hover:border-red-200">
                                                حذف
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- خلاصه سبد خرید / رفتن به تسویه حساب --}}
                <aside class="space-y-4">
                    <div class="rounded-2xl bg-white shadow-sm ring-1 ring-gray-100 p-5">
                        <h2 class="text-sm font-semibold text-gray-900 mb-4">
                            خلاصه سبد خرید
                        </h2>

                        <dl class="space-y-2 text-sm">
                            <div class="flex items-center justify-between">
                                <dt class="text-gray-500">جمع جزء</dt>
                                <dd class="font-semibold text-gray-900">
                                    {{ number_format($subtotal) }}
                                    <span class="text-xs font-normal text-gray-500">تومان</span>
                                </dd>
                            </div>

                            <div class="border-t border-dashed border-gray-200 pt-3 mt-2 flex items-center justify-between">
                                <dt class="text-gray-700 font-semibold">مبلغ قابل پرداخت</dt>
                                <dd class="text-base font-extrabold text-gray-900">
                                    {{ number_format($subtotal) }}
                                    <span class="text-xs font-medium text-gray-500">تومان</span>
                                </dd>
                            </div>
                        </dl>

                        <div class="mt-5 space-y-2">
                            <a href="{{ route('checkout.show') }}"
                               class="inline-flex w-full items-center justify-center rounded-lg bg-indigo-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-700 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500 focus-visible:ring-offset-2 focus-visible:ring-offset-gray-50">
                                ادامه و ثبت سفارش
                            </a>
                            <p class="text-[11px] text-gray-500 text-center">
                                با ادامه فرایند، اطلاعات ارسال و پرداخت خود را در مرحله بعد وارد خواهید کرد.
                            </p>
                        </div>
                    </div>

                    <div class="rounded-2xl border border-gray-100 bg-gray-50/60 px-4 py-3 text-xs text-gray-500">
                        <p>
                            موجودی محصولات در هنگام نهایی کردن سفارش دوباره بررسی می‌شود. ممکن است در صورت اتمام موجودی، برخی اقلام به صورت خودکار از سبد شما حذف شوند.
                        </p>
                    </div>
                </aside>
            </div>
        @endif
    </section>
@endsection
