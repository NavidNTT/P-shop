@extends('layouts.store')

@section('title', 'سبد خرید')

@section('content')
    <div class="space-y-10">
        {{-- Premium Page Header --}}
        <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-6 relative">
            <div class="relative z-10">
                <h1 class="text-3xl sm:text-4xl font-black text-slate-900 tracking-tight mb-3">
                    سبد خرید شما
                </h1>
                <p class="text-base text-slate-500 font-bold">
                    @if(!empty($cart))
                        <span class="inline-flex items-center justify-center bg-indigo-50 text-indigo-600 px-3 py-1 rounded-lg mr-1">{{ count($cart) }}</span> محصول در سبد شما قرار دارد.
                    @else
                        سبد خرید شما در حال حاضر خالی است.
                    @endif
                </p>
            </div>

            @if(!empty($cart))
                <div class="flex flex-wrap items-center gap-4 relative z-10">
                    <a href="{{ route('products.index') }}" class="inline-flex items-center justify-center rounded-2xl border-2 border-slate-200 bg-white px-6 py-3 text-sm font-bold text-slate-600 hover:border-indigo-500 hover:text-indigo-600 hover:shadow-lg hover:shadow-indigo-500/10 transition-all duration-300">
                        ادامه خرید
                    </a>
                    <form action="{{ route('cart.clear') }}" method="POST" onsubmit="return confirm('آیا از خالی کردن سبد خرید اطمینان دارید؟');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="inline-flex items-center justify-center rounded-2xl bg-rose-50 px-6 py-3 text-sm font-bold text-rose-600 hover:bg-rose-500 hover:text-white hover:shadow-lg hover:shadow-rose-500/20 transition-all duration-300">
                            خالی کردن سبد
                        </button>
                    </form>
                </div>
            @endif
        </div>

        {{-- Alerts --}}
        @if (session('success'))
            <div class="rounded-2xl border border-emerald-100 bg-emerald-50 px-6 py-4 flex items-center gap-4 shadow-sm animate-[fadeIn_0.5s_ease-out]">
                <div class="bg-emerald-500 text-white p-1.5 rounded-xl shadow-md shadow-emerald-500/30">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" /></svg>
                </div>
                <span class="text-sm font-bold text-emerald-800">{{ session('success') }}</span>
            </div>
        @endif

        @if (session('error'))
            <div class="rounded-2xl border border-rose-100 bg-rose-50 px-6 py-4 flex items-center gap-4 shadow-sm animate-[fadeIn_0.5s_ease-out]">
                <div class="bg-rose-500 text-white p-1.5 rounded-xl shadow-md shadow-rose-500/30">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>
                </div>
                <span class="text-sm font-bold text-rose-800">{{ session('error') }}</span>
            </div>
        @endif

        @if(empty($cart))
            {{-- Premium Empty State --}}
            <div class="flex flex-col items-center justify-center rounded-[3rem] border-2 border-dashed border-slate-200 bg-slate-50/50 py-32 px-6 text-center">
                <div class="mx-auto w-32 h-32 bg-white shadow-[0_8px_30px_-15px_rgba(0,0,0,0.1)] rounded-full flex items-center justify-center mb-8 relative">
                    <div class="absolute inset-0 bg-indigo-500/10 rounded-full animate-ping"></div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-14 w-14 text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                </div>
                <h2 class="text-2xl font-black text-slate-900 mb-4">سبد خرید شما خالی است</h2>
                <p class="text-base text-slate-500 mb-10 max-w-md font-medium leading-relaxed">شما هنوز هیچ محصولی به سبد خرید خود اضافه نکرده‌اید. برای شروع خرید و مشاهده محصولات بی‌نظیر ما به فروشگاه مراجعه کنید.</p>
                <a href="{{ route('products.index') }}" class="group relative inline-flex items-center justify-center rounded-2xl bg-indigo-600 px-10 py-4 text-base font-bold text-white shadow-xl shadow-indigo-600/30 hover:bg-indigo-500 hover:shadow-indigo-600/40 transition-all duration-300 transform hover:-translate-y-1 overflow-hidden">
                    <span class="relative z-10">رفتن به فروشگاه</span>
                    <div class="absolute inset-0 bg-gradient-to-r from-indigo-500 to-violet-500 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                </a>
            </div>
        @else
            <div class="grid grid-cols-1 lg:grid-cols-[minmax(0,1fr),380px] gap-8">
                {{-- Premium Cart Items --}}
                <div class="bg-white rounded-[2rem] shadow-[0_8px_30px_-15px_rgba(0,0,0,0.05)] border border-slate-100 overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-right border-collapse min-w-[600px]">
                            <thead>
                                <tr class="bg-slate-50/50 border-b border-slate-100">
                                    <th class="px-8 py-5 text-xs font-black text-slate-400 uppercase tracking-widest">محصول</th>
                                    <th class="px-8 py-5 text-xs font-black text-slate-400 uppercase tracking-widest text-center w-40">تعداد</th>
                                    <th class="px-8 py-5 text-xs font-black text-slate-400 uppercase tracking-widest text-center">قیمت کل</th>
                                    <th class="px-8 py-5 text-xs font-black text-slate-400 uppercase tracking-widest text-center w-24">حذف</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100">
                                @foreach($cart as $productId => $item)
                                    @php
                                        $lineTotal = $item['price'] * $item['quantity'];
                                    @endphp
                                    <tr class="hover:bg-slate-50/30 transition-colors group">
                                        <td class="px-8 py-6 align-middle">
                                            <div class="flex items-center gap-5">
                                                <a href="{{ route('products.show', $item['slug']) }}" class="block w-24 h-24 flex-shrink-0 rounded-2xl bg-slate-50 overflow-hidden border border-slate-100 shadow-inner group-hover:shadow-md transition-shadow">
                                                    <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}" class="w-full h-full object-cover mix-blend-multiply">
                                                </a>
                                                <div class="flex flex-col">
                                                    <a href="{{ route('products.show', $item['slug']) }}" class="text-base font-black text-slate-900 hover:text-indigo-600 transition-colors line-clamp-2 leading-relaxed mb-2">
                                                        {{ $item['name'] }}
                                                    </a>
                                                    <div class="inline-flex items-center text-sm font-bold text-slate-500">
                                                        {{ number_format($item['price']) }} <span class="text-[10px] ml-1">تومان</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        
                                        <td class="px-8 py-6 align-middle text-center">
                                            <form action="{{ route('cart.update', $item['product_id']) }}" method="POST" class="inline-flex items-center bg-white rounded-2xl border border-slate-200 p-1.5 shadow-sm">
                                                @csrf
                                                @method('PATCH')
                                                <button type="button" class="w-8 h-8 rounded-xl flex items-center justify-center text-slate-400 hover:bg-slate-100 hover:text-slate-900 transition-all"
                                                        onclick="var input = this.parentElement.querySelector('input[name=quantity]'); var val = parseInt(input.value) || 1; if(val > 1){ input.value = val - 1; this.form.submit(); }">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M20 12H4"></path></svg>
                                                </button>
                                                <input type="number" name="quantity" min="1" max="{{ $item['stock'] }}" value="{{ $item['quantity'] }}" class="w-12 text-center text-base font-black bg-transparent border-none focus:ring-0 text-slate-900 p-0" readonly>
                                                <button type="button" class="w-8 h-8 rounded-xl flex items-center justify-center text-slate-400 hover:bg-slate-100 hover:text-slate-900 transition-all"
                                                        onclick="var input = this.parentElement.querySelector('input[name=quantity]'); var val = parseInt(input.value) || 1; if(val < {{ $item['stock'] }}){ input.value = val + 1; this.form.submit(); }">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"></path></svg>
                                                </button>
                                            </form>
                                            @if($item['quantity'] >= $item['stock'])
                                                <div class="text-[11px] text-rose-500 mt-2 font-black tracking-wide">حداکثر موجودی</div>
                                            @endif
                                        </td>

                                        <td class="px-8 py-6 align-middle text-center">
                                            <div class="text-lg font-black text-slate-900">
                                                {{ number_format($lineTotal) }}
                                                <span class="text-[11px] text-slate-500 font-bold ml-1">تومان</span>
                                            </div>
                                        </td>

                                        <td class="px-8 py-6 align-middle text-center">
                                            <form action="{{ route('cart.remove', $item['product_id']) }}" method="POST" onsubmit="return confirm('این محصول از سبد حذف شود؟');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="p-3 rounded-xl text-slate-300 hover:text-rose-600 hover:bg-rose-50 transition-colors" title="حذف">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- Premium Order Summary --}}
                <aside class="space-y-6">
                    <div class="bg-white rounded-[2rem] p-8 shadow-[0_8px_30px_-15px_rgba(0,0,0,0.05)] border border-slate-100 relative overflow-hidden">
                        {{-- Top Border Gradient --}}
                        <div class="absolute top-0 left-0 w-full h-1 bg-gradient-to-r from-indigo-500 to-violet-500"></div>
                        
                        <h2 class="text-xl font-black text-slate-900 mb-8">خلاصه سفارش</h2>

                        <div class="space-y-5 mb-8">
                            <div class="flex items-center justify-between text-sm">
                                <span class="text-slate-500 font-bold">مبلغ کل محصولات</span>
                                <span class="font-black text-slate-900">{{ number_format($subtotal) }} تومان</span>
                            </div>
                            <div class="flex items-center justify-between text-sm">
                                <span class="text-slate-500 font-bold">هزینه ارسال</span>
                                <span class="font-bold text-indigo-600 bg-indigo-50 px-3 py-1 rounded-lg">رایگان (ویژه)</span>
                            </div>
                        </div>

                        <div class="border-t-2 border-dashed border-slate-100 pt-8 mb-8">
                            <div class="flex items-center justify-between">
                                <span class="text-base font-black text-slate-900 uppercase tracking-wide">جمع کل</span>
                                <div class="text-left flex items-baseline gap-1">
                                    <span class="block text-3xl font-black text-slate-900 tracking-tight">{{ number_format($subtotal) }}</span>
                                    <span class="text-xs text-slate-500 font-bold">تومان</span>
                                </div>
                            </div>
                        </div>

                        <a href="{{ route('checkout.show') }}" class="group relative w-full inline-flex items-center justify-center rounded-2xl bg-indigo-600 px-6 py-4 text-base font-black text-white shadow-xl shadow-indigo-600/30 hover:bg-indigo-500 hover:shadow-indigo-600/40 transition-all duration-300 transform hover:-translate-y-1 overflow-hidden">
                            <span class="relative z-10 flex items-center">
                                تکمیل خرید و پرداخت
                                <svg class="w-5 h-5 mr-2 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                            </span>
                            <div class="absolute inset-0 bg-gradient-to-r from-indigo-500 to-violet-500 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                        </a>
                    </div>

                    <div class="bg-indigo-50/50 rounded-2xl p-5 border border-indigo-100/50 flex items-start gap-4">
                        <div class="bg-indigo-100 text-indigo-500 p-2 rounded-xl flex-shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <p class="text-xs text-indigo-900/70 leading-relaxed font-bold mt-1">
                            کالاهای موجود در سبد شما ثبت و رزرو نشده‌اند، برای ثبت نهایی مراحل بعدی را تکمیل کنید.
                        </p>
                    </div>
                </aside>
            </div>
        @endif
    </div>
@endsection
