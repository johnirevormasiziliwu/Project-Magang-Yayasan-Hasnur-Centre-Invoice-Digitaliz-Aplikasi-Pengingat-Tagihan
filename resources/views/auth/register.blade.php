<x-guest-layout>
    <div class="flex flex-col md:flex-row h-screen">
        <!-- Column Kiri - Logo dan Judul -->
        <div class="bg-[#F8F8F8] bg-center md:w-1/2 hidden sm:hidden md:block">
            <div class="flex items-center justify-center md:justify-start h-full">
                <div class="text-center mx-auto">
                    <img src="{{ asset('dist') }}/assets/img/login/logo_digitaliz.png" alt="Logo">
                </div>
            </div>
        </div>

        <!-- Column Kanan - Form Login -->
        <div class="md:hidden bg-primary text-center py-6 bg-[#F8F8F8]">
            <img class="mx-auto w-60" src="{{ asset('dist') }}/assets/img/login/logo_digitaliz.png" alt="Logo Digitaliz">
        </div>
        <div class="bg-white py-9 md:py-4 md:w-1/2 flex items-center justify-center">
            <div class="max-w-md w-full mx-auto px-4 md:px-8 lg:px-0">
                <h2 class="text-start text-3xl md:text-4xl font-bold mb-10 text-[#6E11F4]">Login</h2>
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <!-- Name -->
                    <div>
                        <x-input-label for="name" :value="__('Name')" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                            :value="old('name')" required autofocus autocomplete="name" />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <!-- Email Address -->
                    <div class="mt-4">
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                            :value="old('email')" required autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div class="mt-4">
                        <x-input-label for="password" :value="__('Password')" />

                        <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                            autocomplete="new-password" />

                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Confirm Password -->
                    <div class="mt-4">
                        <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

                        <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                            name="password_confirmation" required autocomplete="new-password" />

                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                            href="{{ route('login') }}">
                            {{ __('Already registered?') }}
                        </a>

                        <x-primary-button class="ml-4">
                            {{ __('Register') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</x-guest-layout>
