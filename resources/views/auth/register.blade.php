<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-atoms.application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- 法人番号 -->
            <div>
                <x-atoms.label for="corporate_number" value="法人番号" />

                <x-atoms.input id="corporate_number" class="block mt-1 w-full" type="text" name="corporate_number"
                    :value="old('corporate_number')" required autofocus />
            </div>
            <div class="mt-1 text-gray-500 text-xs" id="user_avatar_help">
                <x-atoms.link href="https://www.houjin-bangou.nta.go.jp/" target="_blank">法人番号がわからない方はこちら</x-atoms.link>
            </div>
            <!-- ログインID -->
            <div class="mt-4">
                <x-atoms.label for="login_id" value="ログインID" />

                <x-atoms.input id="login_id" class="block mt-1 w-full" type="text" name="login_id"
                    :value="old('login_id')" required autofocus />
            </div>
            <div class="mt-1 text-gray-500 text-xs" id="user_avatar_help">
                半角英数６文字以上
            </div>

            <!-- Name -->
            <div class="mt-4">
                <x-atoms.label for="name" value="担当者指名" />

                <x-atoms.input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required
                    autofocus />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-atoms.label for="email" :value="__('Email')" />

                <x-atoms.input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                    required />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-atoms.label for="password" :value="__('Password')" />

                <x-atoms.input id="password" class="block mt-1 w-full" type="password" name="password" required
                    autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-atoms.label for="password_confirmation" :value="__('Confirm Password')" />

                <x-atoms.input id="password_confirmation" class="block mt-1 w-full" type="password"
                    name="password_confirmation" required />
            </div>

            <input type="hidden" name="company_id" value="{{ old('company_id', request()->get('company_id')) }}" />

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-atoms.button-primary type="submit" class="ml-4">
                    {{ __('Register') }}
                </x-atoms.button-primary>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
