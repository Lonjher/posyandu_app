<div>
    @slot('title')
        Edukasi
    @endslot
    <!-- Navbar -->
    <header class="sticky top-0 z-50 bg-white dark:bg-gray-900 shadow-sm dark:shadow-gray-800/30">
        <div class="max-w-7xl mx-auto flex justify-between items-center px-6 py-3">
            <!-- Logo -->
            <div class="flex items-center space-x-2">
                <div class="bg-gradient-to-r from-purple-500 to-indigo-500 w-6 h-6 rounded-full"></div>
                <span class="flex flex-col leading-none">
                    <span class="font-bold text-lg/none text-gray-800 dark:text-white">SIPEDES</span>
                    <small><span class="text-xs/none text-gray-800 dark:text-gray-300">Sistem Informasi Posyandu
                            Desa</span></small>
                </span>
            </div>

            <!-- Menu -->
            <nav class="hidden md:flex space-x-6 text-sm text-gray-700 dark:text-gray-300">
                <a href="#" class="hover:text-purple-600 dark:hover:text-purple-400 transition-colors">Features</a>
                <a href="#" class="hover:text-purple-600 dark:hover:text-purple-400 transition-colors">About</a>
                <a href="#" class="hover:text-purple-600 dark:hover:text-purple-400 transition-colors">Pricing</a>
                <a href="#" class="hover:text-purple-600 dark:hover:text-purple-400 transition-colors">Clients</a>
                <a href="#" class="hover:text-purple-600 dark:hover:text-purple-400 transition-colors">Contact</a>
            </nav>

            <div class="flex items-center gap-3">
                <flux:dropdown x-data align="end">
                    <flux:button variant="subtle" square class="group" aria-label="Preferred color scheme">
                        <flux:icon.sun x-show="$flux.appearance === 'light'" variant="mini"
                            class="text-zinc-500 dark:text-white" />
                        <flux:icon.moon x-show="$flux.appearance === 'dark'" variant="mini"
                            class="text-zinc-500 dark:text-white" />
                        <flux:icon.moon x-show="$flux.appearance === 'system' && $flux.dark" variant="mini" />
                        <flux:icon.sun x-show="$flux.appearance === 'system' && ! $flux.dark" variant="mini" />
                    </flux:button>

                    <flux:menu>
                        <flux:menu.item icon="sun" x-on:click="$flux.appearance = 'light'">Light</flux:menu.item>
                        <flux:menu.item icon="moon" x-on:click="$flux.appearance = 'dark'">Dark</flux:menu.item>
                        <flux:menu.item icon="computer-desktop" x-on:click="$flux.appearance = 'system'">System
                        </flux:menu.item>
                    </flux:menu>
                </flux:dropdown>
                <!-- Button -->
                <div>
                    <a href="#"
                        class="bg-purple-600 hover:bg-purple-700 dark:bg-purple-500 dark:hover:bg-purple-600 text-white font-medium py-2 px-4 rounded-lg text-sm transition-colors">
                        Masuk
                    </a>
                </div>
            </div>
        </div>
    </header>

    <div class="container mx-auto px-4 py-6">
        <!-- Header Kategori -->
        <div class="text-center mb-8 animate-fade-in">
            @php
                $categoryIcons = [
                    'bumil' => 'text-pink-600 bg-pink-100 dark:bg-pink-900 dark:text-pink-300',
                    'anak' => 'text-blue-600 bg-blue-100 dark:bg-blue-900 dark:text-blue-300',
                    'lansia' => 'text-purple-600 bg-purple-100 dark:bg-purple-900 dark:text-purple-300',
                    'umum' => 'text-green-600 bg-green-100 dark:bg-green-900 dark:text-green-300',
                ];
            @endphp

            <div
                class="w-16 h-16 mx-auto mb-4 rounded-full flex items-center justify-center {{ $categoryIcons[$kategori] }}">
                @if ($kategori == 'bumil')
                    <img src="{{ asset('img/bumil.png') }}" alt="bumil">
                @elseif($kategori == 'anak')
                    <img src="{{ asset('img/anak.png') }}" alt="anak">
                @elseif($kategori == 'lansia')
                    <img src="{{ asset('img/lansia.png') }}" alt="lansia">
                @else
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                    </svg>
                @endif
            </div>

            <h1 class="text-2xl md:text-3xl font-bold text-gray-800 dark:text-white mb-2">
                {{ $categoryTitles[$kategori] }}
            </h1>
            <p class="text-sm text-gray-600 dark:text-gray-300">
                {{ $categoryDescriptions[$kategori] }}
            </p>
        </div>

        <!-- Search Box -->
        <div class="mb-6 animate-fade-in">
            <div class="relative max-w-md mx-auto">
                <input type="text" wire:model.live="search" placeholder="Cari edukasi..."
                    class="w-full pl-10 pr-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent dark:bg-gray-800 dark:text-white">
                <svg class="absolute left-3 top-2.5 h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>
        </div>

        <!-- Active Search Filter -->
        @if ($search)
            <div class="mb-6 animate-fade-in">
                <div class="flex flex-wrap gap-2 justify-center">
                    <span
                        class="inline-flex items-center px-3 py-1 rounded-full text-xs bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">
                        Pencarian: "{{ $search }}"
                        <button wire:click="clearSearch"
                            class="ml-1 text-blue-600 dark:text-blue-300 hover:text-blue-800 dark:hover:text-blue-100">
                            &times;
                        </button>
                    </span>
                </div>
            </div>
        @endif

        <!-- Grid Edukasi -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 mb-8">
            @forelse ($edukasis as $key => $edukasi)
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-150 dark:border-gray-700 overflow-hidden transition-all duration-200 hover:shadow-md animate-slide-up">

                    <div class="h-40 overflow-hidden">
                        <img src="{{ asset('storage/' . $edukasi->gambar) }}" alt="{{ $edukasi->judul }}"
                            class="w-full h-full object-cover transition-transform duration-300 hover:scale-102">
                    </div>

                    <div class="p-4">
                        <h3 class="font-semibold text-gray-800 dark:text-white text-sm mb-2 line-clamp-2 leading-tight">
                            {{ $edukasi->judul }}
                        </h3>

                        <div class="flex items-center text-xs text-gray-500 dark:text-gray-400 mb-3">
                            <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            {{ $edukasi->created_at->format('d M Y') }}
                        </div>

                        <a href="{{ route('baca.edukasi', $edukasi->id_edukasi) }}"
                            class="w-full bg-indigo-600 hover:bg-indigo-700 text-white py-2 px-3 rounded-md text-xs font-medium transition-colors duration-200">
                            Baca Selengkapnya
                        </a>
                    </div>
                </div>
                <!-- Pagination -->
                <div class="mb-8">
                    {{ $edukasis->links() }}
                </div>
            @empty
                <div class="text-center py-12 animate-fade-in">
                    <div
                        class="w-16 h-16 mx-auto mb-4 bg-gray-100 dark:bg-gray-800 rounded-full flex items-center justify-center">
                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-medium text-gray-600 dark:text-gray-400 mb-2">
                        @if ($search)
                            Tidak ada edukasi ditemukan untuk pencarian "{{ $search }}"
                        @else
                            Belum ada edukasi untuk kategori ini
                        @endif
                    </h3>
                    <p class="text-gray-500 dark:text-gray-500 text-sm mb-4">
                        @if ($search)
                            Coba gunakan kata kunci lain atau hapus pencarian
                        @else
                            Edukasi untuk kategori ini akan segera tersedia
                        @endif
                    </p>
                    @if ($search)
                        <button wire:click="clearSearch"
                            class="px-4 py-2 bg-indigo-600 text-white rounded-md text-sm hover:bg-indigo-700 transition-colors">
                            Hapus Pencarian
                        </button>
                    @endif
                </div>
            @endforelse
        </div>

        <!-- Back Button -->
        <div class="text-center mt-8">
            <a href="{{ route('home') }}"
                class="inline-flex items-center text-indigo-600 hover:text-indigo-800 dark:text-indigo-400 dark:hover:text-indigo-300 font-medium text-sm">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Kembali ke Semua Kategori
            </a>
        </div>
    </div>
</div>
