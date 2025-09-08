<main>
    @push('style')
        <style>
            .line-clamp-1 {
                overflow: hidden;
                display: -webkit-box;
                -webkit-box-orient: vertical;
                -webkit-line-clamp: 1;
            }

            .line-clamp-3 {
                overflow: hidden;
                display: -webkit-box;
                -webkit-box-orient: vertical;
                -webkit-line-clamp: 3;
            }

            .animate-fade-in {
                animation: fade-in 0.5s ease-out forwards;
            }

            .animate-slide-up {
                animation: slide-up 0.4s ease-out forwards;
            }

            .animate-bounce-in {
                animation: bounce-in 0.6s ease-out forwards;
            }

            @keyframes fade-in {
                from {
                    opacity: 0;
                    transform: translateY(10px);
                }

                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            @keyframes slide-up {
                from {
                    opacity: 0;
                    transform: translateY(20px);
                }

                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            @keyframes bounce-in {
                0% {
                    opacity: 0;
                    transform: scale(0.8);
                }

                50% {
                    opacity: 1;
                    transform: scale(1.05);
                }

                100% {
                    opacity: 1;
                    transform: scale(1);
                }
            }

            @keyframes float {

                0%,
                100% {
                    transform: translateY(0);
                }

                50% {
                    transform: translateY(-8px);
                }
            }

            @keyframes pulse-glow {

                0%,
                100% {
                    opacity: 0.7;
                }

                50% {
                    opacity: 1;
                    filter: drop-shadow(0 0 8px rgba(99, 102, 241, 0.6));
                }
            }

            .animate-float {
                animation: float 3s ease-in-out infinite;
            }

            .animate-pulse-glow {
                animation: pulse-glow 2s ease-in-out infinite;
            }

            .category-badge {
                transition: all 0.3s ease;
            }

            .category-badge:hover {
                transform: translateY(-2px);
                box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            }

            .edukasi-card {
                transition: all 0.3s ease;
            }

            .edukasi-card:hover {
                transform: translateY(-5px);
                box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            }
        </style>
    @endpush
    @slot('title')
        Edukasi
    @endslot
    <flux:fieldset>
        <flux:legend>Daftar Edukasi Posyandu</flux:legend>
        <flux:description>Kelola konten edukasi untuk berbagai kategori Posyandu.</flux:description>

        <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-6 gap-4">
            <div class="flex flex-col sm:flex-row gap-2 w-full md:w-auto">
                <flux:input type="text" icon="magnifying-glass" wire:model.live="search"
                    placeholder="Cari judul edukasi..." class="w-full sm:w-64" size="xs" clearable />

                <flux:select size="xs" placeholder="Filter Kategori" wire:model.live="kategoriFilter"
                    class="w-full sm:w-40">
                    <flux:select.option value="">Semua Kategori</flux:select.option>
                    <flux:select.option value="bumil">Ibu Hamil</flux:select.option>
                    <flux:select.option value="anak">anak</flux:select.option>
                    <flux:select.option value="lansia">Lansia</flux:select.option>
                    <flux:select.option value="umum">Umum</flux:select.option>
                </flux:select>

                <flux:select size="xs" placeholder="Per Page" wire:model.live='perPage' class="w-full sm:w-28">
                    <flux:select.option value="5">5</flux:select.option>
                    <flux:select.option value="10">10</flux:select.option>
                    <flux:select.option value="20">20</flux:select.option>
                    <flux:select.option value="35">35</flux:select.option>
                    <flux:select.option value="45">45</flux:select.option>
                    <flux:select.option value="50">50</flux:select.option>
                </flux:select>
            </div>

            <div class="flex gap-2 items-center w-full md:w-auto">
                <flux:modal.trigger name="add-edukasi">
                    <flux:button icon="plus-circle" size="xs"
                        class="shadow-sm cursor-pointer whitespace-nowrap w-full justify-center md:w-auto">
                        Tambah Edukasi
                    </flux:button>
                </flux:modal.trigger>
            </div>
        </div>

        @if ($edukasis->count() > 0)
            <!-- Filter Tags -->
            <div class="flex flex-wrap gap-2 mb-6 animate-fade-in">
                <span class="text-xs text-gray-600 dark:text-gray-400 py-1">Filter aktif:</span>

                @if ($kategoriFilter)
                    <span
                        class="category-badge inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800 dark:bg-indigo-900 dark:text-indigo-200">
                        {{ $kategoriFilter == 'bumil'
                            ? 'Ibu Hamil'
                            : ($kategoriFilter == 'anak'
                                ? 'anak'
                                : ($kategoriFilter == 'lansia'
                                    ? 'Lansia'
                                    : 'Umum')) }}
                        <button wire:click="$set('kategoriFilter', '')"
                            class="ml-1 text-indigo-600 dark:text-indigo-300 hover:text-indigo-800 dark:hover:text-indigo-100">
                            &times;
                        </button>
                    </span>
                @endif

                @if ($search)
                    <span
                        class="category-badge inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">
                        Pencarian: "{{ $search }}"
                        <button wire:click="$set('search', '')"
                            class="ml-1 text-blue-600 dark:text-blue-300 hover:text-blue-800 dark:hover:text-blue-100">
                            &times;
                        </button>
                    </span>
                @endif
            </div>

            <!-- Grid Edukasi -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                @foreach ($edukasis as $key => $edukasi)
                    <div class="edukasi-card bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden hover:shadow-md transition-all duration-200 animate-slide-up"
                        style="animation-delay: {{ $key * 0.03 }}s">
                        <!-- Gambar Edukasi -->
                        <div class="h-36 overflow-hidden relative">
                            <img src="{{ asset('storage/' . $edukasi->gambar) }}" alt="{{ $edukasi->judul }}"
                                class="w-full h-full object-cover transition-transform duration-300 hover:scale-102">

                            <!-- Kategori Badge -->
                            <div class="absolute top-2 left-2">
                                @php
                                    $kategoriColors = [
                                        'bumil' => 'bg-pink-100 text-pink-800 dark:bg-pink-900 dark:text-pink-200',
                                        'anak' => 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200',
                                        'lansia' =>
                                            'bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-200',
                                        'umum' => 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200',
                                    ];

                                    $kategoriLabels = [
                                        'bumil' => 'Ibu Hamil',
                                        'anak' => 'anak',
                                        'lansia' => 'Lansia',
                                        'umum' => 'Umum',
                                    ];
                                @endphp
                                <span
                                    class="text-[10px] font-medium px-1.5 py-0.5 rounded-full {{ $kategoriColors[$edukasi->kategori] }}">
                                    {{ $kategoriLabels[$edukasi->kategori] }}
                                </span>
                            </div>
                        </div>

                        <div class="p-3">
                            <!-- Judul dan Menu Options -->
                            <div class="flex justify-between items-start mb-2">
                                <h3
                                    class="font-medium text-gray-800 dark:text-white text-sm line-clamp-2 leading-tight">
                                    {{ $edukasi->judul }}
                                </h3>

                                <div class="relative">
                                    <flux:dropdown position="bottom" align="end">
                                        <button
                                            class="text-gray-400 hover:text-gray-600 dark:text-gray-500 dark:hover:text-gray-300 p-0.5 rounded-full hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                                            </svg>
                                        </button>
                                        <flux:menu class="w-32 text-xs">
                                            <div class="flex flex-col p-1">
                                                <flux:button wire:click='edit({{ $edukasi->id_edukasi }})'
                                                    size="xs" icon="pencil"
                                                    class="!text-xs justify-start rounded-md py-1.5">
                                                    Edit
                                                </flux:button>
                                                <flux:button wire:click="confirmDelete({{ $edukasi->id_edukasi }})"
                                                    size="xs" icon="trash"
                                                    class="!text-xs justify-start text-red-600 hover:text-red-700 rounded-md py-1.5">
                                                    Hapus
                                                </flux:button>
                                            </div>
                                        </flux:menu>
                                    </flux:dropdown>
                                </div>
                            </div>

                            <!-- Info Tanggal -->
                            <div class="flex items-center text-xs text-gray-500 dark:text-gray-400 mb-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 mr-1" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <span>{{ \Carbon\Carbon::parse($edukasi->created_at)->format('d M Y') }}</span>
                            </div>

                            <!-- Action Button -->
                            <div
                                class="flex justify-between items-center pt-2 border-t border-gray-100 dark:border-gray-700">
                                <a href="{{ route('baca.edukasi', $edukasi->id_edukasi) }}"
                                    class="cursor-pointer text-indigo-600 hover:text-indigo-800 dark:text-indigo-400 dark:hover:text-indigo-300 font-medium flex items-center text-xs transition-colors">
                                    Lihat
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 ml-0.5" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7" />
                                    </svg>
                                </a>

                                <span class="text-[10px] text-gray-400 dark:text-gray-500 truncate max-w-[80px]">
                                    {{ $edukasi->user->name ?? 'Admin' }}
                                </span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-8 animate-fade-in">
                {{ $edukasis->links() }}
            </div>
        @else
            <!-- Empty State -->
            <div class="col-span-full py-16 text-center animate-bounce-in">
                <div
                    class="animate-pulse-glow inline-flex items-center justify-center w-20 h-20 bg-gray-100 dark:bg-gray-800 rounded-full mb-4 p-4 text-indigo-500">
                    <svg class="animate-float" xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>

                <h3 class="text-gray-500 dark:text-gray-400 font-medium mb-2 text-lg">Belum ada edukasi</h3>
                <p class="text-gray-400 dark:text-gray-500 mb-6 max-w-md mx-auto">
                    @if ($search || $kategoriFilter)
                        Tidak ditemukan edukasi yang sesuai dengan filter yang Anda terapkan.
                    @else
                        Mulai dengan membuat edukasi pertama untuk Posyandu.
                    @endif
                </p>

                @if ($search || $kategoriFilter)
                    <button wire:click="clearFilters"
                        class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition-colors text-sm">
                        Hapus Filter
                    </button>
                @else
                    <flux:modal.trigger name="add-edukasi">
                        <flux:button icon="plus-circle" size="sm" class="cursor-pointer">
                            Tambah Edukasi Pertama
                        </flux:button>
                    </flux:modal.trigger>
                @endif
            </div>
        @endif
    </flux:fieldset>

    <!-- Modal untuk Tambah/Edit Edukasi -->
    <flux:modal name="add-edukasi" class="min-w-4xl">
        <div>
            <flux:legend>Edukasi Posyandu</flux:legend>
            <flux:description>Isi informasi edukasi sesuai dengan kategori yang ditargetkan.</flux:description>

            <form wire:submit.prevent="save" class="mt-5 space-y-5">
                <!-- Judul Input -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Judul
                        Edukasi</label>
                    <flux:input size="sm" wire:model="judul" placeholder="Masukkan judul edukasi"></flux:input>
                    @error('judul')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Kategori Select -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Kategori</label>
                    <flux:select size="sm" wire:model="kategori" placeholder="Pilih kategori edukasi">
                        <flux:select.option value="bumil">Ibu Hamil</flux:select.option>
                        <flux:select.option value="anak">anak</flux:select.option>
                        <flux:select.option value="lansia">Lansia</flux:select.option>
                        <flux:select.option value="umum">Umum</flux:select.option>
                    </flux:select>
                    @error('kategori')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Upload Gambar -->
                <div>
                    <div class="flex items-center justify-between mb-2">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Gambar Edukasi
                        </label>
                        @if ($gambar)
                            <span class="text-xs text-gray-500 dark:text-gray-400">
                                Gambar terpilih
                            </span>
                        @endif
                    </div>

                    <!-- Upload Area -->
                    <div wire:loading.class="opacity-70" wire:target="gambar"
                        class="border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-xl p-4 transition-all duration-200 hover:border-indigo-500 dark:hover:border-indigo-400">
                        <label for="gambarInput" class="cursor-pointer">
                            <input id="gambarInput" type="file" wire:model="gambar" accept="image/*"
                                class="hidden" />

                            <div class="flex flex-col items-center justify-center py-4">
                                <div class="p-3 bg-indigo-100 dark:bg-indigo-900/30 rounded-full mb-3">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="h-8 w-8 text-indigo-600 dark:text-indigo-400" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>

                                <p class="text-center text-sm text-gray-600 dark:text-gray-400">
                                    <span class="font-medium text-indigo-600 dark:text-indigo-400">Klik untuk
                                        upload</span> atau drag & drop
                                </p>
                                <p class="text-xs text-gray-500 dark:text-gray-500 mt-1">
                                    Format JPG/PNG (Maks. 2MB)
                                </p>
                            </div>
                        </label>

                        <!-- Error Messages -->
                        @error('gambar')
                            <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror

                        <!-- Preview Gambar -->
                        @if ($gambar)
                            <div class="mt-4 flex justify-center">
                                <div class="relative group">
                                    <div
                                        class="w-32 h-32 overflow-hidden rounded border border-gray-200 dark:border-gray-700 flex items-center justify-center bg-gray-50 dark:bg-gray-800">
                                        @if (is_string($gambar))
                                            <img src="{{ asset('storage/' . $gambar) }}"
                                                class="w-full h-full object-cover" />
                                        @else
                                            <img src="{{ $gambar->temporaryUrl() }}"
                                                class="w-full h-full object-cover" />
                                        @endif
                                    </div>

                                    <!-- Delete Button -->
                                    <button type="button" wire:click="removeGambar"
                                        class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full p-1 opacity-0 group-hover:opacity-100 transition-opacity shadow hover:bg-red-600">
                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                            fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round"
                                                stroke-linejoin="round" stroke-width="2"
                                                d="M6 18 17.94 6M18 18 6.06 6" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        @endif

                        <!-- Loading Indicator -->
                        <div wire:loading.flex wire:target="gambar"
                            class="items-center justify-center mt-2 text-sm text-gray-500 dark:text-gray-400">
                            <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-indigo-500"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10"
                                    stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor"
                                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                </path>
                            </svg>
                            Mengunggah gambar...
                        </div>
                    </div>
                </div>

                <div class="flex justify-end space-x-3 pt-4">
                    <button type="button" wire:click="resetInput"
                        class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500 dark:bg-gray-700 dark:hover:bg-gray-600 transition-colors">
                        Batal
                    </button>
                    <button type="submit"
                        class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:bg-indigo-700 dark:hover:bg-indigo-600 transition-colors">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </flux:modal>

    <!-- Modal untuk Update Edukasi -->
    <flux:modal name="edit-edukasi" class="min-w-4xl">
        <div>
            <flux:legend>Edukasi Posyandu</flux:legend>
            <flux:description>Update informasi edukasi sesuai dengan kategori yang ditargetkan.</flux:description>

            <form wire:submit.prevent="update" class="mt-5 space-y-5">
                <!-- Judul Input -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Judul
                        Edukasi</label>
                    <flux:input size="sm" wire:model="judul" placeholder="Masukkan judul edukasi"></flux:input>
                    @error('judul')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Kategori Select -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Kategori</label>
                    <flux:select size="sm" wire:model="kategori" placeholder="Pilih kategori edukasi">
                        <flux:select.option value="bumil">Ibu Hamil</flux:select.option>
                        <flux:select.option value="anak">Anak</flux:select.option>
                        <flux:select.option value="lansia">Lansia</flux:select.option>
                        <flux:select.option value="umum">Umum</flux:select.option>
                    </flux:select>
                    @error('kategori')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Upload Gambar -->
                <div>
                    <div class="flex items-center justify-between mb-2">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Gambar Edukasi
                        </label>
                        @if ($gambar)
                            <span class="text-xs text-gray-500 dark:text-gray-400">
                                Gambar terpilih
                            </span>
                        @endif
                    </div>

                    <!-- Upload Area -->
                    <div wire:loading.class="opacity-70" wire:target="gambar"
                        class="border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-xl p-4 transition-all duration-200 hover:border-indigo-500 dark:hover:border-indigo-400">
                        <label for="gambarInput" class="cursor-pointer">
                            <input id="gambarInput" type="file" wire:model="gambar" accept="image/*"
                                class="hidden" />

                            <div class="flex flex-col items-center justify-center py-4">
                                <div class="p-3 bg-indigo-100 dark:bg-indigo-900/30 rounded-full mb-3">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="h-8 w-8 text-indigo-600 dark:text-indigo-400" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>

                                <p class="text-center text-sm text-gray-600 dark:text-gray-400">
                                    <span class="font-medium text-indigo-600 dark:text-indigo-400">Klik untuk
                                        upload</span> atau drag & drop
                                </p>
                                <p class="text-xs text-gray-500 dark:text-gray-500 mt-1">
                                    Format JPG/PNG (Maks. 2MB)
                                </p>
                            </div>
                        </label>

                        <!-- Error Messages -->
                        @error('gambar')
                            <p class="mt-1 text-xs text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror

                        <!-- Preview Gambar -->
                        @if ($gambar)
                            <div class="mt-4 flex justify-center">
                                <div class="relative group">
                                    <div
                                        class="w-32 h-32 overflow-hidden rounded border border-gray-200 dark:border-gray-700 flex items-center justify-center bg-gray-50 dark:bg-gray-800">
                                        @if (is_string($gambar))
                                            <img src="{{ asset('storage/' . $gambar) }}"
                                                class="w-full h-full object-cover" />
                                        @else
                                            <img src="{{ $gambar->temporaryUrl() }}"
                                                class="w-full h-full object-cover" />
                                        @endif
                                    </div>

                                    <!-- Delete Button -->
                                    <button type="button" wire:click="removeGambar"
                                        class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full p-1 opacity-0 group-hover:opacity-100 transition-opacity shadow hover:bg-red-600">
                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                            fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round"
                                                stroke-linejoin="round" stroke-width="2"
                                                d="M6 18 17.94 6M18 18 6.06 6" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        @endif

                        <!-- Loading Indicator -->
                        <div wire:loading.flex wire:target="gambar"
                            class="items-center justify-center mt-2 text-sm text-gray-500 dark:text-gray-400">
                            <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-indigo-500"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10"
                                    stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor"
                                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                </path>
                            </svg>
                            Mengunggah gambar...
                        </div>
                    </div>
                </div>

                <div class="flex justify-end space-x-3 pt-4">
                    <button type="button" wire:click="resetInput"
                        class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500 dark:bg-gray-700 dark:hover:bg-gray-600 transition-colors">
                        Batal
                    </button>
                    <button type="submit"
                        class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:bg-indigo-700 dark:hover:bg-indigo-600 transition-colors">
                        {{ $editMode ? 'Update' : 'Simpan' }}
                    </button>
                </div>
            </form>
        </div>
    </flux:modal>
</main>
