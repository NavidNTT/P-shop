{{-- resources/views/products/index.blade.php --}}
@extends('layouts.store')

@section('title', 'محصولات')

@section('content')
    <div class="space-y-8">

        {{-- Page Header --}}
        <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-100 shadow-[0_8px_30px_-15px_rgba(0,0,0,0.05)] flex flex-col md:flex-row md:items-center justify-between gap-6 relative overflow-hidden">
            <div class="absolute right-0 top-0 w-2 h-full bg-gradient-to-b from-indigo-500 to-violet-500"></div>
            <div class="relative z-10">
                <h1 class="text-2xl sm:text-3xl font-black text-slate-900 mb-2 tracking-tight">
                    فروشگاه محصولات
                </h1>
                <p class="text-sm font-medium text-slate-500">
                    @if($products->total() > 0)
                        نمایش <span class="font-black text-indigo-600 bg-indigo-50 px-2 py-0.5 rounded-md">{{ $products->firstItem() }}</span> تا <span class="font-black text-indigo-600 bg-indigo-50 px-2 py-0.5 rounded-md">{{ $products->lastItem() }}</span> از <span class="font-black text-slate-700">{{ number_format($products->total()) }}</span> محصول
                        @if(request('q'))
                            برای <span class="font-bold text-indigo-600 bg-indigo-50 px-2 py-0.5 rounded-md">"{{ request('q') }}"</span>
                        @endif
                    @else
                        محصولی یافت نشد.
                    @endif
                </p>
            </div>

            {{-- Sort Dropdown --}}
            <div class="flex items-center gap-3 bg-slate-50 p-2 rounded-2xl border border-slate-200/60 relative z-10">
                <span class="text-xs font-bold text-slate-500 pl-2">مرتب‌سازی:</span>
                <form action="{{ route('products.index') }}" method="GET" class="flex items-center m-0">
                    @foreach(request()->except('sort', 'page') as $name => $value)
                        <input type="hidden" name="{{ $name }}" value="{{ $value }}">
                    @endforeach

                    <select
                        name="sort"
                        onchange="this.form.submit()"
                        class="rounded-xl border-none bg-white py-2 pl-8 pr-4 text-sm font-bold text-slate-700 shadow-sm focus:ring-2 focus:ring-indigo-500 cursor-pointer transition-shadow"
                    >
                        <option value="newest" {{ request('sort', 'newest') == 'newest' ? 'selected' : '' }}>جدیدترین</option>
                        <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>ارزان‌ترین</option>
                        <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>گران‌ترین</option>
                    </select>
                </form>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-[280px,1fr] gap-8">
            {{-- Sidebar --}}
            <aside class="order-2 lg:order-1 space-y-6">
                {{-- Search Filter --}}
                <div class="bg-white rounded-3xl p-6 border border-slate-100 shadow-[0_8px_30px_-15px_rgba(0,0,0,0.05)]">
                    <h3 class="text-sm font-black text-slate-900 mb-4 uppercase tracking-wider">جستجو</h3>
                    <form action="{{ route('products.index') }}" method="GET">
                        @foreach(request()->except('q', 'page') as $name => $value)
                            <input type="hidden" name="{{ $name }}" value="{{ $value }}">
                        @endforeach
                        <div class="relative group">
                            <div class="absolute inset-0 bg-gradient-to-r from-indigo-500 to-violet-500 rounded-2xl blur opacity-0 group-focus-within:opacity-20 transition-opacity duration-300"></div>
                            <input
                                type="text"
                                name="q"
                                value="{{ request('q') }}"
                                placeholder="نام محصول..."
                                class="relative w-full rounded-2xl border-0 bg-slate-50 py-3.5 pl-4 pr-11 text-sm font-medium text-slate-800 placeholder-slate-400 focus:bg-white ring-1 ring-inset ring-slate-200 focus:ring-2 focus:ring-inset focus:ring-indigo-500 transition-all duration-300 shadow-inner"
                            >
                            <button type="submit" class="absolute inset-y-0 right-0 flex items-center pr-4 text-slate-400 hover:text-indigo-600 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M10.5 18a7.5 7.5 0 100-15 7.5 7.5 0 000 15z" /></svg>
                            </button>
                        </div>
                    </form>
                </div>

                {{-- Categories --}}
                <div class="bg-white rounded-3xl p-6 border border-slate-100 shadow-[0_8px_30px_-15px_rgba(0,0,0,0.05)]">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-sm font-black text-slate-900 uppercase tracking-wider">دسته‌بندی‌ها</h3>
                        @if(request()->filled('category'))
                            <a href="{{ route('products.index', array_merge(request()->except('category', 'page'))) }}" class="text-[10px] font-bold text-rose-600 hover:text-white bg-rose-50 hover:bg-rose-500 px-2 py-1 rounded-md transition-colors">حذف فیلتر</a>
                        @endif
                    </div>

                    <ul class="space-y-1">
                        <li>
                            <a href="{{ route('products.index', array_merge(request()->except('category', 'page'))) }}"
                               class="flex items-center justify-between rounded-xl px-4 py-3 text-sm transition-all duration-200 {{ !request()->filled('category') ? 'bg-indigo-600 text-white font-bold shadow-md shadow-indigo-500/30' : 'text-slate-600 hover:bg-slate-50 hover:text-indigo-600 font-bold' }}">
                                <span>همه دسته‌ها</span>
                            </a>
                        </li>
                        @foreach($categories as $category)
                            @php
                                $isActive = request('category') == $category->slug;
                            @endphp
                            <li>
                                <a href="{{ route('products.index', array_merge(request()->except('page'), ['category' => $category->slug])) }}"
                                   class="flex items-center justify-between rounded-xl px-4 py-3 text-sm transition-all duration-200 {{ $isActive ? 'bg-indigo-600 text-white font-bold shadow-md shadow-indigo-500/30' : 'text-slate-600 hover:bg-slate-50 hover:text-indigo-600 font-bold' }}">
                                    <span>{{ $category->name }}</span>
                                </a>
                                @if($category->children && $category->children->count())
                                    <ul class="mt-1 space-y-1 pr-4 border-r-2 border-slate-100 mr-4 mb-2">
                                        @foreach($category->children as $child)
                                            @php
                                                $childActive = request('category') == $child->slug;
                                            @endphp
                                            <li>
                                                <a href="{{ route('products.index', array_merge(request()->except('page'), ['category' => $child->slug])) }}"
                                                   class="flex items-center rounded-xl px-4 py-2 text-[13px] transition-all duration-200 {{ $childActive ? 'text-indigo-700 font-bold bg-indigo-50' : 'text-slate-500 hover:text-indigo-600 hover:bg-slate-50 font-medium' }}">
                                                    <span class="mr-2">{{ $child->name }}</span>
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

            {{-- Products Grid --}}
            <section class="order-1 lg:order-2">
                @if($products->count())
                    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-6 sm:gap-8">
                        @foreach($products as $product)
                            <article class="group flex flex-col bg-white rounded-3xl border border-slate-100 overflow-hidden hover:shadow-[0_20px_40px_-15px_rgba(0,0,0,0.1)] transition-all duration-500">
                                {{-- Image Container --}}
                                <a href="{{ route('products.show', $product->slug) }}" class="relative block aspect-[4/3] bg-slate-50 overflow-hidden">
                                    <img
                                        src="{{ $product->thumbnail_url }}"
                                        alt="{{ $product->name }}"
                                        class="w-full h-full object-cover mix-blend-multiply transition-transform duration-700 group-hover:scale-110"
                                        loading="lazy"
                                    >
                                    @if($product->stock <= 0)
                                        <div class="absolute inset-0 bg-white/60 backdrop-blur-sm flex items-center justify-center">
                                            <span class="bg-rose-500 text-white px-5 py-2 rounded-full text-sm font-black shadow-lg">ناموجود</span>
                                        </div>
                                    @else
                                        {{-- Hover Overlay --}}
                                        <div class="absolute inset-0 bg-slate-900/5 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                    @endif
                                </a>

                                {{-- Content --}}
                                <div class="flex flex-col flex-1 p-6 relative">
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

                                        @if($product->stock > 0)
                                            <form action="{{ route('cart.add', $product) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="flex items-center justify-center w-12 h-12 rounded-2xl bg-indigo-50 text-indigo-600 group-hover:bg-indigo-600 group-hover:text-white transition-all duration-300 transform group-hover:-translate-y-1 group-hover:shadow-lg group-hover:shadow-indigo-200" title="افزودن به سبد خرید">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                                                </button>
                                            </form>
                                        @else
                                            <button disabled class="flex items-center justify-center w-12 h-12 rounded-2xl bg-slate-100 text-slate-400 cursor-not-allowed">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    </div>

                    {{-- Pagination --}}
                    <div class="mt-12 flex justify-center">
                        {{ $products->withQueryString()->links() }}
                    </div>
                @else
                    {{-- Empty State --}}
                    <div class="flex flex-col items-center justify-center rounded-3xl border-2 border-dashed border-slate-200 bg-slate-50/50 py-24 px-6 text-center">
                        <div class="mx-auto w-24 h-24 bg-white shadow-sm rounded-full flex items-center justify-center mb-6">
                            <svg class="w-12 h-12 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-4.35-4.35M10.5 18a7.5 7.5 0 100-15 7.5 7.5 0 000 15z"></path></svg>
                        </div>
                        <h2 class="text-2xl font-black text-slate-900 mb-3">محصولی یافت نشد!</h2>
                        <p class="text-base text-slate-500 max-w-md mb-8 font-medium leading-relaxed">با فیلترهای انتخاب شده هیچ محصولی پیدا نکردیم. لطفاً فیلترها را تغییر دهید یا عبارت دیگری را جستجو کنید.</p>
                        <a href="{{ route('products.index') }}" class="inline-flex items-center justify-center rounded-xl bg-indigo-600 px-8 py-3.5 text-sm font-bold text-white shadow-lg hover:bg-indigo-500 transition-all duration-300 transform hover:-translate-y-1">
                            مشاهده همه محصولات
                        </a>
                    </div>
                @endif
            </section>
        </div>
    </div>
@endsection
