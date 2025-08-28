<?php

namespace App\Livewire\Pemeriksaan;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\BumilPemeriksaan;
use App\Models\SkriningTbc;
use App\Models\User;
use Flux\Flux;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;

class Anak extends Component
{
    use WithPagination;
    public $searchBumil = null;
    public $searchBumilResults = null;
    public ?User $choosenBumil = null;

    public $user_id;
    public $usia_kehamilan;
    public $berat_badan;
    public $lila;
    public $sistole_distole;
    public $keluhan_lain;
    public $diagnosa;
    public $keterangan;
    public $konsumsi_ttd = false;
    public $jumlah_ttd;
    public $jadwal_ttd;
    public $konsumsi_mt = false;
    public $komposisi_jumlah_porsi;
    public $jadwal_mt;
    public $ikut_kelas_bumil = false;
    public $edukasi;

    // Skrining TBC fields
    public $batuk_terus_menerus = false;
    public $demam_lebih_dari_2_minggu = false;
    public $berat_badan_turun_tanpa_sebab_jelas = false;
    public $kontak_dengan_orang_terinfeksi_tbc = false;

    public $search = '';
    public $isEdit = false;
    public $editedPemeriksaan;

    protected $rules = [
        'usia_kehamilan' => 'required|numeric',
        'berat_badan' => 'required|numeric',
        'lila' => 'required|numeric',
        'sistole_distole' => 'required|string',
        'keluhan_lain' => 'nullable|string',
        'diagnosa' => 'nullable|string',
        'keterangan' => 'nullable|string',
        'jumlah_ttd' => 'nullable|string',
        'jadwal_ttd' => 'nullable',
        'komposisi_jumlah_porsi' => 'nullable|string',
        'jadwal_mt' => 'nullable',
        'ikut_kelas_bumil' => 'boolean',
        'edukasi' => 'nullable|string|required_if:ikut_kelas_bumil,false',

        // Skrining TBC rules
        'batuk_terus_menerus' => 'boolean',
        'demam_lebih_dari_2_minggu' => 'boolean',
        'berat_badan_turun_tanpa_sebab_jelas' => 'boolean',
        'kontak_dengan_orang_terinfeksi_tbc' => 'boolean',
    ];

    public function updatedSearchBumil()
    {
        if (strlen($this->searchBumil) >= 2) {
            $this->searchBumilResults = User::onlyBumil()
                ->where(function ($q) {
                    $q->where('nik', 'like', '%' . $this->searchBumil . '%')
                        ->orWhere('name', 'like', '%' . $this->searchBumil . '%');
                })
                ->get();
        } else {
            $this->searchBumilResults = null;
        }
    }

    public function chooseBumil(User $user)
    {
        $this->choosenBumil = $user;
        Flux::modals()->close();
        Flux::modal('pemeriksaan-modal')->show();
    }

    #[Computed]
    public function bumilList()
    {
        return User::onlyBumil()->get();
    }

    public function edit(BumilPemeriksaan $pemeriksaan)
    {
        $this->isEdit = true;
        // Load data pemeriksaan ke form
        $this->editedPemeriksaan = $pemeriksaan;
        $this->choosenBumil = $pemeriksaan->bumil;
        $this->usia_kehamilan = $pemeriksaan->usia_kehamilan;
        $this->berat_badan = $pemeriksaan->berat_badan;
        $this->lila = $pemeriksaan->lila;
        $this->sistole_distole = $pemeriksaan->sistole_distole;
        $this->keluhan_lain = $pemeriksaan->keluhan_lain;
        $this->diagnosa = $pemeriksaan->diagnosa;
        $this->keterangan = $pemeriksaan->keterangan;
        $this->jumlah_ttd = $pemeriksaan->jumlah_ttd;
        $this->jadwal_ttd = $pemeriksaan->jadwal_ttd;
        $this->konsumsi_ttd = !empty($pemeriksaan->jumlah_ttd); // Set konsumsi_ttd berdasarkan data
        $this->komposisi_jumlah_porsi = $pemeriksaan->komposisi_jumlah_porsi;
        $this->jadwal_mt = $pemeriksaan->jadwal_mt;
        $this->konsumsi_mt = !empty($pemeriksaan->komposisi_jumlah_porsi); // Set konsumsi_mt berdasarkan data
        $this->ikut_kelas_bumil = empty($pemeriksaan->edukasi);
        $this->edukasi = $pemeriksaan->edukasi;
        // dd($pemeriksaan->jumlah_ttd);
        // dd($this->konsumsi_ttd, $this->konsumsi_mt);
        // Load data skrining TBC
        if ($pemeriksaan->skriningTbc) {
            $this->batuk_terus_menerus = $pemeriksaan->skriningTbc->batuk_terus_menerus;
            $this->demam_lebih_dari_2_minggu = $pemeriksaan->skriningTbc->demam_lebih_dari_2_minggu;
            $this->berat_badan_turun_tanpa_sebab_jelas = $pemeriksaan->skriningTbc->berat_badan_turun_tanpa_sebab_jelas;
            $this->kontak_dengan_orang_terinfeksi_tbc = $pemeriksaan->skriningTbc->kontak_dengan_orang_terinfeksi_tbc;
        }

        Flux::modal('pemeriksaan-update')->show();
    }

