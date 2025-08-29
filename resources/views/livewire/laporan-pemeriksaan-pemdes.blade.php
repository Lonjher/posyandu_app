<div>
    @if ($anakPemeriksaans)
        <div class="w-full overflow-x-auto border border-gray-300 dark:border-gray-700 rounded-md">
            <table class="min-w-[800px] w-full text-xs divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300">
                    <tr>
                        <th class="px-2 py-2 text-left">No.</th>
                        <th class="px-2 py-2 text-left">Nama</th>
                        <th class="px-2 py-2 text-left">Diagnosa</th>
                        <th class="px-2 py-2 text-left">Edukasi</th>
                        <th class="px-2 py-2 text-left">Tgl</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                    @if ($anakPemeriksaans)
                        @foreach ($anakPemeriksaans as $no => $pemeriksaan)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-800 text-gray-800 dark:text-gray-200">
                                <td class="px-2 py-2">{{ $no = +1 }}</td>
                                <td class="px-2 py-2 flex items-center gap-2">
                                    <img src="{{ asset('storage/' . $pemeriksaan->anak->avatar) }}"
                                        class="h-6 w-6 rounded-full" alt="avatar">
                                    <div>
                                        <div class="text-[0.7rem] font-semibold">{{ $pemeriksaan->anak->name }}</div>
                                        <div class="text-[0.65rem] text-gray-500 dark:text-gray-400">
                                            {{ $pemeriksaan->anak->nik }}</div>
                                    </div>
                                </td>
                                <td class="px-2 py-1.5 whitespace-nowrap text-gray-500 dark:text-gray-400">
                                    {{ $pemeriksaan->diagnosa ?? '-' }}
                                </td>
                                <td class="px-2 py-1.5 whitespace-nowrap text-gray-500 dark:text-gray-400">
                                    {{ $pemeriksaan->edukasi ?? '-' }}
                                </td>
                                <td class="px-2 py-1.5 whitespace-nowrap text-gray-500 dark:text-gray-400">
                                    {{ $pemeriksaan->created_at->format('d/m') }}
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="20" class="px-2 py-2 text-center text-gray-500 dark:text-gray-400">
                                Tidak ada data
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>

            <!-- Pagination -->
            @if ($anakPemeriksaans && $anakPemeriksaans->hasPages())
                <div class="px-2 py-1.5 border-t dark:border-gray-700">
                    {{ $anakPemeriksaans->links('vendor.pagination.tailwind') }}
                </div>
            @endif
        </div>
    @elseif($lansiaPemeriksaans)
        <!-- Tabel -->
        <div class="w-full overflow-x-auto border border-gray-300 dark:border-gray-700 rounded-md">
            <table class="min-w-[1000px] w-full text-xs divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300">
                    <tr>
                        <th class="px-2 py-2 text-left">No</th>
                        <th class="px-2 py-2 text-left">Nama Lansia</th>
                        <th class="px-2 py-2 text-left">Diagnosa</th>
                        <th class="px-2 py-2 text-left">Edukasi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                    @forelse($lansiaPemeriksaans as $no => $pemeriksaan)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-800">
                            <td class="px-2 py-2">{{ $lansiaPemeriksaans->firstItem() + $no }}</td>
                            <td class="px-2 py-2 flex items-center gap-2">
                                <img src="{{ asset('storage/' . $pemeriksaan->lansia->avatar) }}"
                                    class="h-6 w-6 rounded-full" alt="avatar">
                                <div>
                                    <div class="text-[0.7rem] font-semibold">{{ $pemeriksaan->lansia->name }}</div>
                                    <div class="text-[0.65rem] text-gray-500 dark:text-gray-400">
                                        {{ $pemeriksaan->lansia->nik }}</div>
                                </div>
                            </td>
                            <td class="px-2 py-2">{{ $pemeriksaan->diagnosa }}</td>
                            <td class="px-2 py-2">{{ $pemeriksaan->edukasi ?? '-' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="11" class="px-2 py-2 text-center">Tidak ada data</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            @if ($lansiaPemeriksaans->hasPages())
                <div class="px-2 py-2 border-t">{{ $lansiaPemeriksaans->links() }}</div>
            @endif
        </div>
    @elseif($bumilPemeriksaans)s
        <div class="w-full overflow-x-auto border border-gray-300 dark:border-gray-700 rounded-md">
            <table class="min-w-[800px] w-full text-xs divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300">
                    <tr>
                        <th class="px-2 py-2 text-left">No.</th>
                        <th class="px-2 py-2 text-left">Nama</th>
                        <th class="px-2 py-2 text-left">Diagnosa</th>
                        <th class="px-2 py-2 text-left">Edukasi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                    @if ($bumilPemeriksaans)
                        @foreach ($bumilPemeriksaans as $no => $pemeriksaan)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-800 text-gray-800 dark:text-gray-200">
                                <td class="px-2 py-2">{{ $bumilPemeriksaans->firstItem() + $no }}</td>
                                <td class="px-2 py-2 flex items-center gap-2">
                                    <img src="{{ asset('storage/' . $pemeriksaan->bumil->avatar) }}"
                                        class="h-6 w-6 rounded-full" alt="avatar">
                                    <div>
                                        <div class="text-[0.7rem] font-semibold">{{ $pemeriksaan->bumil->name }}</div>
                                        <div class="text-[0.65rem] text-gray-500 dark:text-gray-400">
                                            {{ $pemeriksaan->bumil->nik }}</div>
                                    </div>
                                </td>
                                <td class="px-2 py-1.5 whitespace-nowrap text-gray-500 dark:text-gray-400">
                                    {{ $pemeriksaan->diagnosa ?? '-' }}
                                </td>
                                <td class="px-2 py-1.5 whitespace-nowrap text-gray-500 dark:text-gray-400">
                                    {{ $pemeriksaan->edukasi ?? '-' }}
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="13" class="px-2 py-2 text-center text-gray-500 dark:text-gray-400">
                                Tidak ada data
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    @endif
</div>
