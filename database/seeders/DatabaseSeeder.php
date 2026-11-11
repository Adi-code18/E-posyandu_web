<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            KaderSeeder::class,
            WargaSeeder::class,
            JadwalPosyanduSeeder::class,
            BarangManajemenSeeder::class,
            LaporanPenjualanSeeder::class,
            TabelKasMasukSeeder::class,
            PemeriksaanSeeder::class,
            KartuKembangAnakSeeder::class,
            KontrolTtdSeeder::class,
            KunjunganRumahSeeder::class,
            LaporanKesehatanSeeder::class,
            InformasiUmumSeeder::class,
        ]);
    }
}
