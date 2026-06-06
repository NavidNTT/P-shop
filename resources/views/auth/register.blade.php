<x-guest-layout>
    @section('title', 'ثبت‌نام')

<h1 class="text-base sm:text-lg font-semibold text-gray-900 mb-2">
    ایجاد حساب کاربری جدید
</h1>
<p class="text-xs sm:text-sm text-gray-500 mb-4">
    لطفاً اطلاعات زیر را برای ثبت‌نام وارد کنید.
</p>

    <form method="POST" action="{{ route('register') }}" class="space-y-5">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="'نام و نام خانوادگی'" />
            <x-text-input
                id="name"
                class="block mt-1 w-full"
                type="text"
                name="name"
                :value="old('name')"
                required
                autofocus
                autocomplete="name"
            />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

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
                autocomplete="new-password"
            />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div>
            <x-input-label for="password_confirmation" :value="'تکرار رمز عبور'" />

            <x-text-input
                id="password_confirmation"
                class="block mt-1 w-full"
                type="password"
                name="password_confirmation"
                required
                autocomplete="new-password"
            />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

<div class="flex items-center justify-between mt-4">
    <a
        class="text-xs text-gray-500 hover:text-gray-700"
        href="{{ route('login') }}"
    >
        قبلاً ثبت‌نام کرده‌اید؟ ورود
    </a>

    <x-primary-button class="ms-4">
        ثبت‌نام
    </x-primary-button>
</div>
    </form>
</x-guest-layout>
