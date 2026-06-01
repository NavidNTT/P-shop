@extends('layouts.store')

@section('content')
    <div class="mb-6 flex items-center justify-between">
        <h1 class="text-2xl font-bold">سفارش #{{ $order->id }}</h1>

        <a href="{{ route('orders.index') }}" class="text-blue-600 hover:underline">
            بازگشت به سفارش‌های من
        </a>
    </div>

    @if(session('success'))
        <div class="mb-4 rounded-lg bg-green-100 px-4 py-3 text-green-700">
            {{ session('success') }}
        </div>
    @endif

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

    <div class="rounded-xl bg-white p-6 shadow">
        <div class="mb-4 text-gray-700">
            وضعیت:
            <span class="rounded-full px-3 py-1 text-xs font-semibold {{ $status['class'] }}">
                {{ $status['label'] }}
            </span>
        </div>

        <div class="mb-4 text-gray-700">
            تاریخ ثبت:
            <span class="font-semibold">{{ $order->created_at->format('Y/m/d H:i') }}</span>
        </div>

        <div class="mb-4 text-gray-700">
            جمع کل:
            <span class="font-semibold">{{ number_format($order->total) }} تومان</span>
        </div>

        <div class="mt-6 border-t pt-4">
            <h2 class="mb-4 text-lg font-semibold">آیتم‌ها</h2>

            <div class="space-y-4">
                @foreach($order->items as $item)
                    <div class="flex items-center justify-between rounded-lg border p-4">
                        <div>
                            <div class="font-semibold">{{ $item->product->name }}</div>
                            <div class="mt-1 text-sm text-gray-500">
                                {{ number_format($item->price) }} تومان × {{ $item->quantity }}
                            </div>
                        </div>

                        <div class="font-bold text-blue-700">
                            {{ number_format($item->line_total) }} تومان
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
