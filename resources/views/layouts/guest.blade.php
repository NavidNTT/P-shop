<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://cdn.jsdelivr.net/gh/rastikerdar/vazirmatn@v33.003/Vazirmatn-font-face.css" rel="stylesheet" type="text/css" />

    <title>{{ config('app.name', 'P-Shop') }} - @yield('title', 'حساب کاربری')</title>

    <!-- Fonts & Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 text-gray-800 antialiased">

    <div class="min-h-screen flex flex-col">

        {{-- Top bar / brand --}}
        <header class="border-b border-gray-200 bg-white/80 backdrop-blur">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-3 flex items-center justify-between gap-3">
                <a href="{{ route('home') }}" class="flex items-center gap-2">
                    <span class="inline-flex h-9 w-9 items-center justify-center rounded-xl bg-indigo-600 text-white font-bold text-lg">
                        P
                    </span>
                    <div class="flex flex-col">
                        <span class="text-sm font-semibold text-gray-900">
                            {{ config('app.name', 'P-Shop') }}
                        </span>
                        <span class="text-xs text-gray-500">
                            ورود / ثبت‌نام
                        </span>
                    </div>
                </a>

                <a href="{{ route('products.index') }}"
                   class="hidden sm:inline-flex items-center rounded-lg border border-gray-200 bg-white px-3 py-1.5 text-xs font-medium text-gray-700 hover:bg-gray-50">
                    بازگشت به فروشگاه
                </a>
            </div>
        </header>

        {{-- Main auth card --}}
<div class="min-h-screen bg-gray-100 flex items-center justify-center px-4">
    <div class="w-full max-w-md">
        <div class="bg-white border border-gray-200 shadow-sm rounded-2xl p-6 sm:p-8">
            {{ $slot }}
        </div>
    </div>
</div>

                <p class="mt-4 text-xs text-center text-gray-500">
                    با ورود یا ثبت‌نام، شما شرایط استفاده از سایت را می‌پذیرید.
                </p>
            </div>
        </main>

        {{-- Footer --}}
        <footer class="border-t border-gray-200 bg-white">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-3 flex items-center justify-between text-[11px] text-gray-500">
                <span>© {{ now()->year }} {{ config('app.name', 'P-Shop') }}</span>
                <span>ساخته‌شده با لاراول</span>
            </div>
        </footer>

    </div>

</body>
</html>
