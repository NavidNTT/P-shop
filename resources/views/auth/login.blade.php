<x-guest-layout>
    @section('title', 'ورود')

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

<h1 class="text-base sm:text-lg font-semibold text-gray-900 mb-2">
    ورود به حساب کاربری
</h1>
<p class="text-xs sm:text-sm text-gray-500 mb-4">
    برای ورود، ایمیل و رمز عبور خود را وارد کنید.
</p>

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="'ایمیل'" />
            <x-text-input
                id="email"
                class="block mt-1 w-full"
                type="email"
                name="email"
                :value="old('email')"
                required
                autofocus
                autocomplete="username"
            />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="'رمز عبور'" />

            <x-text-input
                id="password"
                class="block mt-1 w-full"
                type="password"
                name="password"
                required
                autocomplete="current-password"
            />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center justify-between">
            <label for="remember_me" class="inline-flex items-center">
                <input
                    id="remember_me"
                    type="checkbox"
                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                    name="remember"
                >
                <span class="ms-2 text-sm text-gray-700">مرا به خاطر بسپار</span>
            </label>

            @if (Route::has('password.request'))
                <a
                    class="text-xs text-indigo-600 hover:text-indigo-700 font-medium"
                    href="{{ route('password.request') }}"
                >
                    رمز عبور خود را فراموش کرده‌اید؟
                </a>
            @endif
        </div>

<div class="flex items-center justify-between mt-3">
    <a
        href="{{ route('register') }}"
        class="text-xs text-gray-500 hover:text-gray-700"
    >
        هنوز ثبت‌نام نکرده‌اید؟ ثبت‌نام
    </a>

    <x-primary-button class="ms-3">
        ورود
    </x-primary-button>
</div>
    </form>
</x-guest-layout>
