{{--
    =============================================================================
    Halaman: Manajemen Artikel & Edukasi Kesehatan
    =============================================================================
    Fitur:
    - Editor materi penyuluhan kesehatan masyarakat & gizi
    - Klasifikasi kategori edukasi (1000 HPK, Stunting, MPASI, Imunisasi, Lansia)
    - Sidebar daftar artikel aktif dengan filter tanggal dan status
    - Tombol aksi publikasi dan atur ulang responsif
    =============================================================================
--}}
@extends('layouts.admin')

@section('title', 'Manajemen Artikel')
@section('breadcrumbs', 'Beranda > Manajemen Artikel')
@section('page_title', 'Manajemen Artikel & Edukasi Kesehatan')

@section('content')
<p class="text-muted mb-4">Kelola publikasi informasi kesehatan, panduan pola gizi seimbang, dan tips pencegahan stunting bagi masyarakat.</p>

<div class="content-grid">
    <!-- Kolom Kiri: Formulir Editor Artikel -->
    <div class="card">
        <div class="card-title">
            <span><i class="fa-solid fa-pen-to-square text-primary" style="margin-right: 8px;"></i> Tulis Artikel Baru</span>
            <span class="tag tag-success">Publikasi Terbuka Mobile</span>
        </div>

        <form action="{{ route('admin.artikel.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label class="form-label">Judul Materi Edukasi <span class="text-danger">*</span></label>
                <input type="text" 
                       name="judul" 
                       class="form-control" 
                       style="font-size: 1rem; font-weight: 600;" 
                       placeholder="Contoh: Pentingnya 1000 Hari Pertama Kehidupan untuk Mencegah Stunting" 
                       required>
            </div>

            <div class="form-group">
                <label class="form-label">Kategori Edukasi Kesehatan <span class="text-danger">*</span></label>
                <select name="kategori_info" class="form-control" required>
                    <option value="Tumbuh Kembang">Tumbuh Kembang & Stunting</option>
                    <option value="Nutrisi">Pola Gizi Seimbang & MPASI</option>
                    <option value="Imunisasi">Imunisasi & Vaksinasi Dasar</option>
                    <option value="Ibu Hamil">Ibu Hamil & Pemeriksaan ANC</option>
                    <option value="Lansia">Kesehatan Lansia & Pencegahan PTM</option>
                    <option value="Remaja">Kesehatan Remaja & Skrining Anemia</option>
                </select>
            </div>

            <!-- Editor Teks Sederhana -->
            <div class="form-group">
                <label class="form-label">Isi Artikel & Panduan Kesehatan <span class="text-danger">*</span></label>
                <div style="border: 1px solid var(--border-color); border-radius: var(--radius-md); overflow: hidden;">
                    <div style="background: var(--bg-card-subtle); padding: 8px 12px; display: flex; gap: 14px; border-bottom: 1px solid var(--border-color); color: var(--text-muted); font-size: 0.85rem;">
                        <i class="fa-solid fa-bold" title="Tebal" style="cursor: pointer;"></i>
                        <i class="fa-solid fa-italic" title="Miring" style="cursor: pointer;"></i>
                        <i class="fa-solid fa-list-ul" title="Daftar Poin" style="cursor: pointer;"></i>
                        <div style="width: 1px; height: 16px; background: var(--border-color);"></div>
                        <i class="fa-solid fa-image" title="Sisipkan Gambar" style="cursor: pointer;"></i>
                        <i class="fa-solid fa-link" title="Sisipkan Tautan" style="cursor: pointer;"></i>
                    </div>
                    <textarea name="isi_informasi" 
                              class="form-control" 
                              rows="10" 
                              style="border: none; border-radius: 0; background: #fff; line-height: 1.6;" 
                              placeholder="Tuliskan materi penyuluhan, anjuran gizi, dan langkah-langkah praktis bagi keluarga di sini..." 
                              required></textarea>
                </div>
            </div>

            <!-- Tombol Aksi Editor -->
            <div style="display: flex; justify-content: flex-end; gap: 12px; margin-top: 2rem; flex-wrap: wrap;">
                <button type="reset" class="btn btn-secondary">
                    <i class="fa-solid fa-rotate-left"></i>
                    <span>Atur Ulang</span>
                </button>
                <button type="submit" class="btn btn-primary">
                    <i class="fa-solid fa-paper-plane"></i>
                    <span>Publikasikan Artikel</span>
                </button>
            </div>
        </form>
    </div>

    <!-- Kolom Kanan: Daftar Artikel Aktif -->
    <div style="display: flex; flex-direction: column; gap: 20px;">
        <div class="card" style="background: var(--bg-card-subtle);">
            <div class="card-title">
                <span><i class="fa-solid fa-newspaper text-primary" style="margin-right: 8px;"></i> Artikel Aktif</span>
                <span class="tag tag-neutral">{{ count($articles) }} Artikel</span>
            </div>

            <div style="display: flex; flex-direction: column; gap: 12px; max-height: 520px; overflow-y: auto;">
                @forelse($articles as $art)
                <div style="background: var(--bg-card); padding: 14px; border-radius: var(--radius-md); border: 1px solid var(--border-color); display: flex; gap: 12px; box-shadow: var(--shadow-xs);">
                    <div style="width: 44px; height: 44px; background: var(--primary-light); border-radius: var(--radius-sm); display: flex; align-items: center; justify-content: center; color: var(--primary); font-size: 1.15rem; flex-shrink: 0;">
                        <i class="fa-solid fa-book-medical"></i>
                    </div>
                    <div style="flex-grow: 1; min-width: 0;">
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 4px;">
                            <span class="tag tag-success" style="font-size: 0.65rem; padding: 2px 6px;">{{ $art->kategori_info ?? 'Umum' }}</span>
                            <span style="font-size: 0.7rem; color: var(--text-muted);">{{ \Carbon\Carbon::parse($art->tanggal_post)->format('d M Y') }}</span>
                        </div>
                        <div style="font-weight: 600; font-size: 0.875rem; color: var(--text-main); line-height: 1.35; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                            {{ $art->judul }}
                        </div>
                    </div>
                </div>
                @empty
                <p class="text-muted" style="text-align: center; padding: 2rem 0; font-size: 0.85rem;">Belum ada artikel dipublikasikan.</p>
                @endforelse
            </div>
        </div>

        <div class="card" style="background: var(--primary-light); border-color: var(--primary-border);">
            <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 6px;">
                <i class="fa-solid fa-mobile-screen text-primary" style="font-size: 1.25rem;"></i>
                <div style="font-weight: 700; color: var(--primary); font-size: 0.95rem;">Terkoneksi ke Aplikasi Android</div>
            </div>
            <p style="font-size: 0.825rem; color: var(--text-main); margin: 0; line-height: 1.5;">
                Artikel yang disimpan di sini langsung dapat dibaca oleh warga di HP Android melalui REST API <code>/api/artikel</code>.
            </p>
        </div>
    </div>
</div>
@endsection
