<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\DashboardController;
use App\Http\Controllers\Api\WargaController;
use App\Http\Controllers\Api\PemeriksaanController;
use App\Http\Controllers\Api\JadwalController;
use App\Http\Controllers\Api\ProdukController;
use App\Http\Controllers\Api\ArtikelController;

/*
|--------------------------------------------------------------------------
| REST API Routes untuk Mobile Client (Kotlin Jetpack Compose)
|--------------------------------------------------------------------------
*/

// 1. Autentikasi Mobile (Kader, User, Warga)
Route::prefix('auth')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout']);
});

// 2. Dashboard & Ringkasan Mobile
Route::get('/dashboard', [DashboardController::class, 'index']);

// 3. Manajemen Warga Sasaran (Balita, Bumil, Remaja, Lansia)
Route::prefix('warga')->group(function () {
    Route::get('/', [WargaController::class, 'index']);
    Route::post('/', [WargaController::class, 'store']);
    Route::get('/{nik}', [WargaController::class, 'show']);
    Route::put('/{nik}', [WargaController::class, 'update']);
});

// 4. Pencatatan Fisik & Rekam Medis Antropometri
Route::prefix('pemeriksaan')->group(function () {
    // Balita
    Route::post('/balita', [PemeriksaanController::class, 'storeBalita']);
    Route::get('/balita', [PemeriksaanController::class, 'historyBalita']);

    // Ibu Hamil
    Route::post('/bumil', [PemeriksaanController::class, 'storeBumil']);
    Route::get('/bumil', [PemeriksaanController::class, 'historyBumil']);

    // Remaja
    Route::post('/remaja', [PemeriksaanController::class, 'storeRemaja']);
    Route::get('/remaja', [PemeriksaanController::class, 'historyRemaja']);

    // Lansia
    Route::post('/lansia', [PemeriksaanController::class, 'storeLansia']);
    Route::get('/lansia', [PemeriksaanController::class, 'historyLansia']);
});

// 5. Jadwal Posyandu
Route::prefix('jadwal')->group(function () {
    Route::get('/', [JadwalController::class, 'index']);
    Route::post('/', [JadwalController::class, 'store']);
    Route::get('/{id}', [JadwalController::class, 'show']);
});

// 6. Logistik & PMT / Obat
Route::prefix('produk')->group(function () {
    Route::get('/', [ProdukController::class, 'index']);
    Route::get('/{id}', [ProdukController::class, 'show']);
});

// 7. Artikel & Edukasi Kesehatan
Route::prefix('artikel')->group(function () {
    Route::get('/', [ArtikelController::class, 'index']);
    Route::get('/{id}', [ArtikelController::class, 'show']);
});

