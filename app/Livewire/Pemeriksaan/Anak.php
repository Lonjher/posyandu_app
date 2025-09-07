<?php

namespace App\Livewire\Pemeriksaan;

use Barryvdh\DomPDF\Facade\Pdf;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\AnakPemeriksaan;
use App\Models\SkriningTbc;
use App\Models\User;
use Flux\Flux;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;

class Anak extends Component
{
    use WithPagination;
    public $searchAnak = null;
    public $searchAnakResults = null;
    public ?User $choosenAnak = null;

    // Deklarasi property
    public $bb;
    public $kesimpulan_hasil_bb;
    public $kesimpulan_hasil_pengukuran_bb;
    public $tb;
    public $kesimpulan_hasil_tb;
    public $kesimpulan_hasil_pengukuran_imt;
    public $lingkar_kepala;
    public $kesimpulan_lk;
    public $lingkar_lengan_atas;
    public $kesimpulan_lla;
    public $asi_eksklusif;
    public $mp_asi;
    public $imunisasi;
    public $vitamin_a;
    public $obat_cacing;
    public $mt_pangan_lokal;
    public $gejala_sakit;
    public $diagnosa;
    public $keterangan;

    // skrining TBC
    public $batuk_terus_menerus = false;
    public $demam_lebih_dari_2_minggu = false;
    public $berat_badan_turun_tanpa_sebab_jelas = false;
    public $kontak_dengan_orang_terinfeksi_tbc = false;

    public $search = '';
    public $isEdit = false;
    public $editedPemeriksaan;

    /**
     * Rules validasi
     */
    protected $rules = [
        'bb' => 'required|numeric|min:3',
        'kesimpulan_hasil_bb' => 'required|string',
        'kesimpulan_hasil_pengukuran_bb' => 'required|string',
        'tb' => 'required|numeric|min:3',
        'kesimpulan_hasil_tb' => 'required|string',
        'kesimpulan_hasil_pengukuran_imt' => 'required|string',
        'lingkar_kepala' => 'required|numeric|min:3',
        'kesimpulan_lk' => 'required|string',
        'lingkar_lengan_atas' => 'required|numeric|min:3',
        'kesimpulan_lla' => 'required|string',
        'asi_eksklusif' => 'nullable|boolean',
        'mp_asi' => 'nullable|string',
        'imunisasi' => 'required|string',
        'vitamin_a' => 'nullable|string',
        'obat_cacing' => 'nullable|string',
        'mt_pangan_lokal' => 'nullable|string',
        'gejala_sakit' => 'nullable|string',
        'diagnosa' => 'nullable|string|max:255',
        'keterangan' => 'nullable|string|max:255',

        // Skrining TBC rules
        'batuk_terus_menerus' => 'boolean',
        'demam_lebih_dari_2_minggu' => 'boolean',
        'berat_badan_turun_tanpa_sebab_jelas' => 'boolean',
        'kontak_dengan_orang_terinfeksi_tbc' => 'boolean',
    ];

    /**
     * Custom messages
     */
    protected $messages = [
        'anak_id.required' => 'Anak wajib dipilih.',
        'anak_id.integer' => 'ID anak tidak valid.',

        'bb.required' => 'Berat badan wajib diisi.',
        'bb.numeric' => 'Berat badan harus berupa angka.',
        'bb.min' => 'Berat badan minimal 1.',

        'kesimpulan_hasil_bb.required' => 'Kesimpulan hasil BB wajib diisi.',
        'kesimpulan_hasil_pengukuran_bb.required' => 'Kesimpulan hasil pengukuran BB wajib diisi.',

        'tb.required' => 'Tinggi badan wajib diisi.',
        'tb.numeric' => 'Tinggi badan harus berupa angka.',
        'tb.min' => 'Tinggi badan minimal 1.',

        'kesimpulan_hasil_tb.required' => 'Kesimpulan hasil TB wajib diisi.',
        'kesimpulan_hasil_pengukuran_imt.required' => 'Kesimpulan hasil pengukuran IMT wajib diisi.',

        'lingkar_kepala.required' => 'Lingkar kepala wajib diisi.',
        'lingkar_kepala.numeric' => 'Lingkar kepala harus berupa angka.',
        'kesimpulan_lk.required' => 'Kesimpulan lingkar kepala wajib diisi.',

        'lingkar_lengan_atas.required' => 'Lingkar lengan atas wajib diisi.',
        'lingkar_lengan_atas.numeric' => 'Lingkar lengan atas harus berupa angka.',
        'kesimpulan_lla.required' => 'Kesimpulan LLA wajib diisi.',

        'asi_eksklusif.boolean' => 'ASI eksklusif harus berupa pilihan ya/tidak.',

        'imunisasi.required' => 'Imunisasi wajib diisi.',
    ];

