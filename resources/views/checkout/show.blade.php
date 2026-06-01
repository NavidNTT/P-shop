@extends('layouts.store')

@section('content')
    <h1 class="mb-6 text-2xl font-bold">تسویه حساب</h1>

    @if(session('error'))
        <div class="mb-4 rounded-lg bg-red-100 px-4 py-3 text-red-700">
            {{ session('error') }}
        </div>
    @endif

    <div class="rounded-xl bg-white p-6 shadow">
        <div class="mb-4 text-lg font-semibold">
            مبلغ قابل پرداخت: {{ number_format($subtotal) }} تومان
        </div>

        <form action="{{ route('checkout.store') }}" method="POST"
              onsubmit="return confirm('سفارش ثبت شود؟')">
            @csrf
            <button class="rounded-lg bg-blue-600 px-5 py-3 text-white hover:bg-blue-700">
                ثبت سفارش
            </button>
        </form>
    </div>
@endsection
