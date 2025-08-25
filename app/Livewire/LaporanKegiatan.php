<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\LaporanKegiatan as ModelLaporanKegiatan;
use App\Models\DokumentasiLaporan;
use Flux\Flux;
use Illuminate\Database\Eloquent\Collection;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\On;
use Livewire\WithPagination;

class LaporanKegiatan extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $search = '';
    public $nama_kegiatan;
    public $tanggal_kegiatan;
    public $deskripsi_kegiatan;
    public $photos = [];
    public $editMode = false;
    public $laporanId;
    public $existingPhotos = [];
    public $deletedPhotos = []; // Untuk menampung ID foto yang dihapus
    public $perPage = 10;

    public ?ModelLaporanKegiatan $laporanDetail = null;
    public $Vnama_kegiatan;
    public $Vtanggal_kegiatan;
    public $Vdeskripsi_kegiatan;
    public $Vuser;
    public $Vcreated_at;
    public $Vphotos;
    public $Vjumlah_foto;

    protected $rules = [
        'nama_kegiatan' => 'required|min:5',
        'tanggal_kegiatan' => 'required|date',
        'deskripsi_kegiatan' => 'required|min:10',
        'photos.*' => 'image|max:2048', // 2MB Max
    ];

    public function removePhoto(int $index): void
    {
        if (isset($this->photos[$index])) {
            unset($this->photos[$index]);
            $this->photos = array_values($this->photos);
        }
    }

    public function save()
    {
        $this->validate();

        // Validasi jumlah foto
        $totalPhotos = count($this->photos);
        if ($totalPhotos > 5) {
            session()->flash('error', 'Maksimal upload 5 foto');
            return;
        }

        $laporan = ModelLaporanKegiatan::create([
            'nama_kegiatan' => $this->nama_kegiatan,
            'tanggal_kegiatan' => $this->tanggal_kegiatan,
            'deskripsi_kegiatan' => $this->deskripsi_kegiatan,
            'user_id' => Auth::id(),
        ]);

        // Simpan foto
        if (!empty($this->photos)) {
            foreach ($this->photos as $photo) {
                $path = $photo->store('dokumentasi-posyandu', 'public');

                DokumentasiLaporan::create([
                    'laporan_id' => $laporan->id_laporan,
                    'photo_path' => $path,
                ]);
            }
        }

        $this->resetInput();
        Flux::modals()->close();
        $this->dispatch(
            'alert',
            type: 'success',
            title: 'Sukses',
            text: "Laporan berhasil disimpan!"
        );
    }

    public function edit(ModelLaporanKegiatan $laporan)
    {
        Flux::modal('edit-laporan')->show();
        $this->laporanId = $laporan;
        $this->nama_kegiatan = $laporan->nama_kegiatan;
        $this->tanggal_kegiatan = $laporan->tanggal_kegiatan;
        $this->deskripsi_kegiatan = $laporan->deskripsi_kegiatan;
        $this->existingPhotos = $laporan->dokumentasi;
    }

    // public function update()
    // {
    //     $this->validate();

    //     // Hitung total foto yang akan disimpan
    //     $existingCount = count($this->existingPhotos);
    //     $newCount = count($this->photos);
    //     $totalCount = $existingCount + $newCount;

    //     if ($totalCount > 5) {
    //         session()->flash('error', 'Total foto tidak boleh lebih dari 5');
    //         return;
    //     }

    //     $this->laporanId->update([
    //         'nama_kegiatan' => $this->nama_kegiatan,
    //         'tanggal_kegiatan' => $this->tanggal_kegiatan,
    //         'deskripsi_kegiatan' => $this->deskripsi_kegiatan,
    //     ]);

    //     // Simpan foto baru
    //     if (!empty($this->photos)) {
    //         foreach ($this->photos as $photo) {
    //             $path = $photo->store('dokumentasi-posyandu', 'public');

    //             DokumentasiLaporan::create([
    //                 'laporan_id' => $this->laporanId->id_laporan,
    //                 'photo_path' => $path,
    //             ]);
    //         }
    //     }

    //     $this->resetInput();
    //     Flux::modals()->close();
    //     $this->dispatch('alert',
    //         type: 'success',
    //         title: 'Sukses',
    //         text: "Laporan berhasil diupdate!"
    //     );
    // }
    public function update()
    {
        DB::beginTransaction();

        try {
            $this->validate();

            // Hitung total foto yang akan disimpan
            $existingCount = count($this->existingPhotos);
            $newCount = count($this->photos);
            $totalCount = $existingCount + $newCount;

            if ($totalCount > 5) {
                Flux::modals()->close();
                $this->dispatch(
                    'alert',
                    type: 'error',
                    title: 'Error',
                    text: "Total foto tidak boleh lebih dari 5. Anda memiliki $existingCount foto yang sudah ada dan mencoba menambahkan $newCount foto baru.",
                    timer: 5000
                );
                return;
            }

            // Update data laporan
            $this->laporanId->update([
                'nama_kegiatan' => $this->nama_kegiatan,
                'tanggal_kegiatan' => $this->tanggal_kegiatan,
                'deskripsi_kegiatan' => $this->deskripsi_kegiatan,
            ]);

            // // Handle foto yang dihapus oleh user
            // if (!empty($this->deletedPhotos)) {
            //     foreach ($this->deletedPhotos as $photoId) {
            //         $photo = DokumentasiLaporan::find($photoId);
            //         if ($photo) {
            //             // Hapus file dari storage
            //             if (Storage::disk('public')->exists($photo->photo_path)) {
            //                 Storage::disk('public')->delete($photo->photo_path);
            //             }
            //             // Hapus record dari database
            //             $photo->delete();
            //         }
            //     }
            // }

            // Simpan foto baru
            $uploadedPhotos = [];
            if (!empty($this->photos)) {
                foreach ($this->photos as $photo) {
                    // Validasi apakah file adalah gambar
                    if (!$photo->isValid()) {
                        $this->dispatch(
                            'alert',
                            type: 'warning',
                            title: 'Peringatan',
                            text: "File foto tidak valid: " . $photo->getClientOriginalName()
                        );
                        continue;
                    }

                    // Validasi ukuran file (max 2MB)
                    if ($photo->getSize() > 2048 * 1024) {
                        $this->dispatch(
                            'alert',
                            type: 'warning',
                            title: 'Peringatan',
                            text: "File {$photo->getClientOriginalName()} terlalu besar. Maksimal 2MB."
                        );
                        continue;
                    }

                    $path = $photo->store('dokumentasi-posyandu', 'public');

                    $dokumentasi = DokumentasiLaporan::create([
                        'laporan_id' => $this->laporanId->id_laporan,
                        'photo_path' => $path,
                    ]);

                    $uploadedPhotos[] = $dokumentasi;
                }
            }

            DB::commit();

            $this->resetInput();
            Flux::modals()->close();

            $this->dispatch(
                'alert',
                type: 'success',
                title: 'Sukses',
                text: "Laporan '{$this->nama_kegiatan}' berhasil diupdate!" .
                    (!empty($uploadedPhotos) ? " {$newCount} foto berhasil ditambahkan." : "")
            );

        } catch (\Illuminate\Validation\ValidationException $e) {
            DB::rollBack();
            $this->dispatch(
                'alert',
                type: 'error',
                title: 'Validasi Error',
                text: $e->getMessage(),
                timer: 5000
            );
        } catch (\Exception $e) {
            DB::rollBack();
            $this->dispatch(
                'alert',
                type: 'error',
                title: 'Error',
                text: "Terjadi kesalahan saat mengupdate laporan: " . $e->getMessage(),
                timer: 5000
            );
        }
    }

    // Method untuk menandai foto yang akan dihapus
    public function markPhotoForDeletion($photoId)
    {
        $this->deletedPhotos[] = $photoId;

        // Hapus dari existingPhotos agar tidak dihitung dalam validasi
        $this->existingPhotos = array_filter($this->existingPhotos, function ($photo) use ($photoId) {
            return $photo['id'] != $photoId;
        });
    }

    public function confirmDelete(ModelLaporanKegiatan $id)
    {
        $this->dispatch(
            'confirmDelete',
            type: 'warning',
            title: 'Peringatan',
            text: "Apakah anda yakin ingin menghapus laporan!",
            id: $id->id_laporan
        );
    }

    #[On('delete')]
    public function delete(ModelLaporanKegiatan $id)
    {
        // Hapus foto terkait
        foreach ($id->dokumentasi as $dokumentasi) {
            Storage::disk('public')->delete($dokumentasi->photo_path);
            $dokumentasi->delete();
        }

        $id->delete();
        $this->dispatch(
            'alert',
            type: 'success',
            title: 'Sukses',
            text: "Laporan berhasil dihapus!"
        );
    }

    public function deletePhoto(DokumentasiLaporan $dokumentasi)
    {
        Storage::disk('public')->delete($dokumentasi->photo_path);
        $dokumentasi->delete();

        // Refresh existing photos
        $this->existingPhotos = DokumentasiLaporan::where('laporan_id', $this->laporanId)->get();
        session()->flash('message', 'Foto berhasil dihapus');
    }

    public function resetInput()
    {
        $this->nama_kegiatan = '';
        $this->tanggal_kegiatan = '';
        $this->deskripsi_kegiatan = '';
        $this->photos = [];
        $this->editMode = false;
        $this->laporanId = null;
        $this->existingPhotos = [];
    }

    public function render()
    {
        if ($this->search) {
            $laporans = ModelLaporanKegiatan::with('dokumentasi')
                ->where('user_id', Auth::id())
                ->where(function ($query) {
                    $query->where('nama_kegiatan', 'like', '%' . $this->search . '%')
                        ->orWhere('deskripsi_kegiatan', 'like', '%' . $this->search . '%');
                })
                ->latest()
                ->paginate($this->perPage);
        } else {
            $laporans = ModelLaporanKegiatan::with('dokumentasi')->where('user_id', Auth::id())->latest()->paginate($this->perPage);
        }
        return view('livewire.laporan-kegiatan', [
            'laporans' => $laporans
        ]);
    }

    public function view_laporan(ModelLaporanKegiatan $laporan)
    {
        Flux::modal('view-laporan')->show();
        $this->Vuser = $laporan->user->name;
        $this->Vnama_kegiatan = $laporan->nama_kegiatan;
        $this->Vtanggal_kegiatan = $laporan->tanggal_kegiatan;
        $this->Vdeskripsi_kegiatan = $laporan->deskripsi_kegiatan;
        $this->Vphotos = $laporan->dokumentasi;
        $this->Vjumlah_foto = $laporan->dokumentasi->count();
    }
}
