<div class="w-full max-w-6xl mx-auto px-4">
    <div class="flex flex-col lg:flex-row items-center justify-center w-full">
        <!-- Ilustrasi atau vector di kiri -->
        <div class="hidden lg:flex lg:w-1/2 justify-center items-center p-8">
            <div class="w-full max-w-md bg-primary-50 dark:bg-primary-900/20 rounded-xl p-6">
                <img src="{{ asset('img/login.png') }}" alt="Login">
            </div>
        </div>

        <!-- Form login di kanan -->
        <div class="w-full lg:w-1/2">
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md overflow-hidden max-w-md mx-auto pt-6 ">
                <x-auth-header :title="__('Selamat Datang')" :description="__('Masukkan Username dan Password anda!')" />

                <!-- Session Status -->
                <x-auth-session-status class="text-center" :status="session('status')" />

                <form method="POST" wire:submit="login" class="flex flex-col gap-5 p-8 ">
                    <!-- Email Address -->
                    <flux:input icon="user" wire:model="email" :label="__('Username')" type="email" placeholder="Username" required autofocus
                        autocomplete="username" />

                    <!-- Password -->
                    <div class="relative">
                        <flux:input icon="key" wire:model="password" :label="__('Password')" type="password" required
                            autocomplete="current-password" :placeholder="__('Password')" viewable />

                        @if (Route::has('password.request'))
                            <flux:link class="absolute end-0 top-0 text-sm" :href="route('password.request')"
                                wire:navigate>
                                {{ __('Forgot your password?') }}
                            </flux:link>
                        @endif
                    </div>

                    <!-- Remember Me -->
                    <flux:checkbox wire:model="remember" :label="__('Remember me')" />

                    <div class="flex items-center justify-end">
                        <flux:button variant="primary" type="submit" class="w-full">{{ __('Log in') }}</flux:button>
                    </div>
                    @if (Route::has('register'))
                        <div class="space-x-1 rtl:space-x-reverse text-center text-sm text-zinc-600 dark:text-zinc-400">
                            <span>{{ __('Don\'t have an account?') }}</span>
                            <flux:link :href="route('register')" wire:navigate>{{ __('Sign up') }}</flux:link>
                        </div>
                    @endif
                </form>

                <!-- Footer -->
                <div class="bg-gray-50 dark:bg-gray-700/50 px-6 py-4">
                    <p class="text-xs text-center text-gray-600 dark:text-gray-400">
                        © 2023 Sistem Posyandu. All rights reserved.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
