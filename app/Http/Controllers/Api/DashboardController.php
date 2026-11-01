<?php

namespace App\Http\Controllers\Api;

use App\Models\BarangManajemen;
use App\Models\JadwalPosyandu;
use App\Models\Warga;
use Illuminate\Http\JsonResponse;

class DashboardController extends BaseApiController
{
    /**
     * Mengambil ringkasan statistik dan aktivitas untuk Mobile Home.
     */
    public function index(): JsonResponse
    {
        $stats = [
            'total_warga' => Warga::count(),
            'balita'      => Warga::where('status', 'Balita')->count(),
            'ibu_hamil'   => Warga::where('status', 'Ibu Hamil')->count(),
            'remaja'      => Warga::where('status', 'Remaja')->count(),
            'lansia'      => Warga::where('status', 'Lansia')->count(),
        ];

        $jadwalTerdekat = JadwalPosyandu::with('kader')
            ->where('status_pelaksanaan', 'belum')
            ->orderBy('tanggal_pelaksanaan', 'asc')
            ->take(3)
            ->get();

        $stokMenipis = BarangManajemen::where('jumlah', '<', 10)->count();

        $wargaTerbaru = Warga::orderBy('created_at', 'desc')->take(5)->get();

        return $this->sendResponse([
            'stats'            => $stats,
            'jadwal_mendatang' => $jadwalTerdekat,
            'stok_kritis'      => $stokMenipis,
            'warga_terbaru'    => $wargaTerbaru,
        ], 'Ringkasan dashboard mobile berhasil diambil.');
    }
}

