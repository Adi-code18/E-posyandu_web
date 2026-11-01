<?php

namespace Database\Seeders;

use App\Models\JadwalPosyandu;
use App\Models\Kader;
use App\Models\Warga;
use Illuminate\Database\Seeder;

class JadwalPosyanduSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kader = Kader::first();
        $idKader = $kader ? $kader->id_kader : null;

        $balita1 = Warga::where('status', 'Balita')->first();
        $balita2 = Warga::where('status', 'Balita')->skip(1)->first();

        $jadwalList = [
            [
                'tanggal_pelaksanaan' => now()->subDays(14)->toDateString(),
                'kegiatan_pelaksanaan' => 'Penimbangan Balita, Pengukuran Tinggi Badan, dan Imunisasi Dasar Lengkap.',
                'status_pelaksanaan' => 'selesai',
                'id_kader' => $idKader,
                'id_balita' => $balita1 ? $balita1->NIK : null,
            ],
            [
                'tanggal_pelaksanaan' => now()->subDays(7)->toDateString(),
                'kegiatan_pelaksanaan' => 'Pemberian Kapsul Vitamin A & Obat Cacing Semester Genap Posyandu Anggrek.',
                'status_pelaksanaan' => 'selesai',
                'id_kader' => $idKader,
                'id_balita' => $balita2 ? $balita2->NIK : null,
            ],
            [
                'tanggal_pelaksanaan' => now()->addDays(3)->toDateString(),
                'kegiatan_pelaksanaan' => 'Pemeriksaan Rutin Ibu Hamil (ANC), Konseling Gizi, & Pembagian PMT Pemulihan.',
                'status_pelaksanaan' => 'belum',
                'id_kader' => $idKader,
                'id_balita' => null,
            ],
            [
                'tanggal_pelaksanaan' => now()->addDays(10)->toDateString(),
                'kegiatan_pelaksanaan' => 'Posyandu Lansia: Cek Tensi, Pemeriksaan Gula Darah, Asam Urat, & Senam Sehat.',
                'status_pelaksanaan' => 'belum',
                'id_kader' => $idKader,
                'id_balita' => null,
            ],
            [
                'tanggal_pelaksanaan' => now()->addDays(17)->toDateString(),
                'kegiatan_pelaksanaan' => 'Posyandu Remaja: Skrining Anemia, Edukasi Gizi Seimbang, dan Pembagian Tablet Tambah Darah (TTD).',
                'status_pelaksanaan' => 'belum',
                'id_kader' => $idKader,
                'id_balita' => null,
            ],
        ];

        foreach ($jadwalList as $data) {
            JadwalPosyandu::create($data);
        }
    }
}

