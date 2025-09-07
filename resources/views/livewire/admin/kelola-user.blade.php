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
                        placeholder="Cari Pengguna..." class="w-full" size="xs" />
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
                    <flux:button size="xs" class="shadow-sm cursor-pointer" icon="pdf" wire:click="export">
                        Export
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
                        <flux:text class="mt-2">Buatkan akun untuk pengguna yang belum terdaftar dalam sistem!
                        </flux:text>
                    </div>
                    <flux:input :invalid="$errors->has('nik')" wire:model="nik" label="Nomor Induk Kependudukan (NIK)"
                        placeholder="NIK" />
                    <flux:input :invalid="$errors->has('name')" wire:model="name" label="Nama Lengkap"
                        placeholder="Full Name" />
                    <flux:input :invalid="$errors->has('email')" wire:model="email" label="Email"
                        placeholder="Email" />
                    <flux:input label="No. HP" wire:model.defer="no_hp" :invalid="$errors->has('no_hp')" class="w-full"
                        required placeholder="628xxxxxxxx" :invalid="$errors->has('no_hp')" />
                    <flux:input :invalid="$errors->has('tanggal_lahir')" wire:model="tanggal_lahir" type="date"
                        label="Tanggal Lahir" placeholder="Tanggal Lahir" />
                    <flux:select placeholder="Jenis Kelamin" wire:model='jenis_kelamin'
                        :invalid="$errors->has('jenis_kelamin')">
                        <flux:select.option value="">Pilih Jenis Kelamin</flux:select.option>
                        <flux:select.option value="L" selected>Laki-laki</flux:select.option>
                        <flux:select.option value="P">Perempuan</flux:select.option>
                    </flux:select>
                    <flux:select placeholder="Kategori" wire:model='kategori' :invalid="$errors->has('kategori')">
                        <flux:select.option value="" selected>Kategori</flux:select.option>
                        <flux:select.option value="bumil">Ibu Hamil</flux:select.option>
                        <flux:select.option value="anak">Anak</flux:select.option>
                        <flux:select.option value="lansia">Lansia</flux:select.option>
                    </flux:select>
                    <flux:input :invalid="$errors->has('alamat')" wire:model="alamat" label="Alamat"
                        placeholder="Alamat Lengkap" />
                    <div class="flex">
                        <flux:spacer />
                        <flux:button type="submit" variant="primary">Simpan</flux:button>
                    </div>
                </form>
            </flux:modal>

            <!-- Modal Update User -->
            {{-- <flux:modal name="update-user" class="md:w-xl">
                <form wire:submit.prevent="update" class="space-y-6">
                    <div>
                        <flux:heading size="lg">Tambah Pengguna</flux:heading>
                        <flux:text class="mt-2">Buatkan akun untuk pengguna yang belum terdaftar dalam sistem!
                        </flux:text>
                    </div>
                    <flux:input :invalid="$errors->has('nik')" wire:model="nik" label="Nomor Induk Kependudukan (NIK)"
                        placeholder="NIK" />
                    <flux:input :invalid="$errors->has('name')" wire:model="name" label="Nama Lengkap"
                        placeholder="Full Name" />
                    <flux:input :invalid="$errors->has('email')" wire:model="email" label="Email"
                        placeholder="Email" />
                    <flux:input label="No. HP" wire:model.defer="no_hp" :invalid="$errors->has('no_hp')" class="w-full"
                        required placeholder="628xxxxxxxx" :invalid="$errors->has('no_hp')" />
                    <flux:input :invalid="$errors->has('tanggal_lahir')" wire:model="tanggal_lahir" type="date"
                        label="Tanggal Lahir" placeholder="Tanggal Lahir" />
                    <flux:select placeholder="Jenis Kelamin" wire:model='jenis_kelamin'
                        :invalid="$errors->has('jenis_kelamin')">
                        <flux:select.option value="">Pilih Jenis Kelamin</flux:select.option>
                        <flux:select.option value="L" selected>Laki-laki</flux:select.option>
                        <flux:select.option value="P">Perempuan</flux:select.option>
                    </flux:select>
                    <flux:select placeholder="Kategori" wire:model='kategori' :invalid="$errors->has('kategori')">
                        <flux:select.option value="" selected>Kategori</flux:select.option>
                        <flux:select.option value="bumil">Ibu Hamil</flux:select.option>
                        <flux:select.option value="anak">Anak</flux:select.option>
                        <flux:select.option value="lansia">Lansia</flux:select.option>
                    </flux:select>
                    <flux:input :invalid="$errors->has('alamat')" wire:model="alamat" label="Alamat"
                        placeholder="Alamat Lengkap" />
                    <div class="flex">
                        <flux:spacer />
                        <flux:button type="submit" variant="primary">Simpan</flux:button>
                    </div>
                </form>
            </flux:modal> --}}

            {{-- Update User Modal --}}
            {{-- <flux:modal name="update-user" class="md:w-xl">
                <form wire:submit.prevent="update" class="space-y-6">
                    <div>
                        <flux:heading size="lg">Update Pengguna</flux:heading>
                        <flux:text class="mt-2">Update data pengguna yang sudah terdaftar dalam sistem.</flux:text>
                    </div>
                    <flux:input :invalid="$errors->has('nik')" wire:model="nik"
                        label="Nomor Induk Kependudukan (NIK)" placeholder="NIK" />
                    <flux:input :invalid="$errors->has('name')" wire:model="name" label="Nama Lengkap"
                        placeholder="Full Name" />
                    <flux:input :invalid="$errors->has('email')" wire:model="email" label="Email"
                        placeholder="Email" />
                    <flux:input label="No. HP" wire:model.defer="no_hp" :invalid="$errors->has('no_hp')"
                        class="w-full" required placeholder="628xxxxxxxx" :invalid="$errors->has('no_hp')" />
                    <flux:input :invalid="$errors->has('tanggal_lahir')" wire:model="tanggal_lahir" type="date"
                        label="Tanggal Lahir" placeholder="Tanggal Lahir" />
                    <flux:select placeholder="Jenis Kelamin" wire:model='jenis_kelamin'
                        :invalid="$errors->has('jenis_kelamin')">
                        <flux:select.option value="">Pilih Jenis Kelamin</flux:select.option>
                        <flux:select.option value="L" selected>Laki-laki</flux:select.option>
                        <flux:select.option value="P">Perempuan</flux:select.option>
                    </flux:select>
                    <flux:input :invalid="$errors->has('alamat')" wire:model="alamat" label="Alamat"
                        placeholder="Alamat Lengkap" />
                    <div class="flex">
                        <flux:spacer />
                        <flux:button type="submit" variant="primary">Edit Pengguna</flux:button>
                    </div>
                </form>
            </flux:modal> --}}

            <flux:modal name="open-chat" class="md:w-lg">
                <form wire:submit.prevent="chat_notif" class="space-y-6">
                    <div>
                        <flux:heading size="lg">Chat Notif Pengguna</flux:heading>
                        <flux:text class="mt-2">Buatkan chat notifikasi pengguna terkiat pemeriksaan!
                        </flux:text>
                    </div>
                    <flux:textarea :invalid="$errors->has('chat')" wire:model="chat" label="Chat Notif"
                        placeholder="Tuliskan Notif Anda!" />
                    <div class="flex">
                        <flux:button type="submit" variant="primary">Kirim</flux:button>
                    </div>
                </form>
            </flux:modal>

            <flux:modal name="bulk-chat" class="md:w-lg">
                <form wire:submit.prevent="sendBulkChat" class="space-y-6">
                    <div>
                        <flux:heading size="lg">Chat Notif Pengguna</flux:heading>
                        <flux:text class="mt-2">Buatkan chat notifikasi pengguna terkiat pemeriksaan!
                        </flux:text>
                    </div>
                    <flux:textarea :invalid="$errors->has('chat')" wire:model="chat" label="Chat Notif"
                        placeholder="Tuliskan Notif Anda!" />
                    <div class="flex">
                        <flux:button type="submit" variant="primary">Kirim</flux:button>
                    </div>
                </form>
            </flux:modal>

            <div class="w-full overflow-x-auto border border-gray-300 dark:border-gray-700 rounded-md">
                <!-- Bulk Action Bar (akan muncul ketika ada user yang dipilih) -->
                @if (count($selectedUsers) > 0)
                    <div class="bg-blue-50 dark:bg-blue-900/20 p-2 border-b border-gray-300 dark:border-gray-700">
                        <div class="flex items-center justify-between">
                            <div class="text-sm text-blue-700 dark:text-blue-300">
                                <span class="font-medium">{{ count($selectedUsers) }}</span> user dipilih
                            </div>
                            <div class="space-x-2">
                                <button wire:click="openBulkChat"
                                    class="px-3 py-1 bg-green-100 hover:bg-green-200 text-green-700 text-xs rounded-md">
                                    Chat Notif
                                </button>
                                {{-- <button wire:click="bulkResetPassword"
                                    class="px-3 py-1 bg-orange-100 hover:bg-orange-200 text-orange-700 text-xs rounded-md">
                                    Reset Password
                                </button> --}}
                                <button wire:click="$set('selectedUsers', [])"
                                    class="px-3 py-1 bg-gray-100 hover:bg-gray-200 text-gray-700 text-xs rounded-md">
                                    Batal
                                </button>
                            </div>
                        </div>
                    </div>
                @endif

                <table class="min-w-[800px] w-full text-xs divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300">
                        <tr>
                            <th class="px-2 py-2 text-left w-10">
                                <input type="checkbox" wire:model.live="selectAll"
                                    class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                            </th>
                            <th class="px-2 py-2 text-left">No</th>
                            <th class="px-2 py-2 text-left">Nama</th>
                            <th class="px-2 py-2 text-left">NIK</th>
                            <th class="px-2 py-2 text-left">No. Hp</th>
                            <th class="px-2 py-2 text-left">Tgl. Lahir</th>
                            <th class="px-2 py-2 text-left">Jenis Kelamin</th>
                            <th class="px-2 py-2 text-left">Alamat</th>
                            <th class="px-2 py-2 text-left">Kategori</th>
                            <th class="px-2 py-2 text-left">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                        @forelse ($users as $no => $user)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-800 text-gray-800 dark:text-gray-200">
                                <td class="px-2 py-2">
                                    <input type="checkbox" value="{{ $user->id_user }}"
                                        wire:model.live="selectedUsers"
                                        class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                </td>
                                <td class="px-2 py-2">{{ $users->firstItem() + $no }}</td>
                                <td class="px-2 py-2 flex items-center gap-2">
                                    <img src="{{ asset('storage/' . $user->avatar) }}" class="h-6 w-6 rounded-full"
                                        alt="avatar">
                                    <div>
                                        <div class="text-[0.7rem] font-semibold">{{ $user->name }}</div>
                                        <div class="text-[0.65rem] text-gray-500 dark:text-gray-400">
                                            {{ $user->email }}</div>
                                    </div>
                                </td>
                                <td class="px-2 py-2 text-[0.7rem]">{{ $user->nik }}</td>
                                <td class="px-2 py-2 text-[0.7rem]">{{ $user->no_hp }}</td>
                                <td class="px-2 py-2 text-[0.7rem]">{{ $user->tanggal_lahir }}</td>
                                <td class="px-2 py-2 text-[0.7rem]">{{ $user->jenis_kelamin }}</td>
                                <td class="px-2 py-2 text-[0.7rem]">{{ Str::limit($user->alamat, 20) }}</td>
                                <td class="px-2 py-2 text-[0.7rem]">{{ $user->kategori }}</td>
                                <td class="px-2 py-2 space-x-1">
                                    <flux:dropdown position="bottom" align="start">
                                        <button
                                            class="text-gray-950 bg-blue-100 hover:bg-blue-200 dark:text-white dark:bg-gray-800 dark:hover:bg-gray-700 focus:outline-none px-3 py-1 rounded">
                                            &#8942;
                                        </button>
                                        <flux:menu class="w-10">
                                            <div class="flex flex-col space-y-1">
                                                <flux:button wire:click="edit({{ $user->id_user }})" size="xs"
                                                    icon="pencil" class="!text-[0.65rem]">
                                                    Edit
                                                </flux:button>
                                                <flux:button wire:click="confirmDelete({{ $user->id_user }})"
                                                    size="xs" icon="trash" class="!text-[0.65rem]">
                                                    Hapus
                                                </flux:button>
                                                <flux:button wire:click="confirmResetPassword({{ $user->id_user }})"
                                                    size="xs" icon="key" class="!text-[0.65rem]">
                                                    Reset Password
                                                </flux:button>
                                                <flux:button wire:click="open_chat({{ $user->id_user }})"
                                                    icon="chat-bubble-oval-left-ellipsis" size="xs"
                                                    class="shadow-sm">
                                                    Chat Notif
                                                </flux:button>
                                            </div>
                                        </flux:menu>
                                    </flux:dropdown>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="11"
                                    class="px-2 py-3 text-center text-[0.7rem] text-gray-500 dark:text-gray-400">
                                    Belum ada data.
                                </td>
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
@push('script')
    <script>
        console.log('Hello Motherfucker!')
    </script>
    <!-- Di bagian bawah file blade, sebelum penutup </body> -->
    <script>
        document.addEventListener('livewire:init', () => {
            Livewire.on('openBulkWhatsApp', (event) => {
                const links = event.links;
                console.log('Membuka WhatsApp untuk', links.length, 'penerima');

                if (links.length > 0) {
                    // Buka link pertama di tab saat ini setelah sedikit delay
                    setTimeout(() => {
                        window.open(links[0], '_blank');
                    }, 500);

                    // Buka link lainnya di tab baru dengan jeda
                    for (let i = 1; i < links.length; i++) {
                        setTimeout(() => {
                            window.open(links[i], '_blank');
                        }, 1000 + (i * 1500)); // Jeda 1.5 detik antara setiap tab
                    }
                }
            });
        });
    </script>
@endpush
