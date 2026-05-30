@extends('layouts.app')

@section('content')
    <div class="mb-6">
        <a href="{{ route('home') }}" class="text-blue-600 hover:underline">
            ← بازگشت به صفحه اصلی
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        {{-- گالری --}}
        <div class="bg-white rounded shadow p-4">
            @php
                $mainImage = $product->images->first();
            @endphp

            <div class="mb-4">
                <img
                    id="mainProductImage"
                    src="{{ $mainImage ? Storage::url($mainImage->path) : $product->thumbnail_url }}"
                    alt="{{ $product->name }}"
                    class="w-full h-80 object-cover rounded"
                >
            </div>

            @if($product->images->count() > 1)
                <div class="grid grid-cols-5 gap-3">
                    @foreach($product->images as $img)
                        <button
                            type="button"
                            class="border rounded overflow-hidden hover:ring-2 hover:ring-blue-500"
                            onclick="document.getElementById('mainProductImage').src='{{ Storage::url($img->path) }}'"
                        >
                            <img
                                src="{{ Storage::url($img->path) }}"
                                alt="تصویر {{ $product->name }}"
                                class="w-full h-16 object-cover"
                                loading="lazy"
                            >
                        </button>
                    @endforeach
                </div>
            @endif
        </div>

        {{-- اطلاعات محصول --}}
        <div>
            <h1 class="text-3xl font-bold text-gray-900 mb-3">
                {{ $product->name }}
            </h1>

            <div class="flex items-center gap-3 mb-4">
                <div class="text-2xl font-bold text-gray-900">
                    {{ number_format($product->price) }}
                    <span class="text-base font-normal text-gray-600">تومان</span>
                </div>

                @if($product->stock > 0)
                    <span class="text-sm bg-green-100 text-green-700 px-3 py-1 rounded">
                        موجود ({{ $product->stock }})
                    </span>
                @else
                    <span class="text-sm bg-red-100 text-red-700 px-3 py-1 rounded">
                        ناموجود
                    </span>
                @endif
            </div>

            @if($product->category)
                <p class="text-gray-600 mb-4">
                    دسته‌بندی:
                    <span class="text-gray-900 font-semibold">{{ $product->category->name }}</span>
                </p>
            @endif

            @if(!empty($product->description))
                <div class="bg-white rounded shadow p-4">
                    <h2 class="font-bold mb-2">توضیحات</h2>
                    <p class="text-gray-700 leading-7">
                        {{ $product->description }}
                    </p>
                </div>
            @endif

            {{-- دکمه سبد خرید: در فاز ۴ واقعی می‌کنیم --}}
            <div class="mt-6">
                <button
                    type="button"
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 rounded disabled:opacity-50"
                    @disabled($product->stock <= 0)
                >
                    افزودن به سبد خرید
                </button>
                <p class="text-xs text-gray-500 mt-2">
                    (سبد خرید در فاز ۴ پیاده‌سازی می‌شود)
                </p>
            </div>
        </div>
    </div>
@endsection
