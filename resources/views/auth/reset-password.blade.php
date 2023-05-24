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

                <form method="POST" action="{{ route('password.store') }}">
                    @csrf

                    <!-- Password Reset Token -->
                    <input type="hidden" name="token" value="{{ $request->route('token') }}">

                    <!-- Email Address -->
                    <div>
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                            :value="old('email', $request->email)" required autofocus autocomplete="username" />
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
                        <x-primary-button>
                            {{ __('Reset Password') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
