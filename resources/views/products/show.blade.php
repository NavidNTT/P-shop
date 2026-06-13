{{-- resources/views/products/show.blade.php --}}
@extends('layouts.store')

@section('title', $product->name)

@section('content')

    {{-- Premium Breadcrumb --}}
    <nav class="mb-8 flex items-center text-sm font-bold text-slate-400 bg-white px-6 py-3 rounded-2xl shadow-sm border border-slate-100 w-fit">
        <a href="{{ route('home') }}" class="hover:text-indigo-600 transition-colors">خانه</a>
        <svg class="h-4 w-4 mx-3 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
        <a href="{{ route('products.index') }}" class="hover:text-indigo-600 transition-colors">محصولات</a>
        @if($product->category)
            <svg class="h-4 w-4 mx-3 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
            <a href="{{ route('products.index', ['category' => $product->category->slug]) }}" class="hover:text-indigo-600 transition-colors">{{ $product->category->name }}</a>
        @endif
        <svg class="h-4 w-4 mx-3 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
        <span class="text-slate-800 truncate max-w-[200px] sm:max-w-xs">{{ $product->name }}</span>
    </nav>

    {{-- Alerts --}}
    @if (session('success'))
        <div class="mb-8 rounded-2xl border border-emerald-100 bg-emerald-50 px-6 py-4 flex items-center gap-4 shadow-sm animate-[fadeIn_0.5s_ease-out]">
            <div class="bg-emerald-500 text-white p-1.5 rounded-xl shadow-md shadow-emerald-500/30">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" /></svg>
            </div>
            <span class="text-sm font-bold text-emerald-800">{{ session('success') }}</span>
        </div>
    @endif

    @if (session('error'))
        <div class="mb-8 rounded-2xl border border-rose-100 bg-rose-50 px-6 py-4 flex items-center gap-4 shadow-sm animate-[fadeIn_0.5s_ease-out]">
            <div class="bg-rose-500 text-white p-1.5 rounded-xl shadow-md shadow-rose-500/30">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>
            </div>
            <span class="text-sm font-bold text-rose-800">{{ session('error') }}</span>
        </div>
    @endif

    @php
        $mainImage = $product->images->first();
    @endphp

    <div class="bg-white rounded-[2.5rem] p-6 sm:p-10 lg:p-12 shadow-[0_8px_30px_-15px_rgba(0,0,0,0.05)] border border-slate-100 mb-12">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-20 items-start">
            
            {{-- Gallery Section --}}
            <section class="flex flex-col gap-6 sticky top-32">
                <div class="overflow-hidden rounded-[2rem] bg-slate-50 border border-slate-100 aspect-[4/3] relative group shadow-inner">
                    <img
                        id="mainProductImage"
                        src="{{ $mainImage ? Storage::url($mainImage->path) : $product->thumbnail_url }}"
                        alt="{{ $product->name }}"
                        class="w-full h-full object-cover object-center mix-blend-multiply transition-transform duration-500 group-hover:scale-105"
                    >
                    @if($product->stock <= 0)
                        <div class="absolute inset-0 bg-white/60 backdrop-blur-sm flex items-center justify-center">
                            <span class="bg-rose-500 text-white px-8 py-3 rounded-full text-xl font-black shadow-xl shadow-rose-500/30 transform -rotate-12">ناموجود</span>
                        </div>
                    @endif
                </div>

                {{-- Thumbnails --}}
                @if ($product->images->count() > 1)
                    <div class="flex items-center gap-4 overflow-x-auto pb-2 scrollbar-hide">
                        @foreach ($product->images as $img)
                            <button
                                type="button"
                                onclick="document.getElementById('mainProductImage').src='{{ Storage::url($img->path) }}'"
                                class="flex-shrink-0 w-24 h-24 rounded-2xl border-2 border-transparent hover:border-indigo-500 focus:border-indigo-500 overflow-hidden bg-slate-50 transition-all shadow-sm hover:shadow-md"
                            >
                                <img
                                    src="{{ Storage::url($img->path) }}"
                                    alt="تصویر {{ $product->name }}"
                                    class="w-full h-full object-cover mix-blend-multiply"
                                >
                            </button>
                        @endforeach
                    </div>
                @endif
            </section>

            {{-- Product Info Section --}}
            <section class="flex flex-col">
                <div class="mb-8 border-b border-slate-100 pb-8 relative">
                    @if ($product->category)
                        <a href="{{ route('products.index', ['category' => $product->category->slug]) }}" class="inline-flex items-center text-xs font-black text-indigo-600 mb-4 tracking-widest uppercase hover:text-indigo-800 transition-colors bg-indigo-50 px-3 py-1.5 rounded-lg">
                            {{ $product->category->name }}
                        </a>
                    @endif
                    <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black text-slate-900 leading-tight mb-6">
                        {{ $product->name }}
                    </h1>
                    
                    <div class="flex items-center gap-4">
                        @if ($product->stock > 0)
                            <span class="inline-flex items-center rounded-xl bg-emerald-50 px-4 py-2 text-sm font-bold text-emerald-600 border border-emerald-200/60 shadow-sm">
                                <span class="relative flex h-2.5 w-2.5 ml-2.5">
                                  <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                                  <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-emerald-500"></span>
                                </span>
                                موجود در انبار
                            </span>
                            <span class="text-sm font-bold text-slate-400">
                                ({{ $product->stock }} عدد باقی‌مانده)
                            </span>
                        @else
                            <span class="inline-flex items-center rounded-xl bg-rose-50 px-4 py-2 text-sm font-bold text-rose-600 border border-rose-200/60 shadow-sm">
                                ناموجود
                            </span>
                        @endif
                    </div>
                </div>

                <div class="mb-10">
                    <p class="text-sm font-bold text-slate-400 mb-3 tracking-wide">قیمت فروشنده</p>
                    <div class="flex items-baseline gap-2">
                        <span class="text-5xl font-black text-slate-900 tracking-tight">{{ number_format($product->price) }}</span>
                        <span class="text-lg font-bold text-slate-500">تومان</span>
                    </div>
                </div>

                {{-- Action Area --}}
                <div class="bg-gradient-to-br from-slate-50 to-white rounded-[2rem] p-8 border border-slate-100 mb-10 shadow-sm">
                    @if ($product->stock > 0)
                        <form action="{{ route('cart.add', $product) }}" method="POST" class="flex flex-col sm:flex-row gap-5">
                            @csrf
                            <button
                                type="submit"
                                class="flex-1 group relative inline-flex items-center justify-center rounded-2xl bg-indigo-600 px-8 py-5 text-base font-bold text-white shadow-xl shadow-indigo-500/30 hover:bg-indigo-500 hover:shadow-indigo-500/40 hover:-translate-y-1 transition-all duration-300 overflow-hidden"
                            >
                                <span class="relative z-10 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 ml-3 transform group-hover:-rotate-12 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" /></svg>
                                    افزودن به سبد خرید
                                </span>
                                <div class="absolute inset-0 bg-gradient-to-r from-indigo-500 to-violet-500 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                            </button>
                        </form>
                    @else
                        <div class="text-center p-6 bg-slate-100/50 rounded-2xl border border-slate-200">
                            <p class="text-slate-600 font-bold mb-4">این محصول در حال حاضر ناموجود است.</p>
                            <button disabled class="w-full inline-flex items-center justify-center rounded-2xl bg-slate-200 px-8 py-4 text-base font-black text-slate-400 cursor-not-allowed">
                                ناموجود
                            </button>
                        </div>
                    @endif

                    <div class="mt-8 flex flex-wrap items-center gap-6 justify-center text-sm font-bold text-slate-600">
                        <div class="flex items-center gap-3 bg-white px-4 py-2 rounded-xl shadow-sm border border-slate-100">
                            <div class="w-8 h-8 rounded-lg bg-emerald-50 text-emerald-500 flex items-center justify-center">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <span>ضمانت اصالت</span>
                        </div>
                        <div class="flex items-center gap-3 bg-white px-4 py-2 rounded-xl shadow-sm border border-slate-100">
                            <div class="w-8 h-8 rounded-lg bg-indigo-50 text-indigo-500 flex items-center justify-center">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <span>تحویل اکسپرس</span>
                        </div>
                    </div>
                </div>

                {{-- Description --}}
                @if ($product->description)
                    <div>
                        <h2 class="text-xl font-black text-slate-900 mb-6 flex items-center gap-3">
                            <span class="w-2 h-8 rounded-full bg-indigo-500 block"></span>
                            معرفی محصول
                        </h2>
                        <div class="prose prose-slate max-w-none prose-p:leading-loose prose-p:text-slate-600 text-slate-700 whitespace-pre-line bg-white rounded-3xl p-8 border border-slate-100 shadow-[0_8px_30px_-15px_rgba(0,0,0,0.05)]">
                            {{ $product->description }}
                        </div>
                    </div>
                @endif
            </section>
        </div>
    </div>
@endsection
