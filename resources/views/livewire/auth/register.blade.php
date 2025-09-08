<div class="bg-background flex min-h-svh flex-col items-center justify-center gap-6 p-6 md:p-10">
    <div class="flex w-full flex-col gap-2">
        <div class="w-full max-w-6xl mx-auto" x-data="registerComponent()" x-cloak>
            <div
                class="flex flex-col lg:flex-row items-stretch justify-center w-full rounded-2xl overflow-hidden card-shadow">
                <!-- Form Section -->
                <div class="w-full lg:w-7/12 bg-white dark:bg-gray-800 p-8 lg:p-12 shadow-xl">
                    <!-- Auth Header -->
                    <x-auth-header :title="__('Buat Akun')" :description="__('Lengkapi data berikut untuk melakukan pendaftaram!')" />

                    <form wire:submit.prevent="register" method="POST" class="space-y-5 mt-5">
                        @csrf
                        <!-- Nama & Email -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <flux:input wire:model="name" :label="__('Nama Lengkap')" type="text" icon="user"
                                    size="sm" required autofocus autocomplete="name" placeholder="Nama lengkap"
                                    :invalid="$errors->has('name')" />
                            </div>
                            <div>
                                <flux:input wire:model="email" :label="__('Alamat Email')" type="email"
                                    icon="envelope" size="sm" required autocomplete="email"
                                    placeholder="email@example.com" :invalid="$errors->has('email')" />
                            </div>
                        </div>

                        <!-- NIK & No HP -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <flux:input wire:model="nik" :label="__('Nomor Induk Kependudukan (NIK)')"
                                    type="text" icon="identity-card" maxlength="16" size="sm" required
                                    autocomplete="nik" placeholder="35xxxxxxxxxx" :invalid="$errors->has('nik')" />
                            </div>
                            <div>
                                <flux:input wire:model="no_hp" :label="__('No. Whatsapp')" type="text"
                                    icon="whatsapp" size="sm" required autocomplete="tel" placeholder="628xxxxxxxx"
                                    :invalid="$errors->has('no_hp')"
                                    oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 16);" />
                            </div>
                        </div>

                        <!-- Alamat -->
                        <div>
                            <flux:input wire:model="alamat" :label="__('Alamat Lengkap')" type="text" icon="map-pin"
                                size="sm" required autocomplete="street-address"
                                placeholder="Dusun / Desa / Kecamatan" :invalid="$errors->has('alamat')" />
                        </div>

                        <!-- Jenis Kelamin & Tanggal Lahir -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <flux:select wire:model="jenis_kelamin" :label="__('Jenis Kelamin')" icon="users"
                                    size="sm" :invalid="$errors->has('jenis_kelamin')" required>
                                    <option value="">-- Pilih --</option>
                                    <option value="L">Laki-laki</option>
                                    <option value="P">Perempuan</option>
                                </flux:select>
                            </div>
                            <div>
                                <flux:input wire:model="tanggal_lahir" :label="__('Tanggal Lahir')" type="date"
                                    icon="calendar" size="sm" autocomplete="bday"
                                    :invalid="$errors->has('tanggal_lahir')" />
                            </div>
                        </div>

                        <!-- Jenis Kategori -->
                        <div class="grid grid-cols-1 md:grid-cols-1 gap-4">
                            <div>
                                <flux:select wire:model="kategori" :label="__('Kategori')" icon="users"
                                    size="sm" :invalid="$errors->has('kategori')" required>
                                    <option value="">-- Pilih --</option>
                                    <option value="bumil">Ibu Hamil</option>
                                    <option value="anak">Anak</option>
                                    <option value="lansia">Lansia</option>
                                </flux:select>
                            </div>
                        </div>

                        <!-- Password -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <flux:input wire:model="password" icon="key" size="sm" :label="__('Password')"
                                    type="password" required autocomplete="new-password" placeholder="Password"
                                    viewable />
                            </div>
                            <div>
                                <flux:input wire:model="password_confirmation" :label="__('Konfirmasi Password')"
                                    size="sm" icon="key" type="password" required autocomplete="new-password"
                                    placeholder="Confirm password" viewable />
                            </div>
                        </div>

                        <!-- Terms and Conditions -->
                        <div class="flex items-center">
                            <input type="checkbox" id="terms"
                                class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                            <label for="terms" class="ml-2 block text-sm text-gray-700 dark:text-gray-300">
                                Saya menyetujui <a href="#"
                                    class="text-blue-600 dark:text-blue-400 hover:underline">Syarat & Ketentuan</a> dan
                                <a href="#" class="text-blue-600 dark:text-blue-400 hover:underline">Kebijakan
                                    Privasi</a>
                            </label>
                        </div>

                        <!-- Tombol Submit -->
                        <div class="flex items-center justify-end">
                            <flux:button type="submit" variant="primary" class="w-full">
                                {{ __('Daftar') }}
                            </flux:button>
                        </div>

                        <!-- Link ke Login -->
                        <div class="space-x-1 rtl:space-x-reverse text-center text-sm text-zinc-600 dark:text-zinc-400">
                            <span>{{ __('Sudah punya akun?') }}</span>
                            <flux:link :href="route('login')" wire:navigate>{{ __('Masuk') }}</flux:link>
                        </div>
                    </form>
                </div>

                <!-- Side Image -->
                <div class="w-full lg:w-5/12 hidden lg:flex flex-col justify-center items-center text-white">
                    <div class="max-w-xs mx-auto">
                        <img src="{{ asset('img/logo.png') }}" alt="Register" class="w-full h-auto">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
