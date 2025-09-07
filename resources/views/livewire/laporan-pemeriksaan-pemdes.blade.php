<div>
    @push('style')
        <style>
            .active-tab {
                border-color: #3b82f6;
                color: #3b82f6;
                position: relative;
            }

            .dark .active-tab {
                border-color: #60a5fa;
                color: #60a5fa;
            }

            .dark .active-tab::after {
                background-color: #60a5fa;
            }

            /* Transisi untuk konten tab */
            .tab-content {
                opacity: 0;
                transform: translateY(10px);
                transition: opacity 0.3s ease, transform 0.3s ease;
            }

            .tab-content.active {
                opacity: 1;
                transform: translateY(0);
            }

            /* Efek hover pada tab */
            .tab-button {
                transition: all 0.2s ease;
            }

            .tab-button:hover {
                transform: translateY(-2px);
            }
        </style>
    @endpush

    <!-- Header Section -->
    <div class="mb-6">
        <h2 class="text-2xl font-bold text-gray-800 dark:text-white">Laporan Pemeriksaan</h2>
        <p class="text-gray-600 dark:text-gray-400 mt-1">Review hasil pemeriksaan Posyandu</p>
    </div>

    <!-- Tabs Navigation -->
    <div class="mt-6 mb-4 border-b border-gray-200 dark:border-gray-700">
        <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" role="tablist">
            <li class="me-2">
                <button wire:click="setTab('bumil')"
                    class="cursor-pointer tab-button inline-block p-4 border-b-2 rounded-t-lg border-transparent hover:text-blue-600 hover:border-blue-300 {{ $activeTab === 'bumil' ? 'active-tab' : '' }}"
                    type="button" role="tab">
                    <span class="flex items-center">
                        <svg class="w-4 h-4 mr-2 {{ $activeTab === 'bumil' ? 'text-blue-600 dark:text-blue-400' : 'text-gray-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        Ibu Hamil
                    </span>
                </button>
            </li>
            <li class="me-2">
                <button wire:click="setTab('anak')"
                    class="cursor-pointer tab-button inline-block p-4 border-b-2 rounded-t-lg border-transparent hover:text-blue-600 hover:border-blue-300 {{ $activeTab === 'anak' ? 'active-tab' : '' }}"
                    type="button" role="tab">
                    <span class="flex items-center">
                        <svg class="w-4 h-4 mr-2 {{ $activeTab === 'anak' ? 'text-blue-600 dark:text-blue-400' : 'text-gray-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                        Anak
                    </span>
                </button>
            </li>
            <li class="me-2">
                <button wire:click="setTab('lansia')"
                    class="cursor-pointer tab-button inline-block p-4 border-b-2 rounded-t-lg border-transparent hover:text-blue-600 hover:border-blue-300 {{ $activeTab === 'lansia' ? 'active-tab' : '' }}"
                    type="button" role="tab">
                    <span class="flex items-center">
                        <svg class="w-4 h-4 mr-2 {{ $activeTab === 'lansia' ? 'text-blue-600 dark:text-blue-400' : 'text-gray-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        Lansia
                    </span>
                </button>
            </li>
        </ul>
    </div>

    <!-- Tab Content -->
    <div>
        <!-- Tab Ibu Hamil -->
        <div class="tab-content {{ $activeTab === 'bumil' ? 'active' : '' }}">
            @if ($activeTab === 'bumil')
                @if ($bumilPemeriksaans && $bumilPemeriksaans->count() > 0)
                    <div class="w-full overflow-x-auto border border-gray-300 dark:border-gray-700 rounded-md mb-4">
                        <table class="min-w-[800px] w-full text-xs divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300">
                                <tr>
                                    <th class="px-2 py-2 text-left">No.</th>
                                    <th class="px-2 py-2 text-left">Nama</th>
                                    <th class="px-2 py-2 text-left">Alamat</th>
                                    <th class="px-2 py-2 text-left">Diagnosa</th>
                                    <th class="px-2 py-2 text-left">Tgl</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                                @foreach ($bumilPemeriksaans as $no => $pemeriksaan)
                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-800 text-gray-800 dark:text-gray-200">
                                        <td class="px-2 py-2">{{ $no + 1 }}</td>
                                        <td class="px-2 py-2 flex items-center gap-2">
                                            <img src="{{ asset('storage/' . $pemeriksaan->bumil->avatar) }}"
                                                class="h-6 w-6 rounded-full" alt="avatar">
                                            <div>
                                                <div class="text-[0.7rem] font-semibold">{{ $pemeriksaan->bumil->name }}
                                                </div>
                                                <div class="text-[0.65rem] text-gray-500 dark:text-gray-400">
                                                    {{ $pemeriksaan->bumil->nik }}</div>
                                            </div>
                                        </td>
                                        <td class="px-2 py-1.5 whitespace-nowrap text-gray-500 dark:text-gray-400">
                                            {{ $pemeriksaan->bumil->alamat ?? '-' }}
                                        </td>
                                        <td class="px-2 py-1.5 whitespace-nowrap text-gray-500 dark:text-gray-400">
                                            {{ $pemeriksaan->diagnosa ?? '-' }}
                                        </td>
                                        <td class="px-2 py-1.5 whitespace-nowrap text-gray-500 dark:text-gray-400">
                                            {{ $pemeriksaan->created_at->format('d M Y') }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="p-8 text-center border border-gray-300 dark:border-gray-700 rounded-md">
                        <div class="text-gray-500 dark:text-gray-400">
                            <i class="fas fa-clipboard-list text-4xl mb-3"></i>
                            <p>Tidak ada data pemeriksaan Ibu Hamil</p>
                        </div>
                    </div>
                @endif
            @endif
        </div>

        <!-- Tab Anak -->
        <div class="tab-content {{ $activeTab === 'anak' ? 'active' : '' }}">
            @if ($activeTab === 'anak')
                @if ($anakPemeriksaans && $anakPemeriksaans->count() > 0)
                    <div class="w-full overflow-x-auto border border-gray-300 dark:border-gray-700 rounded-md mb-4">
                        <table class="min-w-[800px] w-full text-xs divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300">
                                <tr>
                                    <th class="px-2 py-2 text-left">No.</th>
                                    <th class="px-2 py-2 text-left">Nama</th>
                                    <th class="px-2 py-2 text-left">Alamat</th>
                                    <th class="px-2 py-2 text-left">Diagnosa</th>
                                    <th class="px-2 py-2 text-left">Tgl</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                                @foreach ($anakPemeriksaans as $no => $pemeriksaan)
                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-800 text-gray-800 dark:text-gray-200">
                                        <td class="px-2 py-2">{{ $no + 1 }}</td>
                                        <td class="px-2 py-2 flex items-center gap-2">
                                            <img src="{{ asset('storage/' . $pemeriksaan->anak->avatar) }}"
                                                class="h-6 w-6 rounded-full" alt="avatar">
                                            <div>
                                                <div class="text-[0.7rem] font-semibold">{{ $pemeriksaan->anak->name }}
                                                </div>
                                                <div class="text-[0.65rem] text-gray-500 dark:text-gray-400">
                                                    {{ $pemeriksaan->anak->nik }}</div>
                                            </div>
                                        </td>
                                        <td class="px-2 py-1.5 whitespace-nowrap text-gray-500 dark:text-gray-400">
                                            {{ $pemeriksaan->anak->alamat ?? '-' }}
                                        </td>
                                        <td class="px-2 py-1.5 whitespace-nowrap text-gray-500 dark:text-gray-400">
                                            {{ $pemeriksaan->diagnosa ?? '-' }}
                                        </td>
                                        <td class="px-2 py-1.5 whitespace-nowrap text-gray-500 dark:text-gray-400">
                                            {{ $pemeriksaan->created_at->format('d M Y') }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="p-8 text-center border border-gray-300 dark:border-gray-700 rounded-md">
                        <div class="text-gray-500 dark:text-gray-400">
                            <i class="fas fa-child text-4xl mb-3"></i>
                            <p>Tidak ada data pemeriksaan Anak</p>
                        </div>
                    </div>
                @endif
            @endif
        </div>

        <!-- Tab Lansia -->
        <div class="tab-content {{ $activeTab === 'lansia' ? 'active' : '' }}">
            @if ($activeTab === 'lansia')
                @if ($lansiaPemeriksaans && $lansiaPemeriksaans->count() > 0)
                    <div class="w-full overflow-x-auto border border-gray-300 dark:border-gray-700 rounded-md mb-4">
                        <table class="min-w-[800px] w-full text-xs divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300">
                                <tr>
                                    <th class="px-2 py-2 text-left">No.</th>
                                    <th class="px-2 py-2 text-left">Nama</th>
                                    <th class="px-2 py-2 text-left">Alamat</th>
                                    <th class="px-2 py-2 text-left">Diagnosa</th>
                                    <th class="px-2 py-2 text-left">Tgl</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                                @foreach ($lansiaPemeriksaans as $no => $pemeriksaan)
                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-800 text-gray-800 dark:text-gray-200">
                                        <td class="px-2 py-2">{{ $no + 1 }}</td>
                                        <td class="px-2 py-2 flex items-center gap-2">
                                            <img src="{{ asset('storage/' . $pemeriksaan->lansia->avatar) }}"
                                                class="h-6 w-6 rounded-full" alt="avatar">
                                            <div>
                                                <div class="text-[0.7rem] font-semibold">
                                                    {{ $pemeriksaan->lansia->name }}
                                                </div>
                                                <div class="text-[0.65rem] text-gray-500 dark:text-gray-400">
                                                    {{ $pemeriksaan->lansia->nik }}</div>
                                            </div>
                                        </td>
                                        <td class="px-2 py-1.5 whitespace-nowrap text-gray-500 dark:text-gray-400">
                                            {{ $pemeriksaan->lansia->alamat ?? '-' }}
                                        </td>
                                        <td class="px-2 py-1.5 whitespace-nowrap text-gray-500 dark:text-gray-400">
                                            {{ $pemeriksaan->diagnosa ?? '-' }}
                                        </td>
                                        <td class="px-2 py-1.5 whitespace-nowrap text-gray-500 dark:text-gray-400">
                                            {{ $pemeriksaan->created_at->format('d M Y') }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="p-8 text-center border border-gray-300 dark:border-gray-700 rounded-md">
                        <div class="text-gray-500 dark:text-gray-400">
                            <i class="fas fa-wheelchair text-4xl mb-3"></i>
                            <p>Tidak ada data pemeriksaan Lansia</p>
                        </div>
                    </div>
                @endif
            @endif
        </div>
    </div>
</div>

