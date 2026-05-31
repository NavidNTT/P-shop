@extends('layouts.store')

@section('content')
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold">جدیدترین محصولات</h2>

    <a href="{{ route('products.index') }}" class="text-blue-600 hover:underline">
        مشاهده همه
    </a>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        @forelse($products as $product)
            <div class="bg-white rounded shadow overflow-hidden">
                <img
                    src="{{ $product->thumbnail_url }}"
                    alt="{{ $product->name }}"
                    class="w-full h-44 object-cover"
                    loading="lazy"
                >

                <div class="p-4">
                    <h3 class="font-semibold text-gray-900 line-clamp-2">
                        {{ $product->name }}
                    </h3>

                    @if(!empty($product->description))
                        <p class="text-gray-600 text-sm mt-2 line-clamp-2">
                            {{ $product->description }}
                        </p>
                    @endif

                    <div class="flex items-center justify-between mt-4">
                        <p class="text-gray-800 font-bold">
                            {{ number_format($product->price) }}
                            <span class="text-sm font-normal text-gray-600">تومان</span>
                        </p>

                        {{-- لینک جزئیات را بعداً به route واقعی وصل می‌کنیم --}}
                        <a
                           href="{{ route('products.show', $product->slug) }}"
                            class="text-sm bg-blue-600 hover:bg-blue-700 text-white px-3 py-2 rounded"
                        >
                            جزئیات
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="bg-white rounded shadow p-6">
                <p class="text-gray-700">محصولی یافت نشد.</p>
            </div>
        @endforelse
    </div>
@endsection
