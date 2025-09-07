<?php

namespace App\Livewire\User;

use Livewire\Component;
use App\Models\Edukasi;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;

#[Layout('components.layouts.auth')]
class EdukasiByKategori extends Component
{
    use WithPagination;

    public $kategori;
    public $search = '';
    public $perPage = 12;

    protected $queryString = [
        'search' => ['except' => '']
    ];

    public function mount($kategori)
    {
        $this->kategori = $kategori;

        // Validasi kategori
        $validCategories = ['bumil', 'anak', 'lansia', 'umum'];
        if (!in_array($this->kategori, $validCategories)) {
            abort(404);
        }
    }

    public function clearSearch()
    {
        $this->reset('search');
        $this->resetPage();
    }

    public function render()
    {
        $categoryTitles = [
            'bumil' => 'Edukasi Ibu Hamil',
            'anak' => 'Edukasi anak',
            'lansia' => 'Edukasi Lansia',
            'umum' => 'Edukasi Kesehatan Umum'
        ];

        $categoryDescriptions = [
            'bumil' => 'Temukan informasi dan tips bermanfaat untuk kesehatan ibu hamil',
            'anak' => 'Tips dan edukasi untuk tumbuh kembang anak yang optimal',
            'lansia' => 'Informasi kesehatan untuk lansia yang sehat dan aktif',
            'umum' => 'Edukasi kesehatan umum untuk seluruh keluarga'
        ];

        $edukasis = Edukasi::with('user')
            ->where('kategori', $this->kategori)
            ->when($this->search, function ($query) {
                $query->where('judul', 'like', '%' . $this->search . '%');
            })
            ->orderBy('created_at', 'desc')
            ->paginate($this->perPage);

        return view('livewire.user.edukasi-by-kategori', compact('categoryTitles', 'categoryDescriptions', 'edukasis'));
    }
}
