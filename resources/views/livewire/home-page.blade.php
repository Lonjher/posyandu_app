<div>
    <section class="relative bg-gradient-to-r from-blue-500 to-teal-400 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 md:py-28">
            <div class="relative z-10 text-center">
                <h1 class="text-4xl md:text-6xl font-bold text-white mb-6 animate-fade-in-down">
                    Layanan Posyandu Modern
                </h1>
                <p class="text-xl text-blue-100 max-w-3xl mx-auto mb-8 animate-fade-in-down animate-delay-100">
                    Pantau tumbuh kembang anak dengan mudah dan terintegrasi
                </p>
                <div class="flex flex-col sm:flex-row justify-center gap-4 animate-fade-in-up animate-delay-200">
                    <a href="{{ route('register') }}"
                        class="px-8 py-3 bg-white text-blue-600 font-semibold rounded-lg shadow-lg hover:bg-blue-50 transition duration-300 transform hover:scale-105">
                        Daftar Sekarang
                    </a>
                    <a href="#fitur"
                        class="px-8 py-3 border-2 border-white text-white font-semibold rounded-lg hover:bg-white hover:bg-opacity-10 transition duration-300">
                        Pelajari Lebih Lanjut
                    </a>
                </div>
            </div>
            <div class="absolute inset-0 flex items-center justify-center opacity-20">
                <svg class="w-full h-full" viewBox="0 0 100 100" preserveAspectRatio="none">
                    <path d="M0,0 L100,0 L100,100 L0,100 Z" fill="white" class="animate-pulse"></path>
                </svg>
            </div>
        </div>
    </section>
    <div x-data="{ activeTab: 'pemeriksaan' }" class="mb-12">
        <div class="flex flex-wrap border-b border-gray-200">
            <button @click="activeTab = 'pemeriksaan'"
                :class="{ 'border-b-2 border-blue-500 text-blue-600': activeTab === 'pemeriksaan' }"
                class="px-6 py-3 font-medium text-lg focus:outline-none transition">
                Pemeriksaan Anak
            </button>
            <button @click="activeTab = 'imunisasi'"
                :class="{ 'border-b-2 border-blue-500 text-blue-600': activeTab === 'imunisasi' }"
                class="px-6 py-3 font-medium text-lg focus:outline-none transition">
                Jadwal Imunisasi
            </button>
        </div>

        <div x-show="activeTab === 'pemeriksaan'" class="pt-6 animate-fade-in">
            <!-- Konten pemeriksaan anak -->
        </div>

        <div x-show="activeTab === 'imunisasi'" class="pt-6 animate-fade-in">
            <!-- Konten imunisasi -->
        </div>
    </div>
    <div class="bg-white rounded-xl shadow-lg p-6 md:p-8 max-w-2xl mx-auto">
        <h3 class="text-2xl font-bold text-center mb-6 text-gray-800">Daftar Cepat Posyandu Digital</h3>

        <form wire:submit.prevent="submit">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Input fields -->
                <div>
                    <label class="block text-gray-700 mb-2">Nama Lengkap</label>
                    <input type="text" wire:model="name"
                        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    @error('name')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Field lainnya -->
            </div>

            <button type="submit"
                class="mt-6 w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-lg transition duration-300 transform hover:scale-101">
                Daftar Sekarang
            </button>
        </form>

        @if (session()->has('message'))
            <div class="mt-4 p-4 bg-green-100 text-green-700 rounded-lg animate-fade-in">
                {{ session('message') }}
            </div>
        @endif
    </div>
</div>
