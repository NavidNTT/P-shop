{{-- resources/views/products/index.blade.php --}}
@extends('layouts.store')

@section('title', 'فروشگاه')

@section('content')
    <div class="space-y-6">

        {{-- Header + search/sort summary --}}
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-xl sm:text-2xl font-bold text-slate-900">
                    فروشگاه
                </h1>
                <p class="mt-1 text-xs sm:text-sm text-slate-500">
                    @if($products->total() > 0)
                        {{ number_format($products->total()) }} محصول یافت شد
                        @if(request('q'))
                            برای جستجوی
                            <span class="font-semibold text-slate-700">"{{ request('q') }}"</span>
                        @endif
                    @else
                        محصولی مطابق فیلترهای فعلی یافت نشد.
                    @endif
                </p>
            </div>

            {{-- Sort (نمای سریع) --}}
            <div class="flex items-center gap-2 text-xs sm:text-sm">
                <span class="text-slate-500">مرتب‌سازی بر اساس:</span>
                <form action="{{ route('products.index') }}" method="GET" class="flex items-center">
                    @foreach(request()->except('sort', 'page') as $name => $value)
                        <input type="hidden" name="{{ $name }}" value="{{ $value }}">
                    @endforeach

                    <select
                        name="sort"
                        onchange="this.form.submit()"
                        class="rounded-xl border border-slate-200 bg-white py-1.5 px-2 text-xs sm:text-sm text-slate-700 focus:border-indigo-500 focus:ring-indigo-100 focus:ring-2"
                    >
                        <option value="">پیش‌فرض</option>
                        <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>جدیدترین</option>
                        <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>ارزان‌ترین</option>
                        <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>گران‌ترین</option>
                    </select>
                </form>
            </div>
        </div>

        {{-- Filters bar (search + sort – موبایل/دسکتاپ) --}}
        <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
            <form action="{{ route('products.index') }}" method="GET" class="flex flex-col gap-3 md:flex-row md:items-center">
                {{-- Search --}}
                <div class="flex-1">
                    <label class="block text-xs font-medium text-slate-500 mb-1">
                        جستجو در محصولات
                    </label>
                    <div class="relative">
                        <input
                            type="text"
                            name="q"
                            value="{{ request('q') }}"
                            placeholder="مثلاً: گوشی، لپ‌تاپ، هدفون..."
                            class="w-full rounded-xl border border-slate-200 bg-slate-50 py-2.5 pl-4 pr-9 text-xs sm:text-sm text-slate-800 placeholder:text-slate-400 focus:border-indigo-500 focus:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-100"
                        >
                        <span class="absolute inset-y-0 right-2 flex items-center pointer-events-none text-slate-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                 viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M21 21l-4.35-4.35M10.5 18a7.5 7.5 0 100-15 7.5 7.5 0 000 15z" />
                            </svg>
                        </span>
                    </div>
                </div>

                {{-- Sort in filter bar --}}
                <div class="md:w-52">
                    <label class="block text-xs font-medium text-slate-500 mb-1">
                        مرتب‌سازی
                    </label>
                    <select
                        name="sort"
                        class="w-full rounded-xl border border-slate-200 bg-white py-2.5 px-3 text-xs sm:text-sm text-slate-700 focus:border-indigo-500 focus:ring-indigo-100 focus:ring-2"
                    >
                        <option value="">پیش‌فرض</option>
                        <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>جدیدترین</option>
                        <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>ارزان‌ترین</option>
                        <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>گران‌ترین</option>
                    </select>
                </div>

                {{-- Hidden keep other params except q, sort, page --}}
                @foreach(request()->except('q', 'sort', 'page') as $name => $value)
                    <input type="hidden" name="{{ $name }}" value="{{ $value }}">
                @endforeach

                <div class="flex items-end gap-2">
                    <button
                        type="submit"
                        class="inline-flex items-center rounded-xl bg-indigo-600 px-4 py-2 text-xs sm:text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 transition"
                    >
                        اعمال فیلتر
                    </button>

                    {{-- Clear filters --}}
                    @if(request()->hasAny(['q', 'category', 'sort']))
                        <a href="{{ route('products.index') }}"
                           class="text-xs text-slate-500 hover:text-rose-500">
                            حذف فیلترها
                        </a>
                    @endif
                </div>
            </form>
        </div>

        {{-- Main layout: Sidebar + Products --}}
        <div class="grid grid-cols-1 lg:grid-cols-[260px,1fr] gap-6 mt-2">
            {{-- Sidebar: Categories --}}
            <aside class="order-2 lg:order-1">
                <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
                    <div class="flex items-center justify-between mb-3">
                        <h2 class="text-sm font-semibold text-slate-800">
                            دسته‌بندی‌ها
                        </h2>

                        {{-- Reset category --}}
                        @if(request()->filled('category'))
                            <a href="{{ route('products.index', array_merge(request()->except('category', 'page'))) }}"
                               class="text-[11px] text-slate-400 hover:text-rose-500">
                                همه محصولات
                            </a>
                        @endif
                    </div>

                    <ul class="space-y-1 text-xs sm:text-sm">
                        {{-- All products item --}}
                        <li>
                            <a
                                href="{{ route('products.index', array_merge(request()->except('category', 'page'))) }}"
                                class="flex items-center justify-between rounded-lg px-2 py-1.5
                                       {{ request()->filled('category') ? 'text-slate-500 hover:bg-slate-50' : 'bg-indigo-50 text-indigo-700 font-semibold' }}"
                            >
                                <span>همه محصولات</span>
                            </a>
                        </li>

                        {{-- Categories tree --}}
                        @foreach($categories as $category)
                            @php
                                $isActive = request('category') == $category->slug;
                            @endphp
                            <li>
                                <a
                                    href="{{ route('products.index', array_merge(request()->except('page'), ['category' => $category->slug])) }}"
                                    class="flex items-center justify-between rounded-lg px-2 py-1.5
                                           {{ $isActive ? 'bg-indigo-50 text-indigo-700 font-semibold' : 'text-slate-600 hover:bg-slate-50' }}"
                                >
                                    <span>{{ $category->name }}</span>
                                </a>

                                {{-- Children --}}
                                @if($category->children && $category->children->count())
                                    <ul class="mt-1 space-y-1 pl-2 border-r border-slate-100 mr-2">
                                        @foreach($category->children as $child)
                                            @php
                                                $childActive = request('category') == $child->slug;
                                            @endphp
                                            <li>
                                                <a
                                                    href="{{ route('products.index', array_merge(request()->except('page'), ['category' => $child->slug])) }}"
                                                    class="flex items-center justify-between rounded-lg px-2 py-1
                                                           text-[11px] sm:text-xs
                                                           {{ $childActive ? 'bg-indigo-50 text-indigo-700 font-semibold' : 'text-slate-500 hover:bg-slate-50' }}"
                                                >
                                                    <span>– {{ $child->name }}</span>
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                </div>
            </aside>

            {{-- Products grid --}}
            <section class="order-1 lg:order-2">
                @if($products->count())
                    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-5">
                        @foreach($products as $product)
                            <article class="group flex flex-col overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm hover:shadow-md transition-shadow duration-150">
                                {{-- Image --}}
                                <a href="{{ route('products.show', $product->slug) }}" class="block overflow-hidden">
                                    <img
                                        src="{{ $product->thumbnail_url }}"
                                        alt="{{ $product->name }}"
                                        class="h-48 w-full object-cover transition-transform duration-300 group-hover:scale-[1.04]"
                                    >
                                </a>

                                {{-- Body --}}
                                <div class="flex flex-1 flex-col p-3 sm:p-4">
                                    {{-- Name --}}
                                    <a href="{{ route('products.show', $product->slug) }}" class="flex-1">
                                        <h3 class="line-clamp-2 text-sm font-semibold text-slate-800 group-hover:text-indigo-600 transition-colors">
                                            {{ $product->name }}
                                        </h3>
                                    </a>

                                    {{-- Category (اختیاری) --}}
                                    @if($product->category)
                                        <p class="mt-1 text-[11px] text-slate-400">
                                            {{ $product->category->name }}
                                        </p>
                                    @endif

                                    {{-- Price + stock --}}
                                    <div class="mt-3 flex items-center justify-between">
                                        <div class="text-sm font-bold text-slate-900">
                                            {{ number_format($product->price) }}
                                            <span class="text-[11px] font-normal text-slate-500">تومان</span>
                                        </div>

                                        @if($product->stock > 0)
                                            <span class="inline-flex items-center rounded-full bg-emerald-50 px-2 py-0.5 text-[11px] font-medium text-emerald-700">
                                                موجود
                                            </span>
                                        @else
                                            <span class="inline-flex items-center rounded-full bg-rose-50 px-2 py-0.5 text-[11px] font-medium text-rose-600">
                                                ناموجود
                                            </span>
                                        @endif
                                    </div>

                                    {{-- Actions --}}
                                    <div class="mt-4 flex items-center justify-between gap-2">
                                        <a
                                            href="{{ route('products.show', $product->slug) }}"
                                            class="inline-flex items-center justify-center rounded-xl border border-slate-200 bg-slate-50 px-3 py-1.5 text-xs font-medium text-slate-700 hover:bg-slate-100 transition"
                                        >
                                            جزئیات
                                        </a>

                                        @if($product->stock > 0)
                                            <form action="{{ route('cart.add', $product) }}" method="POST">
                                                @csrf
                                                <button
                                                    type="submit"
                                                    class="inline-flex items-center justify-center rounded-xl bg-indigo-600 px-3 py-1.5 text-xs font-semibold text-white shadow-sm hover:bg-indigo-500 transition"
                                                >
                                                    افزودن به سبد
                                                </button>
                                            </form>
                                        @else
                                            <button
                                                disabled
                                                class="inline-flex items-center justify-center rounded-xl bg-slate-100 px-3 py-1.5 text-xs font-medium text-slate-400 cursor-not-allowed"
                                            >
                                                ناموجود
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    </div>

                    {{-- Pagination --}}
                    <div class="mt-6">
                        {{ $products->withQueryString()->links() }}
                    </div>
                @else
                    {{-- Empty state --}}
                    <div class="flex flex-col items-center justify-center rounded-2xl border border-dashed border-slate-200 bg-white py-10 px-4 text-center">
                        <div class="mb-3 rounded-full bg-slate-100 p-3 text-slate-400">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                 viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                      d="M21 21l-4.35-4.35M10.5 18a7.5 7.5 0 100-15 7.5 7.5 0 000 15z" />
                            </svg>
                        </div>
                        <h2 class="text-sm font-semibold text-slate-800 mb-1">
                            محصولی یافت نشد
                        </h2>
                        <p class="text-xs text-slate-500 mb-3">
                            فیلترها را تغییر دهید یا عبارت جستجوی دیگری امتحان کنید.
                        </p>
                        @if(request('q'))
                            <p class="text-[11px] text-slate-400 mb-3">
                                عبارت جستجو:
                                <span class="font-semibold text-slate-600">"{{ request('q') }}"</span>
                            </p>
                        @endif

                        <a href="{{ route('products.index') }}"
                           class="inline-flex items-center rounded-xl bg-indigo-600 px-4 py-2 text-xs font-semibold text-white shadow-sm hover:bg-indigo-500 transition">
                            بازگشت به همه محصولات
                        </a>
                    </div>
                @endif
            </section>
        </div>
    </div>
@endsection
