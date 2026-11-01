<?php

namespace Database\Seeders;

use App\Models\BarangManajemen;
use App\Models\LaporanPenjualan;
use App\Models\User;
use Illuminate\Database\Seeder;

class LaporanPenjualanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::first();
        $idKetua = $user ? $user->id_user : null;

        $pmtBalita = BarangManajemen::where('nama_barang', 'like', '%PMT Biskuit Balita%')->first();
        $ttd = BarangManajemen::where('nama_barang', 'like', '%Tablet Tambah Darah%')->first();
        $vitA = BarangManajemen::where('nama_barang', 'like', '%Vitamin A Kapsul Merah%')->first();

        $penjualanList = [
            [
                'nominal' => $pmtBalita ? $pmtBalita->harga : 50000,
                'jumlah_barang' => 15,
                'tanggal_keluar' => now()->subDays(12)->toDateString(),
                'total_harga' => ($pmtBalita ? $pmtBalita->harga : 50000) * 15,
                'id_barang' => $pmtBalita ? $pmtBalita->id_barang : null,
                'id_ketua' => $idKetua,
            ],
            [
                'nominal' => $ttd ? $ttd->harga : 15000,
                'jumlah_barang' => 30,
                'tanggal_keluar' => now()->subDays(8)->toDateString(),
                'total_harga' => ($ttd ? $ttd->harga : 15000) * 30,
                'id_barang' => $ttd ? $ttd->id_barang : null,
                'id_ketua' => $idKetua,
            ],
            [
                'nominal' => $vitA ? $vitA->harga : 12000,
                'jumlah_barang' => 25,
                'tanggal_keluar' => now()->subDays(4)->toDateString(),
                'total_harga' => ($vitA ? $vitA->harga : 12000) * 25,
                'id_barang' => $vitA ? $vitA->id_barang : null,
                'id_ketua' => $idKetua,
            ],
        ];

        foreach ($penjualanList as $data) {
            LaporanPenjualan::create($data);
        }
    }
}

