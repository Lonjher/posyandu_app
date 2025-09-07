<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.auth')]
class Register extends Component
{
    public string $name = '';

    public string $nik = '';

    public string $no_hp = '';

    public string $email = '';

    public string $alamat = '';

    public string $tanggal_lahir = '';

    public string $jenis_kelamin = '';

    public string $password = '';

    public string $password_confirmation = '';

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'nik' => ['required', 'string', 'max:16', 'unique:' . User::class],
            'no_hp' => ['required', 'string', 'max:15'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
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
            // Password
            'password.required' => 'Kata sandi wajib diisi.',
            'password.confirmed' => 'Konfirmasi kata sandi tidak sesuai.',
            // Alamat
            'alamat.required' => 'Alamat lengkap wajib diisi.',
            'alamat.max' => 'Alamat tidak boleh lebih dari 255 karakter.',
            // Tanggal Lahir
            'tanggal_lahir.date' => 'Tanggal lahir harus berupa format tanggal yang valid.',
            // Jenis Kelamin
            'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih.',
            'jenis_kelamin.in' => 'Jenis kelamin hanya boleh Laki-laki atau Perempuan.',
            // Kategori
            'kategori.required' => 'Kategori wajib dipilih.',
            'kategori.in' => 'Kategori tidak sesuai.',
        ]);


        $validated['password'] = Hash::make($validated['password']);
        $validated['role'] = 'user';
        event(new Registered(($user = User::create($validated))));

        Auth::login($user);

        $this->redirect(route('dashboard', absolute: false), navigate: true);
    }
}
