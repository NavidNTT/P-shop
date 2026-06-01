@extends('layouts.store')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-bold">سفارش‌های من</h1>
        <p class="mt-2 text-sm text-gray-600">
            لیست سفارش‌هایی که ثبت کرده‌اید در این صفحه نمایش داده می‌شود.
        </p>
    </div>

    @if($orders->count())
        <div class="overflow-x-auto rounded-xl bg-white shadow">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                <tr class="text-right text-sm font-semibold text-gray-600">
                    <th class="px-4 py-3">شماره سفارش</th>
                    <th class="px-4 py-3">وضعیت</th>
                    <th class="px-4 py-3">مبلغ</th>
                    <th class="px-4 py-3">تاریخ ثبت</th>
                    <th class="px-4 py-3"></th>
                </tr>
                </thead>

                <tbody class="divide-y divide-gray-100">
                @foreach($orders as $order)
                    <tr>
                        <td class="px-4 py-4 font-semibold">
                            #{{ $order->id }}
                        </td>

                        <td class="px-4 py-4">
                            @php
                                $statusMap = [
                                    'pending' => ['label' => 'در انتظار', 'class' => 'bg-yellow-100 text-yellow-800'],
                                    'processing' => ['label' => 'در حال پردازش', 'class' => 'bg-blue-100 text-blue-800'],
                                    'completed' => ['label' => 'تکمیل شده', 'class' => 'bg-green-100 text-green-800'],
                                    'cancelled' => ['label' => 'لغو شده', 'class' => 'bg-red-100 text-red-800'],
                                ];

                                $status = $statusMap[$order->status] ?? [
                                    'label' => $order->status,
                                    'class' => 'bg-gray-100 text-gray-800',
                                ];
                            @endphp

                            <span class="rounded-full px-3 py-1 text-xs font-semibold {{ $status['class'] }}">
                                {{ $status['label'] }}
                            </span>
                        </td>

                        <td class="px-4 py-4">
                            {{ number_format($order->total) }} تومان
                        </td>

                        <td class="px-4 py-4 text-sm text-gray-600">
                            {{ $order->created_at->format('Y/m/d H:i') }}
                        </td>

                        <td class="px-4 py-4 text-left">
                            <a href="{{ route('orders.show', $order) }}"
                               class="text-blue-600 hover:underline">
                                مشاهده جزئیات
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            {{ $orders->links() }}
        </div>
    @else
        <div class="rounded-xl bg-white p-8 text-center shadow">
            <p class="mb-4 text-gray-600">هنوز سفارشی ثبت نکرده‌اید.</p>

            <a href="{{ route('products.index') }}"
               class="inline-block rounded-lg bg-blue-600 px-5 py-3 text-white hover:bg-blue-700">
                مشاهده محصولات
            </a>
        </div>
    @endif
@endsection
