<?php

use App\Livewire\Admin\KelolaAdmin;
use App\Livewire\Admin\KelolaKader;
use App\Livewire\Admin\KelolaPemdes;
use App\Livewire\Admin\KelolaUser;
use App\Livewire\HomePage;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use Illuminate\Support\Facades\Route;

Route::get('/', function(){
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::middleware('isAdmin')->prefix('admin')->group(function() {
        Route::get('kelola-user', KelolaUser::class)->name('admin.kelola-user');
        Route::get('kelola-admin', KelolaAdmin::class)->name('admin.kelola-admin');
        Route::get('kelola-kader', KelolaKader::class)->name('admin.kelola-kader');
        Route::get('kelola-pemdes', KelolaPemdes::class)->name('admin.kelola-pemdes');
    });

    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
});

require __DIR__.'/auth.php';
