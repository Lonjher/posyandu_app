{{-- <div class="flex flex-col gap-6">
    <x-auth-header :title="__('Create an account')" :description="__('Enter your details below to create your account')" />

    <!-- Session Status -->
    <x-auth-session-status class="text-center" :status="session('status')" />

    <form method="POST" wire:submit="register" class="flex flex-col gap-6">
        <!-- Name -->
        <flux:input
            wire:model="name"
            :label="__('Name')"
            type="text"
            required
            autofocus
            autocomplete="name"
            :placeholder="__('Full name')"
        />

        <!-- Email Address -->
        <flux:input
            wire:model="email"
            :label="__('Email address')"
            type="email"
            required
            autocomplete="email"
            placeholder="email@example.com"
        />

        <!-- Password -->
        <flux:input
            wire:model="password"
            :label="__('Password')"
            type="password"
            required
            autocomplete="new-password"
            :placeholder="__('Password')"
            viewable
        />

        <!-- Confirm Password -->
        <flux:input
            wire:model="password_confirmation"
            :label="__('Confirm password')"
            type="password"
            required
            autocomplete="new-password"
            :placeholder="__('Confirm password')"
            viewable
        />

        <div class="flex items-center justify-end">
            <flux:button type="submit" variant="primary" class="w-full">
                {{ __('Create account') }}
            </flux:button>
        </div>
    </form>

    <div class="space-x-1 rtl:space-x-reverse text-center text-sm text-zinc-600 dark:text-zinc-400">
        <span>{{ __('Already have an account?') }}</span>
        <flux:link :href="route('login')" wire:navigate>{{ __('Log in') }}</flux:link>
    </div>
</div> --}}
<div class="w-full max-w-5xl mx-auto px-4" x-data="registerComponent()" x-cloak>
    <!-- Toggle Dark Mode -->
    <div class="flex justify-end mb-4">
        <button @click="toggleDarkMode()"
            class="p-2 rounded-full bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-200 shadow hover:shadow-md transition-shadow">
            <i x-show="!darkMode" class="ri-moon-line"></i>
            <i x-show="darkMode" class="ri-sun-line"></i>
        </button>
    </div>

    <div class="flex flex-col lg:flex-row items-center justify-center w-full gap-6">
        <!-- Ilustrasi atau vector di kiri -->
        <div class="hidden lg:flex lg:w-2/5 justify-center items-center">
            <div class="w-full bg-primary-50 dark:bg-primary-900/20 rounded-xl p-6 shadow">
                <svg class="w-full h-auto text-primary-500 dark:text-primary-400" viewBox="0 0 500 400" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M375 150C375 232.843 307.843 300 225 300C142.157 300 75 232.843 75 150C75 67.1573 142.157 0 225 0C307.843 0 375 67.1573 375 150Z"
                        fill="currentColor" fill-opacity="0.2" />
                    <path
                        d="M425 250C425 287.555 394.555 318 357 318C319.445 318 289 287.555 289 250C289 212.445 319.445 182 357 182C394.555 182 425 212.445 425 250Z"
                        fill="currentColor" fill-opacity="0.3" />
                    <circle cx="125" cy="275" r="75" fill="currentColor" fill-opacity="0.1" />
                    <path
                        d="M150 200C150 232.093 176.907 259 209 259C241.093 259 268 232.093 268 200C268 167.907 241.093 141 209 141C176.907 141 150 167.907 150 200Z"
                        fill="currentColor" />
                    <path
                        d="M325 318H125C102.909 318 85 335.909 85 358V363C85 385.091 102.909 403 125 403H325C347.091 403 365 385.091 365 363V358C365 335.909 347.091 318 325 318Z"
                        fill="currentColor" />
                    <circle cx="160" cy="268" r="48" fill="currentColor"
                        class="text-white dark:text-gray-800" />
                    <path
                        d="M225 318H125C102.909 318 85 335.909 85 358V363C85 385.091 102.909 403 125 403H225C247.091 403 265 385.091 265 363V358C265 335.909 247.091 318 225 318Z"
                        fill="currentColor" fill-opacity="0.7" />
                </svg>
                <div class="mt-6 text-center">
                    <h3 class="text-lg font-bold text-primary-900 dark:text-primary-100">Daftar Akun Baru</h3>
                    <p class="text-primary-700 dark:text-primary-300 mt-2 text-sm">Bergabunglah dengan sistem posyandu
                        kami untuk mendapatkan akses lengkap</p>
                    <ul class="mt-4 space-y-2 text-left text-primary-800 dark:text-primary-200 text-sm">
                        <li class="flex items-start">
                            <i class="ri-checkbox-circle-fill text-green-500 mt-0.5 mr-2 text-sm"></i>
                            <span>Akses ke informasi kesehatan terbaru</span>
                        </li>
                        <li class="flex items-start">
                            <i class="ri-checkbox-circle-fill text-green-500 mt-0.5 mr-2 text-sm"></i>
                            <span>Jadwal posyandu dan layanan</span>
                        </li>
                        <li class="flex items-start">
                            <i class="ri-checkbox-circle-fill text-green-500 mt-0.5 mr-2 text-sm"></i>
                            <span>Konsultasi dengan tenaga kesehatan</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Form register di kanan -->
        <div class="w-full lg:w-3/5">
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md overflow-hidden w-full">
                <!-- Auth Header -->
                <div class="text-center mb-2 px-8 pt-6">
                    <a href="{{ url('/') }}" class="inline-block">
                        <div class="flex justify-center">
                            <div class="bg-primary-500 rounded-full p-2 shadow">
                                <i class="ri-team-line text-white text-2xl"></i>
                            </div>
                        </div>
                        <h1 class="text-xl font-bold text-gray-900 dark:text-white mt-3">Sistem Posyandu</h1>
                    </a>
                    <h4 class="text-lg font-semibold mt-2 dark:text-white">Buat Akun Baru</h4>
                    <p class="text-gray-500 dark:text-gray-400 mt-1 text-sm">Isi data berikut untuk mendaftar</p>
                </div>

                <!-- Session Status -->
                <div class="px-8">
                    <div x-show="sessionStatus"
                        class="mb-3 text-center text-xs text-green-600 dark:text-green-400 py-1 px-3 bg-green-50 dark:bg-green-900/30 rounded-md"
                        x-text="sessionStatus"></div>
                </div>

                <form method="POST" class="flex flex-col gap-4 px-8 pb-8 pt-2">
                    @csrf

                    <!-- Nama dan Email dalam satu baris (horizontal) -->
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                        <!-- Name -->
                        <div>
                            <label class="block text-gray-700 dark:text-gray-300 mb-2 text-sm font-medium">Nama
                                Lengkap</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="ri-user-line text-gray-400"></i>
                                </div>
                                <input type="text" name="name"
                                    class="w-full pl-10 pr-3 py-2 text-sm border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent dark:bg-gray-700 dark:text-white"
                                    placeholder="Nama lengkap" required autofocus autocomplete="name">
                            </div>
                        </div>

                        <!-- Email -->
                        <div>
                            <label class="block text-gray-700 dark:text-gray-300 mb-2 text-sm font-medium">Email</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="ri-mail-line text-gray-400"></i>
                                </div>
                                <input type="email" name="email"
                                    class="w-full pl-10 pr-3 py-2 text-sm border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent dark:bg-gray-700 dark:text-white"
                                    placeholder="Alamat email" required autocomplete="email">
                            </div>
                        </div>
                    </div>

                    <!-- Password dan Konfirmasi Password dalam kolom terpisah (vertikal) -->
                    <div class="space-y-4">
                        <!-- Password -->
                        <div>
                            <label
                                class="block text-gray-700 dark:text-gray-300 mb-2 text-sm font-medium">Password</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="ri-lock-line text-gray-400"></i>
                                </div>
                                <input type="password" name="password" id="password"
                                    class="w-full pl-10 pr-10 py-2 text-sm border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent dark:bg-gray-700 dark:text-white"
                                    placeholder="Password" required autocomplete="new-password">
                                <button type="button" class="absolute inset-y-0 right-0 pr-3 flex items-center"
                                    onclick="togglePassword('password')">
                                    <i class="ri-eye-line text-gray-400" id="password-icon"></i>
                                </button>
                            </div>
                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Password harus minimal 8 karakter
                                dengan kombinasi huruf dan angka</p>
                        </div>

                        <!-- Confirm Password -->
                        <div>
                            <label class="block text-gray-700 dark:text-gray-300 mb-2 text-sm font-medium">Konfirmasi
                                Password</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="ri-lock-line text-gray-400"></i>
                                </div>
                                <input type="password" name="password_confirmation" id="password-confirm"
                                    class="w-full pl-10 pr-10 py-2 text-sm border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent dark:bg-gray-700 dark:text-white"
                                    placeholder="Konfirmasi password" required autocomplete="new-password">
                                <button type="button" class="absolute inset-y-0 right-0 pr-3 flex items-center"
                                    onclick="togglePassword('password-confirm')">
                                    <i class="ri-eye-line text-gray-400" id="password-confirm-icon"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Terms Agreement -->
                    <div class="flex items-start bg-gray-50 dark:bg-gray-700/50 p-3 rounded-lg">
                        <input type="checkbox" name="terms" id="terms"
                            class="h-4 w-4 text-primary-500 rounded focus:ring-primary-500 dark:bg-gray-700 mt-0.5">
                        <label for="terms" class="ml-2 text-xs text-gray-700 dark:text-gray-300">
                            Saya menyetujui <a href="#"
                                class="text-primary-500 dark:text-primary-400 hover:underline">Syarat & Ketentuan</a>
                            dan <a href="#"
                                class="text-primary-500 dark:text-primary-400 hover:underline">Kebijakan Privasi</a>
                        </label>
                    </div>

                    <div class="flex items-center justify-end mt-1">
                        <button type="submit"
                            class="w-full bg-primary-500 text-white py-2 px-4 rounded-lg hover:bg-primary-600 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 transition duration-150 dark:focus:ring-offset-gray-800 text-sm font-medium shadow-sm hover:shadow">
                            Daftar Sekarang
                        </button>
                    </div>

                    <div
                        class="space-x-1 rtl:space-x-reverse text-center text-xs text-gray-600 dark:text-gray-400 pt-3 border-t border-gray-200 dark:border-gray-700">
                        <span>Sudah punya akun?</span>
                        <a href="{{ route('login') }}"
                            class="text-primary-500 dark:text-primary-400 font-medium hover:underline">
                            Login di sini
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
