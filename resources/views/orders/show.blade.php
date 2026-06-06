@extends('layouts.store')

@section('title', 'جزئیات سفارش')

@section('content')
<section class="space-y-6">

    {{-- header --}}
    <div class="flex items-center justify-between flex-wrap gap-3">

        <div>
            <h1 class="text-xl sm:text-2xl font-bold text-gray-900">
                سفارش #{{ $order->id }}
            </h1>

            <p class="text-sm text-gray-500 mt-1">
                ثبت شده در {{ $order->created_at->format('Y/m/d H:i') }}
            </p>
        </div>

        <a href="{{ route('orders.index') }}"
           class="inline-flex items-center rounded-lg border border-gray-200 bg-white px-3 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">
            بازگشت به سفارش‌ها
        </a>

    </div>

    @php
        $statusMap = [
            'pending' => ['text' => 'در انتظار', 'class' => 'bg-yellow-100 text-yellow-800'],
            'processing' => ['text' => 'در حال پردازش', 'class' => 'bg-blue-100 text-blue-800'],
            'completed' => ['text' => 'تکمیل شده', 'class' => 'bg-green-100 text-green-800'],
            'cancelled' => ['text' => 'لغو شده', 'class' => 'bg-red-100 text-red-800'],
        ];

        $status = $statusMap[$order->status] ?? [
            'text' => $order->status,
            'class' => 'bg-gray-100 text-gray-700'
        ];
    @endphp

    {{-- status card --}}
    <div class="rounded-2xl bg-white shadow-sm ring-1 ring-gray-100 p-5">

        <div class="flex items-center justify-between flex-wrap gap-3">

            <div class="text-sm text-gray-500">
                وضعیت سفارش
            </div>

            <span class="px-3 py-1 rounded-full text-xs font-medium {{ $status['class'] }}">
                {{ $status['text'] }}
            </span>

        </div>

    </div>

    {{-- items --}}
    <div class="rounded-2xl bg-white shadow-sm ring-1 ring-gray-100 overflow-hidden">

        <div class="px-5 py-4 border-b border-gray-100">
            <h2 class="text-sm font-semibold text-gray-900">
                محصولات سفارش
            </h2>
        </div>

        <div class="overflow-x-auto">

            <table class="min-w-full divide-y divide-gray-100">

                <thead class="bg-gray-50">

                    <tr>
                        <th class="px-4 py-3 text-right text-xs font-semibold text-gray-500">
                            محصول
                        </th>

                        <th class="px-4 py-3 text-right text-xs font-semibold text-gray-500">
                            قیمت
                        </th>

                        <th class="px-4 py-3 text-right text-xs font-semibold text-gray-500">
                            تعداد
                        </th>

                        <th class="px-4 py-3 text-right text-xs font-semibold text-gray-500">
                            جمع
                        </th>
                    </tr>

                </thead>

                <tbody class="divide-y divide-gray-100 bg-white">

                    @foreach($order->items as $item)

                        <tr>

                            {{-- product --}}
                            <td class="px-4 py-4 text-sm font-medium text-gray-900">
                                {{ $item->product_name }}
                            </td>

                            {{-- price --}}
                            <td class="px-4 py-4 text-sm text-gray-700">
                                {{ number_format($item->price) }}
                                <span class="text-xs text-gray-500">تومان</span>
                            </td>

                            {{-- qty --}}
                            <td class="px-4 py-4 text-sm text-gray-700">
                                {{ $item->quantity }}
                            </td>

                            {{-- total --}}
                            <td class="px-4 py-4 text-sm font-semibold text-gray-900">
                                {{ number_format($item->price * $item->quantity) }}
                                <span class="text-xs text-gray-500">تومان</span>
                            </td>

                        </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

    </div>

    {{-- total --}}
    <div class="rounded-2xl bg-white shadow-sm ring-1 ring-gray-100 p-5">

        <div class="flex items-center justify-between">

            <div class="text-sm text-gray-500">
                مبلغ کل سفارش
            </div>

            <div class="text-lg font-extrabold text-gray-900">
                {{ number_format($order->total) }}
                <span class="text-sm text-gray-500 font-medium">
                    تومان
                </span>
            </div>

        </div>

    </div>

</section>
@endsection
