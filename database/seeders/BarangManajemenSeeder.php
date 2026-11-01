<?php

namespace Database\Seeders;

use App\Models\BarangManajemen;
use App\Models\Kader;
use App\Models\User;
use Illuminate\Database\Seeder;

class BarangManajemenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kader = Kader::first();
        $user = User::first();

        $idKader = $kader ? $kader->id_kader : null;
        $idKetua = $user ? $user->id_user : null;

        $barangList = [
            [
                'nama_barang' => 'PMT Biskuit Balita',
                'jumlah' => 120,
                'tanggal_masuk' => now()->subDays(15)->toDateString(),
                'kategori' => 'Suplemen Gizi',
                'harga' => 50000,
                'id_kader' => $idKader,
                'id_ketua' => $idKetua,
            ],
            [
                'nama_barang' => 'PMT Biskuit Ibu Hamil KEK',
                'jumlah' => 60,
                'tanggal_masuk' => now()->subDays(10)->toDateString(),
                'kategori' => 'Suplemen Gizi',
                'harga' => 65000,
                'id_kader' => $idKader,
                'id_ketua' => $idKetua,
            ],
            [
                'nama_barang' => 'Vitamin A Kapsul Biru (100.000 IU)',
                'jumlah' => 85,
                'tanggal_masuk' => now()->subDays(20)->toDateString(),
                'kategori' => 'Vitamin',
                'harga' => 10000,
                'id_kader' => $idKader,
                'id_ketua' => $idKetua,
            ],
            [
                'nama_barang' => 'Vitamin A Kapsul Merah (200.000 IU)',
                'jumlah' => 150,
                'tanggal_masuk' => now()->subDays(20)->toDateString(),
                'kategori' => 'Vitamin',
                'harga' => 12000,
                'id_kader' => $idKader,
                'id_ketua' => $idKetua,
            ],
            [
                'nama_barang' => 'Tablet Tambah Darah (TTD)',
                'jumlah' => 200,
                'tanggal_masuk' => now()->subDays(25)->toDateString(),
                'kategori' => 'Obat-obatan',
                'harga' => 15000,
                'id_kader' => $idKader,
                'id_ketua' => $idKetua,
            ],
            [
                'nama_barang' => 'Oralit Bubuk 200ml',
                'jumlah' => 90,
                'tanggal_masuk' => now()->subDays(30)->toDateString(),
                'kategori' => 'Obat-obatan',
                'harga' => 5000,
                'id_kader' => $idKader,
                'id_ketua' => $idKetua,
            ],
            [
                'nama_barang' => 'Zink Sulfat 20mg',
                'jumlah' => 45,
                'tanggal_masuk' => now()->subDays(18)->toDateString(),
                'kategori' => 'Obat-obatan',
                'harga' => 18000,
                'id_kader' => $idKader,
                'id_ketua' => $idKetua,
            ],
            [
                'nama_barang' => 'Strip Uji Gula Darah EasyTouch',
                'jumlah' => 0, // Sengaja 0 untuk menguji indikator stok habis
                'tanggal_masuk' => now()->subDays(40)->toDateString(),
                'kategori' => 'Alat Kesehatan',
                'harga' => 95000,
                'id_kader' => $idKader,
                'id_ketua' => $idKetua,
            ],
            [
                'nama_barang' => 'Pita Pengukur LILA Dewasa & Bayi',
                'jumlah' => 15,
                'tanggal_masuk' => now()->subDays(60)->toDateString(),
                'kategori' => 'Alat Kesehatan',
                'harga' => 25000,
                'id_kader' => $idKader,
                'id_ketua' => $idKetua,
            ],
        ];

        foreach ($barangList as $data) {
            BarangManajemen::create($data);
        }
    }
}

