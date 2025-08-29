<?php

namespace App\Livewire;

use App\Models\AnakPemeriksaan;
use App\Models\BumilPemeriksaan;
use App\Models\LansiaPemeriksaan;
use Livewire\Component;

class LaporanPemeriksaanPemdes extends Component
{
    public function render()
    {
        $anakPemeriksaans = AnakPemeriksaan::latest();
        $bumilPemeriksaans = BumilPemeriksaan::latest();
        $lansiaPemeriksaans = LansiaPemeriksaan::latest();
        return view('livewire.laporan-pemeriksaan-pemdes', [
            'anakPemeriksaans' => $anakPemeriksaans,
            'bumilPemeriksaans' => $bumilPemeriksaans,
            'lansiaPemeriksaans' => $lansiaPemeriksaans
        ]);
    }
}
