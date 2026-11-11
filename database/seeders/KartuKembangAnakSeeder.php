<?php

namespace Database\Seeders;

use App\Models\Kader;
use App\Models\User;
use App\Models\KartuKembangAnak;
use Illuminate\Database\Seeder;

class KartuKembangAnakSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kader = Kader::first();
        $user = User::first();

        $idKader = $kader ? $kader->id_kader : null;
        $idUser = $user ? $user->id_user : null;

        $data = [
            // UAC-01: Balita dengan ketidaktercapaian KKA 2 bulan beruntun -> Status Rujuk ke Puskesmas
            [
                'NIK' => '3201022209220003', // Kenzo Alfarizi
                'id_kader' => $idKader,
                'id_user' => $idUser,
                'tanggal_pemeriksaan' => '2024-09-15',
                'usia_bulan' => 24,
                'gerak_kasar' => true,
                'gerak_halus' => false,
                'komunikasi_pasif' => true,
                'komunikasi_aktif' => false,
                'kecerdasan' => true,
                'menolong_diri_sendiri' => true,
                'tingkah_laku_sosial' => true,
                'capai_garis_merah' => true,
                'bulan_tidak_capai_beruntun' => 1,
                'status_rujuk' => 'Perlu Pemantauan',
                'catatan' => 'Bulan pertama tugas motorik halus dan bicara belum tercapai.',
            ],
            [
                'NIK' => '3201022209220003', // Kenzo Alfarizi
                'id_kader' => $idKader,
                'id_user' => $idUser,
                'tanggal_pemeriksaan' => '2024-10-15',
                'usia_bulan' => 25,
                'gerak_kasar' => true,
                'gerak_halus' => false,
                'komunikasi_pasif' => true,
                'komunikasi_aktif' => false,
                'kecerdasan' => true,
                'menolong_diri_sendiri' => true,
                'tingkah_laku_sosial' => true,
                'capai_garis_merah' => true,
                'bulan_tidak_capai_beruntun' => 2,
                'status_rujuk' => 'Rujuk ke Puskesmas',
                'catatan' => '2 bulan beruntun belum capai tugas perkembangan. Dirujuk ke Poli Tumbuh Kembang Puskesmas.',
            ],

            // Balita Normal: Aditya Pratama
            [
                'NIK' => '3201020304050001',
                'id_kader' => $idKader,
                'id_user' => $idUser,
                'tanggal_pemeriksaan' => '2024-10-10',
                'usia_bulan' => 21,
                'gerak_kasar' => true,
                'gerak_halus' => true,
                'komunikasi_pasif' => true,
                'komunikasi_aktif' => true,
                'kecerdasan' => true,
                'menolong_diri_sendiri' => true,
                'tingkah_laku_sosial' => true,
                'capai_garis_merah' => false,
                'bulan_tidak_capai_beruntun' => 0,
                'status_rujuk' => 'Normal',
                'catatan' => 'Perkembangan 7 aspek sangat baik sesuai usia balita.',
            ],
        ];

        foreach ($data as $item) {
            KartuKembangAnak::create($item);
        }
    }
}

