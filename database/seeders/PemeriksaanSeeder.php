<?php

namespace Database\Seeders;

use App\Models\PemeriksaanBalita;
use App\Models\PemeriksaanBumil;
use App\Models\PemeriksaanLansia;
use App\Models\PemeriksaanRemaja;
use App\Models\User;
use Illuminate\Database\Seeder;

class PemeriksaanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::first();
        $idUser = $user ? $user->id_user : null;

        // Pemeriksaan Balita
        $balitaChecks = [
            [
                'tanggal' => now()->subDays(14)->toDateString(),
                'bb' => 12.4,
                'tb' => 88.5,
                'lk' => 47.0,
                'la' => 15.2,
                'lp' => 46.5,
                'status' => 'Gizi Baik (Normal)',
                'id_user' => $idUser,
            ],
            [
                'tanggal' => now()->subDays(10)->toDateString(),
                'bb' => 10.1,
                'tb' => 82.0,
                'lk' => 46.0,
                'la' => 14.0,
                'lp' => 44.0,
                'status' => 'Gizi Baik (Normal)',
                'id_user' => $idUser,
            ],
            [
                'tanggal' => now()->subDays(5)->toDateString(),
                'bb' => 8.5,
                'tb' => 74.0,
                'lk' => 43.5,
                'la' => 12.8,
                'lp' => 41.0,
                'status' => 'Perlu Pemantauan Gizi',
                'id_user' => $idUser,
            ],
        ];

        foreach ($balitaChecks as $data) {
            PemeriksaanBalita::create($data);
        }

        // Pemeriksaan Ibu Hamil
        $bumilChecks = [
            [
                'tanggal' => now()->subDays(12)->toDateString(),
                'usia_kehamilan' => 'Trimester 2 (24 Minggu)',
                'bb' => 58.5,
                'tb' => 156.0,
                'la' => 24.5,
                'lp' => 86.0,
                'tensi' => '115/75',
                'status' => 'Sehat & Normal',
                'id_user' => $idUser,
            ],
            [
                'tanggal' => now()->subDays(7)->toDateString(),
                'usia_kehamilan' => 'Trimester 3 (32 Minggu)',
                'bb' => 64.0,
                'tb' => 158.0,
                'la' => 25.0,
                'lp' => 94.0,
                'tensi' => '120/80',
                'status' => 'Sehat & Normal',
                'id_user' => $idUser,
            ],
            [
                'tanggal' => now()->subDays(3)->toDateString(),
                'usia_kehamilan' => 'Trimester 1 (10 Minggu)',
                'bb' => 46.0,
                'tb' => 152.0,
                'la' => 22.0,
                'lp' => 74.0,
                'tensi' => '105/70',
                'status' => 'Perhatian Khusus (Risiko KEK)',
                'id_user' => $idUser,
            ],
        ];

        foreach ($bumilChecks as $data) {
            PemeriksaanBumil::create($data);
        }

        // Pemeriksaan Remaja
        $remajaChecks = [
            [
                'tanggal' => now()->subDays(15)->toDateString(),
                'bb' => 48.0,
                'tb' => 158.0,
                'tensi' => '110/70',
                'hemoglobin' => 12.8,
                'gula' => 92.0,
                'status' => 'Normal / Bebas Anemia',
                'id_user' => $idUser,
            ],
            [
                'tanggal' => now()->subDays(8)->toDateString(),
                'bb' => 43.5,
                'tb' => 154.0,
                'tensi' => '100/65',
                'hemoglobin' => 10.8,
                'gula' => 88.0,
                'status' => 'Anemia Ringan (Diberikan TTD)',
                'id_user' => $idUser,
            ],
        ];

        foreach ($remajaChecks as $data) {
            PemeriksaanRemaja::create($data);
        }

        // Pemeriksaan Lansia
        $lansiaChecks = [
            [
                'tanggal' => now()->subDays(11)->toDateString(),
                'bb' => 62.0,
                'tb' => 162.0,
                'tensi' => '130/80',
                'gula' => 110.0,
                'riwayat_penyakit' => 'Riwayat pegal linu dan asam urat terkontrol.',
                'status' => 'Kondisi Baik & Terkontrol',
                'id_user' => $idUser,
            ],
            [
                'tanggal' => now()->subDays(6)->toDateString(),
                'bb' => 54.0,
                'tb' => 150.0,
                'tensi' => '145/90',
                'gula' => 142.0,
                'riwayat_penyakit' => 'Hipertensi derajat 1, sering pusing.',
                'status' => 'Hipertensi Ringan (Dirujuk ke Dokter Puskesmas)',
                'id_user' => $idUser,
            ],
        ];

        foreach ($lansiaChecks as $data) {
            PemeriksaanLansia::create($data);
        }
    }
}

