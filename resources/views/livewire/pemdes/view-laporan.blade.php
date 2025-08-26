<main>
    @slot('title')
        Laporan Kegiatan
    @endslot
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

            @keyframes float {

                0%,
                100% {
                    transform: translateY(0);
                }

                50% {
                    transform: translateY(-10px);
                }
            }

            @keyframes pulse-glow {

                0%,
                100% {
                    opacity: 0.7;
                }

                50% {
                    opacity: 1;
                    filter: drop-shadow(0 0 8px rgba(136, 218, 181, 0.6));
                }
            }

            @keyframes flicker {

                0%,
                100% {
                    opacity: 1;
                }

                50% {
                    opacity: 0.6;
                }
            }

            .animate-float {
                animation: float 3s ease-in-out infinite;
            }

            .animate-pulse-glow {
                animation: pulse-glow 2s ease-in-out infinite;
            }

            .animate-flicker {
                animation: flicker 1.5s ease-in-out infinite;
            }
        </style>
    @endpush
    <flux:modal name="view-laporan" class="min-w-3xl">
        <div class=" rounded-lg shadow-md">
            <!-- Informasi Laporan -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <div class="md:col-span-3 ">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-2">
                        {{ $Vnama_kegiatan }}</h3>
                    <div class="flex items-center text-sm text-gray-600 dark:text-gray-400 mb-4 gap-3">
                        <span class="flex items-center text-xs">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <span>{{ \Carbon\Carbon::parse($Vcreated_at)->format('d F Y') }}</span>
                        </span>
                        <flux:separator vertical />
                        <span class="flex items-center text-xs">
                            <flux:icon.user variant="mini" /> <span class="ml-1">{{ $Vuser }}</span>
                        </span>
                    </div>
                    <span class="flex flex-col mb-3">
                        <h4 class="font-medium text-gray-700 dark:text-gray-300 text-xs">Deskripsi</h4>
                        <span class="text-sm">{{ $Vdeskripsi_kegiatan }}</span>
                    </span>
                    <span class="flex flex-col">
                        <h4 class="font-medium text-gray-700 dark:text-gray-300 text-xs">Tanggal Kegiatan</h4>
                        <span class="text-sm">{{ \Carbon\Carbon::parse($Vtanggal_kegiatan)->format('d F Y') }}</span>
                    </span>
                </div>
            </div>

            <!-- Slider Dokumentasi Foto -->
            <div class="mb-6">
                <span class="flex items-center justify-between">
                    <h4 class="font-medium text-gray-700 dark:text-gray-300 text-sm mb-3">Dokumentasi Kegiatan</h4>
                    <span class="text-xs">{{ $Vjumlah_foto }} foto</span>
                </span>

                @if ($Vjumlah_foto > 0)
                    <div x-data="{ currentSlide: 0 }" class="relative">
                        <!-- Slider Container -->
                        <div class="overflow-hidden rounded-lg">
                            <div class="flex transition-transform duration-300 ease-in-out"
                                :style="'transform: translateX(-' + (currentSlide * 100) + '%)'">
                                @foreach ($Vphotos as $index => $dokumentasi)
                                    <div class="w-full flex-shrink-0">
                                        <div
                                            class="bg-gray-100 dark:bg-gray-700 rounded-lg flex items-center justify-center h-64">
                                            <img src="{{ asset('storage/' . $dokumentasi->photo_path) }}"
                                                alt="Dokumentasi kegiatan {{ $index + 1 }}"
                                                class="max-h-full max-w-full object-contain">
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Navigation Buttons -->
                        @if ($Vjumlah_foto > 1)
                            <button x-show="currentSlide > 0" @click="currentSlide--"
                                class="absolute left-2 top-1/2 transform -translate-y-1/2 bg-white/80 dark:bg-gray-800/80 hover:bg-white dark:hover:bg-gray-700 text-gray-800 dark:text-white rounded-full p-2 shadow-md">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 19l-7-7 7-7" />
                                </svg>
                            </button>

                            <button x-show="currentSlide < {{ $Vjumlah_foto - 1 }}" @click="currentSlide++"
                                class="absolute right-2 top-1/2 transform -translate-y-1/2 bg-white/80 dark:bg-gray-800/80 hover:bg-white dark:hover:bg-gray-700 text-gray-800 dark:text-white rounded-full p-2 shadow-md">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                            </button>
                        @endif

                        <!-- Slide Indicators -->
                        @if ($Vjumlah_foto > 1)
                            <div class="flex justify-center mt-4 space-x-2">
                                @foreach ($Vphotos as $index => $dokumentasi)
                                    <button @click="currentSlide = {{ $index }}"
                                        class="w-2 h-2 rounded-full transition-colors"
                                        :class="{
                                            'bg-blue-500 dark:bg-blue-400': currentSlide ===
                                                {{ $index }},
                                            'bg-gray-300 dark:bg-gray-600': currentSlide !==
                                                {{ $index }}
                                        }">
                                    </button>
                                @endforeach
                            </div>
                        @endif
                    </div>
                @else
                    <div class="flex flex-col items-center justify-center space-y-2">
                        <!-- Animated document icon -->
                        <div class="relative">
                            <svg class="w-12 h-12 text-green-400 dark:text-green-500 animate-bounce" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                </path>
                            </svg>
                            <div class="absolute -top-1 -right-1">
                                <span class="relative flex h-3 w-3">
                                    <span
                                        class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                                    <span class="relative inline-flex rounded-full h-3 w-3 bg-green-500"></span>
                                </span>
                            </div>
                        </div>

                        <!-- Text content -->
                        <div class="space-y-1">
                            <p class="text-sm font-medium text-gray-600 dark:text-gray-300">Belum ada
                                data proposal</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Silakan hubungi
                                kelompok anda untuk segera mengupload proposal kelompok mereka</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </flux:modal>
    <flux:fieldset>
        <flux:legend>Daftar Laporan Posyandu</flux:legend>
        <flux:description>Berikut adalah laporan posyandu berdasarkan data terbaru.</flux:description>

        <div class="flex justify-between items-end mb-4">
            <div class="flex gap-2">
                <flux:input type="text" icon="magnifying-glass" wire:model.live="search"
                    placeholder="Cari Laporan..." class="w-full" size="xs" clearable />
                <div>
                    <flux:select size="xs" placeholder="Per Page" wire:model.live='perPage'>
                        <flux:select.option value="5">5</flux:select.option>
                        <flux:select.option value="7">7</flux:select.option>
                        <flux:select.option value="10">10</flux:select.option>
                        <flux:select.option value="20">20</flux:select.option>
                        <flux:select.option value="30">30</flux:select.option>
                        <flux:select.option value="50">50</flux:select.option>
                    </flux:select>
                </div>
            </div>
        </div>
        @if ($laporans->count() > 0)
            {{-- List Laporan --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @forelse ($laporans as $key => $laporan)
                    <div
                        class="bg-white dark:bg-gray-800 rounded-lg shadow-md border border-gray-200 dark:border-gray-700 overflow-hidden hover:shadow-lg transition-shadow duration-300">
                        <div class="p-4">
                            <div class="flex justify-between items-start mb-3">
                                <span
                                    class="text-xs font-medium px-2 py-1 bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200 rounded-full">
                                    #{{ $key + 1 }}
                                </span>
                            </div>

                            <h3 class="font-semibold text-gray-800 dark:text-white text-sm mb-2 line-clamp-1">
                                {{ $laporan->nama_kegiatan }}
                            </h3>

                            <div class="flex items-center text-sm text-gray-600 dark:text-gray-400 mb-4 gap-3">
                                <span class="flex items-center text-xs">
                                    <flux:icon.calendar-days variant="micro" /> <small><span
                                            class="ml-1">{{ \Carbon\Carbon::parse($laporan->created_at)->format('d F Y') }}</span></small>
                                </span>
                                <flux:separator vertical />
                                <span class="flex items-center text-xs">
                                    <flux:icon.user variant="micro" /> <small><span
                                            class="ml-1">{{ $laporan->user->name }}</span></small>
                                </span>
                            </div>

                            <p class="text-xs text-gray-600 dark:text-gray-300 mb-4 line-clamp-3">
                                {{ Str::limit($laporan->deskripsi_kegiatan, 90) }}
                            </p>

                            <div class="flex justify-end items-center text-xs">
                                <button wire:click="view_laporan({{ $laporan->id_laporan }})"
                                    class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 font-medium flex items-center">
                                    Lihat
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 ml-1" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5l7 7-7 7" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-12 text-center animate-fade-in">
                        <div
                            class="inline-flex items-center justify-center w-16 h-16 bg-gray-100 dark:bg-gray-800 rounded-full mb-4">
                            <svg class="animate-float" xmlns="http://www.w3.org/2000/svg"
                                class="h-6 w-6 text-gray-400 dark:text-gray-500" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>

                        <h3 class="text-gray-500 dark:text-gray-400 font-medium mb-2">Belum ada laporan</h3>
                        <p class="text-sm text-gray-400 dark:text-gray-500 mb-4">Mulai dengan membuat laporan pertama
                            Anda</p>
                    </div>
                @endforelse
            </div>
        @else
            <div class="col-span-full py-12 text-center animate-fade-in">
                <div
                    class="animate-pulse-glow inline-flex items-center justify-center w-16 h-16 bg-gray-100 dark:bg-gray-800 rounded-full mb-4 p-3 text-green-500">
                    <svg class="animate-float" xmlns="http://www.w3.org/2000/svg"
                        class="h-8 w-8 text-gray-400 dark:text-gray-500" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>

                <h3 class="text-gray-500 dark:text-gray-400 font-medium mb-2">Belum ada laporan</h3>
                <p class="text-sm text-gray-400 dark:text-gray-500 mb-4">Mulai dengan membuat laporan pertama Anda</p>
            </div>
        @endif
    </flux:fieldset>
</main>
