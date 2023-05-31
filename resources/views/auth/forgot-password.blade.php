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
                <div class="mb-4 text-sm text-gray-600">
                    {{ __('lupa kata sandi Anda? Tidak masalah. Beri tahu kami alamat email Anda dan kami akan mengirimi Anda tautan setel ulang kata sandi melalui email yang memungkinkan Anda memilih yang baru.') }}
                </div>

                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <!-- Email Address -->
                    <div>
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                            :value="old('email')" required autofocus />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-end mt-4 ">
                        <a href="{{ __('login') }}" class="text-center mr-3 w-full items-center py-2 bg-[#6E11F4] border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest  focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150'">
                          Cancel
                        </a>
                        <x-primary-button>
                            {{ __('Email Password Reset Link') }}
                        </x-primary-button>

                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
