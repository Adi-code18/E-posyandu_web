{{--
    =============================================================================
    Halaman: Pencatatan Fisik & Antropometri Posyandu
    =============================================================================
    Fitur:
    - Identifikasi subjek warga sasaran aktif yang sedang diperiksa
    - Formulir parameter fisik (TB, BB, Lingkar Kepala, LILA, Lingkar Perut, Tensi)
    - Kartu panduan standar antropometri Kemenkes RI
    - Tombol aksi simpan rekam medis dengan umpan balik visual
    =============================================================================
--}}
@extends('layouts.admin')

@section('title', 'Pencatatan Fisik & Antropometri')
@section('breadcrumbs', 'Beranda > Daftar Anggota > Pencatatan Fisik')
@section('page_title', 'Pencatatan Fisik & Antropometri')

@section('content')
<p class="text-muted mb-4">Mencatat data pertumbuhan antropometri dan status kesehatan fisik berkala anggota Posyandu.</p>

<div class="content-grid">
    <!-- Kolom Kiri: Formulir Input Antropometri -->
    <div class="card">
        <!-- Banner Identitas Warga Sasaran -->
        <div style="background: var(--primary-light); border-left: 4px solid var(--primary); padding: 1rem 1.25rem; border-radius: var(--radius-md); display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.75rem; flex-wrap: wrap; gap: 10px;">
            <div>
                <span style="font-size: 0.7rem; text-transform: uppercase; color: var(--primary); font-weight: 700; letter-spacing: 0.05em;">
                    Warga Sasaran Terpilih
                </span>
                <div style="font-weight: 700; font-size: 1.1rem; color: var(--text-main);">
                    {{ $warga->nama_lengkap ?? 'Belum ada warga dipilih' }} 
                    <span style="font-weight: 400; color: var(--text-muted); font-size: 0.85rem;">(NIK: {{ $warga->NIK ?? '-' }})</span>
                </div>
            </div>
            <a href="{{ route('admin.daftar-anggota') }}" class="btn btn-outline-primary btn-xs">
                <i class="fa-solid fa-arrows-rotate"></i>
                <span>Ganti Warga</span>
            </a>
        </div>

        <div class="card-title">
            <span><i class="fa-solid fa-file-waveform text-primary" style="margin-right: 8px;"></i> Formulir Pengukuran {{ $warga->status ?? 'Balita' }}</span>
            <span style="font-size: 0.75rem; color: var(--danger); font-weight: 500;">* Bidang wajib diisi</span>
        </div>

        <form action="{{ route('admin.pemeriksaan.store') }}" method="POST">
            @csrf
            <input type="hidden" name="nik" value="{{ $warga->NIK ?? '' }}">

            <!-- Baris 1: Tinggi Badan & Berat Badan -->
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Tinggi Badan (cm) <span class="text-danger">*</span></label>
                    <div style="position: relative;">
                        <input type="number" step="0.1" name="tb" class="form-control" placeholder="Contoh: 85.5" required>
                        <span style="position: absolute; right: 14px; top: 50%; transform: translateY(-50%); color: var(--text-subtle); font-size: 0.85rem; font-weight: 600;">cm</span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Berat Badan (kg) <span class="text-danger">*</span></label>
                    <div style="position: relative;">
                        <input type="number" step="0.1" name="bb" class="form-control" placeholder="Contoh: 11.2" required>
                        <span style="position: absolute; right: 14px; top: 50%; transform: translateY(-50%); color: var(--text-subtle); font-size: 0.85rem; font-weight: 600;">kg</span>
                    </div>
                </div>
            </div>

            <!-- Baris 2: Lingkar Kepala & Lingkar Lengan Atas -->
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Lingkar Kepala (cm)</label>
                    <div style="position: relative;">
                        <input type="number" step="0.1" name="lk" class="form-control" placeholder="Contoh: 46.0">
                        <span style="position: absolute; right: 14px; top: 50%; transform: translateY(-50%); color: var(--text-subtle); font-size: 0.85rem; font-weight: 600;">cm</span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Lingkar Lengan Atas (LiLA) (cm)</label>
                    <div style="position: relative;">
                        <input type="number" step="0.1" name="la" class="form-control" placeholder="Contoh: 14.5">
                        <span style="position: absolute; right: 14px; top: 50%; transform: translateY(-50%); color: var(--text-subtle); font-size: 0.85rem; font-weight: 600;">cm</span>
                    </div>
                </div>
            </div>

            <!-- Baris 3: Lingkar Perut & Tekanan Darah -->
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Lingkar Perut (cm)</label>
                    <div style="position: relative;">
                        <input type="number" step="0.1" name="lp" class="form-control" placeholder="Contoh: 44.0">
                        <span style="position: absolute; right: 14px; top: 50%; transform: translateY(-50%); color: var(--text-subtle); font-size: 0.85rem; font-weight: 600;">cm</span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Tekanan Darah (Tensi / mmHg)</label>
                    <input type="text" name="tensi" class="form-control" placeholder="Contoh: 120/80">
                </div>
            </div>

            <!-- Catatan Tambahan Petugas Medis -->
            <div class="form-group">
                <label class="form-label">Catatan Kesehatan & Rekomendasi Gizi</label>
                <textarea name="catatan" rows="3" class="form-control" placeholder="Catatan evaluasi atau vitamin/PMT yang diserahkan..."></textarea>
            </div>

            <!-- Tombol Aksi Formulir -->
            <div style="display: flex; justify-content: flex-end; gap: 12px; margin-top: 2rem; flex-wrap: wrap;">
                <button type="reset" class="btn btn-secondary">
                    <i class="fa-solid fa-rotate-left"></i>
                    <span>Atur Ulang</span>
                </button>
                <button type="submit" class="btn btn-primary">
                    <i class="fa-solid fa-floppy-disk"></i>
                    <span>Simpan Hasil Pemeriksaan</span>
                </button>
            </div>
        </form>
    </div>

    <!-- Kolom Kanan: Panduan Standar Antropometri -->
    <div style="display: flex; flex-direction: column; gap: 20px;">
        <div class="card" style="background: var(--bg-card-subtle);">
            <div class="card-title">
                <span><i class="fa-solid fa-ruler-combined text-primary" style="margin-right: 8px;"></i> Standar Pengukuran</span>
            </div>
            
            <div style="display: flex; flex-direction: column; gap: 14px; font-size: 0.85rem;">
                <div style="border-left: 3px solid var(--primary); padding-left: 10px;">
                    <div style="font-weight: 700; color: var(--text-main);">Tinggi / Panjang Badan</div>
                    <p style="color: var(--text-muted); margin: 0;">Anak < 2 tahun diukur terlentang (panjang badan), anak >= 2 tahun diukur berdiri tegak (mikrotoa).</p>
                </div>
                <div style="border-left: 3px solid var(--accent); padding-left: 10px;">
                    <div style="font-weight: 700; color: var(--text-main);">Pita LiLA (Ibu Hamil & Balita)</div>
                    <p style="color: var(--text-muted); margin: 0;">LiLA < 23.5 cm pada Ibu Hamil menandakan risiko Kurang Energi Kronis (KEK).</p>
                </div>
                <div style="border-left: 3px solid var(--info); padding-left: 10px;">
                    <div style="font-weight: 700; color: var(--text-main);">Lingkar Kepala</div>
                    <p style="color: var(--text-muted); margin: 0;">Diukur melingkari dahi di atas alis mata dan tonjolan kepala belakang.</p>
                </div>
            </div>
        </div>

        <div class="card" style="background: var(--primary-light); border-color: var(--primary-border);">
            <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 8px;">
                <i class="fa-solid fa-shield-virus text-primary" style="font-size: 1.25rem;"></i>
                <div style="font-weight: 700; color: var(--primary);">Intervensi Stunting</div>
            </div>
            <p style="font-size: 0.825rem; color: var(--text-main); margin: 0;">
                Setiap pengukuran berat badan dan tinggi badan yang berada di bawah -2 Standar Deviasi (SD) wajib dilaporkan ke bidan desa untuk rujukan Puskesmas.
            </p>
        </div>
    </div>
</div>
@endsection
