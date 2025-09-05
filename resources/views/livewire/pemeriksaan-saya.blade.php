<div>
    <!-- Header Section -->
    <flux:legend>Hasil Pemeriksaan Anda</flux:legend>
    <flux:description>Review dan pantau data pemeriksaan kesehatan anda</flux:description>

    <div class="mt-4 mb-2">
        <flux:button wire:click='exportPdf' icon="pdf" size="xs" class="shadow-sm">Export</flux:button>
    </div>

    @if ($anakPemeriksaans)
        <div class="w-full overflow-x-auto border border-gray-300 dark:border-gray-700 rounded-md">
            <table class="min-w-[800px] w-full text-xs divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300">
                    <tr>
                        <th class="px-2 py-2 text-left">No.</th>
                        <th class="px-2 py-2 text-left">Nama</th>
                        <th class="px-2 py-2 text-left">BB</th>
                        <th class="px-2 py-2 text-left">Kes. BB</th>
                        <th class="px-2 py-2 text-left">Kes. Has. BB</th>
                        <th class="px-2 py-2 text-left">TB</th>
                        <th class="px-2 py-2 text-left">Kes. TB</th>
                        <th class="px-2 py-2 text-left">Kes. IMT</th>
                        <th class="px-2 py-2 text-left">LK</th>
                        <th class="px-2 py-2 text-left">Ks. LK</th>
                        <th class="px-2 py-2 text-left">Lila</th>
                        <th class="px-2 py-2 text-left">Kes. Lila</th>
                        <th class="px-2 py-2 text-left">Asi Eks.</th>
                        <th class="px-2 py-2 text-left">Mp. Asi</th>
                        <th class="px-2 py-2 text-left">Imun.</th>
                        <th class="px-2 py-2 text-left">Vit. A</th>
                        <th class="px-2 py-2 text-left">Ob. Cacing</th>
                        <th class="px-2 py-2 text-left">MT. Pgn</th>
                        <th class="px-2 py-2 text-left">Gejala</th>
                        <th class="px-2 py-2 text-left">Diagnosa</th>
                        <th class="px-2 py-2 text-left">Tgl</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                    @if ($anakPemeriksaans && count($anakPemeriksaans) > 0)
                        @foreach ($anakPemeriksaans as $no => $pemeriksaan)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-800 text-gray-800 dark:text-gray-200">
                                <td class="px-2 py-2">{{ $anakPemeriksaans->firstItem() + $no }}</td>
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
                                    {{ $pemeriksaan->bb }}m
                                </td>
                                <td class="px-2 py-1.5 whitespace-nowrap text-gray-500 dark:text-gray-400">
                                    {{ $pemeriksaan->kesimpulan_hasil_bb }}
                                </td>
                                <td class="px-2 py-1.5 whitespace-nowrap text-gray-500 dark:text-gray-400">
                                    {{ $pemeriksaan->kesimpulan_hasil_pengukuran_bb }}
                                </td>
                                <td class="px-2 py-1.5 whitespace-nowrap text-gray-500 dark:text-gray-400">
                                    {{ $pemeriksaan->tb }}
                                </td>
                                <td class="px-2 py-1.5 whitespace-nowrap text-gray-500 dark:text-gray-400">
                                    {{ $pemeriksaan->kesimpulan_hasil_tb ?? '-' }}
                                </td>
                                <td class="px-2 py-1.5 whitespace-nowrap text-gray-500 dark:text-gray-400">
                                    {{ $pemeriksaan->kesimpulan_hasil_pengukuran_imt ?? '-' }}
                                </td>
                                <td class="px-2 py-1.5 whitespace-nowrap text-gray-500 dark:text-gray-400">
                                    {{ $pemeriksaan->lingkar_kepala ?? '-' }}
                                </td>
                                <td class="px-2 py-1.5 whitespace-nowrap text-gray-500 dark:text-gray-400">
                                    {{ $pemeriksaan->kesimpulan_lk ?? '-' }}
                                </td>
                                <td class="px-2 py-1.5 whitespace-nowrap text-gray-500 dark:text-gray-400">
                                    {{ $pemeriksaan->lingkar_lengan_atas ?? '-' }}
                                </td>
                                <td class="px-2 py-1.5 whitespace-nowrap text-gray-500 dark:text-gray-400">
                                    {{ $pemeriksaan->kesimpulan_lla ?? '-' }}
                                </td>
                                <td class="px-2 py-1.5 whitespace-nowrap text-gray-500 dark:text-gray-400">
                                    {{ $pemeriksaan->asi_eksklusif ?? '-' }}
                                </td>
                                <td class="px-2 py-1.5 whitespace-nowrap text-gray-500 dark:text-gray-400">
                                    {{ $pemeriksaan->mp_asi ?? '-' }}
                                </td>
                                <td class="px-2 py-1.5 whitespace-nowrap text-gray-500 dark:text-gray-400">
                                    {{ $pemeriksaan->imunisasi ?? '-' }}
                                </td>
                                <td class="px-2 py-1.5 whitespace-nowrap text-gray-500 dark:text-gray-400">
                                    {{ $pemeriksaan->vitamin_a ?? '-' }}
                                </td>
                                <td class="px-2 py-1.5 whitespace-nowrap text-gray-500 dark:text-gray-400">
                                    {{ $pemeriksaan->obat_cacing ?? '-' }}
                                </td>
                                <td class="px-2 py-1.5 whitespace-nowrap text-gray-500 dark:text-gray-400">
                                    {{ $pemeriksaan->mt_pangan_lokal ?? '-' }}
                                </td>
                                <td class="px-2 py-1.5 whitespace-nowrap text-gray-500 dark:text-gray-400">
                                    {{ $pemeriksaan->gejala_sakit ?? '-' }}
                                </td>
                                <td class="px-2 py-1.5 whitespace-nowrap text-gray-500 dark:text-gray-400">
                                    {{ $pemeriksaan->diagnosa ?? '-' }}
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
        <div class="w-full overflow-x-auto border border-gray-300 dark:border-gray-700 rounded-md">
            <table class="min-w-[1000px] w-full text-xs divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300">
                    <tr>
                        <th class="px-2 py-2 text-left">No</th>
                        <th class="px-2 py-2 text-left">Nama Lansia</th>
                        <th class="px-2 py-2 text-left">Usia</th>
                        <th class="px-2 py-2 text-left">Jenis Kelamin</th>
                        <th class="px-2 py-2 text-left">BB</th>
                        <th class="px-2 py-2 text-left">TB</th>
                        <th class="px-2 py-2 text-left">IMT</th>
                        <th class="px-2 py-2 text-left">Lingkar Perut</th>
                        <th class="px-2 py-2 text-left">Tekanan Darah</th>
                        <th class="px-2 py-2 text-left">Gula Darah</th>
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
                            <td class="px-2 py-2">{{ $pemeriksaan->usia }}</td>
                            <td class="px-2 py-2">{{ $pemeriksaan->lansia->jenis_kelamin }}</td>
                            <td class="px-2 py-2">{{ $pemeriksaan->bb }}</td>
                            <td class="px-2 py-2">{{ $pemeriksaan->tb }}</td>
                            <td class="px-2 py-2">{{ $pemeriksaan->imt }}</td>
                            <td class="px-2 py-2">{{ $pemeriksaan->lingkar_perut }}</td>
                            <td class="px-2 py-2">{{ $pemeriksaan->tekanan_darah }}</td>
                            <td class="px-2 py-2">{{ $pemeriksaan->gula_darah }}</td>
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
    @elseif($bumilPemeriksaans)
        <div class="w-full overflow-x-auto border border-gray-300 dark:border-gray-700 rounded-md">
            <table class="min-w-[800px] w-full text-xs divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300">
                    <tr>
                        <th class="px-2 py-2 text-left">No.</th>
                        <th class="px-2 py-2 text-left">Nama</th>
                        <th class="px-2 py-2 text-left">Us. Kehamilan</th>
                        <th class="px-2 py-2 text-left">BB</th>
                        <th class="px-2 py-2 text-left">Lila</th>
                        <th class="px-2 py-2 text-left">TD</th>
                        <th class="px-2 py-2 text-left">Jum. Ttd</th>
                        <th class="px-2 py-2 text-left">Jad. Ttd</th>
                        <th class="px-2 py-2 text-left">Jum. Mt</th>
                        <th class="px-2 py-2 text-left">Jad. Mt</th>
                        <th class="px-2 py-2 text-left">Diagnosa</th>
                        <th class="px-2 py-2 text-left">Tgl</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                    @if ($bumilPemeriksaans && count($bumilPemeriksaans) > 0)
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
                                    {{ $pemeriksaan->usia_kehamilan }}m
                                </td>
                                <td class="px-2 py-1.5 whitespace-nowrap text-gray-500 dark:text-gray-400">
                                    {{ $pemeriksaan->berat_badan }}
                                </td>
                                <td class="px-2 py-1.5 whitespace-nowrap text-gray-500 dark:text-gray-400">
                                    {{ $pemeriksaan->lila }}
                                </td>
                                <td class="px-2 py-1.5 whitespace-nowrap text-gray-500 dark:text-gray-400">
                                    {{ $pemeriksaan->sistole_distole }}
                                </td>
                                <td class="px-2 py-1.5 whitespace-nowrap text-gray-500 dark:text-gray-400">
                                    {{ $pemeriksaan->jumlah_ttd ?? '-' }}
                                </td>
                                <td class="px-2 py-1.5 whitespace-nowrap text-gray-500 dark:text-gray-400">
                                    {{ $pemeriksaan->jadwal_ttd ?? '-' }}
                                </td>
                                <td class="px-2 py-1.5 whitespace-nowrap text-gray-500 dark:text-gray-400">
                                    {{ $pemeriksaan->komposisi_jumlah_porsi ?? '-' }}
                                </td>
                                <td class="px-2 py-1.5 whitespace-nowrap text-gray-500 dark:text-gray-400">
                                    {{ $pemeriksaan->jadwal_mt ?? '-' }}
                                </td>
                                <td class="px-2 py-1.5 whitespace-nowrap text-gray-500 dark:text-gray-400">
                                    {{ $pemeriksaan->diagnosa ?? '-' }}
                                </td>
                                <td class="px-2 py-1.5 whitespace-nowrap text-gray-500 dark:text-gray-400">
                                    {{ $pemeriksaan->created_at->format('d/m') }}
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
            <!-- Pagination -->
            @if ($bumilPemeriksaans && $bumilPemeriksaans->hasPages())
                <div class="px-2 py-1.5 border-t dark:border-gray-700">
                    {{ $bumilPemeriksaans->links('vendor.pagination.tailwind') }}
                </div>
            @endif
        </div>
    @endif
</div>
