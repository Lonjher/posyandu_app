<?php

namespace App\Livewire\Admin;

use App\Models\Edukasi as ModelsEdukasi;
use Flux\Flux;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Livewire\Attributes\On;

class Edukasi extends Component
{

    use WithPagination;
    use WithFileUploads;

    // Properties untuk form
    public $judul;
    public $gambar;
    public $kategori;
    public $editMode = false;
    public ?Edukasi $edukasi = null;

    // Properties untuk filter dan pencarian
    public $search = '';
    public $kategoriFilter = '';
    public $perPage = 12;

    // Validation rules
    protected $rules = [
        'judul' => 'required|min:5|max:255',
        'kategori' => 'required|in:bumil,anak,lansia,umum',
        'gambar' => 'nullable|image|max:2048', // 2MB max
    ];

    public function render()
    {
        $edukasis = ModelsEdukasi::with('user')
            ->when($this->search, function ($query) {
                $query->where('judul', 'like', '%' . $this->search . '%');
            })
            ->when($this->kategoriFilter, function ($query) {
                $query->where('kategori', $this->kategoriFilter);
            })
            ->orderBy('created_at', 'desc')
            ->paginate($this->perPage);

        return view('livewire.admin.edukasi', compact('edukasis'));
    }

    // Reset input fields
    public function resetInput()
    {
        $this->reset(['judul', 'gambar', 'kategori', 'editMode',]);
        $this->resetErrorBag();
    }

    // Simpan edukasi baru
    public function save()
    {
        $this->validate();

        try {
            // Upload dan proses gambar
            $gambarPath = $this->processImage();

            // Simpan data edukasi
            ModelsEdukasi::create([
                'judul' => $this->judul,
                'gambar' => $gambarPath,
                'kategori' => $this->kategori,
                'user_id' => Auth::user()->id_user,
            ]);

            // Reset form dan tampilkan pesan sukses
            $this->resetInput();
            $this->dispatch(
                'alert',
                type: 'success',
                title: 'Sukses',
                text: 'Edukasi berhasil ditambahkan!'
            );

            // Tutup modal
            Flux::modals()->close();
        } catch (\Exception $e) {
            Flux::modals()->close();
            $this->dispatch(
                'alert',
                type: 'error',
                title: 'Gagal',
                text: $e->getMessage(),
                timer: 5000
            );
        }
    }

    // Edit edukasi
    public function edit(Edukasi $edukasi)
    {
        // Cek authorization
        Gate::authorize('isAdmin');
        if ($edukasi->user_id !== Auth::user()->id_user) {
            $this->dispatch(
                'alert',
                type: 'error',
                title: 'Gagal',
                text: "Anda tidak memiliki akses untuk melakukan ini!"
            );
            return;
        }

        $this->edukasi = $edukasi;
        $this->judul = $edukasi->judul;
        $this->kategori = $edukasi->kategori;
        $this->gambar = $edukasi->gambar; // Path gambar yang sudah ada
        $this->editMode = true;

        // Buka modal edit
        Flux::modal('edit-edukasi')->show();
    }

    // Update edukasi
    public function update()
    {
        $this->validate();

        try {
            Gate::authorize('isAdmin');
            if ($this->edukasi->user_id !== Auth::user()->id_user) {
                $this->dispatch(
                    'alert',
                    type: 'error',
                    title: 'Gagal',
                    text: "Anda tidak memiliki akses untuk melakukan ini!"
                );
                return;
            }

            // Jika ada gambar baru, proses upload
            if ($this->gambar && !is_string($this->gambar)) {
                // Hapus gambar lama
                if ($this->edukasi->gambar && Storage::exists($this->edukasi->gambar)) {
                    Storage::delete($this->edukasi->gambar);
                }

                $gambarPath = $this->processImage();
            } else {
                $gambarPath = $this->edukasi->gambar;
            }

            // Update data
            $this->edukasi->update([
                'judul' => $this->judul,
                'gambar' => $gambarPath,
                'kategori' => $this->kategori,
            ]);

            // Reset form dan tampilkan pesan sukses
            $this->resetInput();
            Flux::modal()->close();
            $this->dispatch(
                'alert',
                type: 'success',
                title: 'Sukses',
                text: "Data berhasil diupdate!"
            );
        } catch (\Exception $e) {
            $this->dispatch(
                'alert',
                type: 'error',
                title: 'Gagal',
                text: $e->getMessage()
            );
        }
    }

    // Konfirmasi penghapusan
    public function confirmDelete(Edukasi $edukasi)
    {
        $this->dispatch(
            'confirmDelete',
            type: 'warning',
            title: 'Peringatan',
            text: "Apakah anda yakin ingin menghapus data ini?",
            id: $edukasi->id_edukasi
        );
    }

    // Hapus edukasi
    #[On('delete')]
    public function deleteEdukasi(Edukasi $id)
    {
        try {
            Gate::authorize('isAdmin');
            // Cek authorization
            if ($id->user_id !== Auth::user()->is_user) {
                $this->dispatch(
                    'alert',
                    type: 'error',
                    title: 'Gagal',
                    text: "Anda tidak memiliki akses untuk melakukan ini!"
                );
                return;
            }

            // Hapus gambar dari storage
            if ($id->gambar && Storage::exists($id->gambar)) {
                Storage::delete($id->gambar);
            }

            // Hapus data
            $id->delete();

            $this->dispatch(
                'alert',
                type: 'success',
                title: 'Sukses',
                text: "Data berhasil dihapus!"
            );
        } catch (\Exception $e) {
            $this->dispatch(
                'alert',
                type: 'error',
                title: 'Gagal',
                text: $e->getMessage()
            );
        }
    }

    // Hapus gambar yang baru diupload
    public function removeGambar()
    {
        $this->gambar = null;
    }

    // Clear semua filter
    public function clearFilters()
    {
        $this->reset(['search', 'kategoriFilter']);
    }

    // Proses upload dan optimasi gambar
    private function processImage()
    {
        if (!$this->gambar) {
            return null;
        }

        // Jika gambar adalah string (sudah ada path), return path tersebut
        if (is_string($this->gambar)) {
            return $this->gambar;
        }

        // Jika gambar adalah string (path yang sudah ada), return path tersebut
        if (is_string($this->gambar)) {
            return $this->gambar;
        }

        // Simpan gambar dengan nama otomatis (Laravel akan generate nama unik)
        return $this->gambar->store('edukasi', 'public');
    }
}
