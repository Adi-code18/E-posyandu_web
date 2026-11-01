@extends('layouts.admin')

@section('title', 'Manajemen Artikel')
@section('breadcrumbs', 'Beranda > Manajemen Artikel')
@section('page_title', 'Manajemen Artikel & Edukasi Kesehatan')

@section('content')
<p class="text-muted mb-4">Kelola informasi kesehatan, tips gizi, dan panduan tumbuh kembang untuk masyarakat Posyandu.</p>

<div class="content-grid" style="grid-template-columns: 2fr 1fr;">
    <!-- Article Editor -->
    <div class="card">
        <div class="card-title" style="border-bottom: 1px solid #eee; padding-bottom: 1rem; margin-bottom: 2rem;">
            <span><i class="fa-solid fa-pen-to-square" style="color: var(--primary); margin-right: 10px;"></i> Editor Artikel Edukasi</span>
            <span style="font-size: 0.75rem; font-weight: 500; color: #888;">Publikasi Terbuka untuk Warga</span>
        </div>

        <form action="{{ route('admin.artikel.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label class="form-label">Judul Artikel <span style="color: red;">*</span></label>
                <input type="text" name="judul" class="form-control" style="font-size: 1.05rem; padding: 0.9rem; background: #f8f9fa;" placeholder="Contoh: Pentingnya 1000 Hari Pertama Kehidupan Cegah Stunting" required>
            </div>

            <div class="form-group">
                <label class="form-label">Kategori Edukasi <span style="color: red;">*</span></label>
                <select name="kategori_info" class="form-control" required>
                    <option value="Tumbuh Kembang">Tumbuh Kembang</option>
                    <option value="Nutrisi">Nutrisi & MPASI</option>
                    <option value="Imunisasi">Imunisasi & Vaksinasi</option>
                    <option value="Ibu Hamil">Ibu Hamil & ANC</option>
                    <option value="Lansia">Kesehatan Lansia & PTM</option>
                    <option value="Remaja">Kesehatan Remaja & Anemia</option>
                </select>
            </div>

            <div class="form-group">
                <label class="form-label">Isi Artikel & Panduan Kesehatan <span style="color: red;">*</span></label>
                <div style="border: 1px solid #eee; border-radius: 12px; overflow: hidden;">
                    <div style="background: #f1f3f4; padding: 10px; display: flex; gap: 15px; border-bottom: 1px solid #eee;">
                        <i class="fa-solid fa-bold" title="Tebal" style="cursor: pointer;"></i>
                        <i class="fa-solid fa-italic" title="Miring" style="cursor: pointer;"></i>
                        <i class="fa-solid fa-list-ul" title="Daftar" style="cursor: pointer;"></i>
                        <div style="width: 1px; height: 15px; background: #ccc;"></div>
                        <i class="fa-solid fa-image" title="Gambar" style="cursor: pointer;"></i>
                        <i class="fa-solid fa-link" title="Tautan" style="cursor: pointer;"></i>
                    </div>
                    <textarea name="isi_informasi" class="form-control" rows="10" style="border: none; border-radius: 0; background: #fff;" placeholder="Tuliskan materi penyuluhan dan panduan kesehatan masyarakat di sini..." required></textarea>
                </div>
            </div>

            <div style="display: flex; justify-content: flex-end; gap: 15px; margin-top: 2rem;">
                <button type="reset" class="btn" style="background: #fff; border: 1px solid #ddd; color: var(--text-main);">Atur Ulang</button>
                <button type="submit" class="btn btn-primary">
                    <i class="fa-solid fa-paper-plane" style="margin-right: 6px;"></i> Publikasikan Artikel
                </button>
            </div>
        </form>
    </div>

    <!-- Article Sidebar -->
    <div style="display: flex; flex-direction: column; gap: 24px;">
        <div class="card" style="background: #fdf8f3; border: none;">
            <div class="card-title">
                <span><i class="fa-solid fa-clock-rotate-left" style="color: #d4a373;"></i> Daftar Artikel Aktif</span>
                <span style="font-size: 0.7rem; background: #fff; padding: 2px 8px; border-radius: 10px;">{{ count($articles) }} Artikel</span>
            </div>

            <div style="display: flex; flex-direction: column; gap: 15px; max-height: 520px; overflow-y: auto;">
                @forelse($articles as $art)
                <div style="background: #fff; padding: 14px; border-radius: 12px; display: flex; gap: 12px; box-shadow: 0 2px 8px rgba(0,0,0,0.03);">
                    <div style="width: 48px; height: 48px; background: #f0f4f1; border-radius: 10px; display: flex; align-items: center; justify-content: center; color: var(--primary); font-size: 1.2rem; flex-shrink: 0;">
                        <i class="fa-solid fa-book-medical"></i>
                    </div>
                    <div style="flex-grow: 1;">
                        <div style="display: flex; justify-content: space-between; margin-bottom: 5px;">
                            <span style="font-size: 0.65rem; font-weight: 700; color: #27ae60; background: #f0f4f1; padding: 2px 8px; border-radius: 6px;">{{ $art->kategori_info ?? 'Umum' }}</span>
                            <span style="font-size: 0.65rem; color: #aaa;">{{ \Carbon\Carbon::parse($art->tanggal_post)->format('d M Y') }}</span>
                        </div>
                        <div style="font-weight: 700; font-size: 0.85rem; margin-bottom: 5px; color: var(--text-main); line-height: 1.3;">{{ $art->judul }}</div>
                        <div style="font-size: 0.75rem; color: #777; line-height: 1.4;">
                            {{ \Illuminate\Support\Str::limit($art->isi_informasi, 70) }}
                        </div>
                    </div>
                </div>
                @empty
                <p style="font-size: 0.85rem; color: var(--text-muted); text-align: center;">Belum ada artikel edukasi.</p>
                @endforelse
            </div>
        </div>

        <div class="card" style="background: #f0f4f1; border: none; text-align: center; padding: 1.5rem;">
            <i class="fa-solid fa-bullhorn" style="font-size: 2rem; color: var(--primary); margin-bottom: 10px;"></i>
            <h4 class="serif" style="margin-bottom: 6px;">Edukasi Komunitas</h4>
            <p style="font-size: 0.8rem; color: var(--text-muted);">Artikel yang dipublikasikan akan tampil di portal warga dan aplikasi mobile Posyandu.</p>
        </div>
    </div>
</div>
@endsection
