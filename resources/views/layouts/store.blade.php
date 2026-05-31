<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>فروشگاه من</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 text-gray-800">

    <nav class="bg-white shadow mb-6">
        <div class="container mx-auto px-4 py-4 flex items-center justify-between">
            <div class="flex items-center gap-6">
                <a href="{{ route('home') }}" class="text-xl font-bold">فروشگاه آنلاین</a>

                <div class="flex items-center gap-4 text-sm">
                    <a href="{{ route('home') }}" class="hover:text-blue-600">خانه</a>
                    <a href="{{ route('products.index') }}" class="hover:text-blue-600">محصولات</a>
                </div>
            </div>

            <div class="flex items-center gap-3 text-sm">
                @guest
                    <a href="{{ route('login') }}" class="hover:text-blue-600">ورود</a>
                    <a href="{{ route('register') }}" class="bg-blue-600 text-white px-3 py-2 rounded hover:bg-blue-700">
                        ثبت‌نام
                    </a>
                @endguest

                @auth
                    <span class="text-gray-600">
                        {{ auth()->user()->name }}
                    </span>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-red-600 hover:underline">
                            خروج
                        </button>
                    </form>
                @endauth
            </div>
        </div>
    </nav>

    <main class="container mx-auto px-4 pb-10">
        @yield('content')
    </main>

    <footer class="text-center py-6 text-gray-500 text-sm">
        تمامی حقوق محفوظ است.
    </footer>
</body>
</html>
