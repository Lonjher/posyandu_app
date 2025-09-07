<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Edukasi;

#[Layout('components.layouts.auth')]
class BacaEdukasi extends Component
{
    public $edukasi;
    public $kategoriColor;
    public $kategoriTextColor;

    public function mount(Edukasi $edukasi)
    {
        $this->edukasi = $edukasi;
    }

    public function render()
    {
        return view('livewire.baca-edukasi');
    }

    private function setCategoryColor($category)
    {
        $colors = [
            'anak' => ['bg-blue-100', 'text-blue-800', 'dark:bg-blue-900', 'dark:text-blue-200'],
            'lansia' => ['bg-green-100', 'text-green-800', 'dark:bg-green-900', 'dark:text-green-200'],
            'bumil' => ['bg-pink-100', 'text-pink-800', 'dark:bg-pink-900', 'dark:text-pink-200'],
            'umum' => ['bg-indigo-100', 'text-indigo-800', 'dark:bg-indigo-900', 'dark:text-indigo-200'],
        ];

        $colorSettings = $colors[$category] ?? ['bg-gray-100', 'text-gray-800', 'dark:bg-gray-700', 'dark:text-gray-200'];

        $this->kategoriColor = "{$colorSettings[0]} {$colorSettings[2]}";
        $this->kategoriTextColor = "{$colorSettings[1]} {$colorSettings[3]}";
    }
}
