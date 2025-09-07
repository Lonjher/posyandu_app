<?php

namespace App\Livewire;

use App\Models\AnakPemeriksaan;
use App\Models\BumilPemeriksaan;
use App\Models\LansiaPemeriksaan;
use Livewire\Component;

class LaporanPemeriksaanPemdes extends Component
{
    public string $activeTab = 'bumil';

    public function render()
    {
        $anakPemeriksaans = AnakPemeriksaan::latest()->get();
        $bumilPemeriksaans = BumilPemeriksaan::latest()->get();
        $lansiaPemeriksaans = LansiaPemeriksaan::latest()->get();
        return view('livewire.laporan-pemeriksaan-pemdes', [
            'anakPemeriksaans' => $anakPemeriksaans,
            'bumilPemeriksaans' => $bumilPemeriksaans,
            'lansiaPemeriksaans' => $lansiaPemeriksaans
        ]);
    }

    public function setTab(string $tab): void
    {
        $this->activeTab = $tab;
    }
}
