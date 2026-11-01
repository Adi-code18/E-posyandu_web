<?php

namespace Database\Seeders;

use App\Models\TabelKasMasuk;
use App\Models\User;
use Illuminate\Database\Seeder;

class TabelKasMasukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::first();
        $idKetua = $user ? $user->id_user : null;

        $kasList = [
            [
                'total_dana_dikelola' => 5000000,
                'status_laporan' => 'terverifikasi',
                'tanggal_terima_dana' => now()->startOfMonth()->toDateString(),
                'nama_sumber' => 'Alokasi Dana Desa (ADD) Posyandu',
                'ket_penggunaan_dana' => 'Pengadaan PMT bergizi balita stunting & logistik operasional posyandu triwulan 4.',
                'id_ketua' => $idKetua,
            ],
            [
                'total_dana_dikelola' => 2500000,
                'status_laporan' => 'terverifikasi',
                'tanggal_terima_dana' => now()->subMonth()->startOfMonth()->toDateString(),
                'nama_sumber' => 'Bantuan Operasional Kesehatan (BOK) Puskesmas',
                'ket_penggunaan_dana' => 'Insentif transportasi kader posyandu dan penyuluhan gizi balita.',
                'id_ketua' => $idKetua,
            ],
            [
                'total_dana_dikelola' => 1250000,
                'status_laporan' => 'terverifikasi',
                'tanggal_terima_dana' => now()->subDays(10)->toDateString(),
                'nama_sumber' => 'Iuran Swadaya Warga Posyandu',
                'ket_penggunaan_dana' => 'Kas sukarela warga untuk perlengkapan cuci tangan, tisu, dan kudapan sehat balita.',
                'id_ketua' => $idKetua,
            ],
            [
                'total_dana_dikelola' => 3700000,
                'status_laporan' => 'pending',
                'tanggal_terima_dana' => now()->toDateString(),
                'nama_sumber' => 'Bantuan CSR Peduli Balita Sehat PT Sejahtera',
                'ket_penggunaan_dana' => 'Bantuan vitamin, susu pertumbuhan, dan paket sembako ibu hamil risiko tinggi.',
                'id_ketua' => $idKetua,
            ],
        ];

        foreach ($kasList as $data) {
            TabelKasMasuk::create($data);
        }
    }
}

