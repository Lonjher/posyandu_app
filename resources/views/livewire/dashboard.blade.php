<div class="flex h-full w-full flex-1 flex-col gap-6 rounded-xl">
    <!-- Header Selamat Datang -->
    <div
        class="flex flex-col md:flex-row md:items-center justify-between p-4 bg-white dark:bg-gray-800 rounded-lg shadow">
        <div>
            <h2 class="text-2xl font-bold text-gray-800 dark:text-white">Selamat datang, {{ Auth::user()->name }}</h2>
            <div class="flex items-center mt-2">
                <span
                    class="px-3 py-1 bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200 text-sm font-medium rounded-full">
                    {{ ucfirst(Auth::user()->role) }}
                </span>
                <span class="ml-3 text-sm text-gray-600 dark:text-gray-400">
                    <i class="far fa-calendar-alt mr-1"></i>
                    {{ date('l, d F Y') }}
                </span>
            </div>
        </div>
    </div>

    <!-- Dashboard Content Berdasarkan Role -->
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">

        @can('isAdmin')
            <!-- Admin Dashboard -->
            <div class="space-y-6 col-span-3">
                <!-- Statistik -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow flex items-center">
                        <div class="p-3 rounded-full bg-pink-100 text-pink-600 dark:bg-pink-900 dark:text-pink-300 mr-4">
                            <i class="fas fa-baby text-lg"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Ibu Hamil</p>
                            <p class="text-xl font-bold text-gray-800 dark:text-white">{{ $bumilCount }}</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Total terdaftar</p>
                        </div>
                    </div>
                    <div class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow flex items-center">
                        <div class="p-3 rounded-full bg-blue-100 text-blue-600 dark:bg-blue-900 dark:text-blue-300 mr-4">
                            <i class="fas fa-child text-lg"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Anak</p>
                            <p class="text-xl font-bold text-gray-800 dark:text-white">{{ $anakCount }}</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Total terdaftar</p>
                        </div>
                    </div>
                    <div class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow flex items-center">
                        <div
                            class="p-3 rounded-full bg-purple-100 text-purple-600 dark:bg-purple-900 dark:text-purple-300 mr-4">
                            <i class="fas fa-wheelchair text-lg"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Lansia</p>
                            <p class="text-xl font-bold text-gray-800 dark:text-white">{{ $lansiaCount }}</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Total terdaftar</p>
                        </div>
                    </div>
                </div>

                <!-- Grafik Fluktuasi -->
                <div class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">Fluktuasi Jumlah Pemeriksaan
                    </h3>
                    <div class="h-full">
                        <canvas id="trendChart" data-labels='@json($monthlyLabels)'
                            data-bumil='@json($monthlyBumil)' data-anak='@json($monthlyAnak)'
                            data-lansia='@json($monthlyLansia)'></canvas>
                    </div>
                </div>

                <!-- Pemeriksaan Terbaru -->
                <div class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">Pemeriksaan Terbaru</h3>
                    <div class="space-y-3">
                        @foreach ($recentPemeriksaan as $pemeriksaan)
                            <div class="flex items-start p-2 bg-gray-50 dark:bg-gray-700 rounded-lg">
                                <div
                                    class="p-2 rounded-full bg-blue-100 text-blue-600 dark:bg-blue-900 dark:text-blue-300 mr-3">
                                    <i class="fas fa-stethoscope"></i>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm font-medium text-gray-800 dark:text-white">
                                        {{ $pemeriksaan->user->name }}</p>
                                    <p class="text-xs text-gray-600 dark:text-gray-400">
                                        {{ $pemeriksaan->created_at->diffForHumans() }} -
                                        @if (isset($pemeriksaan->bumil_id))
                                            Ibu Hamil
                                        @endif
                                        @if (isset($pemeriksaan->anak_id))
                                            Anak
                                        @endif
                                        @if (isset($pemeriksaan->lansia_id))
                                            Lansia
                                        @endif
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endcan

        @can('isPemdes')
            <!-- Pemerintah Desa Dashboard -->
            <div class="space-y-6 col-span-3">
                <!-- Statistik -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow">
                        <div class="flex items-center mb-2">
                            <div
                                class="p-2 rounded-full bg-pink-100 text-pink-600 dark:bg-pink-900 dark:text-pink-300 mr-3">
                                <i class="fas fa-baby"></i>
                            </div>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Ibu Hamil</p>
                        </div>
                        <p class="text-2xl font-bold text-gray-800 dark:text-white">{{ $bumilCount }}</p>
                        <div class="mt-2 w-full bg-gray-200 rounded-full h-1.5 dark:bg-gray-700">
                            <div class="bg-pink-600 h-1.5 rounded-full"
                                style="width: {{ min(($bumilCount / $totalWarga) * 100, 100) }}%"></div>
                        </div>
                    </div>
                    <div class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow">
                        <div class="flex items-center mb-2">
                            <div
                                class="p-2 rounded-full bg-blue-100 text-blue-600 dark:bg-blue-900 dark:text-blue-300 mr-3">
                                <i class="fas fa-child"></i>
                            </div>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Anak</p>
                        </div>
                        <p class="text-2xl font-bold text-gray-800 dark:text-white">{{ $anakCount }}</p>
                        <div class="mt-2 w-full bg-gray-200 rounded-full h-1.5 dark:bg-gray-700">
                            <div class="bg-blue-600 h-1.5 rounded-full"
                                style="width: {{ min(($anakCount / $totalWarga) * 100, 100) }}%"></div>
                        </div>
                    </div>
                    <div class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow">
                        <div class="flex items-center mb-2">
                            <div
                                class="p-2 rounded-full bg-purple-100 text-purple-600 dark:bg-purple-900 dark:text-purple-300 mr-3">
                                <i class="fas fa-wheelchair"></i>
                            </div>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Lansia</p>
                        </div>
                        <p class="text-2xl font-bold text-gray-800 dark:text-white">{{ $lansiaCount }}</p>
                        <div class="mt-2 w-full bg-gray-200 rounded-full h-1.5 dark:bg-gray-700">
                            <div class="bg-purple-600 h-1.5 rounded-full"
                                style="width: {{ min(($lansiaCount / $totalWarga) * 100, 100) }}%"></div>
                        </div>
                    </div>
                </div>

                <!-- Grafik Fluktuasi -->
                <div class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">Fluktuasi Jumlah Pemeriksaan
                    </h3>
                    <div class="h-full">
                        <canvas id="trendChart" data-labels='@json($monthlyLabels)'
                            data-bumil='@json($monthlyBumil)' data-anak='@json($monthlyAnak)'
                            data-lansia='@json($monthlyLansia)'></canvas>
                    </div>
                </div>

                <!-- Status Gizi -->
                <div class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">Status Gizi Balita</h3>
                    <div class="grid grid-cols-3 gap-4">
                        <div class="text-center p-3 bg-green-50 dark:bg-green-900/20 rounded-lg">
                            <p class="text-xl font-bold text-green-600 dark:text-green-400">{{ $giziBaik }}</p>
                            <p class="text-xs text-gray-800 dark:text-white">Gizi Baik</p>
                        </div>
                        <div class="text-center p-3 bg-yellow-50 dark:bg-yellow-900/20 rounded-lg">
                            <p class="text-xl font-bold text-yellow-600 dark:text-yellow-400">{{ $giziSedang }}</p>
                            <p class="text-xs text-gray-800 dark:text-white">Gizi Sedang</p>
                        </div>
                        <div class="text-center p-3 bg-red-50 dark:bg-red-900/20 rounded-lg">
                            <p class="text-xl font-bold text-red-600 dark:text-red-400">{{ $giziBuruk }}</p>
                            <p class="text-xs text-gray-800 dark:text-white">Gizi Buruk</p>
                        </div>
                    </div>
                </div>
            </div>
        @endcan

        @can('isKader')
            <!-- Kader Dashboard -->
            <div class="space-y-6 col-span-3">
                <!-- Tugas Hari Ini -->
                <div class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">Jadwal Pemeriksaan Hari Ini</h3>
                    <div class="space-y-3">
                        {{-- @foreach ($jadwalHariIni as $jadwal)
                    <div class="flex items-center justify-between p-3 bg-blue-50 dark:bg-blue-900/20 rounded-lg">
                        <div class="flex items-center">
                            <div class="p-2 rounded-full bg-blue-100 text-blue-600 dark:bg-blue-900 dark:text-blue-300 mr-3">
                                <i class="fas fa-calendar-check"></i>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-800 dark:text-white">{{ $jadwal->user->name }}</p>
                                <p class="text-xs text-gray-600 dark:text-gray-400">
                                    {{ $jadwal->waktu }} -
                                    @if ($jadwal->kategori == 'bumil') Ibu Hamil @endif
                                    @if ($jadwal->kategori == 'anak') Anak @endif
                                    @if ($jadwal->kategori == 'lansia') Lansia @endif
                                </p>
                            </div>
                        </div>
                        <button class="bg-blue-600 hover:bg-blue-700 text-white text-xs px-3 py-1 rounded-full transition-colors">
                            Detail
                        </button>
                    </div>
                    @endforeach --}}
                    </div>
                </div>

                <!-- Progress Hari Ini -->
                <div class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">Progress Hari Ini</h3>
                    <div class="grid grid-cols-3 gap-4">
                        <div class="text-center p-4 bg-pink-50 dark:bg-pink-900/20 rounded-lg">
                            <p class="text-2xl font-bold text-pink-600 dark:text-pink-400">{{ $bumilCheckedToday }}</p>
                            <p class="text-sm text-gray-800 dark:text-white">Ibu Hamil</p>
                        </div>
                        <div class="text-center p-4 bg-blue-50 dark:bg-blue-900/20 rounded-lg">
                            <p class="text-2xl font-bold text-blue-600 dark:text-blue-400">{{ $anakCheckedToday }}</p>
                            <p class="text-sm text-gray-800 dark:text-white">Anak</p>
                        </div>
                        <div class="text-center p-4 bg-purple-50 dark:bg-purple-900/20 rounded-lg">
                            <p class="text-2xl font-bold text-purple-600 dark:text-purple-400">{{ $lansiaCheckedToday }}
                            </p>
                            <p class="text-sm text-gray-800 dark:text-white">Lansia</p>
                        </div>
                    </div>
                </div>

                <!-- Aksi Cepat -->
                <div class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">Aksi Cepat</h3>
                    <div class="grid grid-cols-2 gap-3">
                        <button
                            class="flex flex-col items-center justify-center p-3 bg-blue-100 hover:bg-blue-200 text-blue-800 dark:bg-blue-900 dark:hover:bg-blue-800 dark:text-blue-200 rounded-lg transition-colors">
                            <i class="fas fa-plus-circle text-lg mb-1"></i>
                            <span class="text-xs">Catat Pemeriksaan</span>
                        </button>
                        <button
                            class="flex flex-col items-center justify-center p-3 bg-green-100 hover:bg-green-200 text-green-800 dark:bg-green-900 dark:hover:bg-green-800 dark:text-green-200 rounded-lg transition-colors">
                            <i class="fas fa-file-medical text-lg mb-1"></i>
                            <span class="text-xs">Buat Laporan</span>
                        </button>
                    </div>
                </div>
            </div>
        @endcan

        @can('isUser')
            <!-- User Dashboard -->
            <div class="space-y-6 col-span-3">
                <!-- Status Kesehatan -->
                <div class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">Status Kesehatan</h3>
                    <div class="space-y-4">
                        @if ($lastPemeriksaan)
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <div
                                        class="p-2 rounded-full bg-blue-100 text-blue-600 dark:bg-blue-900 dark:text-blue-300 mr-3">
                                        <i class="fas fa-heartbeat"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-800 dark:text-white">Pemeriksaan Terakhir
                                        </p>
                                        <p class="text-xs text-gray-600 dark:text-gray-400">
                                            {{ $lastPemeriksaan->created_at->format('d M Y') }}</p>
                                    </div>
                                </div>
                                <span
                                    class="px-2 py-1 rounded-full text-xs font-medium
                            {{ $statusKesehatan === 'Meningkat' ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300' : '' }}
                            {{ $statusKesehatan === 'Menurun' ? 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300' : '' }}
                            {{ $statusKesehatan === 'Stabil' ? 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300' : '' }}">
                                    <i
                                        class="fas {{ $statusKesehatan === 'Meningkat' ? 'fa-arrow-up' : ($statusKesehatan === 'Menurun' ? 'fa-arrow-down' : 'fa-minus') }} mr-1"></i>
                                    {{ $statusKesehatan }}
                                </span>
                            </div>

                            <div class="grid grid-cols-2 gap-4 mt-4">
                                <div class="text-center p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                                    <p class="text-lg font-bold text-gray-800 dark:text-white">
                                        @if (Auth::user()->kategori == 'bumil')
                                            {{ $lastPemeriksaan->berat_badan }} kg
                                        @elseif(Auth::user()->kategori == 'anak')
                                            {{ $lastPemeriksaan->bb }} kg
                                        @elseif(Auth::user()->kategori == 'lansia')
                                            {{ $lastPemeriksaan->bb }} kg
                                        @endif
                                    </p>
                                    <p class="text-xs text-gray-600 dark:text-gray-400">Berat Badan</p>
                                </div>
                                <div class="text-center p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                                    <p class="text-lg font-bold text-gray-800 dark:text-white">
                                        @if (Auth::user()->kategori == 'bumil')
                                            {{ $lastPemeriksaan->usia_kehamilan }} minggu
                                        @elseif(Auth::user()->kategori == 'anak')
                                            {{ $lastPemeriksaan->tb }} cm
                                        @elseif(Auth::user()->kategori == 'lansia')
                                            {{ $lastPemeriksaan->tb }} cm
                                        @endif
                                    </p>
                                    <p class="text-xs text-gray-600 dark:text-gray-400">
                                        @if (Auth::user()->kategori == 'bumil')
                                            Usia Kehamilan
                                        @else
                                            Tinggi Badan
                                        @endif
                                    </p>
                                </div>
                            </div>
                        @else
                            <div class="text-center py-4">
                                <i class="fas fa-clipboard-list text-3xl text-gray-400 mb-2"></i>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Belum ada data pemeriksaan</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Riwayat Perkembangan -->
                <div class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">Riwayat Perkembangan</h3>
                    <div class="h-full">
                        <canvas id="userChart" data-labels='@json($anakLabels)'
                            data-bb='@json($bb)' data-tb='@json($tb)'
                            data-kategori="{{ Auth::user()->kategori }}"></canvas>
                    </div>
                </div>

                <!-- Rekomendasi -->
                <div class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">Rekomendasi</h3>
                    <div class="p-3 bg-blue-50 dark:bg-blue-900/20 rounded-lg">
                        <p class="text-sm text-gray-800 dark:text-white">
                            <i class="fas fa-lightbulb text-yellow-500 mr-2"></i>
                            {{ $rekomendasi }}
                        </p>
                    </div>
                </div>
            </div>
        @endcan
        <!-- Sidebar Kanan (Common untuk semua role) -->
        <div class="lg:col-span-1 space-y-6">
            <!-- Edukasi -->
            <div class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white">Edukasi</h3>
                    @can('isAdmin')
                        <a href="{{ route('view.edukasi') }}"
                            class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 text-xs cursor-pointer font-medium flex items-center">
                            <i class="fas fa-plus-circle mr-1"></i>
                            Buat Baru
                        </a>
                    @endcan
                </div>

                <div class="space-y-3">
                    @forelse($edukasis as $edukasi)
                        <div
                            class="p-3 bg-blue-50 dark:bg-blue-900/20 rounded-lg hover:bg-blue-100 dark:hover:bg-blue-900/30 transition-colors">
                            <div class="flex justify-between items-start">
                                <div class="flex-1">
                                    <h4 class="text-xs font-medium text-gray-800 dark:text-white mb-1">
                                        {{ $edukasi->judul }}</h4>
                                    <p class="text-[11px] text-gray-600 dark:text-gray-400 line-clamp-2">
                                        {{ $edukasi->deskripsi }}</p>
                                </div>
                                <span
                                    class="bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200 text-[10px] px-2 py-1 rounded-full ml-2 whitespace-nowrap">
                                    {{ $edukasi->kategori }}
                                </span>
                            </div>
                            <div class="flex items-center justify-between mt-2">
                                <div class="flex items-center text-xs text-gray-500 dark:text-gray-400">
                                    <i class="fas fa-user-circle mr-1"></i>
                                    {{ $edukasi->user->name }}
                                </div>
                                <div class="text-xs text-gray-500 dark:text-gray-400">
                                    <i class="far fa-clock mr-1"></i>
                                    {{ $edukasi->created_at->diffForHumans() }}
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-8">
                            <div class="text-gray-400 dark:text-gray-500 mb-3">
                                <i class="fas fa-book-open text-3xl"></i>
                            </div>
                            <p class="text-gray-500 dark:text-gray-400 text-sm mb-3">Belum ada materi edukasi</p>
                            @can('isAdmin')
                                <a href="{{ route('view.edukasi') }}"
                                    class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-xs rounded-lg transition-colors flex items-center mx-auto">
                                    <i class="fas fa-plus-circle mr-2"></i>
                                    Buat Edukasi Pertama
                                </a>
                            @endcan
                        </div>
                    @endforelse
                </div>

                @if ($edukasis->count() > 0)
                    <div class="mt-4 text-center">
                        <a href="{{ route('view.edukasi') }}"
                            class="text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 text-xs font-medium">
                            Lihat Semua Edukasi <i class="fas fa-arrow-right ml-1"></i>
                        </a>
                    </div>
                @endif
            </div>

            <!-- Cuaca -->
            <div class="bg-white dark:bg-gray-800 p-4 rounded-lg shadow">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-white">Cuaca Hari Ini</h3>
                    <span class="text-xs text-gray-500 dark:text-gray-400">
                        <span id="current-time">00:00</span> WIB
                    </span>
                </div>

                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center">
                        <div class="text-3xl font-bold text-gray-800 dark:text-white mr-4">
                            {{ $this->getWeather['current']['temp_c'] }}°C
                        </div>
                        <div>
                            <div class="text-sm text-gray-600 dark:text-gray-300 capitalize">
                                {{ $this->getWeather['current']['condition']['text'] }}
                            </div>
                            <div class="text-xs text-gray-500 dark:text-gray-400">
                                Terasa seperti {{ $this->getWeather['current']['feelslike_c'] }}°C
                            </div>
                        </div>
                    </div>
                    <div class="text-4xl text-blue-500">
                        <!-- Icon berdasarkan kondisi cuaca -->
                        @if ($this->getWeather['current']['condition']['text'] == 'Sunny')
                            <i class="fas fa-sun"></i>
                        @elseif($this->getWeather['current']['condition']['text'] == 'Partly cloudy')
                            <i class="fas fa-cloud-sun"></i>
                        @elseif($this->getWeather['current']['condition']['text'] == 'Cloudy')
                            <i class="fas fa-cloud"></i>
                        @elseif(str_contains(strtolower($this->getWeather['current']['condition']['text']), 'rain'))
                            <i class="fas fa-cloud-rain"></i>
                        @else
                            <i class="fas fa-cloud-sun"></i>
                        @endif
                    </div>
                </div>

                <!-- Tanggal Indonesia -->
                <div class="mb-4 p-3 bg-blue-50 dark:bg-blue-900/20 rounded-lg text-center">
                    <div class="text-sm font-medium text-gray-800 dark:text-white" id="current-date">
                        Memuat tanggal...
                    </div>
                    <div class="text-xs text-gray-600 dark:text-gray-400 mt-1">
                        <span id="current-time-full">00:00:00</span> WIB
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div class="flex items-center p-2 bg-gray-50 dark:bg-gray-700 rounded-lg">
                        <div class="text-blue-500 mr-2">
                            <i class="fas fa-wind"></i>
                        </div>
                        <div>
                            <div class="text-xs text-gray-500 dark:text-gray-400">Angin</div>
                            <div class="text-sm font-medium text-gray-800 dark:text-white">
                                {{ $this->getWeather['current']['wind_kph'] }} km/j
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center p-2 bg-gray-50 dark:bg-gray-700 rounded-lg">
                        <div class="text-blue-500 mr-2">
                            <i class="fas fa-tint"></i>
                        </div>
                        <div>
                            <div class="text-xs text-gray-500 dark:text-gray-400">Kelembapan</div>
                            <div class="text-sm font-medium text-gray-800 dark:text-white">
                                {{ $this->getWeather['current']['humidity'] }}%
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center p-2 bg-gray-50 dark:bg-gray-700 rounded-lg">
                        <div class="text-blue-500 mr-2">
                            <i class="fas fa-compress-alt"></i>
                        </div>
                        <div>
                            <div class="text-xs text-gray-500 dark:text-gray-400">Tekanan</div>
                            <div class="text-sm font-medium text-gray-800 dark:text-white">
                                {{ $this->getWeather['current']['pressure_mb'] }} mb
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center p-2 bg-gray-50 dark:bg-gray-700 rounded-lg">
                        <div class="text-blue-500 mr-2">
                            <i class="fas fa-eye"></i>
                        </div>
                        <div>
                            <div class="text-xs text-gray-500 dark:text-gray-400">Visibilitas</div>
                            <div class="text-sm font-medium text-gray-800 dark:text-white">
                                {{ $this->getWeather['current']['vis_km'] }} km
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex justify-between items-center text-xs text-gray-500 dark:text-gray-400">
                    <div class="flex items-center">
                        <i class="fas fa-map-marker-alt mr-1"></i>
                        {{ $this->getWeather['location']['name'] }}, {{ $this->getWeather['location']['region'] }}
                    </div>
                    <div>
                        <i class="fas fa-sync-alt mr-1"></i>
                        Data cuaca:
                        {{ \Carbon\Carbon::parse($this->getWeather['current']['last_updated'])->timezone('Asia/Jakarta')->diffForHumans() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('script')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const ctx = document.getElementById('trendChart');
            if (!ctx) return;

            const labels = JSON.parse(ctx.dataset.labels);
            const bumilData = JSON.parse(ctx.dataset.bumil);
            const anakData = JSON.parse(ctx.dataset.anak);
            const lansiaData = JSON.parse(ctx.dataset.lansia);

            // Destroy chart if already exists
            if (window.trendChartInstance) {
                trendChartInstance.destroy();
            }

            window.trendChartInstance = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                            label: 'Ibu Hamil',
                            data: bumilData,
                            borderColor: 'rgba(236, 72, 153, 1)',
                            backgroundColor: 'rgba(236, 72, 153, 0.2)',
                            tension: 0.3,
                            fill: false,
                        },
                        {
                            label: 'Anak',
                            data: anakData,
                            borderColor: 'rgba(59, 130, 246, 1)',
                            backgroundColor: 'rgba(59, 130, 246, 0.2)',
                            tension: 0.3,
                            fill: false,
                        },
                        {
                            label: 'Lansia',
                            data: lansiaData,
                            borderColor: 'rgba(139, 92, 246, 1)',
                            backgroundColor: 'rgba(139, 92, 246, 0.2)',
                            tension: 0.3,
                            fill: false,
                        }
                    ]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1
                            }
                        }
                    }
                }
            });
        });

        document.addEventListener('DOMContentLoaded', () => {
            const userChart = document.getElementById('userChart');

            const anakLabels = JSON.parse(userChart.dataset.labels);
            const bb = JSON.parse(userChart.dataset.bb);
            const tb = JSON.parse(userChart.dataset.tb);
            const kategori = userChart.dataset.kategori;

            const tbLabel = kategori === 'bumil' ? 'Sistole Diastole' : 'Tinggi Badan (cm)';

            window.userChart = new Chart(userChart, {
                type: 'line',
                data: {
                    labels: anakLabels,
                    datasets: [{
                            label: 'Berat Badan (kg)',
                            data: bb,
                            borderColor: 'rgba(59, 130, 246, 1)',
                            backgroundColor: 'rgba(59, 130, 246, 0.2)',
                            fill: true,
                            tension: 0.3
                        },
                        {
                            label: tbLabel,
                            data: tb,
                            borderColor: 'rgba(34, 197, 94, 1)',
                            backgroundColor: 'rgba(34, 197, 94, 0.2)',
                            fill: true,
                            tension: 0.3
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });

        function updateIndonesiaTime() {
            const now = new Date();

            // Opsi untuk format tanggal Indonesia
            const dateOptions = {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            };

            // Format tanggal: "Hari, DD Month YYYY"
            const formattedDate = now.toLocaleDateString('id-ID', dateOptions);

            // Format waktu: "HH:MM" dan "HH:MM:SS"
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            const seconds = String(now.getSeconds()).padStart(2, '0');

            const shortTime = `${hours}:${minutes}`;
            const fullTime = `${hours}:${minutes}:${seconds}`;

            // Update elemen HTML
            document.getElementById('current-date').textContent = formattedDate;
            document.getElementById('current-time').textContent = shortTime;
            document.getElementById('current-time-full').textContent = fullTime;
        }

        // Update waktu setiap detik
        updateIndonesiaTime();
        setInterval(updateIndonesiaTime, 1000);
    </script>
@endpush
