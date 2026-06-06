{{-- resources/views/layouts/store.blade.php --}}
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', 'فروشگاه')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50 text-slate-800 antialiased">

    {{-- Top Navbar --}}
    <header class="bg-white/90 backdrop-blur shadow-sm sticky top-0 z-30">
        <nav class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16 gap-4">

                {{-- Logo / Brand --}}
                <div class="flex items-center gap-2">
                    <a href="{{ route('products.index') }}" class="flex items-center gap-2">
                        <div class="h-9 w-9 rounded-xl bg-indigo-600 flex items-center justify-center text-white font-bold text-lg shadow-sm">
                            P
                        </div>
                        <div class="flex flex-col">
                            <span class="text-sm font-semibold text-slate-900">P-Shop</span>
                            <span class="text-[11px] text-slate-500 -mt-1">فروشگاه ساده شما</span>
                        </div>
                    </a>
                </div>

                {{-- Center search (اختیاری: می‌تونی بعدا واقعاً سرچ را به آن وصل کنی) --}}
                <div class="hidden md:flex flex-1 max-w-md">
                    <form action="{{ route('products.index') }}" method="GET" class="w-full">
                        <div class="relative">
                            <input
                                type="text"
                                name="q"
                                value="{{ request('q') }}"
                                placeholder="جستجوی محصول، دسته‌بندی، برند..."
                                class="w-full rounded-xl border border-slate-200 bg-slate-50 py-2.5 pl-4 pr-9 text-sm focus:border-indigo-500 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-100"
                            >
                            <span class="absolute inset-y-0 right-2 flex items-center pointer-events-none text-slate-400">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M21 21l-4.35-4.35M10.5 18a7.5 7.5 0 100-15 7.5 7.5 0 000 15z" />
                                </svg>
                            </span>
                        </div>
                    </form>
                </div>

                {{-- Right: Cart + Auth --}}
                <div class="flex items-center gap-3">

                    {{-- Cart link (فرض: route('cart.index') و count($cartItems) در view share شده یا با session) --}}
                    <a href="{{ route('cart.index') }}"
                       class="relative flex items-center gap-2 rounded-xl border border-slate-200 bg-slate-50 px-3 py-1.5 text-xs font-medium text-slate-700 hover:bg-indigo-50 hover:border-indigo-200 transition">
                        <span class="text-slate-600">سبد خرید</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-slate-500" viewBox="0 0 24 24" fill="none"
                             stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="9" cy="21" r="1"></circle>
                            <circle cx="20" cy="21" r="1"></circle>
                            <path d="M1 1h4l2.68 12.39a1 1 0 0 0 .99.81h9.86a1 1 0 0 0 .98-.8L21 6H6"></path>
                        </svg>

                        @php
                            $cartCount = session('cart_count', 0);
                        @endphp

                        @if($cartCount > 0)
                            <span class="absolute -top-1 -left-1 h-4 min-w-[1rem] rounded-full bg-rose-500 px-1 text-[10px] text-white flex items-center justify-center">
                                {{ $cartCount }}
                            </span>
                        @endif
                    </a>

                    {{-- Auth links --}}
                    @auth
                        <a href="{{ route('profile.edit') }}"
                           class="hidden sm:inline-flex items-center rounded-full bg-slate-900 px-3 py-1.5 text-xs font-medium text-slate-50 hover:bg-slate-800 transition">
                            {{ auth()->user()->name }}
                        </a>
                    @else
                        <a href="{{ route('login') }}"
                           class="text-xs font-medium text-slate-600 hover:text-slate-900">
                            ورود
                        </a>
                        <a href="{{ route('register') }}"
                           class="hidden sm:inline-flex items-center rounded-full bg-indigo-600 px-3 py-1.5 text-xs font-medium text-white shadow-sm hover:bg-indigo-500 transition">
                            ثبت‌نام
                        </a>
                    @endauth
                </div>
            </div>

            {{-- Mobile search (زیر نوار بالا) --}}
            <div class="md:hidden pb-3">
                <form action="{{ route('products.index') }}" method="GET" class="w-full">
                    <div class="relative">
                        <input
                            type="text"
                            name="q"
                            value="{{ request('q') }}"
                            placeholder="جستجوی محصول..."
                            class="w-full rounded-xl border border-slate-200 bg-slate-50 py-2.5 pl-4 pr-9 text-xs focus:border-indigo-500 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-100"
                        >
                        <span class="absolute inset-y-0 right-2 flex items-center pointer-events-none text-slate-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M21 21l-4.35-4.35M10.5 18a7.5 7.5 0 100-15 7.5 7.5 0 000 15z" />
                            </svg>
                        </span>
                    </div>
                </form>
            </div>
        </nav>
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
