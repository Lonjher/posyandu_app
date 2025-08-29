<div class="">
    <!-- Header Section -->
    <flux:legend>Pemeriksaan Anak</flux:legend>
    <flux:description>Manajemen data pemeriksaan kesehatan Anak</flux:description>

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
        <flux:modal.trigger name="choose-pasien" class="mb-2">
            <div class="flex gap-2">
                <flux:button icon="plus-circle" size="xs" class="shadow-sm">Tambah</flux:button>
            </div>
        </flux:modal.trigger>
    </div>


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
                    <th class="px-2 py-2 text-left">Imun.</th>
                    <th class="px-2 py-2 text-left">Vit. A</th>
                    <th class="px-2 py-2 text-left">Ob. Cacing</th>
                    <th class="px-2 py-2 text-left">MT. Pgn</th>
                    <th class="px-2 py-2 text-left">Gejala</th>
                    <th class="px-2 py-2 text-left">Diagnosa</th>
                    <th class="px-2 py-2 text-left">Tgl</th>
                    <th class="px-2 py-2 text-left">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                @if ($pemeriksaans && count($pemeriksaans) > 0)
                    @foreach ($pemeriksaans as $no => $pemeriksaan)
                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-800 text-gray-800 dark:text-gray-200">
                            <td class="px-2 py-2">{{ $pemeriksaans->firstItem() + $no }}</td>
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
                            <td class="px-2 py-1.5 whitespace-nowrap">
                                <flux:dropdown position="bottom" align="start">
                                    <button
                                        class="text-gray-950 bg-blue-100 hover:bg-blue-200 dark:text-white dark:bg-gray-800 dark:hover:bg-gray-700 focus:outline-none px-3 py-1 rounded">
                                        &#8942;
                                    </button>
                                    <flux:menu class="w-10">
                                        <div class="flex flex-col space-y-1">

                                            <flux:button wire:click="edit({{ $pemeriksaan->id_anak_pemeriksaan }})"
                                                size="xs" icon="pencil" class="!text-[0.65rem]">
                                                Edit
                                            </flux:button>
                                            <flux:button
                                                wire:click="confirmDelete({{ $pemeriksaan->id_anak_pemeriksaan }})"
                                                size="xs" icon="trash" class="!text-[0.65rem]">
                                                Hapus
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
        @if ($pemeriksaans && $pemeriksaans->hasPages())
            <div class="px-2 py-1.5 border-t dark:border-gray-700">
                {{ $pemeriksaans->links('vendor.pagination.tailwind') }}
            </div>
        @endif
    </div>

    <!-- Modal untuk Tambah Pemeriksaan -->
    <flux:modal name="pemeriksaan-modal" class="min-w-5xl">
        <div class="mx-auto rounded-lg shadow-md overflow-hidden p-3">
            <!-- Header dengan informasi anak -->
            <div class="flex flex-col pb-4">
                <span>
                    <flux:legend> {{ $isEdit ? 'Update' : '' }} Pemeriksaan Ibu Hamil</flux:legend>
                    <flux:description>Manajemen data pemeriksaan kesehatan ibu hamil</flux:description>
                </span>

                @if ($choosenAnak)
                    <span class="flex items-center gap-3 mt-4">
                        <flux:avatar name="{{ $choosenAnak->name ?? '' }}" color="auto" size="xl" />
                        <span class="leading-tight">
                            <span
                                class="font-medium text-gray-900 dark:text-white">{{ $choosenAnak->name ?? '' }}</span>
                            <br />
                            <span class="text-sm text-gray-500 dark:text-gray-400">NIK:
                                {{ $choosenAnak->nik ?? '' }}</span>
                            <br />
                            <span
                                class="text-sm text-gray-500 dark:text-gray-400">{{ $choosenAnak->alamat ?? '' }}</span>
                        </span>
                    </span>
                @endif
            </div>

            <!-- Form -->
            <form wire:submit.prevent="save" class="pb-6">
                <!-- Data Dasar Pemeriksaan Anak -->
                <div class="space-y-4">
                    <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-300 border-b pb-2">
                        Data Dasar Pemeriksaan Anak
                    </h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                        <flux:input type="number" :invalid="$errors->has('bb')" wire:model="bb"
                            label="Berat Badan (Kg)" size="sm" />

                        <flux:select size="sm" wire:model="kesimpulan_hasil_bb"
                            :invalid="$errors->has('kesimpulan_hasil_bb')" label="Kesimpulan Hasil Penimbangan BB">
                            <flux:select.option value="">Pilih Jadwal</flux:select.option>
                            <flux:select.option value="Naik">Naik</flux:select.option>
                            <flux:select.option value="Tidak Naik">Tidak Naik</flux:select.option>
                            <flux:select.option value="Bawah Garis Merah">Bawah Garis Merah</flux:select.option>
                            <flux:select.option value="Bawah Garis Oranye">Atas Garis Oranye</flux:select.option>
                        </flux:select>

                        <flux:select size="sm" wire:model="kesimpulan_hasil_pengukuran_bb"
                            :invalid="$errors->has('kesimpulan_hasil_pengukuran_bb')"
                            label="Kesimpulan Hasil Pengukuran BB">
                            <flux:select.option value="">Pilih Jadwal</flux:select.option>
                            <flux:select.option value="Gizi Buruk">Gizi Buruk</flux:select.option>
                            <flux:select.option value="Gizi Kurang">Gizi Kurang</flux:select.option>
                            <flux:select.option value="Gizi Baik">Gizi Baik</flux:select.option>
                            <flux:select.option value="Berisiko Gizi Lebih">Berisiko Gizi Lebih</flux:select.option>
                            <flux:select.option value="Gizi Lebih">Gizi Lebih</flux:select.option>
                            <flux:select.option value="Obesitas">Obesitas</flux:select.option>
                        </flux:select>

                        <flux:input type="number" :invalid="$errors->has('tb')" wire:model="tb"
                            label="Tinggi Badan (cm)" size="sm" />

                        <flux:select size="sm" wire:model="kesimpulan_hasil_tb"
                            :invalid="$errors->has('kesimpulan_hasil_tb')" label="Kesimpulan Hasil Pengukuran TB">
                            <flux:select.option value="">Pilih Jadwal</flux:select.option>
                            <flux:select.option value="Sangat Pendek dan Pendek">Sangat Pendek dan Pendek
                            </flux:select.option>
                            <flux:select.option value="Normal">Normal</flux:select.option>
                            <flux:select.option value="Tinggi Melebihi Normal">Tinggi Melebihi Normal
                            </flux:select.option>
                        </flux:select>

                        <flux:select size="sm" wire:model="kesimpulan_hasil_pengukuran_imt"
                            :invalid="$errors->has('kesimpulan_hasil_pengukuran_imt')"
                            label="Kesimpulan Hasil Pengukuran IMT">
                            <flux:select.option value="">Pilih Jadwal</flux:select.option>
                            <flux:select.option value="Gizi Buruk">Gizi Buruk</flux:select.option>
                            <flux:select.option value="Gizi Kurang">Gizi Kurang</flux:select.option>
                            <flux:select.option value="Gizi Baik">Gizi Baik</flux:select.option>
                            <flux:select.option value="Berisiko Gizi Lebih">Berisiko Gizi Lebih</flux:select.option>
                            <flux:select.option value="Gizi Lebih">Gizi Lebih</flux:select.option>
                            <flux:select.option value="Obesitas">Obesitas</flux:select.option>
                        </flux:select>

                        <flux:input type="number" :invalid="$errors->has('lingkar_kepala')"
                            wire:model="lingkar_kepala" label="Lingkar Kepala (cm)" size="sm" />

                        <flux:select size="sm" wire:model="kesimpulan_lk"
                            :invalid="$errors->has('kesimpulan_lk')" label="Kesimpulan Hasil Pengukuran LK">
                            <flux:select.option value="">Pilih Jadwal</flux:select.option>
                            <flux:select.option value="Melebihi Normal">Melebihi Normal</flux:select.option>
                            <flux:select.option value="Normal">Normal</flux:select.option>
                            <flux:select.option value="Kurang dari Normal">Kurang dari Normal</flux:select.option>
                        </flux:select>

                        <flux:input type="number" :invalid="$errors->has('lingkar_lengan_atas')"
                            wire:model="lingkar_lengan_atas" label="Lingkar Lengan Atas (cm)" size="sm" />

                        <flux:select size="sm" wire:model="kesimpulan_lla"
                            :invalid="$errors->has('kesimpulan_lla')" label="Kesimpulan Hasil Lila">
                            <flux:select.option value="">Pilih</flux:select.option>
                            <flux:select.option value="H">H</flux:select.option>
                            <flux:select.option value="M">M</flux:select.option>
                        </flux:select>
                    </div>
                </div>

                <!-- Skrining TBC -->
                <div class="space-y-4 mt-6">
                    <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-300 border-b pb-2">Skrining TBC</h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <flux:field variant="inline">
                            <flux:checkbox wire:model="batuk_terus_menerus" />
                            <flux:label>Batuk terus menerus ≥ 2 minggu</flux:label>
                        </flux:field>

                        <flux:field variant="inline">
                            <flux:checkbox wire:model="demam_lebih_dari_2_minggu" />
                            <flux:label>Demam ≥ 2 minggu tanpa sebab jelas</flux:label>
                        </flux:field>

                        <flux:field variant="inline">
                            <flux:checkbox wire:model="berat_badan_turun_tanpa_sebab_jelas" />
                            <flux:label>Berat badan turun tanpa sebab jelas</flux:label>
                        </flux:field>

                        <flux:field variant="inline">
                            <flux:checkbox wire:model="kontak_dengan_orang_terinfeksi_tbc" />
                            <flux:label>Kontak dengan orang terinfeksi TBC</flux:label>
                        </flux:field>
                    </div>
                </div>

                <!-- Bayi atau Balita Mendapatkan -->
                <div class="space-y-4 mt-6">
                    <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-300 border-b pb-2">Bayi atau Belita
                        Mendapatkan</h2>
                    <div class="grid grid-flow-col grid-rows-4 gap-4">
                        <!-- Asi Ekslusif -->
                        <div class="space-y-4 bg-gray-50 dark:bg-zinc-800/30 rounded-lg">
                            <flux:select size="sm" wire:model="asi_ekslusif"
                                :invalid="$errors->has('asi_ekslusif')" label="Asi Eksklusif">
                                <flux:select.option value="">Pilih</flux:select.option>
                                <flux:select.option value="Y">Ya</flux:select.option>
                                <flux:select.option value="T">Tidak</flux:select.option>
                            </flux:select>
                        </div>

                        <!-- MP Asi -->
                        <div class="space-y-4 bg-gray-50 dark:bg-zinc-800/30 rounded-lg">
                            <flux:select size="sm" wire:model="mp_asi" :invalid="$errors->has('mp_asi')"
                                label="MP Asi">
                                <flux:select.option value="">Pilih</flux:select.option>
                                <flux:select.option value="Y">Ya</flux:select.option>
                                <flux:select.option value="T">Tidak</flux:select.option>
                            </flux:select>
                        </div>

                        <!-- Imunisasi -->
                        <div class="space-y-4 bg-gray-50 dark:bg-zinc-800/30 rounded-lg">
                            <flux:select size="sm" wire:model="imunisasi" :invalid="$errors->has('imunisasi')"
                                label="Imunisasi">
                                <flux:select.option value="">Pilih</flux:select.option>
                                <flux:select.option value="Y">Ya</flux:select.option>
                                <flux:select.option value="T">Tidak</flux:select.option>
                            </flux:select>
                        </div>

                        <!-- Imunisasi -->
                        <div class="space-y-4 bg-gray-50 dark:bg-zinc-800/30 rounded-lg">
                            <flux:select size="sm" wire:model="vitamin_a" :invalid="$errors->has('vitamin_a')"
                                label="Vitamin A">
                                <flux:select.option value="">Pilih</flux:select.option>
                                <flux:select.option value="Y">Ya</flux:select.option>
                                <flux:select.option value="T">Tidak</flux:select.option>
                            </flux:select>
                        </div>

                        <!-- Imunisasi -->
                        <div class="space-y-4 bg-gray-50 dark:bg-zinc-800/30 rounded-lg">
                            <flux:select size="sm" wire:model="obat_cacing"
                                :invalid="$errors->has('obat_cacing')" label="Obat Cacing">
                                <flux:select.option value="">Pilih</flux:select.option>
                                <flux:select.option value="Y">Ya</flux:select.option>
                                <flux:select.option value="T">Tidak</flux:select.option>
                            </flux:select>
                        </div>

                        <!-- Imunisasi -->
                        <div class="space-y-4 bg-gray-50 dark:bg-zinc-800/30 rounded-lg">
                            <flux:select size="sm" wire:model="mt_pangan_lokal"
                                :invalid="$errors->has('mt_pangan_lokal')" label="MT Pangan Lokal">
                                <flux:select.option value="">Pilih</flux:select.option>
                                <flux:select.option value="Y">Ya</flux:select.option>
                                <flux:select.option value="T">Tidak</flux:select.option>
                            </flux:select>
                        </div>

                        <!-- Imunisasi -->
                        <div class="space-y-4 bg-gray-50 dark:bg-zinc-800/30 rounded-lg">
                            <flux:select size="sm" wire:model="gejala_sakit"
                                :invalid="$errors->has('gejala_sakit')" label="Gejala Sakit">
                                <flux:select.option value="">Pilih</flux:select.option>
                                <flux:select.option value="Y">Ya</flux:select.option>
                                <flux:select.option value="T">Tidak</flux:select.option>
                            </flux:select>
                        </div>
                    </div>
                </div>

                <!-- Diagnosa -->
                <div class="space-y-4 mt-6">
                    <flux:textarea :invalid="$errors->has('diagnosa')" wire:model="diagnosa" label="Diagnosa"
                        size="sm" />
                </div>

                <!-- Keterangan -->
                <div class="space-y-4 mt-6">
                    <flux:input :invalid="$errors->has('keterangan')" wire:model="keterangan" label="Keterangan"
                        size="sm" />
                </div>

                <!-- Actions -->
                <div class="flex justify-end space-x-3 pt-6 mt-6 border-t dark:border-gray-700">
                    <flux:button type="button" variant="outline" onclick="Flux.modal('pemeriksaan-modal').close()">
                        Batal
                    </flux:button>
                    <flux:button type="submit" variant="primary">
                        Simpan
                    </flux:button>
                </div>
            </form>
        </div>
    </flux:modal>

    <!-- Modal untuk Update Pemeriksaan -->
    <flux:modal name="pemeriksaan-update" class="min-w-5xl">
        <div class="mx-auto rounded-lg shadow-md overflow-hidden p-3">
            <!-- Header dengan informasi anak -->
            <div class="flex flex-col pb-4">
                <span>
                    <flux:legend> {{ $isEdit ? 'Update' : '' }} Pemeriksaan Ibu Hamil</flux:legend>
                    <flux:description>Manajemen data pemeriksaan kesehatan ibu hamil</flux:description>
                </span>

                @if ($choosenAnak)
                    <span class="flex items-center gap-3 mt-4">
                        <flux:avatar name="{{ $choosenAnak->name ?? '' }}" color="auto" size="xl" />
                        <span class="leading-tight">
                            <span
                                class="font-medium text-gray-900 dark:text-white">{{ $choosenAnak->name ?? '' }}</span>
                            <br />
                            <span class="text-sm text-gray-500 dark:text-gray-400">NIK:
                                {{ $choosenAnak->nik ?? '' }}</span>
                            <br />
                            <span
                                class="text-sm text-gray-500 dark:text-gray-400">{{ $choosenAnak->alamat ?? '' }}</span>
                        </span>
                    </span>
                @endif
            </div>

            <!-- Form -->
            <form wire:submit.prevent="update" class="pb-6">
                <!-- Data Dasar Pemeriksaan Anak -->
                <div class="space-y-4">
                    <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-300 border-b pb-2">
                        Data Dasar Pemeriksaan Anak
                    </h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                        <flux:input type="number" :invalid="$errors->has('bb')" wire:model="bb"
                            label="Berat Badan (Kg)" size="sm" />

                        <flux:select size="sm" wire:model="kesimpulan_hasil_bb"
                            :invalid="$errors->has('kesimpulan_hasil_bb')" label="Kesimpulan Hasil Penimbangan BB">
                            <flux:select.option value="">Pilih Jadwal</flux:select.option>
                            <flux:select.option value="Naik">Naik</flux:select.option>
                            <flux:select.option value="Tidak Naik">Tidak Naik</flux:select.option>
                            <flux:select.option value="Bawah Garis Merah">Bawah Garis Merah</flux:select.option>
                            <flux:select.option value="Bawah Garis Oranye">Atas Garis Oranye</flux:select.option>
                        </flux:select>

                        <flux:select size="sm" wire:model="kesimpulan_hasil_pengukuran_bb"
                            :invalid="$errors->has('kesimpulan_hasil_pengukuran_bb')"
                            label="Kesimpulan Hasil Pengukuran BB">
                            <flux:select.option value="">Pilih Jadwal</flux:select.option>
                            <flux:select.option value="Gizi Buruk">Gizi Buruk</flux:select.option>
                            <flux:select.option value="Gizi Kurang">Gizi Kurang</flux:select.option>
                            <flux:select.option value="Gizi Baik">Gizi Baik</flux:select.option>
                            <flux:select.option value="Berisiko Gizi Lebih">Berisiko Gizi Lebih</flux:select.option>
                            <flux:select.option value="Gizi Lebih">Gizi Lebih</flux:select.option>
                            <flux:select.option value="Obesitas">Obesitas</flux:select.option>
                        </flux:select>

                        <flux:input type="number" :invalid="$errors->has('tb')" wire:model="tb"
                            label="Tinggi Badan (cm)" size="sm" />

                        <flux:select size="sm" wire:model="kesimpulan_hasil_tb"
                            :invalid="$errors->has('kesimpulan_hasil_tb')" label="Kesimpulan Hasil Pengukuran TB">
                            <flux:select.option value="">Pilih Jadwal</flux:select.option>
                            <flux:select.option value="Sangat Pendek dan Pendek">Sangat Pendek dan Pendek
                            </flux:select.option>
                            <flux:select.option value="Normal">Normal</flux:select.option>
                            <flux:select.option value="Tinggi Melebihi Normal">Tinggi Melebihi Normal
                            </flux:select.option>
                        </flux:select>

                        <flux:select size="sm" wire:model="kesimpulan_hasil_pengukuran_imt"
                            :invalid="$errors->has('kesimpulan_hasil_pengukuran_imt')"
                            label="Kesimpulan Hasil Pengukuran IMT">
                            <flux:select.option value="">Pilih Jadwal</flux:select.option>
                            <flux:select.option value="Gizi Buruk">Gizi Buruk</flux:select.option>
                            <flux:select.option value="Gizi Kurang">Gizi Kurang</flux:select.option>
                            <flux:select.option value="Gizi Baik">Gizi Baik</flux:select.option>
                            <flux:select.option value="Berisiko Gizi Lebih">Berisiko Gizi Lebih</flux:select.option>
                            <flux:select.option value="Gizi Lebih">Gizi Lebih</flux:select.option>
                            <flux:select.option value="Obesitas">Obesitas</flux:select.option>
                        </flux:select>

                        <flux:input type="number" :invalid="$errors->has('lingkar_kepala')"
                            wire:model="lingkar_kepala" label="Lingkar Kepala (cm)" size="sm" />

                        <flux:select size="sm" wire:model="kesimpulan_lk"
                            :invalid="$errors->has('kesimpulan_lk')" label="Kesimpulan Hasil Pengukuran LK">
                            <flux:select.option value="">Pilih Jadwal</flux:select.option>
                            <flux:select.option value="Melebihi Normal">Melebihi Normal</flux:select.option>
                            <flux:select.option value="Normal">Normal</flux:select.option>
                            <flux:select.option value="Kurang dari Normal">Kurang dari Normal</flux:select.option>
                        </flux:select>

                        <flux:input type="number" :invalid="$errors->has('lingkar_lengan_atas')"
                            wire:model="lingkar_lengan_atas" label="Lingkar Lengan Atas (cm)" size="sm" />

                        <flux:select size="sm" wire:model="kesimpulan_lla"
                            :invalid="$errors->has('kesimpulan_lla')" label="Kesimpulan Hasil Lila">
                            <flux:select.option value="">Pilih</flux:select.option>
                            <flux:select.option value="H">H</flux:select.option>
                            <flux:select.option value="M">M</flux:select.option>
                        </flux:select>
                    </div>
                </div>

                <!-- Skrining TBC -->
                <div class="space-y-4 mt-6">
                    <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-300 border-b pb-2">Skrining TBC</h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <flux:field variant="inline">
                            <flux:checkbox wire:model="batuk_terus_menerus" />
                            <flux:label>Batuk terus menerus ≥ 2 minggu</flux:label>
                        </flux:field>

                        <flux:field variant="inline">
                            <flux:checkbox wire:model="demam_lebih_dari_2_minggu" />
                            <flux:label>Demam ≥ 2 minggu tanpa sebab jelas</flux:label>
                        </flux:field>

                        <flux:field variant="inline">
                            <flux:checkbox wire:model="berat_badan_turun_tanpa_sebab_jelas" />
                            <flux:label>Berat badan turun tanpa sebab jelas</flux:label>
                        </flux:field>

                        <flux:field variant="inline">
                            <flux:checkbox wire:model="kontak_dengan_orang_terinfeksi_tbc" />
                            <flux:label>Kontak dengan orang terinfeksi TBC</flux:label>
                        </flux:field>
                    </div>
                </div>

                <!-- Bayi atau Balita Mendapatkan -->
                <div class="space-y-4 mt-6">
                    <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-300 border-b pb-2">Bayi atau Belita
                        Mendapatkan</h2>
                    <div class="grid grid-flow-col grid-rows-4 gap-4">
                        <!-- Asi Ekslusif -->
                        <div class="space-y-4 bg-gray-50 dark:bg-zinc-800/30 rounded-lg">
                            <flux:select size="sm" wire:model="asi_ekslusif"
                                :invalid="$errors->has('asi_ekslusif')" label="Asi Eksklusif">
                                <flux:select.option value="">Pilih</flux:select.option>
                                <flux:select.option value="Y">Ya</flux:select.option>
                                <flux:select.option value="T">Tidak</flux:select.option>
                            </flux:select>
                        </div>

                        <!-- MP Asi -->
                        <div class="space-y-4 bg-gray-50 dark:bg-zinc-800/30 rounded-lg">
                            <flux:select size="sm" wire:model="mp_asi" :invalid="$errors->has('mp_asi')"
                                label="MP Asi">
                                <flux:select.option value="">Pilih</flux:select.option>
                                <flux:select.option value="Y">Ya</flux:select.option>
                                <flux:select.option value="T">Tidak</flux:select.option>
                            </flux:select>
                        </div>

                        <!-- Imunisasi -->
                        <div class="space-y-4 bg-gray-50 dark:bg-zinc-800/30 rounded-lg">
                            <flux:select size="sm" wire:model="imunisasi" :invalid="$errors->has('imunisasi')"
                                label="Imunisasi">
                                <flux:select.option value="">Pilih</flux:select.option>
                                <flux:select.option value="Y">Ya</flux:select.option>
                                <flux:select.option value="T">Tidak</flux:select.option>
                            </flux:select>
                        </div>

                        <!-- Imunisasi -->
                        <div class="space-y-4 bg-gray-50 dark:bg-zinc-800/30 rounded-lg">
                            <flux:select size="sm" wire:model="vitamin_a" :invalid="$errors->has('vitamin_a')"
                                label="Vitamin A">
                                <flux:select.option value="">Pilih</flux:select.option>
                                <flux:select.option value="Y">Ya</flux:select.option>
                                <flux:select.option value="T">Tidak</flux:select.option>
                            </flux:select>
                        </div>

                        <!-- Imunisasi -->
                        <div class="space-y-4 bg-gray-50 dark:bg-zinc-800/30 rounded-lg">
                            <flux:select size="sm" wire:model="obat_cacing"
                                :invalid="$errors->has('obat_cacing')" label="Obat Cacing">
                                <flux:select.option value="">Pilih</flux:select.option>
                                <flux:select.option value="Y">Ya</flux:select.option>
                                <flux:select.option value="T">Tidak</flux:select.option>
                            </flux:select>
                        </div>

                        <!-- Imunisasi -->
                        <div class="space-y-4 bg-gray-50 dark:bg-zinc-800/30 rounded-lg">
                            <flux:select size="sm" wire:model="mt_pangan_lokal"
                                :invalid="$errors->has('mt_pangan_lokal')" label="MT Pangan Lokal">
                                <flux:select.option value="">Pilih</flux:select.option>
                                <flux:select.option value="Y">Ya</flux:select.option>
                                <flux:select.option value="T">Tidak</flux:select.option>
                            </flux:select>
                        </div>

                        <!-- Imunisasi -->
                        <div class="space-y-4 bg-gray-50 dark:bg-zinc-800/30 rounded-lg">
                            <flux:select size="sm" wire:model="gejala_sakit"
                                :invalid="$errors->has('gejala_sakit')" label="Gejala Sakit">
                                <flux:select.option value="">Pilih</flux:select.option>
                                <flux:select.option value="Y">Ya</flux:select.option>
                                <flux:select.option value="T">Tidak</flux:select.option>
                            </flux:select>
                        </div>
                    </div>
                </div>

                <!-- Diagnosa -->
                <div class="space-y-4 mt-6">
                    <flux:textarea :invalid="$errors->has('diagnosa')" wire:model="diagnosa" label="Diagnosa"
                        size="sm" />
                </div>

                <!-- Keterangan -->
                <div class="space-y-4 mt-6">
                    <flux:input :invalid="$errors->has('keterangan')" wire:model="keterangan" label="Keterangan"
                        size="sm" />
                </div>

                <!-- Actions -->
                <div class="flex justify-end space-x-3 pt-6 mt-6 border-t dark:border-gray-700">
                    <flux:button type="button" variant="outline" onclick="Flux.modal('pemeriksaan-update').close()">
                        Batal
                    </flux:button>
                    <flux:button type="submit" variant="primary">
                        Simpan
                    </flux:button>
                </div>
            </form>
        </div>
    </flux:modal>

    {{-- Modal Pilih Pasien --}}
    <flux:modal name="choose-pasien" class="w-lg">
        {{-- Sticky Search Input --}}
        <div class="sticky top-0 z-40 bg-white dark:bg-zinc-800 px-4 pt-4 pb-2">
            <flux:input type="text" variant="filled" icon="magnifying-glass" wire:model.live="searchAnak"
                placeholder="Cari Ibu Hamil..." class="w-full" size="md" clearable />
        </div>

        {{-- Scrollable Results --}}
        <div class="h-[50vh] overflow-y-auto px-4 pb-4" id="container-dpl-results">
            <div class="text-xs space-y-2">
                {{-- Loading --}}
                @if ($searchAnak && $searchAnakResults === null)
                    @foreach ([1, 2, 3] as $i)
                        <div class="animate-pulse grid grid-cols-3 gap-2 w-full px-4 py-3 rounded-md">
                            <div class="h-5 bg-gray-200 dark:bg-zinc-700 rounded col-span-1">
                            </div>
                            <div class="h-5 bg-gray-200 dark:bg-zinc-700 rounded col-span-2">
                            </div>
                        </div>
                    @endforeach

                    {{-- Results --}}
                @elseif($searchAnak && $searchAnakResults->isNotEmpty())
                    @foreach ($searchAnakResults as $anak)
                        <button wire:click="chooseAnak({{ $anak->id_user }})"
                            class="grid grid-cols-4 cursor-pointer rounded-md dark:text-zinc-400 gap-2 text-zinc-500 w-full text-left px-4 py-3 bg-gray-100 dark:bg-zinc-900 hover:scale-[1.02] hover:bg-blue-200 dark:hover:bg-zinc-700 hover:shadow-md border-l-2 border-transparent hover:border-blue-400 dark:hover:border-zinc-600">
                            <span class="font-medium dark:text-white text-zinc-800">{{ $anak->nik }}</span>
                            <span class="col-span-2">{{ $anak->name }}</span>
                            <span class="text-end">{{ $anak->jenis_kelamin }}</span>
                    @endforeach

                    {{-- No Results --}}
                @elseif($searchAnak)
                    <div class="py-4 text-center">
                        <p class="text-sm text-gray-500 dark:text-zinc-400">
                            🔍 Tidak ditemukan Ibu Hamil</p>
                    </div>

                    {{-- Optional default state --}}
                @elseif($this->anakList)
                    @foreach ($this->anakList as $result)
                        <button wire:click="chooseAnak({{ $result->id_user }})"
                            class="grid grid-cols-4 cursor-pointer rounded-md dark:text-zinc-400 gap-2 text-zinc-500 w-full text-left px-4 py-3 bg-gray-100 dark:bg-zinc-900 hover:scale-[1.02] hover:bg-blue-200 dark:hover:bg-zinc-700 hover:shadow-md border-l-2 border-transparent hover:border-blue-400 dark:hover:border-zinc-600">
                            <span class="font-medium dark:text-white text-zinc-800">{{ $result->nik }}</span>
                            <span class="col-span-2">{{ $result->name }}</span>
                            <span class="text-end">{{ $result->jenis_kelamin }}</span>
                        </button>
                    @endforeach
                @else
                    <div class="py-4 text-center">
                        <p class="text-sm text-gray-500 dark:text-zinc-400">
                            👋 Masukkan nama/NIK Ibu Hamil</p>
                    </div>
                @endif
            </div>
        </div>
    </flux:modal>
</div>
