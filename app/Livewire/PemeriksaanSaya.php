<?php

namespace App\Livewire;

use App\Models\BumilPemeriksaan;
use Barryvdh\DomPDF\Facade\Pdf;
use Livewire\Component;
use App\Models\AnakPemeriksaan;
use App\Models\LansiaPemeriksaan;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;

class PemeriksaanSaya extends Component
{
    use WithPagination;

    public function render()
    {
        $userId = auth()->id();
        $anakPemeriksaans = AnakPemeriksaan::with('skriningTbc')->where('anak_id', $userId)->latest()->paginate(10);
        $bumilPemeriksaans = BumilPemeriksaan::with('skriningTbc')->where('bumil_id', $userId)->latest()->paginate(10);
        $lansiaPemeriksaans = LansiaPemeriksaan::with('skriningTbc')->where('lansia_id', $userId)->latest()->paginate(10);
        return view('livewire.pemeriksaan-saya', [
            'anakPemeriksaans' => $anakPemeriksaans,
            'bumilPemeriksaans'=> $bumilPemeriksaans,
            'lansiaPemeriksaans'=> $lansiaPemeriksaans
        ]);
    }

    public function exportPdf()
    {
        if(Auth::user()->kategori === 'anak')
        {
            $pemeriksaans = AnakPemeriksaan::with(['anak', 'user', 'skriningTbc'])->get();
        }elseif(Auth::user()->kategori === 'lansia'){
            $pemeriksaans = LansiaPemeriksaan::with(['lansia', 'user', 'skriningTbc'])->get();
        }elseif(Auth::user()->kategori === 'bumil'){
            $pemeriksaans = BumilPemeriksaan::with(['bumil', 'user', 'skriningTbc'])->get();
        }

        try {
            if(Auth::user()->kategori === 'anak')
            {
                $pdf = Pdf::loadView('pdf.anak-laporan', compact('pemeriksaans'))
                ->setPaper('folio', 'landscape'); // HORIZONTAL
            }elseif(Auth::user()->kategori === 'lansia'){
                $pdf = Pdf::loadView('pdf.lansia-laporan', compact('pemeriksaans'))
                ->setPaper('folio', 'landscape'); // HORIZONTAL
            }elseif(Auth::user()->kategori === 'bumil'){
                $pdf = Pdf::loadView('pdf.bumil-laporan', compact('pemeriksaans'))
                ->setPaper('folio', 'landscape'); // HORIZONTAL
            }

            return response()->streamDownload(function () use ($pdf) {
                echo $pdf->output();
            }, 'Laporan Hasil Pemeriksaan.pdf');
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
}
