<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Warga;
use App\Models\Kader;
use App\Models\User;
use App\Models\BarangManajemen;
use App\Models\PemeriksaanBalita;
use App\Models\InformasiUmum;
use App\Models\TabelKasMasuk;
use App\Models\LaporanPenjualan;
use App\Models\LaporanKesehatan;

class AdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'balita' => Warga::where('status', 'Balita')->count(),
            'bumil' => Warga::where('status', 'Ibu Hamil')->count(),
            'lansia' => Warga::where('status', 'Lansia')->count(),
            'remaja' => Warga::where('status', 'Remaja')->count(),
        ];

        $recentWarga = Warga::orderBy('created_at', 'desc')->take(4)->get();

        return view('admin.dashboard', compact('stats', 'recentWarga'));
    }

    public function pendaftaran()
    {
        return view('admin.pendaftaran');
    }

    public function wargaStore(Request $request)
    {
        $validated = $request->validate([
            'NIK' => 'required|numeric|digits:16|unique:warga,NIK',
            'nama_lengkap' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'status' => 'required|string',
            'nama_ibu' => 'nullable|string|max:255',
            'nama_ayah' => 'nullable|string|max:255',
        ], [
            'NIK.required' => 'Nomor Induk Kependudukan (NIK) wajib diisi.',
            'NIK.numeric' => 'NIK harus berupa deretan angka.',
            'NIK.digits' => 'NIK harus tepat terdiri dari 16 digit.',
            'NIK.unique' => 'NIK ini sudah terdaftar dalam sistem e-Posyandu.',
            'nama_lengkap.required' => 'Nama lengkap warga wajib diisi.',
            'tanggal_lahir.required' => 'Tanggal lahir warga wajib ditentukan.',
            'jenis_kelamin.required' => 'Pilih jenis kelamin warga.',
        ]);

        $kader = Kader::first();
        $user = User::first();

        $validated['nama_ayah'] = !empty($validated['nama_ayah']) ? $validated['nama_ayah'] : '-';
        $validated['nama_ibu'] = !empty($validated['nama_ibu']) ? $validated['nama_ibu'] : '-';
        $validated['id_kader'] = $kader ? $kader->id_kader : null;
        $validated['id_user'] = $user ? $user->id_user : null;

        Warga::create($validated);

        return redirect()->route('admin.daftar-anggota')->with('success', 'Warga baru (' . $validated['nama_lengkap'] . ') berhasil didaftarkan ke sistem');
    }

    public function daftarAnggota(Request $request)
    {
        $query = Warga::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama_lengkap', 'like', '%' . $search . '%')
                  ->orWhere('NIK', 'like', '%' . $search . '%');
            });
        }

        if ($request->filled('status') && $request->status !== 'Semua') {
            $query->where('status', $request->status);
        }

        $warga = $query->orderBy('created_at', 'desc')->paginate(6);

        return view('admin.daftar-anggota', compact('warga'));
    }

    public function pemeriksaan(Request $request)
    {
        $nik = $request->query('nik');
        $warga = null;

        if ($nik) {
            $warga = Warga::where('NIK', $nik)->first();
        }

        if (!$warga) {
            $warga = Warga::first();
        }

        return view('admin.pemeriksaan', compact('warga'));
    }

    public function pemeriksaanStore(Request $request)
    {
        $validated = $request->validate([
            'nik' => 'nullable|exists:warga,NIK',
            'tb' => 'required|numeric|min:1',
            'bb' => 'required|numeric|min:0.5',
            'lk' => 'nullable|numeric',
            'la' => 'nullable|numeric',
            'lp' => 'nullable|numeric',
            'catatan' => 'nullable|string',
        ], [
            'tb.required' => 'Tinggi badan wajib diisi.',
            'bb.required' => 'Berat badan wajib diisi.',
        ]);

        $status = 'Gizi Baik (Normal)';
        if ($validated['bb'] < 8.0) {
            $status = 'Perlu Pemantauan Gizi';
        }

        $user = User::first();

        PemeriksaanBalita::create([
            'tanggal' => now()->toDateString(),
            'bb' => $validated['bb'],
            'tb' => $validated['tb'],
            'lk' => $validated['lk'] ?? null,
            'la' => $validated['la'] ?? null,
            'lp' => $validated['lp'] ?? null,
            'status' => $status,
            'id_user' => $user ? $user->id_user : null,
        ]);

        $nik = $request->input('nik');
        if ($nik) {
            return redirect()->route('admin.profil', ['nik' => $nik])->with('success', 'Data hasil pemeriksaan fisik berhasil dicatat ke rekam medis');
        }

        return redirect()->route('admin.pemeriksaan')->with('success', 'Data hasil pemeriksaan fisik berhasil disimpan');
    }

    public function profil($nik)
    {
        $warga = Warga::where('NIK', $nik)->firstOrFail();
        return view('admin.profil', compact('warga'));
    }

    public function laporanKeuangan()
    {
        $kasMasuk = TabelKasMasuk::orderBy('tanggal_terima_dana', 'desc')->get();
        $penjualan = LaporanPenjualan::with('barang')->orderBy('tanggal_keluar', 'desc')->get();

        $totalKas = $kasMasuk->sum('total_dana_dikelola');
        $totalPengeluaran = $penjualan->sum('total_harga');
        $saldo = $totalKas - $totalPengeluaran;

        return view('admin.laporan-keuangan', compact('kasMasuk', 'penjualan', 'totalKas', 'totalPengeluaran', 'saldo'));
    }

    public function manajemenArtikel()
    {
        $articles = InformasiUmum::orderBy('tanggal_post', 'desc')->get();
        return view('admin.manajemen-artikel', compact('articles'));
    }

    public function artikelStore(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'kategori_info' => 'required|string',
            'isi_informasi' => 'required|string',
        ], [
            'judul.required' => 'Judul artikel wajib diisi.',
            'isi_informasi.required' => 'Isi artikel edukasi tidak boleh kosong.',
        ]);

        $kader = Kader::first();
        $user = User::first();

        InformasiUmum::create([
            'judul' => $validated['judul'],
            'kategori_info' => $validated['kategori_info'],
            'isi_informasi' => $validated['isi_informasi'],
            'tanggal_post' => now()->toDateString(),
            'id_kader' => $kader ? $kader->id_kader : null,
            'id_ketua' => $user ? $user->id_user : null,
        ]);

        return redirect()->back()->with('success', 'Artikel edukasi kesehatan baru berhasil dipublikasikan');
    }

    public function manajemenProduk()
    {
        $products = BarangManajemen::orderBy('created_at', 'desc')->get();
        $stats = [
            'total' => $products->count(),
            'habis' => $products->where('jumlah', 0)->count(),
            'kategori' => $products->pluck('kategori')->unique()->count(),
        ];

        return view('admin.manajemen-produk', compact('products', 'stats'));
    }

    public function produkStore(Request $request)
    {
        $validated = $request->validate([
            'nama_barang' => 'required|string|max:255',
            'kategori' => 'required|string',
            'jumlah' => 'required|integer|min:0',
            'harga' => 'required|numeric|min:0',
            'tanggal_masuk' => 'required|date',
        ]);

        $kader = Kader::first();
        $user = User::first();

        $validated['id_kader'] = $kader ? $kader->id_kader : null;
        $validated['id_ketua'] = $user ? $user->id_user : null;

        BarangManajemen::create($validated);

        return redirect()->back()->with('success', 'Produk logistik (' . $validated['nama_barang'] . ') berhasil ditambahkan');
    }

    public function laporanKesehatan()
    {
        $laporanList = LaporanKesehatan::orderBy('tanggal_dibuat', 'desc')->get();
        return view('admin.laporan-kesehatan', compact('laporanList'));
    }

    public function login()
    {
        return view('admin.login');
    }
}
