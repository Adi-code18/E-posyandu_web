<?php

namespace Database\Seeders;

use App\Models\Kader;
use App\Models\KunjunganRumah;
use Illuminate\Database\Seeder;

class KunjunganRumahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kader = Kader::first();
        $idKader = $kader ? $kader->id_kader : null;

        $data = [
            // UAC-03: Ibu Hamil KEK / Resti Dewi Lestari Kusuma
            [
                'NIK' => '3201025203970008',
                'id_kader' => $idKader,
                'tanggal' => '2024-10-18',
                'kategori_sasaran' => 'Ibu Hamil KEK / Resti',
                'checklist_hasil' => [
                    'Sanitasi & Air Bersih Layak',
                    'Kepatuhan Minum Suplemen / TTD / Obat',
                    'Kepemilikan & Pengisian Buku KIA/KMS',
                ],
                'tanda_bahaya_ditemukan' => false,
                'status_tindak_lanjut' => 'Edukasi & Pendampingan Rutin',
                'catatan' => 'LILA 22.0 cm (< 23.5 cm risiko KEK). Diberikan PMT Biskuit Ibu Hamil dan edukasi Isi Piringku.',
            ],

            // Balita Masalah Gizi & Stunting: Kenzo Alfarizi
            [
                'NIK' => '3201022209220003',
                'id_kader' => $idKader,
                'tanggal' => '2024-10-22',
                'kategori_sasaran' => 'Balita Masalah Gizi & Stunting',
                'checklist_hasil' => [
                    'Sanitasi & Air Bersih Layak',
                    'Pola Makan Sesuai Isi Piringku',
                    'Kepemilikan & Pengisian Buku KIA/KMS',
                ],
                'tanda_bahaya_ditemukan' => true,
                'status_tindak_lanjut' => 'Rujuk ke Puskesmas / Pustu',
                'catatan' => 'BB tidak naik 2 bulan beruntun dan nafsu makan turun drastis. Diberikan rujukan segera ke Puskesmas.',
            ],

            // Lansia PTM: Karto Wijoyo
            [
                'NIK' => '3201021203550002',
                'id_kader' => $idKader,
                'tanggal' => '2024-10-24',
                'kategori_sasaran' => 'Lansia PTM',
                'checklist_hasil' => [
                    'Sanitasi & Air Bersih Layak',
                    'Kepatuhan Minum Suplemen / TTD / Obat',
                ],
                'tanda_bahaya_ditemukan' => false,
                'status_tindak_lanjut' => 'Kunjungan Rumah Ulang (1 Minggu)',
                'catatan' => 'Tensi darah terkontrol 135/85 mmHg, obat amlodipine diminum teratur tiap malam.',
            ],
        ];

        foreach ($data as $item) {
            KunjunganRumah::create($item);
        }
    }
}

