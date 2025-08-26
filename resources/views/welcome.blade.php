<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIPEDER | Welcome</title>
    @vite('resources/css/app.css')
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
</head>

<body class="antialiased bg-white">

    <!-- Navbar -->
    <header class="sticky top-0 z-50 bg-white shadow-sm">
        <div class="max-w-7xl mx-auto flex justify-between items-center px-6 py-3">
            <!-- Logo -->
            <div class="flex items-center space-x-2">
                <div class="bg-gradient-to-r from-purple-500 to-indigo-500 w-6 h-6 rounded-full"></div>
                <span class="flex flex-col leading-none">
                    <span class="font-bold text-lg/none text-gray-800">SIPEDES</span>
                    <small><span class="text-xs/none text-gray-800">Sistem Informasi Posyandu Desa</span></small>
                </span>
            </div>

            <!-- Menu -->
            <nav class="hidden md:flex space-x-6 text-sm text-gray-700">
                <a href="#" class="hover:text-purple-600">Features</a>
                <a href="#" class="hover:text-purple-600">About</a>
                <a href="#" class="hover:text-purple-600">Pricing</a>
                <a href="#" class="hover:text-purple-600">Clients</a>
                <a href="#" class="hover:text-purple-600">Contact</a>
            </nav>

            <!-- Button -->
            @if (Auth::user())
                <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <flux:button as="button" type="submit" icon="arrow-right-start-on-rectangle" size="sm" variant="primary" color="rose">
                            {{ __('Keluar') }}
                        </flux:button>
                    </form>
            @else
                <flux:button href="{{ route('login') }}" class="transition-transform transform hover:scale-105" icon="arrow-left-end-on-rectangle" variant="primary" color="purple" size='sm'>Masuk</flux:button>
            @endif
        </div>
    </header>

    <!-- Hero Section -->
    <section class="relative bg-gradient-to-r from-purple-50 to-white overflow-hidden">
        <div class="max-w-7xl mx-auto px-6 py-14 grid md:grid-cols-2 gap-8 items-center">

            <!-- Left content -->
            <div class="space-y-4">
                <h1 class="text-3xl md:text-4xl font-bold text-gray-900 leading-tight">
                    Tailwind CSS Template <br>
                    for <span class="text-purple-600">App</span> &
                    <span class="text-purple-600">Software Site</span>.
                </h1>
                <p class="text-gray-600 text-sm md:text-base leading-relaxed">
                    Clean design with all essential components for your next app or software project.
                    Built with TailwindCSS and responsive by default.
                </p>
                <div class="flex space-x-4 pt-2">
                    <flux:button href="{{ route('register') }}" class="transition-transform transform hover:scale-105" variant="primary" color="purple" size='sm'>Daftar Sekarang</flux:button>
                </div>
            </div>

            <!-- Right content (Mockup card) -->
            <div class="relative flex justify-center md:justify-start">

                <!-- Efek Lingkaran Blur -->
                <div
                    class="absolute -top-10 -left-16 w-80 h-80 bg-gradient-to-r from-purple-400 to-indigo-400 rounded-full blur-3xl opacity-30">
                </div>
                <div
                    class="absolute top-20 -left-5 w-96 h-96 bg-gradient-to-r from-indigo-300 to-purple-300 rounded-full blur-3xl opacity-20">
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
    <!-- About Us Section -->
    <section id="about" class="relative bg-white py-16">
        <div class="max-w-6xl mx-auto px-6 text-center">
            <!-- Heading -->
            <h2 class="text-3xl md:text-4xl font-bold text-gray-800">
                About <span class="text-purple-600">Us</span>
            </h2>
            <p class="mt-4 text-gray-600 max-w-2xl mx-auto">
                Kami adalah tim pengembang yang berfokus pada pembuatan solusi digital
                menggunakan teknologi modern seperti Laravel dan TailwindCSS.
                Visi kami adalah menghadirkan pengalaman pengguna yang sederhana, cepat, dan elegan.
            </p>

            <!-- Content Grid -->
            <div class="mt-12 grid gap-8 md:grid-cols-3">
                <div class="p-6 bg-purple-50 rounded-2xl shadow hover:shadow-lg transition">
                    <h3 class="text-lg font-semibold text-gray-800">🎯 Visi</h3>
                    <p class="mt-2 text-gray-600 text-sm">
                        Menjadi pengembang solusi digital yang inovatif, efektif,
                        dan mudah digunakan oleh semua orang.
                    </p>
                </div>
                <div class="p-6 bg-purple-50 rounded-2xl shadow hover:shadow-lg transition">
                    <h3 class="text-lg font-semibold text-gray-800">🚀 Misi</h3>
                    <p class="mt-2 text-gray-600 text-sm">
                        Membangun aplikasi yang efisien, scalable, dan memiliki UI/UX modern
                        untuk mendukung kebutuhan pengguna.
                    </p>
                </div>
                <div class="p-6 bg-purple-50 rounded-2xl shadow hover:shadow-lg transition">
                    <h3 class="text-lg font-semibold text-gray-800">🤝 Layanan</h3>
                    <p class="mt-2 text-gray-600 text-sm">
                        Konsultasi, pengembangan software berbasis web & mobile, serta
                        integrasi sistem untuk bisnis Anda.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Statistics Section -->
    <section class="relative bg-gradient-to-r from-purple-50 to-white overflow-hidden py-16">
        <div class="absolute inset-0 overflow-hidden">
            <div
                class="absolute -top-10 -right-10 w-72 h-72 bg-gradient-to-r from-purple-200 to-indigo-200 rounded-full blur-3xl opacity-40">
            </div>
            <div
                class="absolute bottom-0 left-0 w-96 h-96 bg-gradient-to-r from-indigo-100 to-purple-100 rounded-full blur-3xl opacity-30">
            </div>
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-extrabold text-gray-900 sm:text-4xl">
                    Statistik Tahun 2025
                </h2>
                <p class="mt-4 max-w-2xl mx-auto text-xl text-gray-600">
                    Data Statistik Posyandu ...............
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Statistic 1 -->
                <div class="stat-card bg-white p-6 rounded-xl shadow-md border border-gray-100 text-center">
                    <div class="bg-indigo-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <img src="{{ asset('img/baby.png') }}" alt="baby" width="100">
                    </div>
                    <h3 class="text-4xl font-bold text-indigo-600 counter">97</h3>
                    <p class="mt-2 text-gray-600">Bayi</p>
                </div>

                <!-- Statistic 2 -->
                <div class="stat-card bg-white p-6 rounded-xl shadow-md border border-gray-100 text-center">
                    <div class="bg-purple-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <img src="{{ asset('img/balita.png') }}" alt="balita" width="100">
                    </div>
                    <h3 class="text-4xl font-bold text-purple-600 counter">250</h3>
                    <p class="mt-2 text-gray-600">Balita</p>
                </div>

                <!-- Statistic 3 -->
                <div class="stat-card bg-white p-6 rounded-xl shadow-md border border-gray-100 text-center">
                    <div class="bg-pink-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <img src="{{ asset('img/bumil.png') }}" alt="balita" width="100">
                    </div>
                    <h3 class="text-4xl font-bold text-pink-600 counter">120</h3>
                    <p class="mt-2 text-gray-600">Ibu Hamil</p>
                </div>

                <!-- Statistic 4 -->
                <div class="stat-card bg-white p-6 rounded-xl shadow-md border border-gray-100 text-center">
                    <div class="bg-blue-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <img src="{{ asset('img/lansia.png') }}" alt="balita" width="100">
                    </div>
                    <h3 class="text-4xl font-bold counter text-blue-600">24</h3>
                    <p class="mt-2 text-gray-600">Lansia</p>
                </div>
            </div>

            <!-- Additional Info -->
            <div
                class="mt-16 bg-gradient-to-r from-indigo-600 to-purple-600 rounded-2xl shadow-xl p-8 text-center text-white">
                <h3 class="text-2xl font-bold mb-4">Join Us</h3>
                <p class="max-w-2xl mx-auto mb-6">Bergabung untuk mendapatkan layanan yang kami berikan.</p>
                <button class="bg-white text-indigo-600 hover:bg-gray-100 px-6 py-3 rounded-lg font-medium">
                    Get Started
                </button>
            </div>
        </div>
    </section>
</body>

</html>
