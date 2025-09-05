<x-layouts.auth>
    @slot('title')
    Welcome
    @endslot
    @push('style')
    <style>
        /* Animasi bounce up and down */
        @keyframes bounce {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-20px);
            }
        }

        .bounce-animation {
            animation: bounce 3s ease-in-out infinite;
        }

        /* Efek hover untuk card */
        .card-hover {
            transition: all 0.3s ease;
        }

        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
    </style>
    @endpush
    <section class="antialiased">
        <!-- Navbar -->
        <header class="sticky top-0 z-50 bg-white dark:bg-gray-900 shadow-sm dark:shadow-gray-800/30">
            <div class="max-w-7xl mx-auto flex justify-between items-center px-6 py-3">
                <!-- Logo -->
                <div class="flex items-center space-x-2">
                    <x-app-logo />
                </div>

                <!-- Menu -->
                <nav class="hidden md:flex space-x-6 text-sm text-gray-700 dark:text-gray-300">
                    <a href="#home" class="hover:text-purple-600 dark:hover:text-purple-400 transition-colors">Home</a>
                    <a href="#edukasi" class="hover:text-purple-600 dark:hover:text-purple-400 transition-colors">Edukasi</a>
                    <a href="#about" class="hover:text-purple-600 dark:hover:text-purple-400 transition-colors">About</a>
                    <a href="#statistic" class="hover:text-purple-600 dark:hover:text-purple-400 transition-colors">Statistic</a>
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
                        @if ('Auth::user()')
                            <a href="{{ route('login') }}" class="bg-purple-600 hover:bg-purple-700 dark:bg-purple-500 dark:hover:bg-purple-600 text-white font-medium py-2 px-4 rounded-lg text-sm transition-colors">
                                Masuk
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </header>

        <!-- Hero Section -->
        <section id="hero" class="relative bg-gradient-to-r from-purple-50 to-white dark:from-gray-900 dark:to-gray-800 overflow-hidden">
            <div class="max-w-7xl mx-auto px-6 py-14 grid md:grid-cols-2 gap-8 items-center">

                <!-- Left content -->
                <div class="space-y-4">
                    <h1 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white leading-tight">
                        Sistem Informasi Kesehatan <br>
                        <span class="text-purple-600 dark:text-purple-400">Ibu Hamil</span>, <span class="text-purple-600 dark:text-purple-400">Anak</span> &
                        <span class="text-purple-600 dark:text-purple-400">Lansia</span>.
                    </h1>
                    <p class="text-gray-600 dark:text-gray-300 text-sm md:text-base leading-relaxed">
                        Aplikasi berbasis website untuk mempermudah pencatatan kesehatan, penyampaian informasi, serta
                        pengingat jadwal kegiatan Posyandu bagi Posyandu Desa Ketawang Karay.
                    </p>
                    <div class="flex space-x-4 pt-2">
                        @if (Auth::user())
                        <a href="{{ route('dashboard') }}" class="bg-purple-600 hover:bg-purple-700 dark:bg-purple-500 dark:hover:bg-purple-600 text-white font-medium py-2 px-4 rounded-lg transition-transform transform hover:scale-105">
                            Dashboard
                        </a>
                        @else
                        <a href="{{ route('register') }}" class="bg-purple-600 hover:bg-purple-700 dark:bg-purple-500 dark:hover:bg-purple-600 text-white font-medium py-2 px-4 rounded-lg transition-transform transform hover:scale-105">
                            Daftar Sekarang
                        </a>
                        @endif
                    </div>
                </div>

                <!-- Right content (Mockup card) -->
                <div class="relative flex justify-center md:justify-start">

                    <!-- Efek Lingkaran Blur -->
                    <div class="absolute -top-10 -left-16 w-80 h-80 bg-gradient-to-r from-purple-400 to-indigo-400 dark:from-purple-800 dark:to-indigo-800 rounded-full blur-3xl opacity-30 dark:opacity-20">
                    </div>
                    <div class="absolute top-20 -left-5 w-96 h-96 bg-gradient-to-r from-indigo-300 to-purple-300 dark:from-indigo-700 dark:to-purple-700 rounded-full blur-3xl opacity-20 dark:opacity-15">
                    </div>

                    <!-- Mockup Card -->
                    <div class="relative p-6">
                        <img class="bounce-animation" src="{{ asset('img/home.png') }}" alt="hero">
                    </div>
                </div>

            </div>
        </section>

        {{-- <div class="max-w-6xl mx-auto">
            <div class="text-center mb-12">
                <h1 class="text-4xl font-bold text-white mb-4">App Dashboard</h1>
                <p class="text-xl text-indigo-100">With animated bounce effect and gradient circles</p>
            </div>

            <div class="flex flex-col md:flex-row items-center justify-between gap-10">
                <!-- Bagian kiri dengan efek lingkaran dan gambar -->
                <div class="relative flex justify-center md:justify-start w-full md:w-1/2">
                    <!-- Efek Lingkaran Blur -->
                    <div
                        class="absolute -top-10 -left-16 w-80 h-80 bg-gradient-to-r from-purple-400 to-indigo-400 rounded-full blur-3xl opacity-30">
                    </div>
                    <div
                        class="absolute top-20 -left-5 w-96 h-96 bg-gradient-to-r from-indigo-300 to-purple-300 rounded-full blur-3xl opacity-20">
                    </div>

                    <!-- Mockup Card -->
                    <div class="relative p-6">
                        <img src="https://images.unsplash.com/photo-1551650975-87deedd944c3?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1074&q=80"
                            alt="Dashboard App" class="w-full max-w-md rounded-2xl shadow-2xl bounce-animation">
                    </div>
                </div>

                <!-- Bagian kanan dengan fitur-fitur -->
                <div class="w-full md:w-1/2 bg-white rounded-2xl shadow-xl p-8">
                    <h2 class="text-3xl font-bold text-gray-800 mb-6">App Features</h2>

                    <div class="space-y-6">
                        <div class="card-hover bg-gray-50 p-5 rounded-xl border border-gray-200">
                            <div class="flex items-start">
                                <div class="bg-blue-100 p-3 rounded-lg mr-4">
                                    <i class="fas fa-chart-pie text-blue-600 text-xl"></i>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-lg text-gray-800">Analytics Dashboard</h3>
                                    <p class="text-gray-600 mt-2">Track your financial data with beautiful and interactive
                                        charts.</p>
                                </div>
                            </div>
                        </div>

                        <div class="card-hover bg-gray-50 p-5 rounded-xl border border-gray-200">
                            <div class="flex items-start">
                                <div class="bg-green-100 p-3 rounded-lg mr-4">
                                    <i class="fas fa-shield-alt text-green-600 text-xl"></i>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-lg text-gray-800">Secure Transactions</h3>
                                    <p class="text-gray-600 mt-2">Bank-level security for all your transactions and data.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="card-hover bg-gray-50 p-5 rounded-xl border border-gray-200">
                            <div class="flex items-start">
                                <div class="bg-purple-100 p-3 rounded-lg mr-4">
                                    <i class="fas fa-bell text-purple-600 text-xl"></i>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-lg text-gray-800">Smart Notifications</h3>
                                    <p class="text-gray-600 mt-2">Get alerted for important events and transactions.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-8 flex flex-wrap gap-4">
                        <button
                            class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-lg font-medium flex items-center">
                            <i class="fab fa-apple mr-2 text-xl"></i> App Store
                        </button>
                        <button
                            class="bg-gray-800 hover:bg-black text-white px-6 py-3 rounded-lg font-medium flex items-center">
                            <i class="fab fa-google-play mr-2 text-xl"></i> Google Play
                        </button>
                    </div>
                </div>
            </div>
        </div> --}}
        <!-- Edukasi Section -->
        <div id="edukasi" class="container mx-auto px-4 py-6">
            <!-- Header -->
            <div class="text-center mb-8 animate-fade-in">
                <h1 class="text-2xl md:text-3xl font-bold text-gray-800 dark:text-white mb-3">
                    Edukasi Posyandu
                </h1>
                <p class="text-sm text-gray-600 dark:text-gray-300 max-w-xl mx-auto">
                    Pilih kategori edukasi untuk kesehatan keluarga
                </p>
            </div>

            <!-- Grid Kategori -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
                @foreach ($categories as $key => $category)
                <a href="{{ route('adukasi.kategori', $key) }}"
                    class="category-card group bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-150 dark:border-gray-700 p-4 text-center transition-all duration-200 hover:shadow-md hover:border-indigo-200 dark:hover:border-indigo-600 animate-slide-up"
                    style="animation-delay: {{ $loop->index * 0.07 }}s">

                    <div
                        class="w-12 h-12 mx-auto mb-3 rounded-full flex items-center justify-center transition-all duration-200 group-hover:scale-105
                {{ $key == 'bumil'
                    ? 'bg-pink-100 dark:bg-pink-900 text-pink-600 dark:text-pink-300'
                    : ($key == 'anak'
                        ? 'bg-blue-100 dark:bg-blue-900 text-blue-600 dark:text-blue-300'
                        : ($key == 'lansia'
                            ? 'bg-purple-100 dark:bg-purple-900 text-purple-600 dark:text-purple-300'
                            : 'bg-green-100 dark:bg-green-900 text-green-600 dark:text-green-300')) }}">

                        @if ($key == 'bumil')
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" />
                        </svg>
                        @elseif($key == 'anak')
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                        </svg>
                        @elseif($key == 'lansia')
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" />
                        </svg>
                        @else
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                        </svg>
                        @endif
                    </div>

                    <h3 class="font-medium text-gray-800 dark:text-white text-sm mb-1">
                        {{ $category }}
                    </h3>
                    <p class="text-xs text-gray-500 dark:text-gray-400 line-clamp-2">
                        {{ $key == 'bumil'
                            ? 'Edukasi ibu hamil'
                            : ($key == 'anak'
                                ? 'Edukasi anak'
                                : ($key == 'lansia'
                                    ? 'Edukasi lansia'
                                    : 'Kesehatan umum')) }}
                    </p>

                    <div
                        class="mt-2 text-indigo-600 dark:text-indigo-400 opacity-0 group-hover:opacity-100 transition-opacity">
                        <span class="text-xs">Lihat</span>
                        <svg class="w-3 h-3 inline-block ml-0.5" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </div>
                </a>
                @endforeach
            </div>

            <!-- Edukasi Terbaru -->
            <div class="animate-fade-in">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-bold text-gray-800 dark:text-white">Edukasi Terbaru</h2>
                    <a href="#" class="text-xs text-indigo-600 dark:text-indigo-400 hover:underline">Lihat semua</a>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    @foreach ($latestEdukasi as $edukasi)
                    <div
                        class="bg-white dark:bg-gray-800 rounded-md shadow-sm border border-gray-150 dark:border-gray-700 overflow-hidden transition-all duration-200 hover:shadow-md">
                        <div class="h-28 overflow-hidden">
                            <img src="{{ asset('storage/' . $edukasi->gambar) }}" alt="{{ $edukasi->judul }}"
                                class="w-full h-full object-cover transition-transform duration-300 hover:scale-102">
                        </div>
                        <div class="p-3">
                            <span
                                class="text-[10px] font-medium px-1.5 py-0.5 rounded-full
                        {{ $edukasi->kategori == 'bumil'
                            ? 'bg-pink-100 text-pink-800 dark:bg-pink-900 dark:text-pink-200'
                            : ($edukasi->kategori == 'anak'
                                ? 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200'
                                : ($edukasi->kategori == 'lansia'
                                    ? 'bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-200'
                                    : 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200')) }}">
                                {{ $edukasi->kategori == 'bumil'
                                    ? 'Ibu Hamil'
                                    : ($edukasi->kategori == 'anak'
                                        ? 'anak'
                                        : ($edukasi->kategori == 'lansia'
                                            ? 'Lansia'
                                            : 'Umum')) }}
                            </span>

                            <h3
                                class="font-medium text-gray-800 dark:text-white text-sm mt-1.5 mb-1.5 line-clamp-2 leading-tight">
                                {{ $edukasi->judul }}
                            </h3>

                            <a href="{{ route('baca.edukasi', $edukasi->id_edukasi) }}"
                                class="text-xs text-indigo-600 hover:text-indigo-800 dark:text-indigo-400 dark:hover:text-indigo-300 font-medium inline-flex items-center">
                                Baca
                                <svg class="w-3 h-3 ml-0.5" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- About Section -->
        <section id="about" class="relative bg-white dark:bg-gray-900 py-16">
            <div class="max-w-6xl mx-auto px-6 text-center">
                <!-- Heading -->
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 dark:text-white">
                    <span class="text-purple-600 dark:text-purple-400">SIPEDES</span>
                </h2>
                <p class="mt-4 text-gray-600 dark:text-gray-300 max-w-2xl mx-auto">
                    SIPEDES hadir untuk membantu kader, bidan, dan masyarakat desa dalam mengelola data kesehatan ibu hamil,
                    anak, dan lansia secara lebih cepat, terstruktur, dan mudah diakses.
                </p>

                <!-- Content Grid -->
                <div class="mt-8 grid gap-4 md:grid-cols-3">
                    <!-- Visi -->
                    <div
                        class="p-4 bg-purple-50 dark:bg-purple-900/30 rounded-lg shadow-sm hover:shadow-md transition-all duration-200">
                        <div class="flex items-center mb-2">
                            <div
                                class="w-6 h-6 bg-purple-100 dark:bg-purple-800 rounded-md flex items-center justify-center mr-2">
                                <span class="text-purple-600 dark:text-purple-300 text-xs">🎯</span>
                            </div>
                            <h3 class="text-sm font-semibold text-gray-800 dark:text-white">Visi</h3>
                        </div>
                        <p class="text-gray-600 dark:text-gray-300 text-xs leading-relaxed">
                            Mewujudkan pelayanan kesehatan masyarakat desa yang efektif dan mudah diakses melalui teknologi
                            digital.
                        </p>
                    </div>

                    <!-- Misi -->
                    <div
                        class="p-4 bg-blue-50 dark:bg-blue-900/30 rounded-lg shadow-sm hover:shadow-md transition-all duration-200">
                        <div class="flex items-center mb-2">
                            <div
                                class="w-6 h-6 bg-blue-100 dark:bg-blue-800 rounded-md flex items-center justify-center mr-2">
                                <span class="text-blue-600 dark:text-blue-300 text-xs">🚀</span>
                            </div>
                            <h3 class="text-sm font-semibold text-gray-800 dark:text-white">Misi</h3>
                        </div>
                        <ul class="text-gray-600 dark:text-gray-300 text-xs space-y-1">
                            <li class="flex items-start">
                                <span class="text-blue-500 dark:text-blue-400 mr-1 text-xs">•</span>
                                Mempermudah pencatatan data kesehatan
                            </li>
                            <li class="flex items-start">
                                <span class="text-blue-500 dark:text-blue-400 mr-1 text-xs">•</span>
                                Notifikasi WhatsApp jadwal posyandu
                            </li>
                            <li class="flex items-start">
                                <span class="text-blue-500 dark:text-blue-400 mr-1 text-xs">•</span>
                                Edukasi kesehatan masyarakat
                            </li>
                            <li class="flex items-start">
                                <span class="text-blue-500 dark:text-blue-400 mr-1 text-xs">•</span>
                                Dukungan pengambilan keputusan
                            </li>
                        </ul>
                    </div>

                    <!-- Layanan -->
                    <div
                        class="p-4 bg-green-50 dark:bg-green-900/30 rounded-lg shadow-sm hover:shadow-md transition-all duration-200">
                        <div class="flex items-center mb-2">
                            <div
                                class="w-6 h-6 bg-green-100 dark:bg-green-800 rounded-md flex items-center justify-center mr-2">
                                <span class="text-green-600 dark:text-green-300 text-xs">🤝</span>
                            </div>
                            <h3 class="text-sm font-semibold text-gray-800 dark:text-white">Layanan</h3>
                        </div>
                        <ul class="text-gray-600 dark:text-gray-300 text-xs space-y-1">
                            <li class="flex items-start">
                                <span class="text-green-500 dark:text-green-400 mr-1 text-xs">•</span>
                                Pencatatan data kesehatan
                            </li>
                            <li class="flex items-start">
                                <span class="text-green-500 dark:text-green-400 mr-1 text-xs">•</span>
                                Notifikasi WhatsApp
                            </li>
                            <li class="flex items-start">
                                <span class="text-green-500 dark:text-green-400 mr-1 text-xs">•</span>
                                Edukasi kesehatan
                            </li>
                            <li class="flex items-start">
                                <span class="text-green-500 dark:text-green-400 mr-1 text-xs">•</span>
                                Dokumentasi kegiatan
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <!-- Statistics Section -->
        <section id="statistic" class="relative bg-gradient-to-r from-purple-50 to-white dark:from-gray-900 dark:to-gray-800 overflow-hidden py-16">
            <div class="absolute inset-0 overflow-hidden">
                <div
                    class="absolute -top-10 -right-10 w-72 h-72 bg-gradient-to-r from-purple-200 to-indigo-200 dark:from-purple-900 dark:to-indigo-900 rounded-full blur-3xl opacity-40 dark:opacity-20">
                </div>
                <div
                    class="absolute bottom-0 left-0 w-96 h-96 bg-gradient-to-r from-indigo-100 to-purple-100 dark:from-indigo-800 dark:to-purple-800 rounded-full blur-3xl opacity-30 dark:opacity-15">
                </div>
            </div>

            <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="text-3xl font-extrabold text-gray-900 dark:text-white sm:text-4xl">
                        Statistik Tahun 2025
                    </h2>
                    <p class="mt-4 max-w-2xl mx-auto text-xl text-gray-600 dark:text-gray-300">
                        Data Statistik Posyandu Desa Ketawang Karay
                    </p>
                </div>

                <div class="flex justify-center">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 md:gap-6 w-full max-w-2xl">
                        <!-- Statistic 1 -->
                        <div class="stat-card bg-white dark:bg-gray-800 p-4 md:p-5 rounded-lg shadow-sm border border-gray-100 dark:border-gray-700 text-center mx-auto w-full">
                            <div class="bg-purple-100 dark:bg-purple-900/40 w-12 h-12 md:w-14 md:h-14 rounded-full flex items-center justify-center mx-auto mb-3">
                                <img src="{{ asset('img/anak.png') }}" alt="anak" class="w-6 h-6 md:w-7 md:h-7">
                            </div>
                            <h3 class="text-2xl md:text-3xl font-bold text-purple-600 dark:text-purple-400 counter">250</h3>
                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-300">Anak</p>
                        </div>

                        <!-- Statistic 2 -->
                        <div class="stat-card bg-white dark:bg-gray-800 p-4 md:p-5 rounded-lg shadow-sm border border-gray-100 dark:border-gray-700 text-center mx-auto w-full">
                            <div class="bg-pink-100 dark:bg-pink-900/40 w-12 h-12 md:w-14 md:h-14 rounded-full flex items-center justify-center mx-auto mb-3">
                                <img src="{{ asset('img/bumil.png') }}" alt="bumil" class="w-6 h-6 md:w-7 md:h-7">
                            </div>
                            <h3 class="text-2xl md:text-3xl font-bold text-pink-600 dark:text-pink-400 counter">120</h3>
                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-300">Ibu Hamil</p>
                        </div>

                        <!-- Statistic 3 -->
                        <div class="stat-card bg-white dark:bg-gray-800 p-4 md:p-5 rounded-lg shadow-sm border border-gray-100 dark:border-gray-700 text-center mx-auto w-full">
                            <div class="bg-blue-100 dark:bg-blue-900/40 w-12 h-12 md:w-14 md:h-14 rounded-full flex items-center justify-center mx-auto mb-3">
                                <img src="{{ asset('img/lansia.png') }}" alt="lansia" class="w-6 h-6 md:w-7 md:h-7">
                            </div>
                            <h3 class="text-2xl md:text-3xl font-bold counter text-blue-600 dark:text-blue-400">24</h3>
                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-300">Lansia</p>
                        </div>
                    </div>
                </div>

                <!-- Additional Info -->
                <div
                    class="mt-16 bg-gradient-to-r from-indigo-600 to-purple-600 dark:from-indigo-700 dark:to-purple-700 rounded-2xl shadow-xl p-8 text-center text-white">
                    <h3 class="text-2xl font-bold mb-4">Join Us</h3>
                    <p class="max-w-2xl mx-auto mb-6">Bergabung untuk mendapatkan layanan yang kami berikan.</p>
                    <button class="bg-white text-indigo-600 dark:bg-gray-100 dark:text-indigo-700 hover:bg-gray-100 dark:hover:bg-gray-200 px-6 py-3 rounded-lg font-medium">
                        Get Started
                    </button>
                </div>
            </div>
        </section>
    </section>
</x-layouts.auth>
