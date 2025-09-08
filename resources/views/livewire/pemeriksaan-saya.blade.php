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
                        <th class="px-2 py-2 text-left">Mp. Asi.</th>
                        <th class="px-2 py-2 text-left">Imun.</th>
                        <th class="px-2 py-2 text-left">Vit. A</th>
                        <th class="px-2 py-2 text-left">Ob. Cacing</th>
                        <th class="px-2 py-2 text-left">MT. Pgn</th>
                        <th class="px-2 py-2 text-left">Gejala</th>
                        <th class="px-2 py-2 text-left">Diagnosa</th>
                        <th class="px-2 py-2 text-left">Edukasi</th>
                        <th class="px-2 py-2 text-left">Tgl</th>
                        <th class="px-2 py-2 text-left">Aksi</th>
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
                                    {{ $pemeriksaan->edukasi ?? '-' }}
                                </td>
                                <td class="px-2 py-1.5 whitespace-nowrap text-gray-500 dark:text-gray-400">
                                    {{ $pemeriksaan->created_at->format('d/m') }}
                                </td>
                                <td class="px-2 py-2">
                                    <flux:dropdown position="bottom" align="start">
                                        <button
                                            class="text-gray-950 bg-blue-100 hover:bg-blue-200 dark:text-white dark:bg-gray-800 dark:hover:bg-gray-700 focus:outline-none px-3 py-1 rounded">
                                            &#8942;
                                        </button>
                                        <flux:menu class="w-10">
                                            <div class="flex flex-col space-y-1">
                                                <flux:button
                                                    wire:click="openModalTbcAnak({{ $pemeriksaan->id_anak_pemeriksaan }})"
                                                    size="xs" icon="information-circle" class="!text-[0.65rem]">
                                                    Skrining TBC
                                                </flux:button>
                                            </div>
                                        </flux:menu>
                                    </flux:dropdown>
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
                        <th class="px-2 py-2 text-left">Mata Kanan</th>
                        <th class="px-2 py-2 text-left">Mata Kiri</th>
                        <th class="px-2 py-2 text-left">Telingan Kanan</th>
                        <th class="px-2 py-2 text-left">Telingan Kiri</th>
                        <th class="px-2 py-2 text-left">Usia</th>
                        <th class="px-2 py-2 text-left">Alat Kontrasepsi</th>
                        <th class="px-2 py-2 text-left">Diagnosa</th>
                        <th class="px-2 py-2 text-left">Edukasi</th>
                        <th class="px-2 py-2 text-left">Aksi</th>
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
                            <td class="px-2 py-2">{{ $pemeriksaan->mata_kanan }}</td>
                            <td class="px-2 py-2">{{ $pemeriksaan->mata_kiri }}</td>
                            <td class="px-2 py-2">{{ $pemeriksaan->telinga_kanan }}</td>
                            <td class="px-2 py-2">{{ $pemeriksaan->telinga_kiri }}</td>
                            <td class="px-2 py-2">{{ $pemeriksaan->usia }}</td>
                            <td class="px-2 py-2">{{ $pemeriksaan->menggunakan_alat_kontrasepsi ? 'Ya' : 'Tidak' }}
                            </td>
                            <td class="px-2 py-2">{{ $pemeriksaan->diagnosa }}</td>
                            <td class="px-2 py-2">{{ $pemeriksaan->edukasi }}</td>
                            <td class="px-2 py-2">
                                <flux:dropdown position="bottom" align="start">
                                    <button
                                        class="text-gray-950 bg-blue-100 hover:bg-blue-200 dark:text-white dark:bg-gray-800 dark:hover:bg-gray-700 focus:outline-none px-3 py-1 rounded">
                                        &#8942;
                                    </button>
                                    <flux:menu class="w-10">
                                        <div class="flex flex-col space-y-1">
                                            <flux:button
                                                wire:click="openModalTbcLansia({{ $pemeriksaan->id_lansia_pemeriksaan }})"
                                                size="xs" icon="information-circle" class="!text-[0.65rem]">
                                                Skrining TBC
                                            </flux:button>
                                        </div>
                                    </flux:menu>
                                </flux:dropdown>
                            </td>
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
                        <th class="px-2 py-2 text-left">Edukasi</th>
                        <th class="px-2 py-2 text-left">Tgl</th>
                        <th class="px-2 py-2 text-left">Aksi</th>
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
                                    {{ $pemeriksaan->edukasi ?? '-' }}
                                </td>
                                <td class="px-2 py-1.5 whitespace-nowrap text-gray-500 dark:text-gray-400">
                                    {{ $pemeriksaan->created_at->format('d/m') }}
                                </td>
                                <td class="px-2 py-2">
                                    <flux:dropdown position="bottom" align="start">
                                        <button
                                            class="text-gray-950 bg-blue-100 hover:bg-blue-200 dark:text-white dark:bg-gray-800 dark:hover:bg-gray-700 focus:outline-none px-3 py-1 rounded">
                                            &#8942;
                                        </button>
                                        <flux:menu class="w-10">
                                            <div class="flex flex-col space-y-1">
                                                <flux:button
                                                    wire:click="openModalTbcBumil({{ $pemeriksaan->id_bumil_pemeriksaan }})"
                                                    size="xs" icon="information-circle" class="!text-[0.65rem]">
                                                    Skrining TBC
                                                </flux:button>
                                            </div>
                                        </flux:menu>
                                    </flux:dropdown>
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

    <flux:modal name="skrining-tbc" class="min-w-3xl">
        <!-- Modal Skrining TBC -->
        <div
            class="rounded-lg w-full overflow-hidden bg-gradient-to-br from-white to-gray-50 dark:from-gray-800 dark:to-gray-900 shadow-2xl">

            <!-- Modal Header dengan Gradient -->
            <div
                class="flex items-center justify-between p-6 bg-gradient-to-r from-blue-500 to-blue-600 dark:from-blue-700 dark:to-blue-800 text-white">
                <div class="flex items-center">
                    <div class="w-10 h-10 rounded-full bg-white/20 flex items-center justify-center mr-3">
                        <i class="fas fa-lungs-virus text-xl"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold">Hasil Skrining TBC</h3>
                        <p class="text-sm text-blue-100 opacity-90">Status kesehatan pernapasan</p>
                    </div>
                </div>
            </div>

            <!-- Modal Body -->
            <div class="p-6">
                <div class="mb-6 text-center">
                    <p class="text-sm text-gray-600 dark:text-gray-300 mb-4">
                        Hasil pemeriksaan skrining TBC untuk pasien:
                    </p>

                    <!-- Status Hasil dengan Icon -->
                    <div
                        class="mb-6 p-5 rounded-2xl border-2 shadow-sm transition-all duration-300
                    @if (
                        $batuk_terus_menerus == 0 &&
                            $demam_lebih_dari_2_minggu == 0 &&
                            $berat_badan_turun_tanpa_sebab_jelas == 0 &&
                            $kontak_dengan_orang_terinfeksi_tbc == 0) border-green-200 bg-green-50 dark:border-green-800 dark:bg-green-900/20
                         hover:shadow-green-200 dark:hover:shadow-green-900
                    @elseif (
                        $batuk_terus_menerus +
                            $demam_lebih_dari_2_minggu +
                            $berat_badan_turun_tanpa_sebab_jelas +
                            $kontak_dengan_orang_terinfeksi_tbc >=
                            2)
                         border-red-200 bg-red-50 dark:border-red-800 dark:bg-red-900/20
                         hover:shadow-red-200 dark:hover:shadow-red-900
                    @else
                         border-yellow-200 bg-yellow-50 dark:border-yellow-800 dark:bg-yellow-900/20
                         hover:shadow-yellow-200 dark:hover:shadow-yellow-900 @endif">

                        <div class="flex items-center justify-center mb-3">
                            <div
                                class="w-12 h-12 rounded-full flex items-center justify-center
                            @if (
                                $batuk_terus_menerus == 0 &&
                                    $demam_lebih_dari_2_minggu == 0 &&
                                    $berat_badan_turun_tanpa_sebab_jelas == 0 &&
                                    $kontak_dengan_orang_terinfeksi_tbc == 0) bg-green-100 text-green-600 dark:bg-green-800 dark:text-green-300
                            @elseif (
                                $batuk_terus_menerus +
                                    $demam_lebih_dari_2_minggu +
                                    $berat_badan_turun_tanpa_sebab_jelas +
                                    $kontak_dengan_orang_terinfeksi_tbc >=
                                    2)
                                 bg-red-100 text-red-600 dark:bg-red-800 dark:text-red-300
                            @else
                                 bg-yellow-100 text-yellow-600 dark:bg-yellow-800 dark:text-yellow-300 @endif">
                                <i
                                    class="fas
                                @if (
                                    $batuk_terus_menerus == 0 &&
                                        $demam_lebih_dari_2_minggu == 0 &&
                                        $berat_badan_turun_tanpa_sebab_jelas == 0 &&
                                        $kontak_dengan_orang_terinfeksi_tbc == 0) fa-check-circle
                                @elseif (
                                    $batuk_terus_menerus +
                                        $demam_lebih_dari_2_minggu +
                                        $berat_badan_turun_tanpa_sebab_jelas +
                                        $kontak_dengan_orang_terinfeksi_tbc >=
                                        2)
                                     fa-exclamation-circle
                                @else
                                     fa-info-circle @endif text-xl">
                                </i>
                            </div>
                        </div>

                        <span
                            class="font-bold text-lg
                        @if (
                            $batuk_terus_menerus == 0 &&
                                $demam_lebih_dari_2_minggu == 0 &&
                                $berat_badan_turun_tanpa_sebab_jelas == 0 &&
                                $kontak_dengan_orang_terinfeksi_tbc == 0) text-green-700 dark:text-green-300
                        @elseif (
                            $batuk_terus_menerus +
                                $demam_lebih_dari_2_minggu +
                                $berat_badan_turun_tanpa_sebab_jelas +
                                $kontak_dengan_orang_terinfeksi_tbc >=
                                2)
                             text-red-700 dark:text-red-300
                        @else
                             text-yellow-700 dark:text-yellow-300 @endif">
                            @if (
                                $batuk_terus_menerus == 0 &&
                                    $demam_lebih_dari_2_minggu == 0 &&
                                    $berat_badan_turun_tanpa_sebab_jelas == 0 &&
                                    $kontak_dengan_orang_terinfeksi_tbc == 0)
                                TIDAK ADA GEJALA TBC
                            @elseif (
                                $batuk_terus_menerus +
                                    $demam_lebih_dari_2_minggu +
                                    $berat_badan_turun_tanpa_sebab_jelas +
                                    $kontak_dengan_orang_terinfeksi_tbc >=
                                    2)
                                DIREKOMENDASIKAN TES TBC
                            @else
                                PERLU PEMANTAUAN LANJUT
                            @endif
                        </span>

                        <p
                            class="text-sm mt-2
                        @if (
                            $batuk_terus_menerus == 0 &&
                                $demam_lebih_dari_2_minggu == 0 &&
                                $berat_badan_turun_tanpa_sebab_jelas == 0 &&
                                $kontak_dengan_orang_terinfeksi_tbc == 0) text-green-600 dark:text-green-400
                        @elseif (
                            $batuk_terus_menerus +
                                $demam_lebih_dari_2_minggu +
                                $berat_badan_turun_tanpa_sebab_jelas +
                                $kontak_dengan_orang_terinfeksi_tbc >=
                                2)
                             text-red-600 dark:text-red-400
                        @else
                             text-yellow-600 dark:text-yellow-400 @endif">
                            @if (
                                $batuk_terus_menerus == 0 &&
                                    $demam_lebih_dari_2_minggu == 0 &&
                                    $berat_badan_turun_tanpa_sebab_jelas == 0 &&
                                    $kontak_dengan_orang_terinfeksi_tbc == 0)
                                ✅ Tidak terdeteksi gejala TBC
                            @elseif (
                                $batuk_terus_menerus +
                                    $demam_lebih_dari_2_minggu +
                                    $berat_badan_turun_tanpa_sebab_jelas +
                                    $kontak_dengan_orang_terinfeksi_tbc >=
                                    2)
                                ⚠️ Segera konsultasi ke dokter
                            @else
                                🔍 Perlu observasi lebih lanjut
                            @endif
                        </p>
                    </div>

                    <!-- Daftar Gejala dengan Card -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                        <div
                            class="bg-white dark:bg-gray-800 p-4 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm hover:shadow-md transition-shadow duration-300
                         {{ $batuk_terus_menerus ? 'ring-2 ring-red-200 dark:ring-red-800' : 'ring-2 ring-green-200 dark:ring-green-800' }}">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <div
                                        class="w-8 h-8 rounded-full flex items-center justify-center mr-3
                                    {{ $batuk_terus_menerus ? 'bg-red-100 text-red-600 dark:bg-red-900 dark:text-red-300' : 'bg-green-100 text-green-600 dark:bg-green-900 dark:text-green-300' }}">
                                        <i class="fas fa-coughing"></i>
                                    </div>
                                    <span class="text-sm font-medium text-gray-800 dark:text-white">Batuk terus
                                        menerus</span>
                                </div>
                                <span
                                    class="px-3 py-1 rounded-full text-xs font-bold
                                {{ $batuk_terus_menerus ? 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300' : 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300' }}">
                                    {{ $batuk_terus_menerus ? 'Ya' : 'Tidak' }}
                                </span>
                            </div>
                        </div>

                        <div
                            class="bg-white dark:bg-gray-800 p-4 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm hover:shadow-md transition-shadow duration-300
                         {{ $demam_lebih_dari_2_minggu ? 'ring-2 ring-red-200 dark:ring-red-800' : 'ring-2 ring-green-200 dark:ring-green-800' }}">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <div
                                        class="w-8 h-8 rounded-full flex items-center justify-center mr-3
                                    {{ $demam_lebih_dari_2_minggu ? 'bg-red-100 text-red-600 dark:bg-red-900 dark:text-red-300' : 'bg-green-100 text-green-600 dark:bg-green-900 dark:text-green-300' }}">
                                        <i class="fas fa-temperature-high"></i>
                                    </div>
                                    <span class="text-sm font-medium text-gray-800 dark:text-white">Demam > 2
                                        minggu</span>
                                </div>
                                <span
                                    class="px-3 py-1 rounded-full text-xs font-bold
                                {{ $demam_lebih_dari_2_minggu ? 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300' : 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300' }}">
                                    {{ $demam_lebih_dari_2_minggu ? 'Ya' : 'Tidak' }}
                                </span>
                            </div>
                        </div>

                        <div
                            class="bg-white dark:bg-gray-800 p-4 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm hover:shadow-md transition-shadow duration-300
                         {{ $berat_badan_turun_tanpa_sebab_jelas ? 'ring-2 ring-red-200 dark:ring-red-800' : 'ring-2 ring-green-200 dark:ring-green-800' }}">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <div
                                        class="w-8 h-8 rounded-full flex items-center justify-center mr-3
                                    {{ $berat_badan_turun_tanpa_sebab_jelas ? 'bg-red-100 text-red-600 dark:bg-red-900 dark:text-red-300' : 'bg-green-100 text-green-600 dark:bg-green-900 dark:text-green-300' }}">
                                        <i class="fas fa-weight"></i>
                                    </div>
                                    <span class="text-sm font-medium text-gray-800 dark:text-white">Berat badan
                                        turun</span>
                                </div>
                                <span
                                    class="px-3 py-1 rounded-full text-xs font-bold
                                {{ $berat_badan_turun_tanpa_sebab_jelas ? 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300' : 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300' }}">
                                    {{ $berat_badan_turun_tanpa_sebab_jelas ? 'Ya' : 'Tidak' }}
                                </span>
                            </div>
                        </div>

                        <div
                            class="bg-white dark:bg-gray-800 p-4 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm hover:shadow-md transition-shadow duration-300
                         {{ $kontak_dengan_orang_terinfeksi_tbc ? 'ring-2 ring-red-200 dark:ring-red-800' : 'ring-2 ring-green-200 dark:ring-green-800' }}">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <div
                                        class="w-8 h-8 rounded-full flex items-center justify-center mr-3
                                    {{ $kontak_dengan_orang_terinfeksi_tbc ? 'bg-red-100 text-red-600 dark:bg-red-900 dark:text-red-300' : 'bg-green-100 text-green-600 dark:bg-green-900 dark:text-green-300' }}">
                                        <i class="fas fa-people-arrows"></i>
                                    </div>
                                    <span class="text-sm font-medium text-gray-800 dark:text-white">Kontak dengan
                                        penderita TBC</span>
                                </div>
                                <span
                                    class="px-3 py-1 rounded-full text-xs font-bold
                                {{ $kontak_dengan_orang_terinfeksi_tbc ? 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300' : 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300' }}">
                                    {{ $kontak_dengan_orang_terinfeksi_tbc ? 'Ya' : 'Tidak' }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Informasi Tambahan -->
                <div
                    class="bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-blue-900/20 dark:to-indigo-900/20 p-5 rounded-2xl border border-blue-200 dark:border-blue-700">
                    <div class="flex items-start">
                        <div
                            class="w-10 h-10 rounded-full bg-blue-100 dark:bg-blue-800 flex items-center justify-center mr-4 flex-shrink-0">
                            <i class="fas fa-info-circle text-blue-600 dark:text-blue-300"></i>
                        </div>
                        <div>
                            <h4 class="text-sm font-semibold text-gray-800 dark:text-white mb-2">
                                Rekomendasi Tindakan
                            </h4>
                            <p class="text-xs text-gray-600 dark:text-gray-300 leading-relaxed">
                                @if (
                                    $batuk_terus_menerus +
                                        $demam_lebih_dari_2_minggu +
                                        $berat_badan_turun_tanpa_sebab_jelas +
                                        $kontak_dengan_orang_terinfeksi_tbc >=
                                        2)
                                    🚨 <strong>Segera konsultasi ke dokter!</strong> Ditemukan
                                    {{ $batuk_terus_menerus + $demam_lebih_dari_2_minggu + $berat_badan_turun_tanpa_sebab_jelas + $kontak_dengan_orang_terinfeksi_tbc }}
                                    gejala yang mengindikasikan kemungkinan TBC.
                                @elseif (
                                    $batuk_terus_menerus +
                                        $demam_lebih_dari_2_minggu +
                                        $berat_badan_turun_tanpa_sebab_jelas +
                                        $kontak_dengan_orang_terinfeksi_tbc ==
                                        1)
                                    🔍 <strong>Perlu pemantauan.</strong> Terdapat 1 gejala, observasi perkembangan
                                    kondisi.
                                @else
                                    ✅ <strong>Tidak ada tindakan khusus.</strong> Tidak terdeteksi gejala TBC, tetap
                                    jaga kesehatan.
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </flux:modal>
</div>
