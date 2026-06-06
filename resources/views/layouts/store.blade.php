{{-- resources/views/layouts/store.blade.php --}}
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://cdn.jsdelivr.net/gh/rastikerdar/vazirmatn@v33.003/Vazirmatn-font-face.css" rel="stylesheet" type="text/css" />

    <title>@yield('title', 'فروشگاه')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @auth
    <form method="POST" action="{{ route('logout') }}" class="inline">
        @csrf
        <button
            type="submit"
            class="inline-flex items-center rounded-lg border border-gray-200 bg-white px-3 py-1.5 text-xs font-medium text-gray-700 hover:bg-gray-50"
        >
            خروج از حساب
        </button>
    </form>
@endauth
</head>
<body class="bg-slate-50 text-slate-800 antialiased">

    {{-- Top Navbar --}}
    <header class="bg-white/90 backdrop-blur shadow-sm sticky top-0 z-30">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <nav class="flex items-center justify-between gap-4 h-16">

            {{-- بخش راست: لوگو و لینک‌های اصلی --}}
            <div class="flex items-center gap-6">
                {{-- لوگو / برند --}}
                <a href="{{ route('products.index') }}" class="flex items-center gap-2">
                    <div class="h-9 w-9 rounded-2xl bg-indigo-600 text-white flex items-center justify-center text-lg font-bold shadow-sm">
                        P
                    </div>
                    <div class="flex flex-col">
                        <span class="text-base font-semibold text-slate-900">
                            {{ config('app.name', 'P-Shop') }}
                        </span>
                        <span class="text-xs text-slate-500">
                            فروشگاه ساده شما
                        </span>
                    </div>
                </a>

                {{-- لینک‌های اصلی (دسکتاپ) --}}
                <div class="hidden md:flex items-center gap-4 text-sm font-medium text-slate-600">
                    <a href="{{ route('products.index') }}" class="hover:text-indigo-600">
                        محصولات
                    </a>
                    <a href="{{ route('cart.index') }}" class="hover:text-indigo-600">
                        سبد خرید
                    </a>
                    @auth
                        <a href="{{ route('orders.index') }}" class="hover:text-indigo-600">
                            سفارش‌های من
                        </a>
                    @endauth
                </div>
            </div>

            {{-- وسط: سرچ دسکتاپ --}}
            <div class="hidden md:flex flex-1 max-w-md">
                <form action="{{ route('products.index') }}" method="GET" class="w-full">
                    <label for="search" class="sr-only">جستجوی محصولات</label>
                    <div class="relative">
                        <input
                            type="text"
                            name="q"
                            id="search"
                            value="{{ request('q') }}"
                            class="block w-full rounded-xl border border-slate-200 bg-slate-50/60 px-3 py-2 text-sm text-slate-800 placeholder-slate-400 shadow-sm focus:border-indigo-500 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20"
                            placeholder="جستجوی محصولات..."
                        >
                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                            <svg class="h-4 w-4 text-slate-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                                 viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M21 21l-4.35-4.35M17.25 10.5A6.75 6.75 0 1 1 3.75 10.5a6.75 6.75 0 0 1 13.5 0Z"/>
                            </svg>
                        </div>
                    </div>
                </form>
            </div>

            {{-- بخش چپ: سبد خرید + وضعیت کاربر --}}
            <div class="flex items-center gap-3">

                {{-- دکمه سبد خرید --}}
                <a href="{{ route('cart.index') }}"
                   class="relative inline-flex items-center justify-center rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm font-medium text-slate-700 hover:bg-slate-50 hover:border-slate-300 transition-all duration-150">
                    <svg class="h-5 w-5 text-slate-500" xmlns="http://www.w3.org/2000/svg" fill="none"
                         viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M2.25 3h1.386c.51 0 .955.343 1.087.835L5.91 8.25m0 0L7.5 15.75h9l1.59-7.5m-12.18 0h12.18M9 19.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm9 0a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z"/>
                    </svg>
                    <span class="mr-2 hidden sm:inline">سبد خرید</span>
                    @php
                        $cartCount = session('cart_count', 0);
                    @endphp
                    @if($cartCount > 0)
                        <span class="absolute -top-1 -right-1 min-w-[1.25rem] rounded-full bg-red-500 px-1.5 py-0.5 text-xs font-bold text-white text-center">
                            {{ $cartCount }}
                        </span>
                    @endif
                </a>

                {{-- وضعیت کاربر: ورود/ثبت‌نام یا نام کاربر + خروج --}}
                @auth
                    <div class="flex items-center gap-2">
                        <a href="{{ route('profile.edit') }}"
                           class="hidden sm:inline-flex items-center text-sm text-slate-700 hover:text-indigo-600">
                            <span class="ml-1 text-xs text-slate-400">حساب کاربری</span>
                            <span class="font-medium">{{ auth()->user()->name }}</span>
                        </a>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                    class="inline-flex items-center justify-center rounded-lg border border-red-100 bg-white px-3 py-1.5 text-xs font-medium text-red-600 hover:bg-red-50 hover:border-red-200 transition-all duration-150">
                                خروج
                            </button>
                        </form>
                    </div>
                @else
                    <div class="flex items-center gap-2">
                        <a href="{{ route('login') }}"
                           class="text-sm font-medium text-slate-600 hover:text-indigo-600">
                            ورود
                        </a>
                        <a href="{{ route('register') }}"
                           class="inline-flex items-center justify-center rounded-lg bg-indigo-600 px-3 py-1.5 text-xs font-medium text-white hover:bg-indigo-700 shadow-sm transition-all duration-150">
                            ثبت‌نام
                        </a>
                    </div>
                @endauth

            </div>
        </nav>

        {{-- سرچ موبایل زیر نوار اصلی --}}
        <div class="md:hidden pb-3">
            <form action="{{ route('products.index') }}" method="GET" class="w-full">
                <label for="mobile-search" class="sr-only">جستجوی محصولات</label>
                <div class="relative">
                    <input
                        type="text"
                        name="q"
                        id="mobile-search"
                        value="{{ request('q') }}"
                        class="block w-full rounded-xl border border-slate-200 bg-slate-50/60 px-3 py-2 text-sm text-slate-800 placeholder-slate-400 shadow-sm focus:border-indigo-500 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500/20"
                        placeholder="جستجوی محصولات..."
                    >
                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                        <svg class="h-4 w-4 text-slate-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                             viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M21 21l-4.35-4.35M17.25 10.5A6.75 6.75 0 1 1 3.75 10.5a6.75 6.75 0 0 1 13.5 0Z"/>
                        </svg>
                    </div>
                </div>
            </form>
        </div>
    </div>
</header>


    {{-- Page content --}}
    <main class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-6 sm:py-8 lg:py-10">
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="border-t border-slate-200 bg-white mt-8">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex flex-col sm:flex-row items-center justify-between gap-2 text-xs text-slate-500">
            <p>© {{ now()->year }} P-Shop. تمامی حقوق محفوظ است.</p>
            <p class="flex items-center gap-1">
                ساخته‌شده با
                <span class="text-rose-500">♥</span>
                با لاراول
            </p>
        </div>
    </footer>

</body>
</html>
