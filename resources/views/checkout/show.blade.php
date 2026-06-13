@extends('layouts.store')

@section('title', 'تسویه حساب')

@section('content')
    <section class="space-y-8 max-w-5xl mx-auto">
        {{-- Premium Page Header --}}
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between bg-white p-6 sm:p-8 rounded-[2rem] shadow-sm border border-slate-100">
            <div>
                <h1 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight">
                    تسویه حساب
                </h1>
                <p class="mt-2 text-sm font-bold text-slate-500">
                    مبلغ سفارش شما در این مرحله بررسی می‌شود و در صورت تأیید، سفارش نهایی خواهد شد.
                </p>
            </div>

            <a href="{{ route('cart.index') }}"
               class="inline-flex items-center justify-center rounded-2xl border-2 border-slate-200 bg-white px-6 py-3 text-sm font-bold text-slate-600 shadow-sm hover:bg-slate-50 hover:border-indigo-500 hover:text-indigo-600 transition-all duration-300">
                بازگشت به سبد خرید
            </a>
        </div>

        {{-- Alerts --}}
        @if (session('error'))
            <div class="rounded-2xl border border-rose-100 bg-rose-50 px-6 py-4 text-sm font-bold text-rose-800 flex items-center gap-4 shadow-sm">
                <div class="bg-rose-500 text-white p-1.5 rounded-xl shadow-md shadow-rose-500/30">
                     <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>
                </div>
                <p>{{ session('error') }}</p>
            </div>
        @endif

        @if (session('success'))
            <div class="rounded-2xl border border-emerald-100 bg-emerald-50 px-6 py-4 text-sm font-bold text-emerald-800 flex items-center gap-4 shadow-sm">
                 <div class="bg-emerald-500 text-white p-1.5 rounded-xl shadow-md shadow-emerald-500/30">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" /></svg>
                </div>
                <p>{{ session('success') }}</p>
            </div>
        @endif

        {{-- Main Checkout Content --}}
        <div class="grid grid-cols-1 lg:grid-cols-[minmax(0,2fr),minmax(320px,1.2fr)] gap-8">
            
            {{-- Information and Terms --}}
            <div class="space-y-6">
                <div class="rounded-[2rem] bg-white shadow-[0_8px_30px_-15px_rgba(0,0,0,0.05)] border border-slate-100 p-8 sm:p-10 relative overflow-hidden">
                    <div class="absolute -right-4 -top-4 w-24 h-24 bg-indigo-50 rounded-full blur-2xl opacity-70"></div>
                    <div class="relative z-10">
                        <div class="flex items-center gap-3 mb-6">
                            <span class="w-2 h-8 rounded-full bg-indigo-500 block"></span>
                            <h2 class="text-xl font-black text-slate-900">
                                اطلاعات و شرایط ثبت نهایی
                            </h2>
                        </div>
                        
                        <div class="space-y-4 text-[15px] font-medium text-slate-600 leading-loose">
                            <p class="flex items-start gap-3">
                                <svg class="w-5 h-5 text-indigo-500 flex-shrink-0 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                در این مرحله، با تأیید نهایی، سفارش شما در سیستم ثبت می‌شود و فاکتور نهایی صادر می‌گردد.
                            </p>
                            <p class="flex items-start gap-3">
                                <svg class="w-5 h-5 text-indigo-500 flex-shrink-0 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                در صورت اتمام موجودی برخی کالاها در لحظه ثبت، سیستم بصورت خودکار به شما هشدار داده و سبد خریدتان را به‌روزرسانی می‌کند.
                            </p>
                            <div class="mt-8 p-5 bg-rose-50/50 rounded-2xl border border-rose-100">
                                <p class="text-sm font-bold text-rose-600">
                                    توجه: این فروشگاه در حال حاضر برای پرداخت آنلاین و ثبت آدرس نیازی به پر کردن فرم‌های اضافی ندارد و سفارش شما به صورت پیش‌فرض (تستی) نهایی خواهد شد.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Order Summary & Submit --}}
            <aside class="space-y-6">
                <div class="rounded-[2rem] bg-white shadow-[0_8px_30px_-15px_rgba(0,0,0,0.05)] border border-slate-100 p-8 relative overflow-hidden">
                    <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-indigo-500 to-violet-500"></div>

                    <h2 class="text-xl font-black text-slate-900 mb-8">
                        خلاصه فاکتور
                    </h2>

                    <dl class="space-y-5 text-sm mb-8">
                        <div class="flex items-center justify-between pb-5 border-b border-dashed border-slate-100">
                            <dt class="text-slate-500 font-bold">
                                تعداد اقلام
                            </dt>
                            <dd class="text-base font-black text-slate-900 bg-slate-50 px-3 py-1 rounded-lg">
                                {{ session('cart_count', 0) }} قلم
                            </dd>
                        </div>
                        <div class="flex items-center justify-between">
                            <dt class="text-slate-900 text-base font-black uppercase tracking-wide">
                                مبلغ نهایی
                            </dt>
                            <dd class="text-left flex items-baseline gap-1">
                                <span class="text-3xl font-black text-indigo-600 tracking-tight">{{ number_format($subtotal) }}</span>
                                <span class="text-xs font-bold text-slate-500">تومان</span>
                            </dd>
                        </div>
                    </dl>

                    <form action="{{ route('checkout.store') }}" method="POST"
                          class="mt-8 space-y-4"
                          onsubmit="return confirm('آیا از ثبت این سفارش اطمینان دارید؟');">
                        @csrf

                        <button type="submit"
                                class="group relative w-full inline-flex items-center justify-center rounded-2xl bg-indigo-600 px-6 py-4 text-base font-black text-white shadow-xl shadow-indigo-600/30 hover:bg-indigo-500 hover:shadow-indigo-600/40 transition-all duration-300 transform hover:-translate-y-1 overflow-hidden">
                            <span class="relative z-10">تأیید نهایی و ثبت سفارش</span>
                            <div class="absolute inset-0 bg-gradient-to-r from-indigo-500 to-violet-500 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                        </button>

                        <p class="text-xs font-bold text-slate-400 text-center leading-relaxed px-2">
                            با ثبت سفارش، اطلاعات آن در بخش «سفارش‌های من» پنل کاربری قابل مشاهده خواهد بود.
                        </p>
                    </form>
                </div>

                <div class="rounded-2xl border border-indigo-100 bg-indigo-50/50 px-5 py-4 text-xs font-bold text-indigo-800 leading-relaxed shadow-sm">
                    <p class="flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        پس از تأیید نهایی، امکان ویرایش این سفارش از طریق سایت وجود نخواهد داشت.
                    </p>
                </div>
            </aside>
        </div>
    </section>
@endsection