    public function confirmDelete(BumilPemeriksaan $pemeriksaan)
    {
        $this->dispatch(
            'confirmDelete',
            type: 'question',
            title: 'Peringatan!',
            text: "Apakah anda yakin ingin menghapus data ini?",
            id: $pemeriksaan->id_bumil_pemeriksaan
        );
    }

    #[On('delete')]
    public function delete(BumilPemeriksaan $id)
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
        } catch(\Exception $e){
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

        // Simpan data pemeriksaan bumil
        $data = [
            'user_id' => Auth::user()->id_user,
            'bumil_id' => $this->choosenBumil->id_user,
            'usia_kehamilan' => $this->usia_kehamilan,
            'berat_badan' => $this->berat_badan,
            'lila' => $this->lila,
            'sistole_distole' => $this->sistole_distole,
            'keluhan_lain' => $this->keluhan_lain,
            'diagnosa' => $this->diagnosa,
            'keterangan' => $this->keterangan,
            'jumlah_ttd' => $this->konsumsi_ttd ? $this->jumlah_ttd : null,
            'jadwal_ttd' => $this->konsumsi_ttd ? $this->jadwal_ttd : null,
            'komposisi_jumlah_porsi' => $this->konsumsi_mt ? $this->komposisi_jumlah_porsi : null,
            'jadwal_mt' => $this->konsumsi_mt ? $this->jadwal_mt : null,
            'ikut_kelas_bumil' => $this->ikut_kelas_bumil,
            'edukasi' => $this->edukasi,
        ];

        try {
            $skriningTbc = SkriningTbc::create($skriningTbcData);
            $data['skrining_tbc_id'] = $skriningTbc->id_skrining_tbc;
            // Buat pemeriksaan baru
            BumilPemeriksaan::create($data);
            $message = 'Data berhasil disimpan!';
            Flux::modals()->close('pemeriksaan-modal');
            $this->dispatch(
                'alert',
                type: 'success',
                title: "Sukses",
                text: $message
            );

            $this->resetForm();
        } catch (\Exception $e) {
            Flux::modals()->close('pemeriksaan-modal');
            $this->dispatch(
                'alert',
                type: 'error',
                title: "Error",
                text: 'Terjadi kesalahan: ' . $e->getMessage()
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

        // Simpan data pemeriksaan bumil
        $data = [
            'user_id' => Auth::user()->id_user,
            'bumil_id' => $this->choosenBumil->id_user,
            'usia_kehamilan' => $this->usia_kehamilan,
            'berat_badan' => $this->berat_badan,
            'lila' => $this->lila,
            'sistole_distole' => $this->sistole_distole,
            'keluhan_lain' => $this->keluhan_lain,
            'diagnosa' => $this->diagnosa,
            'keterangan' => $this->keterangan,
            'jumlah_ttd' => $this->jumlah_ttd,
            'jadwal_ttd' => $this->jadwal_ttd,
            'komposisi_jumlah_porsi' => $this->komposisi_jumlah_porsi,
            'jadwal_mt' => $this->jadwal_mt,
            'ikut_kelas_bumil' => $this->ikut_kelas_bumil,
            'edukasi' => $this->edukasi,
        ];
        // Update skrining TBC
        $this->editedPemeriksaan->skriningTbc->update($skriningTbcData);
        // Update pemeriksaan
        $this->editedPemeriksaan->update($data);
        Flux::modals()->close();
        $this->dispatch(
            'alert',
            type: 'success',
            title: "Sukses",
            text: "Data berhasil diupdate"
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
        $query = BumilPemeriksaan::with('bumil')
            ->orderBy('created_at', 'desc');

        if ($this->search) {
            $query->whereHas('bumil', function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%');
            });
        }

        $pemeriksaans = $query->paginate(10);

        return view('livewire.pemeriksaan.anak', [
            'pemeriksaans' => $pemeriksaans
        ]);
    }
}
