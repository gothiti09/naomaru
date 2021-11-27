<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-atoms.application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- 法人番号 -->
            <div>
                <x-atoms.label for="corporate_number" value="法人番号" />

                <x-atoms.input id="corporate_number" class="block mt-1 w-full" name="corporate_number"
                    :value="old('corporate_number', request()->get('corporate_number'))" required autofocus />
            </div>

            <!-- ログインID -->
            <div class="mt-4">
                <x-atoms.label for="login_id" value="ログインID" />

                <x-atoms.input id="login_id" class="block mt-1 w-full" name="login_id"
                    :value="old('login_id', request()->get('login_id'))" required />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-atoms.label for="password" :value="__('Password')" />

                <x-atoms.input id="password" class="block mt-1 w-full" type="password" name="password" required
                    autocomplete="current-password" />
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox"
                        class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                        name="remember">
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                <div class="flex flex-col">
                    @if (Route::has('password.request'))
                        <a class="underline text-sm text-gray-600 hover:text-gray-900"
                            href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('register') }}">
                        {{ __('未登録の方はこちら') }}
                    </a>
                </div>
                <x-atoms.button-primary class="ml-3" type="submit">
                    {{ __('Log in') }}
                </x-atoms.button-primary>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
