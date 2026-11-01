<?php

namespace Database\Seeders;

use App\Models\LaporanKesehatan;
use App\Models\PemeriksaanBalita;
use App\Models\User;
use Illuminate\Database\Seeder;

class LaporanKesehatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::first();
        $idKetua = $user ? $user->id_user : null;

        $periksaBalita = PemeriksaanBalita::first();
        $idPeriksa = $periksaBalita ? $periksaBalita->id_periksa : null;

        $laporanList = [
            [
                'jenis_laporan' => 'Rekapitulasi Penimbangan & Status Gizi Balita Bulanan',
                'tanggal_dibuat' => now()->startOfMonth()->toDateString(),
                'id_periksa' => $idPeriksa,
                'id_ketua' => $idKetua,
            ],
            [
                'jenis_laporan' => 'Laporan Pemantauan Ibu Hamil & Skrining Kurang Energi Kronis (KEK)',
                'tanggal_dibuat' => now()->subMonth()->startOfMonth()->toDateString(),
                'id_periksa' => $idPeriksa,
                'id_ketua' => $idKetua,
            ],
            [
                'jenis_laporan' => 'Laporan Skrining Kesehatan Penyakit Tidak Menular (PTM) Lansia',
                'tanggal_dibuat' => now()->subMonth()->addDays(15)->toDateString(),
                'id_periksa' => $idPeriksa,
                'id_ketua' => $idKetua,
            ],
            [
                'jenis_laporan' => 'Rekapitulasi Distribusi Tablet Tambah Darah Remaja Putri',
                'tanggal_dibuat' => now()->subDays(5)->toDateString(),
                'id_periksa' => $idPeriksa,
                'id_ketua' => $idKetua,
            ],
        ];

        foreach ($laporanList as $data) {
            LaporanKesehatan::create($data);
        }
    }
}

