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
                'nama' => 'Dr. Hendra Kusuma',
                'username' => 'ketua',
                'jabatan' => 'Ketua Posyandu',
                'password' => Hash::make('password'),
            ],
            [
                'nama' => 'Administrator Posyandu',
                'username' => 'admin',
                'jabatan' => 'Administrator Sistem',
                'password' => Hash::make('password'),
            ],
            [
                'nama' => 'Bdn. Ratna Juwita, S.Tr.Keb',
                'username' => 'bidan_desa',
                'jabatan' => 'Bidan Desa Pembina',
                'password' => Hash::make('password'),
            ],
            [
                'nama' => 'Siti Nurhaliza, A.Md.Gz',
                'username' => 'nutrisionis',
                'jabatan' => 'Petugas Gizi Puskesmas',
                'password' => Hash::make('password'),
            ],
        ];

        foreach ($users as $data) {
            User::firstOrCreate(
                ['username' => $data['username']],
                $data
            );
        }
    }
}