    public function updatedSearchAnak()
    {
        if (strlen($this->searchAnak) >= 2) {
            $this->searchAnakResults = User::onlyAnak()
                ->where(function ($q) {
                    $q->where('nik', 'like', '%' . $this->searchBumil . '%')
                        ->orWhere('name', 'like', '%' . $this->searchBumil . '%');
                })
                ->get();
        } else {
            $this->searchAnakResults = null;
        }
    }

    #[Computed]
    public function anakList()
    {
        return User::onlyAnak()->get();
    }

    public function chooseAnak(User $user)
    {
        $this->choosenAnak = $user;
        Flux::modals()->close();
        Flux::modal('pemeriksaan-modal')->show();
    }

    public function edit(AnakPemeriksaan $pemeriksaan)
    {
        $this->isEdit = true;

        // simpan object pemeriksaan yang sedang diedit
        $this->editedPemeriksaan = $pemeriksaan;

        // Load data pemeriksaan ke form (disesuaikan dengan atribut fungsi save)
        $this->user_id = $pemeriksaan->user_id;
        $this->choosenAnak = $pemeriksaan->anak;
        $this->bb = $pemeriksaan->bb;
        $this->kesimpulan_hasil_bb = $pemeriksaan->kesimpulan_hasil_bb;
        $this->kesimpulan_hasil_pengukuran_bb = $pemeriksaan->kesimpulan_hasil_pengukuran_bb;
        $this->tb = $pemeriksaan->tb;
        $this->kesimpulan_hasil_tb = $pemeriksaan->kesimpulan_hasil_tb;
        $this->kesimpulan_hasil_pengukuran_imt = $pemeriksaan->kesimpulan_hasil_pengukuran_imt;
        $this->lingkar_kepala = $pemeriksaan->lingkar_kepala;
        $this->kesimpulan_lk = $pemeriksaan->kesimpulan_lk;
        $this->lingkar_lengan_atas = $pemeriksaan->lingkar_lengan_atas;
        $this->kesimpulan_lla = $pemeriksaan->kesimpulan_lla;
        $this->asi_eksklusif = $pemeriksaan->asi_eksklusif;
        $this->mp_asi = $pemeriksaan->mp_asi;
        $this->imunisasi = $pemeriksaan->imunisasi;
        $this->vitamin_a = $pemeriksaan->vitamin_a;
        $this->obat_cacing = $pemeriksaan->obat_cacing;
        $this->mt_pangan_lokal = $pemeriksaan->mt_pangan_lokal;
        $this->gejala_sakit = $pemeriksaan->gejala_sakit;
        $this->skrining_tbc_id = $pemeriksaan->skrining_tbc_id;

        // Jika ada relasi skrining TBC, load juga detailnya
        if ($pemeriksaan->skriningTbc) {
            $this->batuk_terus_menerus = $pemeriksaan->skriningTbc->batuk_terus_menerus;
            $this->demam_lebih_dari_2_minggu = $pemeriksaan->skriningTbc->demam_lebih_dari_2_minggu;
            $this->berat_badan_turun_tanpa_sebab_jelas = $pemeriksaan->skriningTbc->berat_badan_turun_tanpa_sebab_jelas;
            $this->kontak_dengan_orang_terinfeksi_tbc = $pemeriksaan->skriningTbc->kontak_dengan_orang_terinfeksi_tbc;
        }

        // buka modal edit
        Flux::modal('pemeriksaan-update')->show();
    }


