<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StatusController extends Controller
{
    /**
     * Data katalog lengkap seluruh tipe status code HTTP untuk e-Posyandu.
     */
    protected function getStatusCodes(): array
    {
        return [
            // 2xx Sukses
            '200' => [
                'code' => '200',
                'category' => '2xx',
                'category_name' => 'Sukses (2xx)',
                'badge' => 'HTTP 200 • OK / BERHASIL',
                'title' => 'Layanan Berjalan Normal & Berhasil',
                'message' => 'Permintaan Anda telah berhasil diproses dengan sempurna oleh server e-Posyandu. Seluruh data kesehatan dan rekam medis siap diakses.',
                'detail' => 'Status kode 200 menunjukkan transaksi web atau panggilan API selesai tanpa kendala. Seluruh sensor database dan cache beroperasi optimal.',
                'icon' => 'fa-circle-check',
                'color' => '#27ae60',
                'badge_class' => 'badge-2xx',
                'code_class' => 'code-2xx',
                'primary_btn_text' => 'Buka Dashboard Utama',
                'primary_btn_url' => route('admin.dashboard'),
                'secondary_btn_text' => 'Lihat Daftar Warga',
                'secondary_btn_url' => route('admin.daftar-anggota'),
            ],
            '201' => [
                'code' => '201',
                'category' => '2xx',
                'category_name' => 'Sukses (2xx)',
                'badge' => 'HTTP 201 • CREATED / DIBUAT',
                'title' => 'Data Baru Berhasil Ditambahkan',
                'message' => 'Entri data baru seperti pendaftaran warga baru, hasil pemeriksaan fisik balita, atau stok logistik obat telah berhasil tersimpan permanen ke basis data.',
                'detail' => 'Status kode 201 adalah respons standar keberhasilan operasi pembuatan rekaman baru (POST) baik di Web maupun REST API mobile.',
                'icon' => 'fa-square-check',
                'color' => '#2ecc71',
                'badge_class' => 'badge-2xx',
                'code_class' => 'code-2xx',
                'primary_btn_text' => 'Ke Daftar Anggota',
                'primary_btn_url' => route('admin.daftar-anggota'),
                'secondary_btn_text' => 'Input Pemeriksaan Baru',
                'secondary_btn_url' => route('admin.pemeriksaan'),
            ],
            '204' => [
                'code' => '204',
                'category' => '2xx',
                'category_name' => 'Sukses (2xx)',
                'badge' => 'HTTP 204 • NO CONTENT',
                'title' => 'Aksi Sukses Tanpa Konten Balikan',
                'message' => 'Permintaan penghapusan atau pembaruan atribut data berhasil dieksekusi oleh sistem, dan tidak ada konten data tambahan yang perlu ditampilkan.',
                'detail' => 'Biasa digunakan pada panggilan REST API penghapusan catatan logistik atau pembersihan berkas sementara aplikasi.',
                'icon' => 'fa-clipboard-check',
                'color' => '#16a085',
                'badge_class' => 'badge-2xx',
                'code_class' => 'code-2xx',
                'primary_btn_text' => 'Kembali ke Dashboard',
                'primary_btn_url' => route('admin.dashboard'),
                'secondary_btn_text' => 'Kembali',
                'secondary_btn_url' => 'javascript:history.back()',
            ],

            // 4xx Kesalahan Klien
            '400' => [
                'code' => '400',
                'category' => '4xx',
                'category_name' => 'Klien (4xx)',
                'badge' => 'HTTP 400 • BAD REQUEST',
                'title' => 'Permintaan Data Tidak Valid',
                'message' => 'Server tidak dapat memproses permintaan karena terdapat kesalahan sintaks atau format data yang dikirimkan oleh peramban atau aplikasi mobile tidak valid.',
                'detail' => 'Periksa kembali parameter URL, format tanggal (wajib YYYY-MM-DD), atau tipe input angka pada tinggi/berat badan.',
                'icon' => 'fa-triangle-exclamation',
                'color' => '#e67e22',
                'badge_class' => 'badge-4xx',
                'code_class' => 'code-4xx',
                'primary_btn_text' => 'Kembali ke Beranda',
                'primary_btn_url' => route('admin.dashboard'),
                'secondary_btn_text' => 'Ulangi Pengisian',
                'secondary_btn_url' => 'javascript:history.back()',
            ],
            '401' => [
                'code' => '401',
                'category' => '4xx',
                'category_name' => 'Klien (4xx)',
                'badge' => 'HTTP 401 • UNAUTHORIZED',
                'title' => 'Sesi Belum Terotentikasi / Perlu Login',
                'message' => 'Akses ditolak karena Anda belum masuk ke sistem atau sesi token keamanan Anda telah berakhir. Silakan login terlebih dahulu.',
                'detail' => 'Demi menjaga kerahasiaan data kesehatan anak dan rekam medis ibu hamil, sistem mewajibkan otentikasi aktif untuk seluruh modul operasional.',
                'icon' => 'fa-shield-halved',
                'color' => '#d35400',
                'badge_class' => 'badge-4xx',
                'code_class' => 'code-4xx',
                'primary_btn_text' => 'Masuk ke Akun',
                'primary_btn_url' => route('login'),
                'secondary_btn_text' => 'Bantuan Login',
                'secondary_btn_url' => '#',
            ],
            '403' => [
                'code' => '403',
                'category' => '4xx',
                'category_name' => 'Klien (4xx)',
                'badge' => 'HTTP 403 • FORBIDDEN',
                'title' => 'Akses Modul Terlarang / Dibatasi',
                'message' => 'Anda tidak memiliki hak wewenang atau hak istimewa (*Privilege*) untuk membuka modul ini. Fitur ini hanya dikhususkan bagi Ketua Posyandu atau Bidan Desa.',
                'detail' => 'Hak akses posyandu diatur berjenjang (Role-Based Access Control) untuk menjamin akuntabilitas validasi keuangan dan laporan kesehatan.',
                'icon' => 'fa-user-lock',
                'color' => '#c0392b',
                'badge_class' => 'badge-4xx',
                'code_class' => 'code-4xx',
                'primary_btn_text' => 'Kembali ke Dashboard',
                'primary_btn_url' => route('admin.dashboard'),
                'secondary_btn_text' => 'Ganti Akun Login',
                'secondary_btn_url' => route('login'),
            ],
            '404' => [
                'code' => '404',
                'category' => '4xx',
                'category_name' => 'Klien (4xx)',
                'badge' => 'HTTP 404 • NOT FOUND',
                'title' => 'Halaman atau Data Tidak Ditemukan',
                'message' => 'Berkas KMS, riwayat warga, atau alamat URL yang Anda tuju tidak ditemukan di server e-Posyandu. Tautan mungkin telah dihapus atau salah diketik.',
                'detail' => 'Gunakan kotak pencarian NIK pada modul Daftar Anggota untuk memverifikasi apakah warga sasaran telah terdaftar di database.',
                'icon' => 'fa-file-circle-question',
                'color' => '#e67e22',
                'badge_class' => 'badge-4xx',
                'code_class' => 'code-4xx',
                'primary_btn_text' => 'Kembali ke Dashboard',
                'primary_btn_url' => route('admin.dashboard'),
                'secondary_btn_text' => 'Cari Data Warga',
                'secondary_btn_url' => route('admin.daftar-anggota'),
            ],
            '405' => [
                'code' => '405',
                'category' => '4xx',
                'category_name' => 'Klien (4xx)',
                'badge' => 'HTTP 405 • METHOD NOT ALLOWED',
                'title' => 'Metode Permintaan Tidak Didukung',
                'message' => 'Metode HTTP yang Anda gunakan (seperti GET / POST / PUT / DELETE) tidak diizinkan untuk rute URL endpoint tujuan ini.',
                'detail' => 'Sebagai contoh, pengiriman formulir pendaftaran warga harus melalui metode POST, bukan metode GET langsung dari URL browser.',
                'icon' => 'fa-ban',
                'color' => '#d35400',
                'badge_class' => 'badge-4xx',
                'code_class' => 'code-4xx',
                'primary_btn_text' => 'Kembali ke Beranda',
                'primary_btn_url' => route('admin.dashboard'),
                'secondary_btn_text' => 'Kembali',
                'secondary_btn_url' => 'javascript:history.back()',
            ],
            '419' => [
                'code' => '419',
                'category' => '4xx',
                'category_name' => 'Klien (4xx)',
                'badge' => 'HTTP 419 • PAGE EXPIRED',
                'title' => 'Sesi Formulir Kedaluwarsa',
                'message' => 'Token keamanan CSRF formulir telah kedaluwarsa karena halaman dibiarkan terbuka terlalu lama tanpa ada interaksi atau pengiriman.',
                'detail' => 'Fitur keamanan ini melindungi sistem dari serangan injeksi Cross-Site Request Forgery. Anda cukup memuat ulang halaman untuk mendapatkan token baru.',
                'icon' => 'fa-clock-rotate-left',
                'color' => '#e67e22',
                'badge_class' => 'badge-4xx',
                'code_class' => 'code-4xx',
                'primary_btn_text' => 'Muat Ulang Halaman',
                'primary_btn_url' => 'javascript:window.location.reload()',
                'secondary_btn_text' => 'Ke Beranda Dashboard',
                'secondary_btn_url' => route('admin.dashboard'),
            ],
            '422' => [
                'code' => '422',
                'category' => '4xx',
                'category_name' => 'Klien (4xx)',
                'badge' => 'HTTP 422 • UNPROCESSABLE ENTITY',
                'title' => 'Validasi Data Formulir Gagal',
                'message' => 'Server memahami struktur permintaan Anda, namun data yang dikirimkan tidak memenuhi kriteria validasi (misal NIK tidak 16 digit, atau kolom wajib masih kosong).',
                'detail' => 'Periksa kembali pesan error spesifik di bawah formulir input. Pastikan NIK unik dan belum terdaftar pada warga lain.',
                'icon' => 'fa-file-circle-xmark',
                'color' => '#d35400',
                'badge_class' => 'badge-4xx',
                'code_class' => 'code-4xx',
                'primary_btn_text' => 'Perbaiki Pengisian Data',
                'primary_btn_url' => 'javascript:history.back()',
                'secondary_btn_text' => 'Daftar Anggota',
                'secondary_btn_url' => route('admin.daftar-anggota'),
            ],
            '429' => [
                'code' => '429',
                'category' => '4xx',
                'category_name' => 'Klien (4xx)',
                'badge' => 'HTTP 429 • TOO MANY REQUESTS',
                'title' => 'Batas Akses Terlampaui (Rate Limit)',
                'message' => 'Perangkat Anda mengirimkan terlalu banyak permintaan ke server dalam durasi yang sangat singkat. Server membatasi akses sementara.',
                'detail' => 'Mekanisme rate limiting aktif untuk melindungi kestabilan server dari lonjakan traffic tak wajar. Silakan jeda 1 menit sebelum melanjutkan.',
                'icon' => 'fa-hand',
                'color' => '#e67e22',
                'badge_class' => 'badge-4xx',
                'code_class' => 'code-4xx',
                'primary_btn_text' => 'Coba Kembali Sekarang',
                'primary_btn_url' => 'javascript:window.location.reload()',
                'secondary_btn_text' => 'Kembali ke Dashboard',
                'secondary_btn_url' => route('admin.dashboard'),
            ],

            // 5xx Kesalahan Server
            '500' => [
                'code' => '500',
                'category' => '5xx',
                'category_name' => 'Server (5xx)',
                'badge' => 'HTTP 500 • INTERNAL SERVER ERROR',
                'title' => 'Gangguan Internal Server Aplikasi',
                'message' => 'Terjadi kesalahan sistem yang tidak terduga pada server kami saat menjalankan proses komputasi data posyandu.',
                'detail' => 'Log teknis telah dicatat secara otomatis. Hubungi tim IT / Administrator Puskesmas bila kendala ini terus berulang.',
                'icon' => 'fa-server',
                'color' => '#c0392b',
                'badge_class' => 'badge-5xx',
                'code_class' => 'code-5xx',
                'primary_btn_text' => 'Coba Muat Ulang',
                'primary_btn_url' => 'javascript:window.location.reload()',
                'secondary_btn_text' => 'Kembali Aman ke Dashboard',
                'secondary_btn_url' => route('admin.dashboard'),
            ],
            '502' => [
                'code' => '502',
                'category' => '5xx',
                'category_name' => 'Server (5xx)',
                'badge' => 'HTTP 502 • BAD GATEWAY',
                'title' => 'Gerbang Komunikasi Server Bermasalah',
                'message' => 'Server bertindak sebagai gerbang (*gateway*) dan menerima respons yang tidak valid dari server hulu (*upstream server* atau database).',
                'detail' => 'Bisa terjadi saat server database MySQL sedang restart atau koneksi PHP-FPM terputus sejenak dari web server Nginx/Apache.',
                'icon' => 'fa-network-wired',
                'color' => '#e74c3c',
                'badge_class' => 'badge-5xx',
                'code_class' => 'code-5xx',
                'primary_btn_text' => 'Hubungi Server Ulang',
                'primary_btn_url' => 'javascript:window.location.reload()',
                'secondary_btn_text' => 'Beranda e-Posyandu',
                'secondary_btn_url' => route('admin.dashboard'),
            ],
            '503' => [
                'code' => '503',
                'category' => '5xx',
                'category_name' => 'Server (5xx)',
                'badge' => 'HTTP 503 • SERVICE UNAVAILABLE',
                'title' => 'Pemeliharaan Sistem Berkala (Maintenance)',
                'message' => 'Aplikasi e-Posyandu saat ini sedang dalam masa pemeliharaan berkala untuk peningkatan performa dan sinkronisasi data tumbuh kembang anak.',
                'detail' => 'Layanan ditangguhkan sementara selama proses update berlangsung (biasanya kurang dari 10 menit). Seluruh data warga aman tersimpan.',
                'icon' => 'fa-screwdriver-wrench',
                'color' => '#4a7c59',
                'badge_class' => 'badge-4xx',
                'code_class' => 'code-4xx',
                'primary_btn_text' => 'Cek Status Server',
                'primary_btn_url' => 'javascript:window.location.reload()',
                'secondary_btn_text' => 'Bantuan Kader',
                'secondary_btn_url' => 'https://wa.me/',
            ],
            '504' => [
                'code' => '504',
                'category' => '5xx',
                'category_name' => 'Server (5xx)',
                'badge' => 'HTTP 504 • GATEWAY TIMEOUT',
                'title' => 'Batas Waktu Respons Server Habis',
                'message' => 'Server perantara tidak menerima respons tepat waktu dari server database saat mencoba memproses kueri rekapitulasi data yang besar.',
                'detail' => 'Kendala ini biasanya terjadi saat pencetakan laporan tahunan dalam skala ribuan data warga secara serentak.',
                'icon' => 'fa-hourglass-clock',
                'color' => '#8e44ad',
                'badge_class' => 'badge-5xx',
                'code_class' => 'code-5xx',
                'primary_btn_text' => 'Coba Kembali',
                'primary_btn_url' => 'javascript:window.location.reload()',
                'secondary_btn_text' => 'Kembali ke Dashboard',
                'secondary_btn_url' => route('admin.dashboard'),
            ],
        ];
    }

    /**
     * Tampilkan landing page status code dengan switcher interaktif.
     */
    public function index(Request $request, ?string $code = null)
    {
        $statusCodes = $this->getStatusCodes();

        // Default code: 404 jika tidak dispesifikasikan, atau baca dari parameter
        $activeCode = $code ?? $request->query('code', '404');

        if (!array_key_exists($activeCode, $statusCodes)) {
            $activeCode = '404';
        }

        $current = $statusCodes[$activeCode];

        return view('status.index', compact('statusCodes', 'activeCode', 'current'));
    }

    /**
     * Endpoint untuk mensimulasikan respon HTTP asli (misal memicu abort(404), abort(403), dll).
     */
    public function simulate(int $code)
    {
        $allowed = [401, 403, 404, 419, 429, 500, 503];

        if (in_array($code, $allowed)) {
            abort($code);
        }

        return redirect()->route('status.show', ['code' => $code]);
    }
}

