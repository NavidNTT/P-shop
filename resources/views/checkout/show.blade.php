@extends('layouts.store')

@section('title', 'تسویه حساب')

@section('content')
    <section class="space-y-6">
        {{-- سربرگ صفحه --}}
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-xl sm:text-2xl font-bold text-gray-900">
                    تسویه حساب
                </h1>
                <p class="mt-1 text-sm text-gray-500">
                    مبلغ سفارش شما در این مرحله بررسی می‌شود و در صورت تأیید، سفارش ثبت خواهد شد.
                </p>
            </div>

            <a href="{{ route('cart.index') }}"
               class="inline-flex items-center justify-center rounded-lg border border-gray-200 bg-white px-3.5 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 hover:border-gray-300">
                بازگشت به سبد خرید
            </a>
        </div>

        {{-- پیام‌های خطا / موفقیت --}}
        @if (session('error'))
            <div class="rounded-xl border border-red-100 bg-red-50 px-4 py-3 text-sm text-red-800 flex items-start gap-3">
                <span class="mt-0.5">⚠️</span>
                <p>{{ session('error') }}</p>
            </div>
        @endif

        @if (session('success'))
            <div class="rounded-xl border border-green-100 bg-green-50 px-4 py-3 text-sm text-green-800 flex items-start gap-3">
                <span class="mt-0.5">✅</span>
                <p>{{ session('success') }}</p>
            </div>
        @endif

        {{-- محتوای اصلی تسویه حساب --}}
        <div class="grid grid-cols-1 lg:grid-cols-[minmax(0,2fr),minmax(280px,1fr)] gap-6">
            {{-- توضیحات و نکات --}}
            <div class="space-y-4">
                <div class="rounded-2xl bg-white shadow-sm ring-1 ring-gray-100 p-5">
                    <h2 class="text-sm font-semibold text-gray-900 mb-3">
                        مرحله نهایی ثبت سفارش
                    </h2>
                    <div class="space-y-2 text-sm text-gray-600 leading-relaxed">
                        <p>
                            در این مرحله، با تأیید نهایی، سفارش شما ثبت می‌شود و اطلاعات سبد خرید شما ذخیره می‌گردد.
                        </p>
                        <p>
                            در صورت بروز هرگونه مشکل در موجودی کالاها، نتیجه به صورت پیام خطا به شما نمایش داده خواهد شد و سبد خرید به‌روزرسانی می‌شود.
                        </p>
                        <p class="text-xs text-gray-500">
                            توجه: این نسخه از فروشگاه فاقد فرم آدرس و پرداخت آنلاین است و صرفاً برای ثبت سفارش ساده طراحی شده است.
                        </p>
                    </div>
                </div>
            </div>

            {{-- خلاصه مبلغ و دکمه ثبت سفارش --}}
            <aside class="space-y-4">
                <div class="rounded-2xl bg-white shadow-sm ring-1 ring-gray-100 p-5">
                    <h2 class="text-sm font-semibold text-gray-900 mb-4">
                        خلاصه پرداخت
                    </h2>

                    <dl class="space-y-3 text-sm">
                        <div class="flex items-center justify-between">
                            <dt class="text-gray-500">
                                مبلغ قابل پرداخت
                            </dt>
                            <dd class="text-base font-extrabold text-gray-900">
                                {{ number_format($subtotal) }}
                                <span class="text-xs font-medium text-gray-500">تومان</span>
                            </dd>
                        </div>
                    </dl>

                    <form action="{{ route('checkout.store') }}" method="POST"
                          class="mt-5 space-y-2"
                          onsubmit="return confirm('آیا از ثبت این سفارش اطمینان دارید؟');">
                        @csrf

                        <button type="submit"
                                class="inline-flex w-full items-center justify-center rounded-lg bg-indigo-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-700 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-indigo-500 focus-visible:ring-offset-2 focus-visible:ring-offset-gray-50">
                            ثبت نهایی سفارش
                        </button>

                        <p class="text-[11px] text-gray-500 text-center">
                            با کلیک روی دکمه بالا، سفارش شما در سیستم ثبت می‌شود و از طریق بخش
                            «سفارش‌های من» قابل پیگیری خواهد بود.
                        </p>
                    </form>
                </div>

                <div class="rounded-2xl border border-gray-100 bg-gray-50/60 px-4 py-3 text-xs text-gray-500">
                    <p>
                        پس از ثبت سفارش، امکان ویرایش مستقیم آن وجود ندارد. در صورت نیاز به تغییر، می‌توانید سفارش را لغو کرده و سفارش جدیدی ثبت کنید (در صورت پیاده‌سازی این قابلیت در نسخه‌های بعدی).
                    </p>
                </div>
            </aside>
        </div>
    </section>
@endsection
