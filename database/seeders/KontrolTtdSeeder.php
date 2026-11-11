<?php

namespace Database\Seeders;

use App\Models\Kader;
use App\Models\KontrolTtd;
use Illuminate\Database\Seeder;

class KontrolTtdSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kader = Kader::first();
        $idKader = $kader ? $kader->id_kader : null;

        $data = [
            // Ibu Hamil: Siti Aminah (Target min 90 tablet selama kehamilan)
            [
                'NIK' => '3201024508920005',
                'id_kader' => $idKader,
                'tanggal_konsumsi' => '2024-09-01',
                'jumlah_tablet' => 30,
                'status_sasaran' => 'Ibu Hamil',
                'kadar_hb' => 12.8,
                'status_anemia' => false,
                'efek_samping' => 'Tidak Ada',
                'catatan' => 'Trimester 1: konsumsi 30 tablet tuntas tanpa keluhan mual.',
            ],
            [
                'NIK' => '3201024508920005',
                'id_kader' => $idKader,
                'tanggal_konsumsi' => '2024-10-01',
                'jumlah_tablet' => 30,
                'status_sasaran' => 'Ibu Hamil',
                'kadar_hb' => 12.6,
                'status_anemia' => false,
                'efek_samping' => 'Tinja Gelap',
                'catatan' => 'Trimester 2: konsumsi 30 tablet tuntas, edukasi efek samping tinja gelap wajar.',
            ],
            [
                'NIK' => '3201024508920005',
                'id_kader' => $idKader,
                'tanggal_konsumsi' => '2024-10-25',
                'jumlah_tablet' => 15,
                'status_sasaran' => 'Ibu Hamil',
                'kadar_hb' => 12.5,
                'status_anemia' => false,
                'efek_samping' => 'Tidak Ada',
                'catatan' => 'Total 75 dari 90 tablet telah dikonsumsi (83%).',
            ],

            // UAC-04: Remaja Putri Putri Maharani (Hb 11.0 gr/dl -> Anemia, Wajib TTD 1x/minggu)
            [
                'NIK' => '3201025509090006',
                'id_kader' => $idKader,
                'tanggal_konsumsi' => '2024-10-14',
                'jumlah_tablet' => 1,
                'status_sasaran' => 'Remaja Putri',
                'kadar_hb' => 11.0,
                'status_anemia' => true,
                'efek_samping' => 'Tidak Ada',
                'catatan' => 'Skrining Hb 11.0 gr/dl (Anemia). Wajib konsumsi TTD mingguan dari sekolah/posyandu.',
            ],
            [
                'NIK' => '3201025509090006',
                'id_kader' => $idKader,
                'tanggal_konsumsi' => '2024-10-21',
                'jumlah_tablet' => 1,
                'status_sasaran' => 'Remaja Putri',
                'kadar_hb' => 11.2,
                'status_anemia' => true,
                'efek_samping' => 'Mual',
                'catatan' => 'Konsumsi minggu ke-2, edukasi minum malam sebelum tidur.',
            ],
        ];

        foreach ($data as $item) {
            KontrolTtd::create($item);
        }
    }
}

