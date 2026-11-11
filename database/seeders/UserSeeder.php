<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'nama' => 'Administrator Posyandu',
                'username' => 'admin',
                'jabatan' => 'Administrator Sistem',
                'role' => 'admin',
                'password' => Hash::make('password'),
            ],
            [
                'nama' => 'Dr. Hendra Kusuma',
                'username' => 'ketua',
                'jabatan' => 'Ketua Posyandu',
                'role' => 'ketua',
                'password' => Hash::make('password'),
            ],
            [
                'nama' => 'Bdn. Ratna Juwita, S.Tr.Keb',
                'username' => 'bidan_desa',
                'jabatan' => 'Bidan Desa Pembina',
                'role' => 'bidan',
                'password' => Hash::make('password'),
            ],
            [
                'nama' => 'Siti Nurhaliza, A.Md.Gz',
                'username' => 'nutrisionis',
                'jabatan' => 'Petugas Gizi Puskesmas',
                'role' => 'bidan',
                'password' => Hash::make('password'),
            ],
            [
                'nama' => 'Ibu Kader Rahmawati',
                'username' => 'kader',
                'jabatan' => 'Kader Aktif (RW 01)',
                'role' => 'kader',
                'password' => Hash::make('password'),
            ],
            [
                'nama' => 'Ibu Kader Anggrek',
                'username' => 'kader1',
                'jabatan' => 'Kader Posyandu Anggrek',
                'role' => 'kader',
                'password' => Hash::make('password'),
            ],
        ];

        foreach ($users as $data) {
            User::updateOrCreate(
                ['username' => $data['username']],
                $data
            );
        }
    }
}
