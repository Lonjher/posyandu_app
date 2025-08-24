<main class="p-1 min-w-full mx-auto space-y-6">
    @slot('title')
        Pengguna
    @endslot
    <flux:fieldset>
        <flux:legend>Daftar Pengguna</flux:legend>
        <flux:description>Berikut adalah data Pengguna Sistem Anda!</flux:description>
        <div class="min-h-screen">
            <div class="flex justify-between items-center mb-4 ">
                <div class="flex gap-2">
                    <flux:input type="text" icon="magnifying-glass" kbd="⌘K" wire:model.live="search"
                        placeholder="Cari DPL..." class="w-full" size="xs" />
                    <div>
                        <flux:select size="xs" placeholder="Per Page" wire:model.live='perPage'>
                            <flux:select.option value="5">5</flux:select.option>
                            <flux:select.option value="7">7</flux:select.option>
                            <flux:select.option value="10">10</flux:select.option>
                            <flux:select.option value="20">20</flux:select.option>
                            <flux:select.option value="30">30</flux:select.option>
                            <flux:select.option value="50">50</flux:select.option>
                            <flux:select.option value="100">100</flux:select.option>
                        </flux:select>
                    </div>
                </div>
                <div class="flex gap-2">
                    <flux:button size="xs" class="shadow-sm cursor-pointer" icon="document"
                        wire:click="export">Export
                    </flux:button>
                    <flux:modal.trigger name="add-user" class="mb-4">
                        <flux:button icon="plus-circle" size="xs" class="shadow-sm">Tambah</flux:button>
                    </flux:modal.trigger>
                </div>
            </div>

            {{-- Add User Modal --}}
            <flux:modal name="add-user" class="md:w-xl">
                <form wire:submit.prevent="store" class="space-y-6">
                    <div>
                        <flux:heading size="lg">Tambah Pengguna</flux:heading>
                        <flux:text class="mt-2">Buatkan akun untuk pengguna yang belum terdaftar dalam sistem!</flux:text>
                    </div>
                    <flux:input :invalid="$errors->has('nik')" wire:model="nik" label="Nomor Induk Kependudukan (NIK)" placeholder="NIK" />
                    <flux:input :invalid="$errors->has('name')" wire:model="name" label="Nama Lengkap"
                        placeholder="Full Name" />
                    <flux:input :invalid="$errors->has('email')" wire:model="email" label="Email"
                        placeholder="Email" />
                    <flux:input label="No. HP" wire:model.defer="no_hp" :invalid="$errors->has('no_hp')"
                        class="w-full" required placeholder="628xxxxxxxx" :invalid="$errors->has('no_hp')" />
                    <flux:input :invalid="$errors->has('tanggal_lahir')" wire:model="tanggal_lahir" type="date"
                        label="Tanggal Lahir" placeholder="Tanggal Lahir" />
                    <flux:select placeholder="Jenis Kelamin" wire:model='jenis_kelamin' :invalid="$errors->has('jenis_kelamin')">
                        <flux:select.option value="">Pilih Jenis Kelamin</flux:select.option>
                        <flux:select.option value="L" selected>Laki-laki</flux:select.option>
                        <flux:select.option value="P">Perempuan</flux:select.option>
                    </flux:select>
                    <flux:input :invalid="$errors->has('alamat')" wire:model="alamat" label="Alamat"
                        placeholder="Alamat Lengkap" />
                    <div class="flex">
                        <flux:spacer />
                        <flux:button type="submit" variant="primary">Simpan</flux:button>
                    </div>
                </form>
            </flux:modal>

            {{-- Update User Modal --}}
            <flux:modal name="edit-user" class="md:w-xl">
                <form wire:submit.prevent="update" class="space-y-6">
                    <div>
                        <flux:heading size="lg">Update Pengguna</flux:heading>
                        <flux:text class="mt-2">Update data pengguna yang sudah terdaftar dalam sistem.</flux:text>
                    </div>
                    <flux:select placeholder="Peran Pengguna" wire:model='role'
                        :invalid="$errors->has('role')">
                            <flux:select.option value="admin">Admin</flux:select.option>
                            <flux:select.option value="kader">Kader</flux:select.option>
                            <flux:select.option value="pemdes">Pemerintah Desa</flux:select.option>
                            <flux:select.option value="user">Penggguna</flux:select.option>
                    </flux:select>
                    <flux:input :invalid="$errors->has('nik')" wire:model="nik" label="Nomor Induk Kependudukan (NIK)" placeholder="NIK" />
                    <flux:input :invalid="$errors->has('name')" wire:model="name" label="Nama Lengkap"
                        placeholder="Full Name" />
                    <flux:input :invalid="$errors->has('email')" wire:model="email" label="Email"
                        placeholder="Email" />
                    <flux:input label="No. HP" wire:model.defer="no_hp" :invalid="$errors->has('no_hp')"
                        class="w-full" required placeholder="628xxxxxxxx" :invalid="$errors->has('no_hp')" />
                    <flux:input :invalid="$errors->has('tanggal_lahir')" wire:model="tanggal_lahir" type="date"
                        label="Tanggal Lahir" placeholder="Tanggal Lahir" />
                    <flux:select placeholder="Jenis Kelamin" wire:model='jenis_kelamin' :invalid="$errors->has('jenis_kelamin')">
                        <flux:select.option value="">Pilih Jenis Kelamin</flux:select.option>
                        <flux:select.option value="L" selected>Laki-laki</flux:select.option>
                        <flux:select.option value="P">Perempuan</flux:select.option>
                    </flux:select>
                    <flux:input :invalid="$errors->has('alamat')" wire:model="alamat" label="Alamat"
                        placeholder="Alamat Lengkap" />
                    <div class="flex">
                        <flux:spacer />
                        <flux:button type="submit" variant="primary">Edit DPL</flux:button>
                    </div>
                </form>
            </flux:modal>

            <div class="w-full overflow-x-auto border border-gray-300 dark:border-gray-700 rounded-md">
                <table class="min-w-[800px] w-full text-xs divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300">
                        <tr>
                            <th class="px-2 py-2 text-left">No</th>
                            <th class="px-2 py-2 text-left">Nama</th>
                            <th class="px-2 py-2 text-left">NIK</th>
                            <th class="px-2 py-2 text-left">No. Hp</th>
                            <th class="px-2 py-2 text-left">Tgl. Lahir</th>
                            <th class="px-2 py-2 text-left">Jenis Kelamin</th>
                            <th class="px-2 py-2 text-left">Alamat</th>
                            <th class="px-2 py-2 text-left">Peran</th>
                            <th class="px-2 py-2 text-left">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                        @forelse ($users as $no => $user)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-800 text-gray-800 dark:text-gray-200">
                                <td class="px-2 py-2">{{ $users->firstItem() + $no }}</td>
                                <td class="px-2 py-2 flex items-center gap-2">
                                    <img src="{{ asset('storage/' . $user->avatar) }}"
                                        class="h-6 w-6 rounded-full" alt="avatar">
                                    <div>
                                        <div class="text-[0.7rem] font-semibold">{{ $user->name }}</div>
                                        <div class="text-[0.65rem] text-gray-500 dark:text-gray-400">
                                            {{ $user->email }}</div>
                                    </div>
                                </td>
                                <td class="px-2 py-2 text-[0.7rem]">{{ $user->nik }}
                                </td>
                                <td class="px-2 py-2 text-[0.7rem]">{{ $user->no_hp }}
                                </td>
                                <td class="px-2 py-2 text-[0.7rem]">{{ $user->tanggal_lahir }}
                                </td>
                                <td class="px-2 py-2 text-[0.7rem]">{{ $user->jenis_kelamin }}
                                </td>
                                <td class="px-2 py-2 text-[0.7rem]">
                                    {{ Str::limit($user->alamat, 20) }}</td>
                                <td class="px-2 py-2 text-[0.7rem]">
                                    {{ $user->role }}</td>
                                <td class="px-2 py-2 space-x-1">
                                    <flux:dropdown position="bottom" align="start">
                                        <button
                                            class="text-gray-950 bg-blue-100 hover:bg-blue-200 dark:text-white dark:bg-gray-800 dark:hover:bg-gray-700 focus:outline-none px-3 py-1 rounded">
                                            &#8942;
                                        </button>
                                        <flux:menu class="w-10">
                                            <div class="flex flex-col space-y-1">
                                                <flux:button wire:click="edit({{ $user->id_user }})"
                                                    size="xs" icon="pencil" class="!text-[0.65rem]">
                                                    Edit
                                                </flux:button>
                                                <flux:button wire:click="confirmDelete({{ $user->id_user }})"
                                                    size="xs" icon="trash" class="!text-[0.65rem]">
                                                    Hapus
                                                </flux:button>
                                                <flux:button
                                                    wire:click="confirm_reset_password({{ $user->id_user }})"
                                                    size="xs" icon="key" class="!text-[0.65rem]">
                                                    Reset Password
                                                </flux:button>
                                            </div>
                                        </flux:menu>
                                    </flux:dropdown>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="10"
                                    class="px-2 py-3 text-center text-[0.7rem] text-gray-500 dark:text-gray-400">Belum
                                    ada data.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="text-sm mt-2">
                {{ $users->links('vendor.pagination.tailwind') }}
            </div>
        </div>
    </flux:fieldset>
</main>
