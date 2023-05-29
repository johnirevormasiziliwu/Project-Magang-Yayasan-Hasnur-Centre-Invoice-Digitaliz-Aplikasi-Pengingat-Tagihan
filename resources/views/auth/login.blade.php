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

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email Address -->
                    <div>
                        <x-input-label for="password" :value="__('Email')" />

                        <x-text-input id="email" class="block mt-5 w-full" type="email"
                            placeholder="Masukan Email Anda" name="email" :value="old('email')" required autofocus
                            autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div class="mt-4">
                        <x-input-label for="password" :value="__('Password')" />

                        <div class="relative">
                            <x-text-input id="passwordLogin" type="tel" class="block mt-1 w-full pr-10"
                                type="password" name="password" required autocomplete="new-password"
                                placeholder="Masukkan password anda" onfocus="this.placeholder=''"
                                onblur="this.placeholder='Masukkan password anda'" />

                            <button id="togglePassword3"
                                class="absolute top-0 right-0 h-full w-10 text-gray-400 hover:text-gray-600 flex items-center justify-center focus:outline-none">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24"
                                    height="24">
                                    <path
                                        d="M1.18164 12C2.12215 6.87976 6.60812 3 12.0003 3C17.3924 3 21.8784 6.87976 22.8189 12C21.8784 17.1202 17.3924 21 12.0003 21C6.60812 21 2.12215 17.1202 1.18164 12ZM12.0003 17C14.7617 17 17.0003 14.7614 17.0003 12C17.0003 9.23858 14.7617 7 12.0003 7C9.23884 7 7.00026 9.23858 7.00026 12C7.00026 14.7614 9.23884 17 12.0003 17ZM12.0003 15C10.3434 15 9.00026 13.6569 9.00026 12C9.00026 10.3431 10.3434 9 12.0003 9C13.6571 9 15.0003 10.3431 15.0003 12C15.0003 13.6569 13.6571 15 12.0003 15Z"
                                        fill="#022240"></path>
                                </svg>
                            </button>
                        </div>

                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Remember Me -->
                    <div class="block mt-4">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox"
                                class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                                name="remember">
                            <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                        </label>
                    </div>

                    <div class="flex items-center justify-end mt-5">
                        @if (Route::has('password.request'))
                            <a class="underline text-sm text-[#6E11F4] no-underline font-normal  hover:primary"
                                href="{{ route('password.request') }}">
                                {{ __('Lupa password?') }}
                            </a>
                        @endif

                    </div>
                    <div class=" mt-4 text-center">
                        <x-primary-button class="text-center">
                            {{ __('Login') }}
                        </x-primary-button>
                    </div>

                </form>



            </div>
        </div>
    </div>
</x-guest-layout>
