<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StatusController;

Route::get('/', [AdminController::class, 'login'])->name('login');

// Error & HTTP Status Code Landing Page
Route::get('/status', [StatusController::class, 'index'])->name('status.index');
Route::get('/status/{code}', [StatusController::class, 'index'])->name('status.show');
Route::get('/status/simulate/{code}', [StatusController::class, 'simulate'])->name('status.simulate');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    
    // Warga
    Route::get('/pendaftaran', [AdminController::class, 'pendaftaran'])->name('pendaftaran');
    Route::post('/warga', [AdminController::class, 'wargaStore'])->name('warga.store');
    Route::get('/daftar-anggota', [AdminController::class, 'daftarAnggota'])->name('daftar-anggota');
    Route::get('/profil/{nik}', [AdminController::class, 'profil'])->name('profil');

    // Pemeriksaan Fisik
    Route::get('/pemeriksaan', [AdminController::class, 'pemeriksaan'])->name('pemeriksaan');
    Route::post('/pemeriksaan', [AdminController::class, 'pemeriksaanStore'])->name('pemeriksaan.store');

    // Artikel / Edukasi Kesehatan Masyarakat
    Route::get('/manajemen-artikel', [AdminController::class, 'manajemenArtikel'])->name('manajemen-artikel');
    Route::post('/artikel', [AdminController::class, 'artikelStore'])->name('artikel.store');

    // Laporan Kesehatan & Stunting
    Route::get('/laporan-kesehatan', [AdminController::class, 'laporanKesehatan'])->name('laporan-kesehatan');

    // Pengaturan Akun, Profil, Keamanan (Password, 2FA/TFA), & Posko
    Route::get('/pengaturan-akun', [AdminController::class, 'pengaturanAkun'])->name('pengaturan-akun');
    Route::post('/pengaturan-akun/profil', [AdminController::class, 'updateProfilAkun'])->name('pengaturan-akun.profil');
    Route::post('/pengaturan-akun/password', [AdminController::class, 'updatePasswordAkun'])->name('pengaturan-akun.password');
    Route::post('/pengaturan-akun/tfa', [AdminController::class, 'toggleTfa'])->name('pengaturan-akun.tfa');
    Route::post('/pengaturan-akun/posko', [AdminController::class, 'updatePosko'])->name('pengaturan-akun.posko');
    Route::post('/pengaturan-akun/logout-sesi', [AdminController::class, 'logoutOtherSessions'])->name('pengaturan-akun.logout-sesi');
});
