<?php

namespace Database\Seeders;

use App\Models\InformasiUmum;
use App\Models\Kader;
use App\Models\User;
use Illuminate\Database\Seeder;

class InformasiUmumSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kader = Kader::first();
        $user = User::first();

        $idKader = $kader ? $kader->id_kader : null;
        $idKetua = $user ? $user->id_user : null;

        $artikelList = [
            [
                'judul' => 'Pentingnya 1000 Hari Pertama Kehidupan (HPK) untuk Mencegah Stunting',
                'isi_informasi' => 'Periode 1000 Hari Pertama Kehidupan (HPK) yang dihitung sejak masa konsepsi dalam kandungan hingga anak berusia 2 tahun merupakan periode emas (golden period) dalam pertumbuhan fisik dan perkembangan otak anak. Pemenuhan gizi optimal, pemeriksaan rutin kehamilan, inisiasi menyusu dini (IMD), ASI eksklusif 6 bulan, serta pemberian MPASI berkualitas sangat menentukan masa depan kecerdasan anak.',
                'tanggal_post' => now()->subDays(18)->toDateString(),
                'kategori_info' => 'Tumbuh Kembang',
                'gambar_poster' => 'stunting_prevention.jpg',
                'id_kader' => $idKader,
                'id_ketua' => $idKetua,
            ],
            [
                'judul' => 'Panduan MPASI Bergizi Seimbang dengan Menu 4 Bintang',
                'isi_informasi' => 'Pemberian Makanan Pendamping ASI (MPASI) dimulai saat bayi genap berusia 6 bulan. Menu 4 bintang terdiri dari karbohidrat utama (beras, kentang, jagung), protein hewani (telur, daging ayam, ikan, hati sapi), protein nabati (tahu, tempe, kacang hijau), dan sayuran hijau/buah kaya serat dan mikronutrien. Jangan lupa menambahkan lemak tambahan sehat seperti santan, minyak kelapa, atau mentega untuk mencukupi kebutuhan kalori balita.',
                'tanggal_post' => now()->subDays(12)->toDateString(),
                'kategori_info' => 'Nutrisi',
                'gambar_poster' => 'mpasi_guide.jpg',
                'id_kader' => $idKader,
                'id_ketua' => $idKetua,
            ],
            [
                'judul' => 'Jadwal Imunisasi Dasar Lengkap Nasional untuk Perlindungan Buah Hati',
                'isi_informasi' => 'Imunisasi dasar lengkap melindungi anak dari penyakit berbahaya seperti Hepatitis B, Polio, TBC, Difteri, Pertusis, Tetanus, Campak, dan Rubella. Pastikan orang tua membawa buku KIA/KMS setiap jadwal Posyandu bulanan agar catatan vaksinasi balita selalu diperbarui dan terpantau dengan baik oleh bidan dan kader posyandu.',
                'tanggal_post' => now()->subDays(8)->toDateString(),
                'kategori_info' => 'Imunisasi',
                'gambar_poster' => 'imunisasi_rutin.jpg',
                'id_kader' => $idKader,
                'id_ketua' => $idKetua,
            ],
            [
                'judul' => 'Kenali Tanda Bahaya Kehamilan dan Langkah Tanggap Darurat',
                'isi_informasi' => 'Ibu hamil dan keluarga perlu mewaspadai tanda-tanda bahaya seperti perdarahan jalan lahir, bengkak pada kaki/tangan/wajah disertai sakit kepala hebat, demam tinggi, janin kurang bergerak, atau ketuban pecah sebelum waktunya. Jika menemukan gejala ini, segera bawa ibu hamil ke fasilitas kesehatan terdekat atau hubungi bidan desa pembina.',
                'tanggal_post' => now()->subDays(4)->toDateString(),
                'kategori_info' => 'Ibu Hamil',
                'gambar_poster' => 'tanda_bahaya_kehamilan.jpg',
                'id_kader' => $idKader,
                'id_ketua' => $idKetua,
            ],
            [
                'judul' => 'Gaya Hidup Sehat Lansia: Pola Makan Rendah Garam & Senam Rutin',
                'isi_informasi' => 'Kesehatan lansia dapat dipertahankan melalui pola hidup CERDIK: Cek kesehatan berkala, Enyahkan asap rokok, Rajin aktivitas fisik atau senam lansia, Diet sehat kalori seimbang dengan batasan konsumsi garam dan gula, Istirahat cukup, serta Kelola stres dengan berinteraksi bersama komunitas lansia posyandu.',
                'tanggal_post' => now()->subDays(2)->toDateString(),
                'kategori_info' => 'Lansia',
                'gambar_poster' => 'senam_lansia.jpg',
                'id_kader' => $idKader,
                'id_ketua' => $idKetua,
            ],
        ];

        foreach ($artikelList as $data) {
            InformasiUmum::create($data);
        }
    }
}

