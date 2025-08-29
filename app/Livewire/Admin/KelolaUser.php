<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Flux\Flux;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class KelolaUser extends Component
{
    use WithPagination;
    public $search = '';
    public $perPage = 10;
    public $sortField = 'id_user';
    public $sortDirection = 'desc';

    public $name;
    public $email;
    public $nik;
    public $no_hp;
    public $alamat;
    public $jenis_kelamin;
    public $kategori;
    public $tanggal_lahir;
    public $role;

    public function render()
    {
        $query = User::onlyUser();

        if ($this->search) {
            $users = $query->where(function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('email', 'like', '%' . $this->search . '%')
                    ->orWhere('nik', 'like', '%' . $this->search . '%');
            })->paginate($this->perPage);
        } else {
            $users = $query->latest()
                ->paginate($this->perPage);
        }

        return view('livewire.admin.kelola-user', [
            'users' => $users
        ]);
    }

    public function store()
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'nik' => ['required', 'string', 'max:16', 'unique:' . User::class],
            'no_hp' => ['required', 'string', 'max:15'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'alamat' => ['required', 'string', 'max:255'],
            'tanggal_lahir' => ['nullable', 'date'],
            'jenis_kelamin' => ['required', 'in:L,P'], // Laki-laki / Perempuan
            'kategori' => ['required', 'in:bumil,anak,lansia'], // Ibu hamil / Anak / Lansia
        ], [
            // Name
            'name.required' => 'Nama lengkap wajib diisi.',
            'name.max' => 'Nama lengkap tidak boleh lebih dari 255 karakter.',
            // NIK
            'nik.required' => 'Nomor Induk Kependudukan (NIK) wajib diisi.',
            'nik.max' => 'NIK tidak boleh lebih dari 16 digit.',
            'nik.unique' => 'NIK sudah terdaftar, silakan gunakan NIK lain.',
            // No HP
            'no_hp.required' => 'Nomor WhatsApp wajib diisi.',
            'no_hp.max' => 'Nomor WhatsApp tidak boleh lebih dari 15 digit.',
            // Email
            'email.required' => 'Alamat email wajib diisi.',
            'email.email' => 'Format alamat email tidak valid.',
            'email.max' => 'Alamat email tidak boleh lebih dari 255 karakter.',
            'email.unique' => 'Alamat email sudah terdaftar, silakan gunakan email lain.',
            // Alamat
            'alamat.required' => 'Alamat lengkap wajib diisi.',
            'alamat.max' => 'Alamat tidak boleh lebih dari 255 karakter.',
            // Tanggal Lahir
            'tanggal_lahir.date' => 'Tanggal lahir harus berupa format tanggal yang valid.',
            // Jenis Kelamin
            'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih.',
            'jenis_kelamin.in' => 'Jenis kelamin hanya boleh Laki-laki atau Perempuan.',
            'kategori.required' => 'Kategori wajib dipilih.',
            'kategori.in' => 'Kategori tidak valid!.',
        ]);

        $validated['password'] = Hash::make(str_replace('-', '', $this->tanggal_lahir));
        $validated['role'] = 'user';
        try {
            User::create($validated);
            $this->resetForm();
            Flux::modals()->close();
            $this->dispatch(
                'alert',
                type: 'success',
                title: "Sukses",
                text: "User berhasil ditambahkan.",
            );
        } catch (\Exception $e) {
            $this->resetForm();
            Flux::modals()->close();
            $this->dispatch(
                'alert',
                type: 'error',
                title: "Gagal",
                text: $e->getMessage(),
                timer: 5000
            );
            return;
        }
    }

    public function resetForm()
    {
        $this->reset([
            'name',
            'email',
            'nik',
            'no_hp',
            'alamat',
            'jenis_kelamin',
            'kategori',
            'tanggal_lahir',
            'role',
        ]);
        $this->resetErrorBag();
    }

    public function confirmDelete(User $user)
    {
        $this->dispatch(
            'alert',
            type: 'info',
            title: "Informasi",
            text: "Fitur ini akan segera hadir!",
        );
    }

    #[On('delete')]
    public function delete(User $id)
    {
        try {
            $id->delete();
            $this->dispatch(
                'alert',
                type: 'success',
                title: "Sukses",
                text: "Data pemdes berhasil dihapus.",
            );
        } catch (\Exception $e) {
            $this->dispatch(
                'alert',
                type: 'error',
                title: "Gagal",
                text: $e->getMessage(),
                times: 5000
            );
            return;
        }
    }

    public function confirm_reset_password(User $user)
    {
        $this->dispatch(
            'alert',
            type: 'info',
            title: 'Informasi!',
            text: 'Fitur ini akan segera hadir!',
            timer: 4000
        );
    }

    public  function edit(){
        $this->dispatch(
            'alert',
            type: 'info',
            title: 'Informasi!',
            text: 'Fitur ini akan segera hadir!',
            timer: 4000
        );
    }

    public function export()
    {
        $this->dispatch(
            'alert',
            type: 'info',
            title: 'Informasi!',
            text: 'Fitur ini akan segera hadir!',
            timer: 4000
        );
    }
}
