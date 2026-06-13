{{-- resources/views/layouts/store.blade.php --}}
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/gh/rastikerdar/vazirmatn@v33.003/Vazirmatn-font-face.css" rel="stylesheet" type="text/css" />

    <title>@yield('title', config('app.name', 'P-Shop') . ' - فروشگاه برتر')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50/50 text-slate-800 antialiased flex flex-col min-h-screen selection:bg-indigo-500 selection:text-white">

    {{-- Premium Top Navbar --}}
    <header class="bg-white/80 backdrop-blur-xl shadow-[0_4px_30px_-10px_rgba(0,0,0,0.05)] sticky top-0 z-50 border-b border-white/20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <nav class="flex items-center justify-between gap-6 h-24">

                {{-- Right: Logo & Links --}}
                <div class="flex items-center gap-10">
                    {{-- Logo --}}
                    <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                        <div class="relative w-12 h-12 flex items-center justify-center">
                            <div class="absolute inset-0 bg-gradient-to-tr from-indigo-600 to-violet-500 rounded-2xl transform rotate-3 group-hover:rotate-6 transition-transform duration-300 shadow-lg shadow-indigo-500/30"></div>
                            <span class="relative text-white font-black text-2xl drop-shadow-md">P</span>
                        </div>
                        <div class="hidden sm:flex flex-col">
                            <span class="text-xl font-black text-slate-900 tracking-tight leading-none group-hover:text-indigo-600 transition-colors">
                                {{ config('app.name', 'P-Shop') }}
                            </span>
                            <span class="text-xs font-bold text-slate-400 tracking-widest uppercase mt-1">
                                EXPERIENCED
                            </span>
                        </div>
                    </a>

                    {{-- Main Links (Desktop) --}}
                    <div class="hidden md:flex items-center gap-8 text-[15px] font-bold">
                        <a href="{{ route('home') }}" class="relative group py-2 text-slate-600 hover:text-indigo-600 transition-colors {{ request()->routeIs('home') ? 'text-indigo-600' : '' }}">
                            خانه
                            <span class="absolute bottom-0 left-0 w-full h-0.5 bg-indigo-600 transform scale-x-0 group-hover:scale-x-100 transition-transform origin-right {{ request()->routeIs('home') ? 'scale-x-100' : '' }}"></span>
                        </a>
                        <a href="{{ route('products.index') }}" class="relative group py-2 text-slate-600 hover:text-indigo-600 transition-colors {{ request()->routeIs('products.*') ? 'text-indigo-600' : '' }}">
                            محصولات
                            <span class="absolute bottom-0 left-0 w-full h-0.5 bg-indigo-600 transform scale-x-0 group-hover:scale-x-100 transition-transform origin-right {{ request()->routeIs('products.*') ? 'scale-x-100' : '' }}"></span>
                        </a>
                    </div>
                </div>

                {{-- Center: Search Bar --}}
                <div class="hidden lg:flex flex-1 max-w-xl">
                    <form action="{{ route('products.index') }}" method="GET" class="w-full relative group">
                        <div class="absolute inset-0 bg-gradient-to-r from-indigo-500 to-violet-500 rounded-2xl blur opacity-0 group-focus-within:opacity-20 transition-opacity duration-300"></div>
                        <input
                            type="text"
                            name="q"
                            value="{{ request('q') }}"
                            class="relative block w-full rounded-2xl border-0 bg-slate-100/80 py-3.5 pl-4 pr-12 text-sm text-slate-900 font-medium placeholder-slate-400 ring-1 ring-inset ring-slate-200 focus:bg-white focus:ring-2 focus:ring-inset focus:ring-indigo-500 transition-all duration-300 shadow-inner"
                            placeholder="جستجوی محصول، برند یا دسته بندی..."
                        >
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-4">
                            <svg class="h-5 w-5 text-slate-400 group-focus-within:text-indigo-600 transition-colors duration-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M17.25 10.5A6.75 6.75 0 1 1 3.75 10.5a6.75 6.75 0 0 1 13.5 0Z"/>
                            </svg>
                        </div>
                        <button type="submit" class="hidden"></button>
                    </form>
                </div>

                {{-- Left: Cart & User --}}
                <div class="flex items-center gap-5">

                    {{-- Cart Button --}}
                    <a href="{{ route('cart.index') }}" class="relative group flex items-center justify-center w-12 h-12 rounded-2xl hover:bg-indigo-50 transition-colors">
                        <svg class="h-6 w-6 text-slate-700 group-hover:text-indigo-600 transition-colors" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                        </svg>
                        @php
                            $cartCount = session('cart_count', 0);
                        @endphp
                        @if($cartCount > 0)
                            <span class="absolute top-1.5 right-1.5 flex items-center justify-center min-w-[20px] h-[20px] rounded-full bg-gradient-to-tr from-rose-500 to-pink-500 text-[11px] font-black text-white shadow-md shadow-rose-500/30 ring-2 ring-white transform group-hover:scale-110 transition-transform">
                                {{ $cartCount }}
                            </span>
                        @endif
                    </a>

                    <div class="h-8 w-px bg-slate-200 hidden sm:block"></div>

                    {{-- User Status --}}
                    @auth
                        <div class="relative group hidden sm:block">
                            <button class="flex items-center gap-3 p-1.5 rounded-2xl hover:bg-slate-50 transition-colors border border-transparent hover:border-slate-100">
                                <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-indigo-100 to-violet-100 text-indigo-700 flex items-center justify-center font-black text-base border border-indigo-200/50 shadow-inner">
                                    {{ mb_substr(auth()->user()->name, 0, 1) }}
                                </div>
                                <div class="flex flex-col items-start">
                                    <span class="text-[11px] font-bold text-slate-400 uppercase tracking-wide">پنل کاربری</span>
                                    <span class="text-sm font-bold text-slate-800">{{ auth()->user()->name }}</span>
                                </div>
                                <svg class="h-4 w-4 text-slate-400 ml-1 group-hover:text-indigo-500 transition-colors" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                                </svg>
                            </button>
                            
                            {{-- Premium Dropdown Menu --}}
                            <div class="absolute left-0 mt-3 w-56 rounded-2xl bg-white p-2 shadow-[0_20px_40px_-15px_rgba(0,0,0,0.1)] ring-1 ring-slate-100 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 origin-top-left transform scale-95 group-hover:scale-100 z-50">
                                <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 px-4 py-3 text-sm font-bold text-slate-700 rounded-xl hover:bg-indigo-50 hover:text-indigo-700 transition-colors">
                                    <svg class="w-5 h-5 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                    حساب کاربری
                                </a>
                                <a href="{{ route('orders.index') }}" class="flex items-center gap-3 px-4 py-3 text-sm font-bold text-slate-700 rounded-xl hover:bg-indigo-50 hover:text-indigo-700 transition-colors mt-1">
                                    <svg class="w-5 h-5 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                                    سفارش‌های من
                                </a>
                                <div class="my-2 border-t border-slate-100"></div>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 text-sm font-bold text-rose-600 rounded-xl hover:bg-rose-50 transition-colors">
                                        <svg class="w-5 h-5 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                                        خروج از سیستم
                                    </button>
                                </form>
                            </div>
                        </div>

                        {{-- Mobile Menu Trigger for Auth User --}}
                        <div class="sm:hidden flex items-center">
                             <a href="{{ route('profile.edit') }}" class="flex items-center justify-center w-12 h-12 rounded-2xl text-slate-700 hover:bg-slate-100 transition-colors">
                                 <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                             </a>
                        </div>
                    @else
                        <div class="flex items-center gap-3">
                            <a href="{{ route('login') }}" class="hidden sm:inline-flex px-5 py-2.5 text-sm font-bold text-slate-700 hover:text-indigo-600 hover:bg-indigo-50 rounded-xl transition-colors">
                                ورود
                            </a>
                            <a href="{{ route('register') }}" class="inline-flex items-center justify-center rounded-xl bg-gradient-to-r from-indigo-600 to-violet-600 px-6 py-2.5 text-sm font-bold text-white shadow-lg shadow-indigo-500/30 hover:shadow-indigo-500/50 transition-all duration-300 hover:-translate-y-0.5">
                                ثبت‌نام
                            </a>
                        </div>
                    @endauth

                </div>
            </nav>

            {{-- Mobile Search --}}
            <div class="lg:hidden pb-4">
                <form action="{{ route('products.index') }}" method="GET" class="w-full relative">
                    <input
                        type="text"
                        name="q"
                        value="{{ request('q') }}"
                        class="block w-full rounded-2xl border-0 bg-slate-100 py-3.5 pl-4 pr-11 text-sm font-medium text-slate-900 placeholder-slate-500 focus:bg-white focus:ring-2 focus:ring-inset focus:ring-indigo-500 shadow-inner"
                        placeholder="جستجوی محصول..."
                    >
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-4">
                        <svg class="h-5 w-5 text-slate-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M17.25 10.5A6.75 6.75 0 1 1 3.75 10.5a6.75 6.75 0 0 1 13.5 0Z"/>
                        </svg>
                    </div>
                </form>
            </div>
        </div>
    </header>

    {{-- Main Content --}}
    <main class="flex-grow w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        @yield('content')
    </main>

    {{-- Premium Footer --}}
    <footer class="bg-white border-t border-slate-200 mt-auto relative overflow-hidden">
        {{-- Decorative top border gradient --}}
        <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-indigo-500 via-violet-500 to-indigo-500"></div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 relative z-10">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-12 mb-12">
                <div class="col-span-1 md:col-span-5 lg:col-span-4">
                    <a href="{{ route('home') }}" class="flex items-center gap-3 mb-6">
                        <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-indigo-600 to-violet-500 text-white flex items-center justify-center text-xl font-black shadow-lg shadow-indigo-500/30">P</div>
                        <span class="text-2xl font-black text-slate-900 tracking-tight">{{ config('app.name', 'P-Shop') }}</span>
                    </a>
                    <p class="text-slate-500 leading-relaxed font-medium mb-6">
                        فروشگاه اینترنتی پی‌شاپ با هدف ارائه بهترین و جدیدترین محصولات دنیا با بالاترین کیفیت و پشتیبانی ۲۴ ساعته در خدمت شماست. تجربه یک خرید امن، سریع و لذت‌بخش.
                    </p>
                    <div class="flex items-center gap-4">
                        {{-- Social placeholders --}}
                        <a href="#" class="w-10 h-10 rounded-full bg-slate-100 flex items-center justify-center text-slate-500 hover:bg-indigo-500 hover:text-white transition-all duration-300"><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/></svg></a>
                        <a href="#" class="w-10 h-10 rounded-full bg-slate-100 flex items-center justify-center text-slate-500 hover:bg-indigo-500 hover:text-white transition-all duration-300"><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg></a>
                    </div>
                </div>

                <div class="col-span-1 md:col-span-3 lg:col-span-2 lg:col-start-7">
                    <h3 class="text-base font-black text-slate-900 mb-6 uppercase tracking-wider">دسترسی سریع</h3>
                    <ul class="space-y-4 font-bold text-slate-500">
                        <li><a href="{{ route('home') }}" class="hover:text-indigo-600 transition-colors flex items-center gap-2"><span class="w-1 h-1 rounded-full bg-slate-300"></span> خانه</a></li>
                        <li><a href="{{ route('products.index') }}" class="hover:text-indigo-600 transition-colors flex items-center gap-2"><span class="w-1 h-1 rounded-full bg-slate-300"></span> محصولات</a></li>
                        <li><a href="{{ route('cart.index') }}" class="hover:text-indigo-600 transition-colors flex items-center gap-2"><span class="w-1 h-1 rounded-full bg-slate-300"></span> سبد خرید</a></li>
                    </ul>
                </div>

                <div class="col-span-1 md:col-span-4 lg:col-span-3">
                    <h3 class="text-base font-black text-slate-900 mb-6 uppercase tracking-wider">پشتیبانی و خدمات</h3>
                    <ul class="space-y-4 font-bold text-slate-500">
                        <li><a href="#" class="hover:text-indigo-600 transition-colors flex items-center gap-2"><span class="w-1 h-1 rounded-full bg-slate-300"></span> سوالات متداول</a></li>
                        <li><a href="#" class="hover:text-indigo-600 transition-colors flex items-center gap-2"><span class="w-1 h-1 rounded-full bg-slate-300"></span> پیگیری سفارش</a></li>
                        <li><a href="#" class="hover:text-indigo-600 transition-colors flex items-center gap-2"><span class="w-1 h-1 rounded-full bg-slate-300"></span> تماس با ما</a></li>
                        <li><a href="#" class="hover:text-indigo-600 transition-colors flex items-center gap-2"><span class="w-1 h-1 rounded-full bg-slate-300"></span> قوانین و مقررات</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="border-t border-slate-100 pt-8 flex flex-col md:flex-row items-center justify-between gap-6">
                <p class="text-sm font-bold text-slate-400">
                    © {{ now()->year }} <span class="text-slate-600">{{ config('app.name', 'P-Shop') }}</span>. تمامی حقوق محفوظ است.
                </p>
                <div class="flex items-center gap-2 text-sm font-bold text-slate-400 bg-slate-50 px-4 py-2 rounded-full">
                    توسعه یافته با 
                    <svg class="h-4 w-4 text-rose-500 animate-pulse" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path d="M9.653 16.915l-.005-.003-.019-.01a20.759 20.759 0 01-1.162-.682 22.045 22.045 0 01-2.582-1.9C4.045 12.733 2 10.352 2 7.5a4.5 4.5 0 018-2.828A4.5 4.5 0 0118 7.5c0 2.852-2.044 5.233-3.885 6.82a22.049 22.049 0 01-3.744 2.582l-.019.01-.005.003h-.002a.739.739 0 01-.69.001l-.002-.001z" /></svg> 
                    و قدرت <span class="text-rose-500">لاراول</span>
                </div>
            </div>
        </div>
    </footer>

</body>
</html>
