<?php

namespace App\Livewire\Pemdes;

use App\Models\LaporanKegiatan;
use Flux\Flux;
use Livewire\Component;
use Livewire\WithPagination;

class ViewLaporan extends Component
{
    use WithPagination;
    public $search = '';
    public $perPage = 10;
    public $Vuser;
    public $Vnama_kegiatan;
    public $Vcreated_at;
    public $Vtanggal_kegiatan;
    public $Vdeskripsi_kegiatan;
    public $Vphotos;
    public $Vjumlah_foto;

    public function render()
    {
        if ($this->search) {
            $laporans = LaporanKegiatan::with('dokumentasi', 'user')
                ->where(function ($query) {
                    $query->where('nama_kegiatan', 'like', '%' . $this->search . '%')
                        ->orWhere('deskripsi_kegiatan', 'like', '%' . $this->search . '%');
                })
                ->latest()
                ->paginate($this->perPage);
        } else {
            $laporans = LaporanKegiatan::with('dokumentasi', 'user')->latest()->paginate($this->perPage);
        }
        return view('livewire.pemdes.view-laporan', [
            'laporans' => $laporans
        ]);
    }

    public function view_laporan(LaporanKegiatan $laporan)
    {
        Flux::modal('view-laporan')->show();
        $this->Vuser = $laporan->user->name;
        $this->Vnama_kegiatan = $laporan->nama_kegiatan;
        $this->Vcreated_at = $laporan->created_at->format('d M Y');
        $this->Vtanggal_kegiatan = $laporan->tanggal_kegiatan;
        $this->Vdeskripsi_kegiatan = $laporan->deskripsi_kegiatan;
        $this->Vphotos = $laporan->dokumentasi;
        $this->Vjumlah_foto = $laporan->dokumentasi->count();
    }
}