    public function confirmDelete(AnakPemeriksaan $pemeriksaan)
    {
        $this->dispatch(
            'confirmDelete',
            type: 'question',
            title: 'Peringatan!',
            text: "Apakah anda yakin ingin menghapus data ini?",
            id: $pemeriksaan->id_anak_pemeriksaan
        );
    }

    #[On('delete')]
    public function delete(AnakPemeriksaan $id)
    {
        $pemeriksaan = $id;
        $skriningTbc = $id->skriningTbc;
        try {
            $pemeriksaan->delete();
            $skriningTbc->delete();
            $this->dispatch(
                'alert',
                type: 'success',
                title: 'Sukses',
                text: "Data pemeriksaan berhasil dihapus!"
            );
        } catch (\Exception $e) {
            $this->dispatch(
                'alert',
                type: 'error',
                title: 'Error',
                text: "Ada yang salah: " . $e->getMessage(),
                timer: 5000
            );
            return;
        }
    }

    public function save()
    {

        $this->validate();


        try {
            // Simpan data skrining TBC
            $skriningTbc = SkriningTbc::create([
                'batuk_terus_menerus' => $this->batuk_terus_menerus,
                'demam_lebih_dari_2_minggu' => $this->demam_lebih_dari_2_minggu,
                'berat_badan_turun_tanpa_sebab_jelas' => $this->berat_badan_turun_tanpa_sebab_jelas,
                'kontak_dengan_orang_terinfeksi_tbc' => $this->kontak_dengan_orang_terinfeksi_tbc,
            ]);

            // Simpan data pemeriksaan anak
            AnakPemeriksaan::create([
                'user_id' => Auth::user()->id_user,
                'anak_id' => $this->choosenAnak->id_user,
                'bb' => $this->bb,
                'kesimpulan_hasil_bb' => $this->kesimpulan_hasil_bb,
                'kesimpulan_hasil_pengukuran_bb' => $this->kesimpulan_hasil_pengukuran_bb,
                'tb' => $this->tb,
                'kesimpulan_hasil_tb' => $this->kesimpulan_hasil_tb,
                'kesimpulan_hasil_pengukuran_imt' => $this->kesimpulan_hasil_pengukuran_imt,
                'lingkar_kepala' => $this->lingkar_kepala,
                'kesimpulan_lk' => $this->kesimpulan_lk,
                'lingkar_lengan_atas' => $this->lingkar_lengan_atas,
                'kesimpulan_lla' => $this->kesimpulan_lla,
                'asi_eksklusif' => $this->asi_eksklusif,
                'mp_asi' => $this->mp_asi,
                'imunisasi' => $this->imunisasi,
                'vitamin_a' => $this->vitamin_a,
                'obat_cacing' => $this->obat_cacing,
                'mt_pangan_lokal' => $this->mt_pangan_lokal,
                'gejala_sakit' => $this->gejala_sakit,
                'skrining_tbc_id' => $skriningTbc->id_skrining_tbc,
            ]);

            FLux::modals()->close();
            $this->dispatch(
                'alert',
                type: 'success',
                title: "Sukses",
                text: "Data berhasil disimpan!"
            );

            $this->reset();

        } catch (\Exception $e) {
            FLux::modals()->close();
            $this->dispatch(
                'alert',
                type: 'error',
                title: "Error",
                text: 'Terjadi kesalahan: ' . $e->getMessage(),
                timer: 5000
            );
        }
    }

