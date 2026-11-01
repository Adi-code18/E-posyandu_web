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

    // Produk / Logistik
    Route::get('/manajemen-produk', [AdminController::class, 'manajemenProduk'])->name('manajemen-produk');
    Route::post('/produk', [AdminController::class, 'produkStore'])->name('produk.store');

    // Artikel / Edukasi
    Route::get('/manajemen-artikel', [AdminController::class, 'manajemenArtikel'])->name('manajemen-artikel');
    Route::post('/artikel', [AdminController::class, 'artikelStore'])->name('artikel.store');

    // Laporan
    Route::get('/laporan-keuangan', [AdminController::class, 'laporanKeuangan'])->name('laporan-keuangan');
    Route::get('/laporan-kesehatan', [AdminController::class, 'laporanKesehatan'])->name('laporan-kesehatan');
});
