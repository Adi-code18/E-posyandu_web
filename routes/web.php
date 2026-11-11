<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StatusController;

// Rute Autentikasi Publik
Route::get('/', [AdminController::class, 'login'])->name('login');
Route::post('/login', [AdminController::class, 'loginProcess'])->name('login.post');
Route::post('/logout', [AdminController::class, 'logout'])->name('logout');

// Error & HTTP Status Code Landing Page
Route::get('/status', [StatusController::class, 'index'])->name('status.index');
Route::get('/status/{code}', [StatusController::class, 'index'])->name('status.show');
Route::get('/status/simulate/{code}', [StatusController::class, 'simulate'])->name('status.simulate');

// Grup Rute Terproteksi Autentikasi & RBAC (Role-Based Access Control)
Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    // 1. Dashboard Utama (Semua Peran: Admin, Ketua, Bidan, Kader)
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    
    // 2. Data Kependudukan & Sasaran
    Route::get('/daftar-anggota', [AdminController::class, 'daftarAnggota'])->name('daftar-anggota');
    Route::get('/profil/{nik}', [AdminController::class, 'profil'])->name('profil');

    // 3. Pendaftaran Sasaran Baru (Khusus: Administrator & Kader Lapangan)
    Route::middleware('role:admin,kader')->group(function () {
        Route::get('/pendaftaran', [AdminController::class, 'pendaftaran'])->name('pendaftaran');
        Route::post('/warga', [AdminController::class, 'wargaStore'])->name('warga.store');
    });

    // 4. Pemeriksaan Fisik, Antropometri & Evaluasi KKA (Bidan, Kader, Admin)
    Route::middleware('role:admin,bidan,kader')->group(function () {
        Route::get('/pemeriksaan', [AdminController::class, 'pemeriksaan'])->name('pemeriksaan');
        Route::post('/pemeriksaan', [AdminController::class, 'pemeriksaanStore'])->name('pemeriksaan.store');
        Route::post('/kka', [AdminController::class, 'kkaStore'])->name('kka.store');
        Route::post('/kontrol-ttd', [AdminController::class, 'kontrolTtdStore'])->name('kontrol-ttd.store');
    });

    // 5. Kunjungan Rumah (Home Visit ILP Kemenkes - Input oleh Kader, Supervisi oleh Ketua & Bidan)
    Route::get('/kunjungan-rumah', [AdminController::class, 'kunjunganRumah'])->name('kunjungan-rumah');
    Route::post('/kunjungan-rumah', [AdminController::class, 'kunjunganRumahStore'])->name('kunjungan-rumah.store');

    // 6. Artikel & Edukasi Kesehatan (Admin, Bidan, Kader)
    Route::get('/manajemen-artikel', [AdminController::class, 'manajemenArtikel'])->name('manajemen-artikel');
    Route::post('/artikel', [AdminController::class, 'artikelStore'])->name('artikel.store');

    // 7. Laporan Kesehatan & Stunting (Semua Peran)
    Route::get('/laporan-kesehatan', [AdminController::class, 'laporanKesehatan'])->name('laporan-kesehatan');

    // 8. Pengaturan Akun, Profil Pribadi & Keamanan 2FA (Semua Peran)
    Route::get('/pengaturan-akun', [AdminController::class, 'pengaturanAkun'])->name('pengaturan-akun');
    Route::post('/pengaturan-akun/profil', [AdminController::class, 'updateProfilAkun'])->name('pengaturan-akun.profil');
    Route::post('/pengaturan-akun/password', [AdminController::class, 'updatePasswordAkun'])->name('pengaturan-akun.password');
    Route::post('/pengaturan-akun/tfa', [AdminController::class, 'toggleTfa'])->name('pengaturan-akun.tfa');
    Route::post('/pengaturan-akun/logout-sesi', [AdminController::class, 'logoutOtherSessions'])->name('pengaturan-akun.logout-sesi');

    // 9. Konfigurasi Posko Posyandu (Khusus: Administrator & Ketua Posyandu)
    Route::middleware('role:admin,ketua')->group(function () {
        Route::post('/pengaturan-akun/posko', [AdminController::class, 'updatePosko'])->name('pengaturan-akun.posko');
    });
});
