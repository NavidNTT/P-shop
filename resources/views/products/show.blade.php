{{-- resources/views/products/show.blade.php --}}
@extends('layouts.store')

@section('title', $product->name)

@section('content')

    {{-- Back link --}}
    <div class="mb-4">
        <a href="{{ route('products.index') }}"
           class="inline-flex items-center gap-1 text-xs text-slate-500 hover:text-slate-800">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none"
                 stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round">
                <path d="M15 18l-6-6 6-6" />
            </svg>
            بازگشت به فروشگاه
        </a>
    </div>

    {{-- Alerts --}}
    @if (session('success'))
        <div class="mb-4 rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-xs sm:text-sm text-emerald-800 flex items-start gap-2">
            <span class="mt-0.5">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </span>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    @if (session('error'))
        <div class="mb-4 rounded-2xl border border-rose-200 bg-rose-50 px-4 py-3 text-xs sm:text-sm text-rose-800 flex items-start gap-2">
            <span class="mt-0.5">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M12 9v2m0 4h.01M4.93 4.93l14.14 14.14M12 5a7 7 0 017 7 7 7 0 01-7 7 7 7 0 01-7-7 7 7 0 017-7z" />
                </svg>
            </span>
            <span>{{ session('error') }}</span>
        </div>
    @endif

    @php
        $mainImage = $product->images->first();
    @endphp

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-10 items-start">
        {{-- Gallery --}}
        <section class="space-y-3">
            <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
                <img
                    id="mainProductImage"
                    src="{{ $mainImage ? Storage::url($mainImage->path) : $product->thumbnail_url }}"
                    alt="{{ $product->name }}"
                    class="w-full h-80 sm:h-96 object-cover"
                >
            </div>

            {{-- Thumbnails --}}
            @if ($product->images->count() > 1)
                <div class="grid grid-cols-4 sm:grid-cols-5 gap-3">
                    @foreach ($product->images as $img)
                        <button
                            type="button"
                            onclick="document.getElementById('mainProductImage').src='{{ Storage::url($img->path) }}'"
                            class="group relative overflow-hidden rounded-xl border border-slate-200 bg-white focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:ring-offset-2 focus:ring-offset-slate-50"
                        >
                            <img
                                src="{{ Storage::url($img->path) }}"
                                alt="تصویر {{ $product->name }}"
                                class="h-16 w-full object-cover transition-transform duration-200 group-hover:scale-105"
                            >
                        </button>
                    @endforeach
                </div>
            @endif
        </section>

        {{-- Product info --}}
        <section class="space-y-5">
            {{-- Title + basic info --}}
            <div class="space-y-2">
                <h1 class="text-xl sm:text-2xl font-bold text-slate-900">
                    {{ $product->name }}
                </h1>

                <div class="flex flex-wrap items-center gap-3 text-xs sm:text-sm">
                    {{-- Category --}}
                    @if ($product->category)
                        <span class="inline-flex items-center rounded-full bg-slate-100 px-3 py-1 text-[11px] sm:text-xs text-slate-700">
                            دسته‌بندی:
                            <span class="mr-1 font-semibold">{{ $product->category->name }}</span>
                        </span>
                    @endif

                    {{-- Stock --}}
                    @if ($product->stock > 0)
                        <span class="inline-flex items-center rounded-full bg-emerald-50 px-3 py-1 text-[11px] sm:text-xs font-medium text-emerald-700">
                            موجود ({{ $product->stock }})
                        </span>
                    @else
                        <span class="inline-flex items-center rounded-full bg-rose-50 px-3 py-1 text-[11px] sm:text-xs font-medium text-rose-600">
                            ناموجود
                        </span>
                    @endif
                </div>
            </div>

            {{-- Price card --}}
            <div class="rounded-2xl border border-slate-200 bg-white p-4 sm:p-5 shadow-sm">
                <div class="flex items-center justify-between gap-4">
                    <div>
                        <p class="text-xs text-slate-500 mb-1">
                            قیمت
                        </p>
                        <p class="text-lg sm:text-2xl font-bold text-slate-900">
                            {{ number_format($product->price) }}
                            <span class="text-xs sm:text-sm font-normal text-slate-500">تومان</span>
                        </p>
                    </div>

                    {{-- Add to cart --}}
                    <div class="flex items-center gap-2">
                        @if ($product->stock > 0)
                            <form action="{{ route('cart.add', $product) }}" method="POST" class="flex items-center gap-2">
                                @csrf

                                {{-- Quantity (اختیاری: اگر فعلاً نداری، می‌توانی حذفش کنی) --}}
                                {{-- 
                                <input
                                    type="number"
                                    name="quantity"
                                    value="1"
                                    min="1"
                                    max="{{ $product->stock }}"
                                    class="w-16 rounded-xl border border-slate-200 bg-slate-50 py-2 px-2 text-xs text-center focus:border-indigo-500 focus:ring-indigo-100 focus:ring-2"
                                >
                                --}}

                                <button
                                    type="submit"
                                    class="inline-flex items-center justify-center rounded-xl bg-indigo-600 px-4 py-2 text-xs sm:text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 transition"
                                >
                                    افزودن به سبد خرید
                                </button>
                            </form>
                        @else
                            <button
                                disabled
                                class="inline-flex items-center justify-center rounded-xl bg-slate-100 px-4 py-2 text-xs sm:text-sm font-medium text-slate-400 cursor-not-allowed"
                            >
                                ناموجود
                            </button>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Description --}}
            @if ($product->description)
                <div class="rounded-2xl border border-slate-200 bg-white p-4 sm:p-5 shadow-sm">
                    <h2 class="mb-2 text-sm font-semibold text-slate-900">
                        توضیحات محصول
                    </h2>
                    <p class="text-xs sm:text-sm leading-relaxed text-slate-700 whitespace-pre-line">
                        {{ $product->description }}
                    </p>
                </div>
            @endif
        </section>
    </div>
@endsection
