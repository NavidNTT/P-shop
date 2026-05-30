<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>فروشگاه من</title>
    <!-- استفاده از Tailwind CSS از طریق CDN برای راحتی -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <nav class="bg-white shadow mb-6">
        <div class="container mx-auto px-4 py-4 flex items-center justify-between">
            <div class="flex items-center gap-6">
                <a href="{{ route('home') }}" class="text-xl font-bold">فروشگاه آنلاین</a>

                <div class="flex items-center gap-4 text-sm">
                    <a href="{{ route('home') }}" class="hover:text-blue-600">خانه</a>
                    <a href="{{ route('products.index') }}" class="hover:text-blue-600">محصولات</a>
                </div>
            </div>

            <div class="text-sm text-gray-500">
                فروشگاه آزمایشی لاراول
            </div>
        </div>
    </nav>

    <main class="container mx-auto p-4">
        @yield('content')
    </main>

    <footer class="text-center p-6 text-gray-500">
        تمامی حقوق محفوظ است.
    </footer>
</body>
</html>
