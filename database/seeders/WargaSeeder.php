<?php

namespace Database\Seeders;

use App\Models\Kader;
use App\Models\User;
use App\Models\Warga;
use Illuminate\Database\Seeder;

class WargaSeeder extends Seeder
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

        $wargaList = [
            // Balita
            [
                'NIK' => '3201020304050001',
                'nama_lengkap' => 'Aditya Pratama',
                'tanggal_lahir' => '2023-01-15',
                'nama_ayah' => 'Budi Santoso',
                'jenis_kelamin' => 'Laki-laki',
                'nama_ibu' => 'Siti Aminah',
                'status' => 'Balita',
                'id_kader' => $idKader,
                'id_user' => $idUser,
            ],
            [
                'NIK' => '3274012023080004',
                'nama_lengkap' => 'Arlo Wijaya',
                'tanggal_lahir' => '2022-06-14',
                'nama_ayah' => 'Bambang Sugianto',
                'jenis_kelamin' => 'Laki-laki',
                'nama_ibu' => 'Rina Herlina',
                'status' => 'Balita',
                'id_kader' => $idKader,
                'id_user' => $idUser,
            ],
            [
                'NIK' => '3201021405230002',
                'nama_lengkap' => 'Naura Kayla Az-Zahra',
                'tanggal_lahir' => '2023-05-14',
                'nama_ayah' => 'Fajar Nugraha',
                'jenis_kelamin' => 'Perempuan',
                'nama_ibu' => 'Dewi Sartika',
                'status' => 'Balita',
                'id_kader' => $idKader,
                'id_user' => $idUser,
            ],
            [
                'NIK' => '3201022209220003',
                'nama_lengkap' => 'Kenzo Alfarizi',
                'tanggal_lahir' => '2024-07-11', // Umur kronologis 4 bulan
                'nama_ayah' => 'Rizky Ramadhan',
                'jenis_kelamin' => 'Laki-laki',
                'nama_ibu' => 'Fitriani',
                'status' => 'Balita',
                'is_prematur' => true,
                'usia_kehamilan_minggu' => 34, // Lahir 34 minggu (defisit 6 minggu = 1.5 bln, Usia Koreksi = 2.5 bln)
                'id_kader' => $idKader,
                'id_user' => $idUser,
            ],

            // Ibu Hamil
            [
                'NIK' => '3201024508920005',
                'nama_lengkap' => 'Siti Aminah',
                'tanggal_lahir' => '1995-08-20',
                'nama_ayah' => 'Hussein Basalamah',
                'jenis_kelamin' => 'Perempuan',
                'nama_ibu' => 'Maryam',
                'status' => 'Ibu Hamil',
                'id_kader' => $idKader,
                'id_user' => $idUser,
            ],
            [
                'NIK' => '3201025203970008',
                'nama_lengkap' => 'Dewi Lestari Kusuma',
                'tanggal_lahir' => '1997-03-12',
                'nama_ayah' => 'Ahmad Suhendra',
                'jenis_kelamin' => 'Perempuan',
                'nama_ibu' => 'Sri Astuti',
                'status' => 'Ibu Hamil',
                'id_kader' => $idKader,
                'id_user' => $idUser,
            ],
            [
                'NIK' => '3201026111940009',
                'nama_lengkap' => 'Rina Marlina',
                'tanggal_lahir' => '1994-11-21',
                'nama_ayah' => 'Dedi Iskandar',
                'jenis_kelamin' => 'Perempuan',
                'nama_ibu' => 'Nurjanah',
                'status' => 'Ibu Hamil',
                'id_kader' => $idKader,
                'id_user' => $idUser,
            ],

            // Remaja
            [
                'NIK' => '3201021804080003',
                'nama_lengkap' => 'Dimas Arya Pratama',
                'tanggal_lahir' => '2008-04-18',
                'nama_ayah' => 'Gunawan Wibowo',
                'jenis_kelamin' => 'Laki-laki',
                'nama_ibu' => 'Yuliana',
                'status' => 'Remaja',
                'id_kader' => $idKader,
                'id_user' => $idUser,
            ],
            [
                'NIK' => '3201025509090006',
                'nama_lengkap' => 'Putri Maharani',
                'tanggal_lahir' => '2009-09-15',
                'nama_ayah' => 'Hendra Setiawan',
                'jenis_kelamin' => 'Perempuan',
                'nama_ibu' => 'Kartika Sari',
                'status' => 'Remaja',
                'id_kader' => $idKader,
                'id_user' => $idUser,
            ],
            [
                'NIK' => '3201021207070004',
                'nama_lengkap' => 'Farhan Fauziansyah',
                'tanggal_lahir' => '2007-07-12',
                'nama_ayah' => 'Fauzi Rahman',
                'jenis_kelamin' => 'Laki-laki',
                'nama_ibu' => 'Nurul Aini',
                'status' => 'Remaja',
                'id_kader' => $idKader,
                'id_user' => $idUser,
            ],

            // Lansia
            [
                'NIK' => '3201021203550002',
                'nama_lengkap' => 'Karto Wijoyo',
                'tanggal_lahir' => '1955-03-12',
                'nama_ayah' => 'Mbah Marto',
                'jenis_kelamin' => 'Laki-laki',
                'nama_ibu' => 'Mbah Samini',
                'status' => 'Lansia',
                'id_kader' => $idKader,
                'id_user' => $idUser,
            ],
            [
                'NIK' => '3201024807530007',
                'nama_lengkap' => 'Hj. Sutinah',
                'tanggal_lahir' => '1953-07-08',
                'nama_ayah' => 'H. Zakaria',
                'jenis_kelamin' => 'Perempuan',
                'nama_ibu' => 'Hj. Aminah',
                'status' => 'Lansia',
                'id_kader' => $idKader,
                'id_user' => $idUser,
            ],
            [
                'NIK' => '3201020101500010',
                'nama_lengkap' => 'Slamet Riyadi',
                'tanggal_lahir' => '1950-01-01',
                'nama_ayah' => 'Mbah Sastro',
                'jenis_kelamin' => 'Laki-laki',
                'nama_ibu' => 'Mbah Painem',
                'status' => 'Lansia',
                'id_kader' => $idKader,
                'id_user' => $idUser,
            ],
        ];

        foreach ($wargaList as $data) {
            Warga::firstOrCreate(
                ['NIK' => $data['NIK']],
                $data
            );
        }
    }
}

