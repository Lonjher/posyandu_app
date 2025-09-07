<?php

namespace App\Livewire\Admin;

use App\Models\User;
use App\Services\FonnteService;
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
    public ?User $editedUser = null;
    public $chatUser;

    public $tanggalAgenda;
    public $waktuAgenda;
    public $agenda;
    public $bulkChatMessage;

    public $bulkUsers = [];
    public $selectedUsers = [];
    public $selectAll = false;

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

        $this->bulkUsers = $users->items();

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
            'confirmDelete',
            type: 'warning',
            title: "Peringatan",
            text: "Apakah anda yakin ingin menghapus User ini!?",
            id: $user->id_user,
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
                timer: 5000
            );
            return;
        }
    }

    public function edit(User $user)
    {
        $this->editedUser = $user;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->nik = $user->nik;
        $this->no_hp = $user->no_hp;
        $this->alamat = $user->alamat;
        $this->jenis_kelamin = $user->jenis_kelamin;
        $this->kategori = $user->kategori;
        $this->tanggal_lahir = $user->tanggal_lahir;
        FLux::modal('edit-user')->show();
    }

    public function confirmResetPassword(User $user)
    {
        $this->dispatch(
            'confirmResetPassword',
            type: 'warning',
            title: 'Peringatan',
            text: 'Apakah anda ingin Mereset password untuk akun ini?',
            id: $user->id_user
        );
    }

    #[On('resetPassword')]
    public function resetPassword(User $id)
    {
        $password = Hash::make(str_replace('-', '', $id->tanggal_lahir));
        try {

            $id->update([
                'password' => $password
            ]);
            $this->dispatch(
                'alert',
                type: 'success',
                title: 'Sukses',
                text: 'Password berhasil direset!',
            );
        } catch (\Exception $e) {
            $this->dispatch(
                'alert',
                type: 'error',
                title: 'Error',
                text: 'Ada masalah ' . $e->getMessage(),
            );
        }
    }

    public function update()
    {

        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'nik' => ['required', 'string', 'max:16'],
            'no_hp' => ['required', 'string', 'max:15'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255'],
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
        try {
            $this->editedUser->update($validated);
            Flux::modals()->close();
            $this->dispatch(
                'alert',
                type: 'success',
                title: 'Sukses!',
                text: 'Data berhasil diupdate!',
            );
        } catch (\Exception $e) {
            Flux::modals()->close();
            $this->dispatch(
                'alert',
                type: 'error',
                title: 'Error!',
                text: 'Ada yang salah ' . $e->getMessage(),
                timer: 5000
            );
        }
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

    public function open_chat(User $user)
    {
        $this->chatUser = $user;
        Flux::modal("open-chat")->show();
    }

    public function chat_notif()
    {

        $validated = $this->validate([
            'tanggalAgenda' => 'required|date',
            'waktuAgenda' => 'required|date_format:H:i',
            'agenda' => 'required|string|max:255',
        ]);

        $templateMessage = "INFORMASI KEGIATAN POSYANDU

Assalamu'alaikum Warahmatullahi Wabarakatuh

Kami mengundang Bapak/Ibu untuk hadir dalam kegiatan Posyandu:

📅 *Hari/Tanggal*
" . \Carbon\Carbon::parse($validated['tanggalAgenda'])->translatedFormat('l, d F Y') . "

⏰ *Waktu*
" . date('H:i', strtotime($validated['waktuAgenda'])) . " WIB

📋 *Agenda*
" . $validated['agenda'] . "

📍 *Tempat*
Posyandu Desa Ketawang Karay


Wassalamu'alaikum Warahmatullahi Wabarakatuh
----------------------------
Mohon hadir tepat waktu
Atas perhatiannya kami ucapkan terima kasih 🙏";

        try {
            $service = new FonnteService();
            $service->sendMessage($this->chatUser->no_hp, $templateMessage, '2');
            Flux::modals()->close();
            $this->dispatch(
                'alert',
                type: 'success',
                title: 'Sukses',
                text: 'Pesan berhasil dikirim!',
            );
        } catch (\Exception $e) {
            Flux::modals()->close();
            $this->dispatch(
                'alert',
                type: 'error',
                title: 'Error',
                text: 'Ada yang salah ' . $e->getMessage(),
                timer: 5000
            );
        }
    }

    // Fungsi Mengirim Bulk Chat
    public function sendBulkChat()
    {
        $validated = $this->validate([
            'tanggalAgenda' => 'required|date',
            'waktuAgenda' => 'required|date_format:H:i',
            'agenda' => 'required|string|max:255',
        ]);

        $templateMessage = "INFORMASI KEGIATAN POSYANDU

Assalamu'alaikum Warahmatullahi Wabarakatuh

Kami mengundang Bapak/Ibu untuk hadir dalam kegiatan Posyandu:

📅 *Hari/Tanggal*
" . \Carbon\Carbon::parse($validated['tanggalAgenda'])->translatedFormat('l, d F Y') . "

⏰ *Waktu*
" . date('H:i', strtotime($validated['waktuAgenda'])) . " WIB

📋 *Agenda*
" . $validated['agenda'] . "

📍 *Tempat*
Posyandu Desa Ketawang Karay


Wassalamu'alaikum Warahmatullahi Wabarakatuh
----------------------------
Mohon hadir tepat waktu
Atas perhatiannya kami ucapkan terima kasih 🙏";

        $no = [];
        $no = implode(',', $this->selectedUsers);
        try {
            $service = new FonnteService();
            $service->sendMessage($no, $templateMessage, '2');
            Flux::modals()->close();
            $this->dispatch(
                'alert',
                type: 'success',
                title: 'Sukses',
                text: 'Pesan berhasil dikirim!',
            );
        } catch (\Exception $e) {
            Flux::modals()->close();
            $this->dispatch(
                'alert',
                type: 'error',
                title: 'Error',
                text: 'Ada yang salah ' . $e->getMessage(),
                timer: 5000
            );
        }
    }

    // Method untuk membuka modal bulk chat
    public function openBulkChat()
    {
        if (count($this->selectedUsers) > 0) {
            Flux::modal("bulk-chat")->show();
        } else {
            $this->dispatch(
                'alert',
                type: 'warning',
                title: 'Peringatan',
                text: 'Pilih setidaknya satu user untuk mengirim pesan.',
                timer: 3000
            );
        }
    }

    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->selectedUsers = collect($this->bulkUsers)->pluck('no_hp')->map(function ($no_hp) {
                return (string) $no_hp;
            })->toArray();
        } else {
            $this->selectedUsers = [];
        }
    }

    public function updatedSelectedUsers()
    {
        $this->selectAll = false;
    }

    public function bulkResetPassword()
    {
        if (empty($this->selectedUsers)) {
            $this->dispatch(
                'alert',
                type: 'warning',
                title: 'Peringatan',
                text: 'Pilih setidaknya satu user untuk reset password.',
                timer: 3000
            );
            return;
        }

        // Dispatch event ke JavaScript untuk menampilkan SweetAlert2
        $this->dispatch('show-bulk-reset-confirmation', selectedUsers: $this->selectedUsers);
    }

    #[On('execute-bulk-reset-password')]
    public function executeBulkResetPassword($selectedUsers)
    {
        try {
            $resetCount = 0;
            $failedCount = 0;

            foreach ($selectedUsers as $userId) {
                $user = User::find($userId);
                if ($user) {
                    // Reset password ke tanggal lahir (format: ddmmyyyy)
                    $password = $user->tanggal_lahir
                        ? str_replace('-', '', $user->tanggal_lahir)
                        : 'password123'; // Fallback jika tanggal lahir tidak ada

                    $user->password = Hash::make($password);
                    $user->save();
                    $resetCount++;
                } else {
                    $failedCount++;
                }
            }

            $this->selectedUsers = [];
            $this->selectAll = false;

            if ($failedCount > 0) {
                $this->dispatch(
                    'alert',
                    type: 'warning',
                    title: 'Sebagian Berhasil',
                    text: 'Password berhasil direset untuk ' . $resetCount . ' user, tetapi ' . $failedCount . ' user gagal. Password default: tanggal lahir (ddmmyyyy).',
                    timer: 6000
                );
            } else {
                $this->dispatch(
                    'alert',
                    type: 'success',
                    title: 'Berhasil',
                    text: 'Password berhasil direset untuk ' . $resetCount . ' user. Password default: tanggal lahir (ddmmyyyy).',
                    timer: 5000
                );
            }

        } catch (\Exception $e) {
            $this->dispatch(
                'alert',
                type: 'error',
                title: 'Error',
                text: 'Terjadi kesalahan: ' . $e->getMessage(),
                timer: 5000
            );
        }
    }

    // Untuk reset password single user
    public function confirmBulkResetPassword($userId = null)
    {
        if ($userId) {
            $this->selectedUsers = [$userId];
        }

        $this->dispatch('show-bulk-reset-confirmation', selectedUsers: $this->selectedUsers);
    }
}
