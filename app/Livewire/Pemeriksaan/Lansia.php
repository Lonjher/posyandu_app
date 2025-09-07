<?php

namespace App\Livewire\Pemeriksaan;

use App\Models\LansiaPemeriksaan;
use Barryvdh\DomPDF\Facade\Pdf;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\SkriningTbc;
use App\Models\User;
use Flux\Flux;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;

class Lansia extends Component
{
    use WithPagination;
    public $searchLansia = null;
    public $searchLansiaResults = null;
    public ?User $choosenLansia = null;

    public $lansia_id;
    public $bb;
    public $tb;
    public $imt;
    public $lingkar_perut;
    public $tekanan_darah;
    public $gula_darah;
    public $mata_kanan;
    public $mata_kiri;
    public $telinga_kanan;
    public $telinga_kiri;
    public $usia;
    public $menggunakan_alat_kontrasepsi;
    public $diagnosa;
    public $keterangan;
    public $skrining_tbc_id;

    // Skrining TBC fields
    public $batuk_terus_menerus = false;
    public $demam_lebih_dari_2_minggu = false;
    public $berat_badan_turun_tanpa_sebab_jelas = false;
    public $kontak_dengan_orang_terinfeksi_tbc = false;

    public $search = '';
    public $isEdit = false;
    public $editedPemeriksaan;

    protected $rules = [
        'bb' => 'required|numeric',
        'tb' => 'required|numeric',
        'imt' => 'required|numeric',
        'lingkar_perut' => 'required|numeric',
        'tekanan_darah' => 'required|string',
        'gula_darah' => 'required|numeric',
        'mata_kanan' => 'required|string',
        'mata_kiri' => 'required|string',   // mungkin maksudnya 'mata_kiri'? (cek lagi)
        'telinga_kanan' => 'required|string',
        'telinga_kiri' => 'required|string',
        'usia' => 'required|numeric',
        'menggunakan_alat_kontrasepsi' => 'boolean',
        'diagnosa' => 'nullable|string|max:255',
        'keterangan' => 'nullable|string|max:255',

        // Skrining TBC rules
        'batuk_terus_menerus' => 'boolean',
        'demam_lebih_dari_2_minggu' => 'boolean',
        'berat_badan_turun_tanpa_sebab_jelas' => 'boolean',
        'kontak_dengan_orang_terinfeksi_tbc' => 'boolean',
    ];

    public function updatedSearchLansia()
    {
        if (strlen($this->searchLansia) >= 2) {
            $this->searchLansiaResults = User::onlyLansia()
                ->where(function ($q) {
                    $q->where('nik', 'like', '%' . $this->searchLansia . '%')
                        ->orWhere('name', 'like', '%' . $this->searchLansia . '%');
                })
                ->get();
        } else {
            $this->searchBumilResults = null;
        }
    }

    public function chooseLansia(User $user)
    {
        $this->choosenLansia = $user;
        Flux::modals()->close();
        Flux::modal('pemeriksaan-modal')->show();
    }

    #[Computed]
    public function lansiaList()
    {
        return User::onlyLansia()->get();
    }

    public function edit(LansiaPemeriksaan $pemeriksaan)
    {
        $this->isEdit = true;

        // simpan objek pemeriksaan yg sedang diedit
        $this->editedPemeriksaan = $pemeriksaan;

        // mapping data ke form
        $this->lansia_id = $pemeriksaan->lansia_id;
        $this->bb = $pemeriksaan->bb;
        $this->tb = $pemeriksaan->tb;
        $this->imt = $pemeriksaan->imt;
        $this->lingkar_perut = $pemeriksaan->lingkar_perut;
        $this->tekanan_darah = $pemeriksaan->tekanan_darah;
        $this->gula_darah = $pemeriksaan->gula_darah;
        $this->mata_kanan = $pemeriksaan->mata_kanan;
        $this->mata_kiri = $pemeriksaan->mata_kiri;
        $this->telinga_kanan = $pemeriksaan->telinga_kanan;
        $this->telinga_kiri = $pemeriksaan->telinga_kiri;
        $this->usia = $pemeriksaan->usia;
        $this->menggunakan_alat_kontrasepsi = $pemeriksaan->menggunakan_alat_kontrasepsi;
        $this->diagnosa = $pemeriksaan->diagnosa;
        $this->keterangan = $pemeriksaan->keterangan;

        // jika ada data skrining TBC yg berelasi
        if ($pemeriksaan->skriningTbc) {
            $this->batuk_terus_menerus = $pemeriksaan->skriningTbc->batuk_terus_menerus;
            $this->demam_lebih_dari_2_minggu = $pemeriksaan->skriningTbc->demam_lebih_dari_2_minggu;
            $this->berat_badan_turun_tanpa_sebab_jelas = $pemeriksaan->skriningTbc->berat_badan_turun_tanpa_sebab_jelas;
            $this->kontak_dengan_orang_terinfeksi_tbc = $pemeriksaan->skriningTbc->kontak_dengan_orang_terinfeksi_tbc;
        }

        Flux::modal('pemeriksaan-update')->show();
    }


    public function confirmDelete(LansiaPemeriksaan $pemeriksaan)
    {
        $this->dispatch(
            'confirmDelete',
            type: 'question',
            title: 'Peringatan!',
            text: "Apakah anda yakin ingin menghapus data ini?",
            id: $pemeriksaan->id_lansia_pemeriksaan
        );
    }

