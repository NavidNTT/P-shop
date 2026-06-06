@extends('layouts.store')

@section('title', 'سفارش‌های من')

@section('content')
<section class="space-y-6">

    {{-- header --}}
    <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-xl sm:text-2xl font-bold text-gray-900">
                سفارش‌های من
            </h1>
            <p class="text-sm text-gray-500 mt-1">
                لیست سفارش‌هایی که ثبت کرده‌اید در این صفحه نمایش داده می‌شود.
            </p>
        </div>

        <a href="{{ route('products.index') }}"
           class="inline-flex items-center justify-center rounded-lg border border-gray-200 bg-white px-3 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">
            مشاهده محصولات
        </a>
    </div>

    @if($orders->count())

        <div class="rounded-2xl bg-white shadow-sm ring-1 ring-gray-100 overflow-hidden">

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-100">

                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-right text-xs font-semibold text-gray-500">
                                شماره سفارش
                            </th>

                            <th class="px-4 py-3 text-right text-xs font-semibold text-gray-500">
                                وضعیت
                            </th>

                            <th class="px-4 py-3 text-right text-xs font-semibold text-gray-500">
                                مبلغ
                            </th>

                            <th class="px-4 py-3 text-right text-xs font-semibold text-gray-500">
                                تاریخ ثبت
                            </th>

                            <th class="px-4 py-3 text-center text-xs font-semibold text-gray-500">
                                عملیات
                            </th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-100 bg-white">

                        @foreach($orders as $order)

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

                            <tr>

                                {{-- id --}}
                                <td class="px-4 py-4 text-sm font-semibold text-gray-900">
                                    #{{ $order->id }}
                                </td>

                                {{-- status --}}
                                <td class="px-4 py-4 text-sm">
                                    <span class="px-2.5 py-1 rounded-full text-xs font-medium {{ $status['class'] }}">
                                        {{ $status['text'] }}
                                    </span>
                                </td>

                                {{-- price --}}
                                <td class="px-4 py-4 text-sm font-semibold text-gray-900">
                                    {{ number_format($order->total) }}
                                    <span class="text-xs text-gray-500">تومان</span>
                                </td>

                                {{-- date --}}
                                <td class="px-4 py-4 text-sm text-gray-600">
                                    {{ $order->created_at->format('Y/m/d H:i') }}
                                </td>

                                {{-- action --}}
                                <td class="px-4 py-4 text-center">
                                    <a href="{{ route('orders.show', $order) }}"
                                       class="inline-flex items-center justify-center rounded-md border border-gray-200 px-3 py-1.5 text-xs font-medium text-gray-700 hover:bg-gray-50">
                                        مشاهده جزئیات
                                    </a>
                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>
            </div>

        </div>

        {{-- pagination --}}
        <div>
            {{ $orders->links() }}
        </div>

    @else

        {{-- empty state --}}
        <div class="rounded-2xl border border-dashed border-gray-300 bg-white p-10 text-center">

            <div class="text-3xl mb-3">
                📦
            </div>

            <h2 class="text-base font-semibold text-gray-900 mb-1">
                هنوز سفارشی ثبت نکرده‌اید
            </h2>

            <p class="text-sm text-gray-500 mb-5">
                برای شروع خرید، به صفحه محصولات بروید.
            </p>

            <a href="{{ route('products.index') }}"
               class="inline-flex items-center justify-center rounded-lg bg-indigo-600 px-4 py-2 text-sm font-medium text-white hover:bg-indigo-700">
                مشاهده محصولات
            </a>

        </div>

    @endif

</section>
@endsection
