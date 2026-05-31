@extends('layouts.store')

@section('content')
    <div class="flex flex-col lg:flex-row gap-6">
        {{-- Sidebar دسته‌بندی‌ها --}}
        <aside class="w-full lg:w-1/4">
            <div class="bg-white rounded shadow p-4">
                <h2 class="font-bold text-lg mb-4">دسته‌بندی‌ها</h2>

                <div class="space-y-3">
                    <a
                        href="{{ route('products.index') }}"
                        class="block text-sm {{ request('category') ? 'text-gray-700' : 'text-blue-600 font-bold' }}"
                    >
                        همه محصولات
                    </a>

                    @foreach($categories as $category)
                        <div>
                            <a
                                href="{{ route('products.index', ['category' => $category->slug]) }}"
                                class="block text-sm font-semibold {{ request('category') === $category->slug ? 'text-blue-600' : 'text-gray-800' }}"
                            >
                                {{ $category->name }}
                            </a>

                            @if($category->children->count())
                                <div class="mt-2 mr-4 space-y-2">
                                    @foreach($category->children as $child)
                                        <a
                                            href="{{ route('products.index', ['category' => $child->slug]) }}"
                                            class="block text-sm {{ request('category') === $child->slug ? 'text-blue-600 font-bold' : 'text-gray-600' }}"
                                        >
                                            - {{ $child->name }}
                                        </a>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        </aside>

        {{-- لیست محصولات --}}
        <section class="w-full lg:w-3/4">
            <div class="flex items-center justify-between mb-6">
                <h1 class="text-2xl font-bold">محصولات</h1>

                <p class="text-sm text-gray-500">
                    تعداد: {{ $products->total() }} محصول
                </p>
            </div>

            @if($products->count())
                <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-6">
                    @foreach($products as $product)
                        <div class="bg-white rounded shadow overflow-hidden">
                            <img
                                src="{{ $product->thumbnail_url }}"
                                alt="{{ $product->name }}"
                                class="w-full h-48 object-cover"
                                loading="lazy"
                            >

                            <div class="p-4">
                                <h3 class="font-semibold text-gray-900 mb-2">
                                    {{ $product->name }}
                                </h3>

                                <p class="text-gray-700 font-bold mb-4">
                                    {{ number_format($product->price) }}
                                    <span class="text-sm font-normal text-gray-500">تومان</span>
                                </p>

                                <div class="flex items-center justify-between">
                                    @if($product->stock > 0)
                                        <span class="text-xs bg-green-100 text-green-700 px-2 py-1 rounded">
                                            موجود
                                        </span>
                                    @else
                                        <span class="text-xs bg-red-100 text-red-700 px-2 py-1 rounded">
                                            ناموجود
                                        </span>
                                    @endif

                                    <a
                                        href="{{ route('products.show', $product->slug) }}"
                                        class="text-sm bg-blue-600 hover:bg-blue-700 text-white px-3 py-2 rounded"
                                    >
                                        جزئیات
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-8">
                    {{ $products->links() }}
                </div>
            @else
                <div class="bg-white rounded shadow p-6">
                    <p class="text-gray-700">محصولی برای این دسته‌بندی پیدا نشد.</p>
                </div>
            @endif
        </section>
    </div>
@endsection