    public function update()
    {
        // Simpan data skrining TBC terlebih dahulu
        $skriningTbcData = [
            'batuk_terus_menerus' => $this->batuk_terus_menerus,
            'demam_lebih_dari_2_minggu' => $this->demam_lebih_dari_2_minggu,
            'berat_badan_turun_tanpa_sebab_jelas' => $this->berat_badan_turun_tanpa_sebab_jelas,
            'kontak_dengan_orang_terinfeksi_tbc' => $this->kontak_dengan_orang_terinfeksi_tbc,
        ];

        // Data yang akan diupdate
        $data = [
            'user_id' => Auth::user()->id_user,
            'anak_id' => $this->choosenAnak->id_user,
            'bb' => $this->bb,
            'kesimpulan_hasil_bb' => $this->kesimpulan_hasil_bb,
            'kesimpulan_hasil_pengukuran_bb' => $this->kesimpulan_hasil_pengukuran_bb,
            'tb' => $this->tb,
            'kesimpulan_hasil_tb' => $this->kesimpulan_hasil_tb,
            'kesimpulan_hasil_pengukuran_imt' => $this->kesimpulan_hasil_pengukuran_imt,
            'lingkar_kepala' => $this->lingkar_kepala,
            'kesimpulan_lk' => $this->kesimpulan_lk,
            'lingkar_lengan_atas' => $this->lingkar_lengan_atas,
            'kesimpulan_lla' => $this->kesimpulan_lla,
            'asi_eksklusif' => $this->asi_eksklusif,
            'mp_asi' => $this->mp_asi,
            'imunisasi' => $this->imunisasi,
            'vitamin_a' => $this->vitamin_a,
            'obat_cacing' => $this->obat_cacing,
            'mt_pangan_lokal' => $this->mt_pangan_lokal,
            'gejala_sakit' => $this->gejala_sakit,
        ];

        $this->editedPemeriksaan->skriningTbc->update($skriningTbcData);
        // Update data pemeriksaan
        $this->editedPemeriksaan->update($data);

        Flux::modals()->close();
        $this->dispatch(
            'alert',
            type: 'success',
            title: "Sukses",
            text: "Data berhasil diperbarui"
        );
    }


    public function resetForm()
    {
        $this->reset([
            'isEdit',
            'editedPemeriksaan',
            'usia_kehamilan',
            'berat_badan',
            'lila',
            'sistole_distole',
            'keluhan_lain',
            'diagnosa',
            'keterangan',
            'konsumsi_ttd',
            'jumlah_ttd',
            'jadwal_ttd',
            'konsumsi_mt',
            'komposisi_jumlah_porsi',
            'jadwal_mt',
            'ikut_kelas_bumil',
            'edukasi',
            'batuk_terus_menerus',
            'demam_lebih_dari_2_minggu',
            'berat_badan_turun_tanpa_sebab_jelas',
            'kontak_dengan_orang_terinfeksi_tbc',
        ]);

        $this->choosenBumil = null;
    }

    public function render()
    {
        $query = AnakPemeriksaan::with('anak')
            ->orderBy('created_at', 'desc');

        if ($this->search) {
            $query->whereHas('anak', function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%');
            });
        }

        $pemeriksaans = $query->paginate(10);

        return view('livewire.pemeriksaan.anak', [
            'pemeriksaans' => $pemeriksaans
        ]);
    }

    public function exportPdf()
    {
        $pemeriksaans = AnakPemeriksaan::with(['anak', 'user', 'skriningTbc'])->get();

        try {
            $pdf = Pdf::loadView('pdf.anak-laporan', compact('pemeriksaans'))
                ->setPaper('folio', 'landscape'); // HORIZONTAL

            return response()->streamDownload(function () use ($pdf) {
                echo $pdf->output();
            }, 'laporan-anak-pemeriksaan.pdf');
        } catch (\Exception $e) {
            $this->dispatch(
                'alert',
                type: 'error',
                title: "Error",
                text: 'Ada masalah' . $e->getMessage(),
                timer: 5000
            );
            return;
        }
    }

    public function openModalTbc(AnakPemeriksaan $pemeriksaan)
    {

        $this->batuk_terus_menerus = $pemeriksaan->skriningTbc->batuk_terus_menerus;
        $this->demam_lebih_dari_2_minggu = $pemeriksaan->skriningTbc->demam_lebih_dari_2_minggu;
        $this->berat_badan_turun_tanpa_sebab_jelas = $pemeriksaan->skriningTbc->berat_badan_turun_tanpa_sebab_jelas;
        $this->kontak_dengan_orang_terinfeksi_tbc = $pemeriksaan->skriningTbc->kontak_dengan_orang_terinfeksi_tbc;
        Flux::modal('skrining-tbc')->show();
    }
}
