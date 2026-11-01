<?php

namespace Database\Seeders;

use App\Models\Kader;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class KaderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kaders = [
            [
                'nama_kader' => 'Ibu Kader Anggrek',
                'username' => 'kader1',
                'password' => Hash::make('password'),
            ],
            [
                'nama_kader' => 'Ibu Sri Wahyuni (Pos Mawar)',
                'username' => 'kader_mawar',
                'password' => Hash::make('password'),
            ],
            [
                'nama_kader' => 'Ibu Siti Rahayu (Pos Melati)',
                'username' => 'kader_melati',
                'password' => Hash::make('password'),
            ],
            [
                'nama_kader' => 'Ibu Endang Lestari (Pos Dahlia)',
                'username' => 'kader_dahlia',
                'password' => Hash::make('password'),
            ],
        ];

        foreach ($kaders as $data) {
            Kader::firstOrCreate(
                ['username' => $data['username']],
                $data
            );
        }
    }
}

