<?php


use App\Livewire\Admin\Edukasi;
use App\Livewire\Admin\KelolaAdmin;
use App\Livewire\Admin\KelolaKader;
use App\Livewire\Admin\KelolaPemdes;
use App\Livewire\Admin\KelolaUser;
use App\Livewire\LaporanKegiatan;
use App\Livewire\Pemdes\ViewLaporan;
use App\Livewire\Pemeriksaan\Bumil;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use App\Livewire\User\EdukasiByKategori;
use App\Models\Edukasi as ModelsEdukasi;
use Illuminate\Support\Facades\Route;

Route::get('/', function(){
    $categories = [
            'anak' => 'Anak',
            'bumil' => 'Ibu Hamil',
            'lansia' => 'Lansia',
            'umum' => 'Umum'
        ];

        $latestEdukasi = ModelsEdukasi::with('user')
            ->orderBy('created_at', 'desc')
            ->take(6)
            ->get();
    return view('welcome', compact('categories', 'latestEdukasi'));
})->name('home');

Route::get('/edukasi/{kategori}', EdukasiByKategori::class)->name('adukasi.kategori');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::middleware('isAdmin')->prefix('admin')->group(function() {
        Route::get('kelola-user', KelolaUser::class)->name('admin.kelola-user');
        Route::get('kelola-admin', KelolaAdmin::class)->name('admin.kelola-admin');
        Route::get('kelola-kader', KelolaKader::class)->name('admin.kelola-kader');
        Route::get('kelola-pemdes', KelolaPemdes::class)->name('admin.kelola-pemdes');
        Route::get('laporan-kegiatan', LaporanKegiatan::class)->name('view.laporan-kegiatan');
        Route::get('edukasi', Edukasi::class)->name('view.edukasi');
    });

    Route::middleware('isAdminBidanKader')->prefix('pemeriksaan')->group(function() {
        Route::get('bumil', Bumil::class)->name('pemeriksaan.bumil');
    });

    Route::middleware('isPemdes')->prefix('pemdes')->group(function() {
        Route::get('laporan-kegiatan', ViewLaporan::class)->name('pemdes.laporan-kegiatan');
    });
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
});

require __DIR__.'/auth.php';
