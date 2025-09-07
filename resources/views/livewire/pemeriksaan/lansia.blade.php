<div class="">
    <!-- Header Section -->
    <flux:legend>Pemeriksaan Lansia</flux:legend>
    <flux:description>Manajemen data pemeriksaan kesehatan Lansia</flux:description>

    <div class="flex justify-between items-end mb-2 mt-5">
        <div class="flex gap-2">
            <flux:input type="text" icon="magnifying-glass" wire:model.live="search" placeholder="Cari Pemeriksaan..."
                class="w-full" size="xs" clearable />
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
        <div class="flex gap-4">
            <flux:button wire:click='exportPdf' icon="pdf" size="xs" class="shadow-sm">Export</flux:button>
            <flux:modal.trigger name="choose-pasien" class="mb-2">
                <div class="flex gap-2">
                    <flux:button icon="plus-circle" size="xs" class="shadow-sm">Tambah</flux:button>
                </div>
            </flux:modal.trigger>
        </div>
    </div>


    <!-- Tabel -->
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
                    <th class="px-2 py-2 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                @forelse($pemeriksaans as $no => $pemeriksaan)
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-800">
                        <td class="px-2 py-2">{{ $pemeriksaans->firstItem() + $no }}</td>
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
                        <td class="px-2 py-2">
                            <flux:dropdown position="bottom" align="start">
                                <button
                                    class="text-gray-950 bg-blue-100 hover:bg-blue-200 dark:text-white dark:bg-gray-800 dark:hover:bg-gray-700 focus:outline-none px-3 py-1 rounded">
                                    &#8942;
                                </button>
                                <flux:menu class="w-10">
                                    <div class="flex flex-col space-y-1">

                                        <flux:button wire:click="edit({{ $pemeriksaan->id_lansia_pemeriksaan }})"
                                            size="xs" icon="pencil" class="!text-[0.65rem]">
                                            Edit
                                        </flux:button>
                                        <flux:button
                                            wire:click="confirmDelete({{ $pemeriksaan->id_lansia_pemeriksaan }})"
                                            size="xs" icon="trash" class="!text-[0.65rem]">
                                            Hapus
                                        </flux:button>
                                        <flux:button
                                            wire:click="openModalTbc({{ $pemeriksaan->id_lansia_pemeriksaan }})"
                                            size="xs" icon="information-circle" class="!text-[0.65rem]">
                                            Skrining Tbc
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
        @if ($pemeriksaans->hasPages())
            <div class="px-2 py-2 border-t">{{ $pemeriksaans->links() }}</div>
        @endif
    </div>

    <!-- Modal untuk Tambah Pemeriksaan -->
    <flux:modal name="pemeriksaan-modal" class="min-w-5xl">
        <!-- Header dengan informasi bumil -->
        <div class="flex flex-col pb-4">
            <span>
                <flux:legend>Pemeriksaan Ibu Hamil</flux:legend>
                <flux:description>Manajemen data pemeriksaan kesehatan ibu hamil</flux:description>
            </span>

            @if ($choosenLansia)
                <span class="flex items-center gap-3 mt-4">
                    <flux:avatar name="{{ $choosenLansia->name ?? '' }}" color="auto" size="xl" />
                    <span class="leading-tight">
                        <span class="font-medium text-gray-900 dark:text-white">{{ $choosenLansia->name ?? '' }}</span>
                        <br />
                        <span class="text-sm text-gray-500 dark:text-gray-400">NIK:
                            {{ $choosenLansia->nik ?? '' }}</span>
                        <br />
                        <span
                            class="text-sm text-gray-500 dark:text-gray-400">{{ $choosenLansia->alamat ?? '' }}</span>
                    </span>
                </span>
            @endif
        </div>
        <form wire:submit.prevent="save" class="space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <flux:input wire:model="bb" label="Berat Badan (Kg)" type="number" />
                <flux:input wire:model="tb" label="Tinggi Badan (cm)" type="number" />
                <flux:input wire:model="imt" label="Indeks Massa Tubuh" type="text" />
                <flux:input wire:model="lingkar_perut" label="Lingkar Perut (cm)" type="number" />
                <flux:input wire:model="tekanan_darah" label="Tekanan Darah" type="text" />
                <flux:input wire:model="gula_darah" label="Gula Darah" type="number" />
                <flux:input wire:model="usia" label="Usia" type="number" />
                <flux:select wire:model="menggunakan_alat_kontrasepsi" label="Menggunakan Alat Kontrasepsi">
                    <flux:select.option value="">Pilih</flux:select.option>
                    <flux:select.option value="0">Tidak</flux:select.option>
                    <flux:select.option value="1">Ya</flux:select.option>
                </flux:select>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                <!-- Tes Hitung Jari Tangan -->
                <div class="space-y-4 bg-gray-50 dark:bg-zinc-800 p-4 rounded-lg">
                    <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-300 border-b pb-2">Tes Hitung Jari
                        Tangan</h2>
                    <flux:select size="sm" wire:model="mata_kanan" :invalid="$errors->has('mata_kanan')"
                        label="Mata Kanan">
                        <flux:select.option value="">Pilih</flux:select.option>
                        <flux:select.option value="Normal">Normal</flux:select.option>
                        <flux:select.option value="Gangguan">Gangguan</flux:select.option>
                    </flux:select>
                    <flux:select size="sm" wire:model="mata_kiri" :invalid="$errors->has('mata_kiri')"
                        label="Mata Kiri">
                        <flux:select.option value="">Pilih</flux:select.option>
                        <flux:select.option value="Normal">Normal</flux:select.option>
                        <flux:select.option value="Gangguan">Gangguan</flux:select.option>
                    </flux:select>
                </div>

                <!-- Tes Berbisik -->
                <div class="space-y-4 bg-gray-50 dark:bg-zinc-800 p-4 rounded-lg">
                    <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-300 border-b pb-2">Tes Berbisik</h2>
                    <flux:select size="sm" wire:model="telinga_kanan" :invalid="$errors->has('telinga_kanan')"
                        label="Telingan Kanan">
                        <flux:select.option value="">Pilih</flux:select.option>
                        <flux:select.option value="Normal">Normal</flux:select.option>
                        <flux:select.option value="Gangguan">Gangguan</flux:select.option>
                    </flux:select>
                    <flux:select size="sm" wire:model="telinga_kiri" :invalid="$errors->has('telinga_kiri')"
                        label="Telingan Kiri">
                        <flux:select.option value="">Pilih</flux:select.option>
                        <flux:select.option value="Normal">Normal</flux:select.option>
                        <flux:select.option value="Gangguan">Gangguan</flux:select.option>
                    </flux:select>
                </div>
            </div>

            <!-- Skrining TBC -->
            <div class="bg-gray-50 dark:bg-zinc-800 p-4 rounded-lg mt-4">
                <h3 class="font-semibold mb-3">Skrining TBC</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                    <flux:checkbox wire:model="batuk_terus_menerus" label="Batuk ≥ 2 minggu" />
                    <flux:checkbox wire:model="demam_lebih_dari_2_minggu" label="Demam ≥ 2 minggu" />
                    <flux:checkbox wire:model="berat_badan_turun_tanpa_sebab_jelas"
                        label="BB turun tanpa sebab jelas" />
                    <flux:checkbox wire:model="kontak_dengan_orang_terinfeksi_tbc"
                        label="Kontak dengan penderita TBC" />
                </div>
            </div>

            <!-- Diagnosa dan Keterangan -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-4">
                <div class="space-y-2">
                    <flux:textarea :invalid="$errors->has('diagnosa')" wire:model="diagnosa" label="Diagnosa"
                        size="sm" />
                </div>
                <div class="space-y-2">
                    <flux:input :invalid="$errors->has('keterangan')" wire:model="keterangan" label="Keterangan"
                        size="sm" />
                </div>
            </div>

            <!-- Actions -->
            <div class="flex justify-end gap-2 pt-4 border-t dark:border-gray-700 mt-6">
                <flux:button type="button" variant="outline" onclick="Flux.modal('pemeriksaan-modal').close()">Batal
                </flux:button>
                <flux:button type="submit" variant="primary">Simpan</flux:button>
            </div>
        </form>
    </flux:modal>

    <!-- Modal untuk Update Pemeriksaan -->
    <flux:modal name="pemeriksaan-update" class="min-w-5xl">
        <!-- Header dengan informasi bumil -->
        <div class="flex flex-col pb-4">
            <span>
                <flux:legend>Pemeriksaan Ibu Hamil</flux:legend>
                <flux:description>Manajemen data pemeriksaan kesehatan ibu hamil</flux:description>
            </span>

            @if ($choosenLansia)
                <span class="flex items-center gap-3 mt-4">
                    <flux:avatar name="{{ $choosenLansia->name ?? '' }}" color="auto" size="xl" />
                    <span class="leading-tight">
                        <span
                            class="font-medium text-gray-900 dark:text-white">{{ $choosenLansia->name ?? '' }}</span>
                        <br />
                        <span class="text-sm text-gray-500 dark:text-gray-400">NIK:
                            {{ $choosenLansia->nik ?? '' }}</span>
                        <br />
                        <span
                            class="text-sm text-gray-500 dark:text-gray-400">{{ $choosenLansia->alamat ?? '' }}</span>
                    </span>
                </span>
            @endif
        </div>
        <form wire:submit.prevent="update" class="space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <flux:input wire:model="bb" label="Berat Badan (Kg)" type="number" />
                <flux:input wire:model="tb" label="Tinggi Badan (cm)" type="number" />
                <flux:input wire:model="imt" label="Indeks Massa Tubuh" type="text" />
                <flux:input wire:model="lingkar_perut" label="Lingkar Perut (cm)" type="number" />
                <flux:input wire:model="tekanan_darah" label="Tekanan Darah" type="text" />
                <flux:input wire:model="gula_darah" label="Gula Darah" type="number" />
                <flux:input wire:model="usia" label="Usia" type="number" />
                <flux:select wire:model="menggunakan_alat_kontrasepsi" label="Menggunakan Alat Kontrasepsi">
                    <flux:select.option value="">Pilih</flux:select.option>
                    <flux:select.option value="0">Tidak</flux:select.option>
                    <flux:select.option value="1">Ya</flux:select.option>
                </flux:select>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                <!-- Tes Hitung Jari Tangan -->
                <div class="space-y-4 bg-gray-50 dark:bg-zinc-800 p-4 rounded-lg">
                    <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-300 border-b pb-2">Tes Hitung Jari
                        Tangan</h2>
                    <flux:select size="sm" wire:model="mata_kanan" :invalid="$errors->has('mata_kanan')"
                        label="Mata Kanan">
                        <flux:select.option value="">Pilih</flux:select.option>
                        <flux:select.option value="Normal">Normal</flux:select.option>
                        <flux:select.option value="Gangguan">Gangguan</flux:select.option>
                    </flux:select>
                    <flux:select size="sm" wire:model="mata_kiri" :invalid="$errors->has('mata_kiri')"
                        label="Mata Kiri">
                        <flux:select.option value="">Pilih</flux:select.option>
                        <flux:select.option value="Normal">Normal</flux:select.option>
                        <flux:select.option value="Gangguan">Gangguan</flux:select.option>
                    </flux:select>
                </div>

                <!-- Tes Berbisik -->
                <div class="space-y-4 bg-gray-50 dark:bg-zinc-800 p-4 rounded-lg">
                    <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-300 border-b pb-2">Tes Berbisik</h2>
                    <flux:select size="sm" wire:model="telinga_kanan" :invalid="$errors->has('telinga_kanan')"
                        label="Telingan Kanan">
                        <flux:select.option value="">Pilih</flux:select.option>
                        <flux:select.option value="Normal">Normal</flux:select.option>
                        <flux:select.option value="Gangguan">Gangguan</flux:select.option>
                    </flux:select>
                    <flux:select size="sm" wire:model="telinga_kiri" :invalid="$errors->has('telinga_kiri')"
                        label="Telingan Kiri">
                        <flux:select.option value="">Pilih</flux:select.option>
                        <flux:select.option value="Normal">Normal</flux:select.option>
                        <flux:select.option value="Gangguan">Gangguan</flux:select.option>
                    </flux:select>
                </div>
            </div>

            <!-- Skrining TBC -->
            <div class="bg-gray-50 dark:bg-zinc-800 p-4 rounded-lg mt-4">
                <h3 class="font-semibold mb-3">Skrining TBC</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                    <flux:checkbox wire:model="batuk_terus_menerus" label="Batuk ≥ 2 minggu" />
                    <flux:checkbox wire:model="demam_lebih_dari_2_minggu" label="Demam ≥ 2 minggu" />
                    <flux:checkbox wire:model="berat_badan_turun_tanpa_sebab_jelas"
                        label="BB turun tanpa sebab jelas" />
                    <flux:checkbox wire:model="kontak_dengan_orang_terinfeksi_tbc"
                        label="Kontak dengan penderita TBC" />
                </div>
            </div>

            <!-- Diagnosa dan Keterangan -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-4">
                <div class="space-y-2">
                    <flux:textarea :invalid="$errors->has('diagnosa')" wire:model="diagnosa" label="Diagnosa"
                        size="sm" />
                </div>
                <div class="space-y-2">
                    <flux:input :invalid="$errors->has('keterangan')" wire:model="keterangan" label="Keterangan"
                        size="sm" />
                </div>
            </div>

            <!-- Actions -->
            <div class="flex justify-end gap-2 pt-4 border-t dark:border-gray-700 mt-6">
                <flux:button type="button" variant="outline" onclick="Flux.modal('pemeriksaan-modal').close()">Batal
                </flux:button>
                <flux:button type="submit" variant="primary">Simpan</flux:button>
            </div>
        </form>
    </flux:modal>

    {{-- Modal Pilih Pasien --}}
    <flux:modal name="choose-pasien" class="w-lg">
        {{-- Sticky Search Input --}}
        <div class="sticky top-0 z-40 bg-white dark:bg-zinc-800 px-4 pt-4 pb-2">
            <flux:input type="text" variant="filled" icon="magnifying-glass" wire:model.live="searchLansia"
                placeholder="Cari Lansia..." class="w-full" size="md" clearable />
        </div>

        {{-- Scrollable Results --}}
        <div class="h-[50vh] overflow-y-auto px-4 pb-4" id="container-dpl-results">
            <div class="text-xs space-y-2">
                {{-- Loading --}}
                @if ($searchLansia && $searchLansiaResults === null)
                    @foreach ([1, 2, 3] as $i)
                        <div class="animate-pulse grid grid-cols-3 gap-2 w-full px-4 py-3 rounded-md">
                            <div class="h-5 bg-gray-200 dark:bg-zinc-700 rounded col-span-1">
                            </div>
                            <div class="h-5 bg-gray-200 dark:bg-zinc-700 rounded col-span-2">
                            </div>
                        </div>
                    @endforeach

                    {{-- Results --}}
                @elseif($searchLansia && $searchLansiaResults->isNotEmpty())
                    @foreach ($searchLansiaResults as $lansia)
                        <button wire:click="chooseLansia({{ $lansia->id_user }})"
                            class="grid grid-cols-4 cursor-pointer rounded-md dark:text-zinc-400 gap-2 text-zinc-500 w-full text-left px-4 py-3 bg-gray-100 dark:bg-zinc-900 hover:scale-[1.02] hover:bg-blue-200 dark:hover:bg-zinc-700 hover:shadow-md border-l-2 border-transparent hover:border-blue-400 dark:hover:border-zinc-600">
                            <span class="font-medium dark:text-white text-zinc-800">{{ $lansia->nik }}</span>
                            <span class="col-span-2">{{ $lansia->name }}</span>
                            <span class="text-end">{{ $lansia->jenis_kelamin }}</span>
                    @endforeach

                    {{-- No Results --}}
                @elseif($searchLansia)
                    <div class="py-4 text-center">
                        <p class="text-sm text-gray-500 dark:text-zinc-400">
                            🔍 Tidak ditemukan Lansia</p>
                    </div>

                    {{-- Optional default state --}}
                @elseif($this->lansiaList)
                    @foreach ($this->lansiaList as $result)
                        <button wire:click="chooseLansia({{ $result->id_user }})"
                            class="grid grid-cols-4 cursor-pointer rounded-md dark:text-zinc-400 gap-2 text-zinc-500 w-full text-left px-4 py-3 bg-gray-100 dark:bg-zinc-900 hover:scale-[1.02] hover:bg-blue-200 dark:hover:bg-zinc-700 hover:shadow-md border-l-2 border-transparent hover:border-blue-400 dark:hover:border-zinc-600">
                            <span class="font-medium dark:text-white text-zinc-800">{{ $result->nik }}</span>
                            <span class="col-span-2">{{ $result->name }}</span>
                            <span class="text-end">{{ $result->jenis_kelamin }}</span>
                        </button>
                    @endforeach
                @else
                    <div class="py-4 text-center">
                        <p class="text-sm text-gray-500 dark:text-zinc-400">
                            👋 Masukkan nama/NIK Lansia</p>
                    </div>
                @endif
            </div>
        </div>
    </flux:modal>

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