    #[On('delete')]
    public function delete(LansiaPemeriksaan $id)
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
                text: "Ada yang salah: " . $e->getMessage()
            );
            return;
        }
    }

    public function save()
    {
        $this->validate();

        // Simpan data skrining TBC terlebih dahulu
        $skriningTbcData = [
            'batuk_terus_menerus' => $this->batuk_terus_menerus,
            'demam_lebih_dari_2_minggu' => $this->demam_lebih_dari_2_minggu,
            'berat_badan_turun_tanpa_sebab_jelas' => $this->berat_badan_turun_tanpa_sebab_jelas,
            'kontak_dengan_orang_terinfeksi_tbc' => $this->kontak_dengan_orang_terinfeksi_tbc,
        ];

        $data = [
            'user_id' => Auth::user()->id_user,
            'lansia_id' => $this->choosenLansia->id_user,
            'bb' => $this->bb,
            'tb' => $this->tb,
            'imt' => $this->imt,
            'lingkar_perut' => $this->lingkar_perut,
            'tekanan_darah' => $this->tekanan_darah,
            'gula_darah' => $this->gula_darah,
            'mata_kanan' => $this->mata_kanan,
            'mata_kiri' => $this->mata_kiri,
            'telinga_kanan' => $this->telinga_kanan,
            'telinga_kiri' => $this->telinga_kiri,
            'usia' => $this->usia,
            'menggunakan_alat_kontrasepsi' => $this->menggunakan_alat_kontrasepsi,
            'diagnosa' => $this->diagnosa,
            'keterangan' => $this->keterangan,
        ];

        try {
            $skriningTbc = SkriningTbc::create($skriningTbcData);
            $data['skrining_tbc_id'] = $skriningTbc->id_skrining_tbc;

            LansiaPemeriksaan::create($data);

            Flux::modals()->close();
            $this->dispatch(
                'alert',
                type: 'success',
                title: "Sukses",
                text: "Data berhasil disimpan!"
            );

            $this->resetForm();
        } catch (\Exception $e) {
            Flux::modals()->close();
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
        $this->validate();

        $skriningTbcData = [
            'batuk_terus_menerus' => $this->batuk_terus_menerus,
            'demam_lebih_dari_2_minggu' => $this->demam_lebih_dari_2_minggu,
            'berat_badan_turun_tanpa_sebab_jelas' => $this->berat_badan_turun_tanpa_sebab_jelas,
            'kontak_dengan_orang_terinfeksi_tbc' => $this->kontak_dengan_orang_terinfeksi_tbc,
        ];

        $data = [
            'bb' => $this->bb,
            'tb' => $this->tb,
            'imt' => $this->imt,
            'lingkar_perut' => $this->lingkar_perut,
            'tekanan_darah' => $this->tekanan_darah,
            'gula_darah' => $this->gula_darah,
            'mata_kanan' => $this->mata_kanan,
            'mata_kiri' => $this->mata_kiri, // cek lagi, mungkin mata_kiri
            'telinga_kanan' => $this->telinga_kanan,
            'telinga_kiri' => $this->telinga_kiri,
            'usia' => $this->usia,
            'menggunakan_alat_kontrasepsi' => $this->menggunakan_alat_kontrasepsi,
            'diagnosa' => $this->diagnosa,
            'keterangan' => $this->keterangan,
        ];

        try {
            $this->editedPemeriksaan->skriningTbc->update($skriningTbcData);
            $this->editedPemeriksaan->update($data);

            Flux::modals()->close();
            $this->dispatch(
                'alert',
                type: 'success',
                title: "Sukses",
                text: "Data berhasil diupdate!"
            );
        } catch (\Exception $e) {
            Flux::modals()->close();
            $this->dispatch(
                'alert',
                type: 'error',
                title: "Error",
                text: 'Terjadi kesalahan: ' . $e->getMessage(),
                timer: 5000
            );
        }
    }

    public function resetForm()
    {
        $this->reset([
            'isEdit',
            'editedPemeriksaan',
            'lansia_id',
            'bb',
            'tb',
            'imt',
            'lingkar_perut',
            'tekanan_darah',
            'gula_darah',
            'mata_kanan',
            'mata_kiri',
            'telinga_kanan',
            'telinga_kiri',
            'usia',
            'menggunakan_alat_kontrasepsi',
            'diagnosa',
            'keterangan',
            'skrining_tbc_id',
        ]);

        $this->choosenLansia = null;
    }

    public function render()
    {
        $query = LansiaPemeriksaan::with('lansia')
            ->orderBy('created_at', 'desc');

        if ($this->search) {
            $query->whereHas('lansia', function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%');
            });
        }

        $pemeriksaans = $query->paginate(10);

        return view('livewire.pemeriksaan.lansia', [
            'pemeriksaans' => $pemeriksaans
        ]);
    }

    public function exportPdf()
    {
        $pemeriksaans = LansiaPemeriksaan::with(['lansia', 'user', 'skriningTbc'])->get();

        try {
            $pdf = Pdf::loadView('pdf.lansia-laporan', compact('pemeriksaans'))
                ->setPaper('folio', 'landscape'); // HORIZONTAL

            return response()->streamDownload(function () use ($pdf) {
                echo $pdf->output();
            }, 'laporan-lansia-pemeriksaan.pdf');
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

    public function openModalTbc(LansiaPemeriksaan $pemeriksaan)
    {
        $this->batuk_terus_menerus = $pemeriksaan->skriningTbc->batuk_terus_menerus;
        $this->demam_lebih_dari_2_minggu = $pemeriksaan->skriningTbc->demam_lebih_dari_2_minggu;
        $this->berat_badan_turun_tanpa_sebab_jelas = $pemeriksaan->skriningTbc->berat_badan_turun_tanpa_sebab_jelas;
        $this->kontak_dengan_orang_terinfeksi_tbc = $pemeriksaan->skriningTbc->kontak_dengan_orang_terinfeksi_tbc;
        Flux::modal('skrining-tbc')->show();
    }
}
