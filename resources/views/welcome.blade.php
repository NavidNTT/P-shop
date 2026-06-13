@extends('layouts.store')

@section('content')
    {{-- Premium Hero Section --}}
    <div class="relative rounded-[2rem] overflow-hidden bg-slate-900 mb-20 shadow-2xl">
        <div class="absolute inset-0">
            {{-- Modern gradient background --}}
            <div class="absolute inset-0 bg-gradient-to-r from-slate-900 via-slate-800 to-slate-900 z-10"></div>
            {{-- Abstract colorful glows --}}
            <div class="absolute -top-24 -right-24 w-96 h-96 bg-indigo-500/30 rounded-full blur-[80px] mix-blend-screen z-10 animate-pulse"></div>
            <div class="absolute -bottom-24 -left-24 w-96 h-96 bg-violet-500/30 rounded-full blur-[80px] mix-blend-screen z-10 animate-pulse delay-1000"></div>
            {{-- Grain texture overlay (simulated) --}}
            <div class="absolute inset-0 opacity-20 z-10" style="background-image: url('data:image/svg+xml,%3Csvg viewBox=%220 0 200 200%22 xmlns=%22http://www.w3.org/2000/svg%22%3E%3Cfilter id=%22noiseFilter%22%3E%3CfeTurbulence type=%22fractalNoise%22 baseFrequency=%220.65%22 numOctaves=%223%22 stitchTiles=%22stitch%22/%3E%3C/filter%3E%3Crect width=%22100%25%22 height=%22100%25%22 filter=%22url(%23noiseFilter)%22/%3E%3C/svg%3E');"></div>
        </div>

        <div class="relative z-20 flex flex-col lg:flex-row items-center justify-between p-8 sm:p-12 md:p-20">
            <div class="w-full lg:w-1/2 text-right relative z-30">
                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/10 border border-white/10 backdrop-blur-md mb-8">
                    <span class="flex h-2 w-2 rounded-full bg-emerald-400 animate-pulse"></span>
                    <span class="text-white/90 text-sm font-medium tracking-wide">فروش ویژه فصل آغاز شد</span>
                </div>
                
                <h1 class="text-4xl sm:text-5xl lg:text-7xl font-black text-white leading-[1.2] mb-6">
                    آینده خرید آنلاین <br/>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-400 to-violet-400">
                        همینجاست
                    </span>
                </h1>
                
                <p class="text-slate-300 text-lg sm:text-xl mb-10 leading-relaxed max-w-xl font-light">
                    تجربه خریدی لذت‌بخش با دسترسی به جدیدترین محصولات دنیا. کیفیت، اصالت و سرعت را با پی‌شاپ تجربه کنید.
                </p>
                
                <div class="flex flex-wrap items-center gap-5">
                    <a href="{{ route('products.index') }}" class="group relative inline-flex items-center justify-center rounded-2xl bg-white px-8 py-4 text-base font-bold text-slate-900 shadow-xl hover:shadow-indigo-500/20 transition-all duration-300 hover:-translate-y-1 overflow-hidden">
                        <span class="relative z-10 flex items-center">
                            مشاهده محصولات
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 transform group-hover:-translate-x-1 transition-transform" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </span>
                        <div class="absolute inset-0 bg-gradient-to-r from-indigo-50 to-violet-50 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                    </a>
                </div>
            </div>

            {{-- Modern Abstract Visual --}}
            <div class="hidden lg:flex w-full lg:w-1/2 justify-end relative mt-12 lg:mt-0">
                <div class="relative w-[450px] h-[450px] flex items-center justify-center">
                    <div class="absolute inset-0 rounded-full border border-white/10 animate-[spin_60s_linear_infinite]"></div>
                    <div class="absolute inset-8 rounded-full border border-white/5 animate-[spin_40s_linear_infinite_reverse]"></div>
                    
                    <div class="relative z-10 w-72 h-72 bg-gradient-to-tr from-indigo-600 to-violet-500 rounded-3xl rotate-12 shadow-2xl shadow-indigo-500/50 flex items-center justify-center backdrop-blur-sm border border-white/20 transform transition-transform duration-700 hover:rotate-0 hover:scale-105">
                        <span class="text-8xl font-black text-white/90 drop-shadow-xl">P</span>
                        
                        {{-- Floating Elements --}}
                        <div class="absolute -top-8 -right-8 w-24 h-24 bg-white/10 backdrop-blur-md rounded-2xl border border-white/20 shadow-xl flex items-center justify-center animate-bounce" style="animation-duration: 3s;">
                            <svg class="w-10 h-10 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" /></svg>
                        </div>
                        <div class="absolute -bottom-6 -left-6 w-20 h-20 bg-white/10 backdrop-blur-md rounded-full border border-white/20 shadow-xl flex items-center justify-center animate-bounce" style="animation-duration: 4s; animation-delay: 1s;">
                            <svg class="w-8 h-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" /></svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Premium Features --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-24">
        <div class="group relative bg-white rounded-[2rem] p-8 border border-slate-100 shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all duration-300">
            <div class="absolute inset-0 bg-gradient-to-br from-emerald-50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity rounded-[2rem]"></div>
            <div class="relative z-10">
                <div class="w-16 h-16 rounded-2xl bg-emerald-100 text-emerald-600 flex items-center justify-center mb-6 transform group-hover:rotate-6 transition-transform">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <h3 class="text-xl font-bold text-slate-900 mb-2">تضمین اصالت کالا</h3>
                <p class="text-slate-500 leading-relaxed">تمامی محصولات ارائه شده دارای ضمانت اصالت و سلامت فیزیکی می‌باشند.</p>
            </div>
        </div>

        <div class="group relative bg-white rounded-[2rem] p-8 border border-slate-100 shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all duration-300">
            <div class="absolute inset-0 bg-gradient-to-br from-indigo-50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity rounded-[2rem]"></div>
            <div class="relative z-10">
                <div class="w-16 h-16 rounded-2xl bg-indigo-100 text-indigo-600 flex items-center justify-center mb-6 transform group-hover:-rotate-6 transition-transform">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                </div>
                <h3 class="text-xl font-bold text-slate-900 mb-2">ارسال فوق سریع</h3>
                <p class="text-slate-500 leading-relaxed">سفارشات شما در سریع‌ترین زمان ممکن پردازش و به دستتان خواهد رسید.</p>
            </div>
        </div>

        <div class="group relative bg-white rounded-[2rem] p-8 border border-slate-100 shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all duration-300">
            <div class="absolute inset-0 bg-gradient-to-br from-rose-50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity rounded-[2rem]"></div>
            <div class="relative z-10">
                <div class="w-16 h-16 rounded-2xl bg-rose-100 text-rose-600 flex items-center justify-center mb-6 transform group-hover:scale-110 transition-transform">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                </div>
                <h3 class="text-xl font-bold text-slate-900 mb-2">پشتیبانی همیشگی</h3>
                <p class="text-slate-500 leading-relaxed">تیم پشتیبانی ما در تمامی روزهای هفته آماده پاسخگویی به شماست.</p>
            </div>
        </div>
    </div>

    {{-- Trending Products Header --}}
    <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 mb-10">
        <div>
            <h2 class="text-3xl font-black text-slate-900 tracking-tight">جدیدترین محصولات</h2>
            <p class="text-slate-500 mt-2 text-lg">گلچینی از بهترین‌ها برای شما</p>
        </div>
        <a href="{{ route('products.index') }}" class="group inline-flex items-center gap-2 text-sm font-bold text-indigo-600 bg-indigo-50 px-5 py-2.5 rounded-xl hover:bg-indigo-100 transition-colors">
            مشاهده همه
            <svg class="w-4 h-4 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"></path></svg>
        </a>
    </div>

    {{-- Products Grid --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
        @forelse($products as $product)
            <article class="group flex flex-col bg-white rounded-3xl border border-slate-100 overflow-hidden hover:shadow-[0_20px_40px_-15px_rgba(0,0,0,0.1)] transition-all duration-500">
                {{-- Image Container --}}
                <a href="{{ route('products.show', $product->slug) }}" class="relative block aspect-[4/3] bg-slate-50 overflow-hidden">
                    <img
                        src="{{ $product->thumbnail_url }}"
                        alt="{{ $product->name }}"
                        class="w-full h-full object-cover mix-blend-multiply transition-transform duration-700 group-hover:scale-110"
                        loading="lazy"
                    >
                    {{-- Hover Overlay --}}
                    <div class="absolute inset-0 bg-slate-900/5 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                </a>

                {{-- Content --}}
                <div class="flex flex-col flex-1 p-6">
                    @if($product->category)
                        <span class="inline-block px-3 py-1 rounded-full bg-slate-100 text-slate-600 text-xs font-bold tracking-wide mb-4 w-fit">
                            {{ $product->category->name }}
                        </span>
                    @endif
                    
                    <a href="{{ route('products.show', $product->slug) }}" class="block flex-1">
                        <h3 class="text-base font-bold text-slate-900 leading-relaxed group-hover:text-indigo-600 transition-colors line-clamp-2">
                            {{ $product->name }}
                        </h3>
                    </a>

                    <div class="mt-6 flex items-center justify-between border-t border-slate-100 pt-4">
                        <div>
                            <span class="block text-xs font-medium text-slate-400 mb-1">قیمت نهایی</span>
                            <div class="flex items-baseline gap-1 text-slate-900">
                                <span class="text-lg font-black">{{ number_format($product->price) }}</span>
                                <span class="text-xs font-bold text-slate-500">تومان</span>
                            </div>
                        </div>

                        <a href="{{ route('products.show', $product->slug) }}" class="flex items-center justify-center w-12 h-12 rounded-2xl bg-indigo-50 text-indigo-600 group-hover:bg-indigo-600 group-hover:text-white transition-all duration-300 transform group-hover:-translate-y-1 group-hover:shadow-lg group-hover:shadow-indigo-200">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        </a>
                    </div>
                </div>
            </article>
        @empty
            <div class="col-span-full rounded-3xl border-2 border-dashed border-slate-200 bg-slate-50/50 py-24 px-6 text-center">
                <div class="mx-auto w-20 h-20 bg-white shadow-sm rounded-full flex items-center justify-center mb-6">
                    <svg class="w-10 h-10 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                </div>
                <h3 class="text-xl font-bold text-slate-900 mb-2">محصولی یافت نشد</h3>
                <p class="text-slate-500">در حال حاضر محصولی برای نمایش وجود ندارد. لطفا بعدا سر بزنید.</p>
            </div>
        @endforelse
    </div>
@endsection
