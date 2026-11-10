{{--
    =============================================================================
    Halaman: Laporan Kesehatan Bulanan & Agregat Posyandu
    =============================================================================
    Fitur:
    - Rekapitulasi capaian 4 kategori siklus hidup (Balita, Bumil, Remaja, Lansia)
    - Filter periode laporan bulanan dan tahunan
    - Tombol unduh laporan berkas format PDF resmi
    - Tabel riwayat dokumen laporan kesehatan yang telah divalidasi
    =============================================================================
--}}
@extends('layouts.admin')

@section('title', 'Laporan Kesehatan')
@section('breadcrumbs', 'Beranda > Laporan Kesehatan')
@section('page_title', 'Laporan Kesehatan Bulanan')

@section('content')
<p class="text-muted mb-4">Kelola, tinjau, dan unduh berkas rekapitulasi data capaian kesehatan masyarakat Posyandu secara berkala.</p>

<!-- 1. Baris Filter Periode -->
<div style="display: flex; justify-content: flex-end; align-items: center; gap: 12px; margin-bottom: 2rem; flex-wrap: wrap;">
    <div style="display: flex; gap: 6px; align-items: center;">
        <span style="font-size: 0.75rem; color: var(--text-muted); font-weight: 700; text-transform: uppercase;">Bulan:</span>
        <select class="form-control" style="width: auto; padding: 6px 12px; font-size: 0.85rem;">
            <option>November</option>
            <option>Oktober</option>
            <option>September</option>
        </select>
    </div>
    <div style="display: flex; gap: 6px; align-items: center;">
        <span style="font-size: 0.75rem; color: var(--text-muted); font-weight: 700; text-transform: uppercase;">Tahun:</span>
        <select class="form-control" style="width: auto; padding: 6px 12px; font-size: 0.85rem;">
            <option>2024</option>
            <option>2023</option>
        </select>
    </div>
    <button type="button" class="btn btn-primary btn-sm">
        <i class="fa-solid fa-filter"></i>
        <span>Terapkan</span>
    </button>
</div>

<!-- 2. Grid Kartu Kategori Laporan Responsif -->
<div class="stats-grid mb-4" style="grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));">
    @php
        $categories = [
            ['Bayi & Balita', '42 kunjungan penimbangan', 'fa-baby', 'var(--primary-light)', 'var(--primary)'],
            ['Ibu Hamil (ANC)', '12 pemeriksaan kehamilan', 'fa-person-pregnant', 'var(--accent-light)', 'var(--accent-hover)'],
            ['Remaja & Produktif', '28 skrining Hb & anemia', 'fa-people-group', '#f0fdf4', '#15803d'],
            ['Lansia (Posbindu)', '35 cek tensi & metabolik', 'fa-person-walking-with-cane', '#f0f9ff', '#0369a1'],
        ];
    @endphp

    @foreach($categories as $cat)
    <div class="card" style="text-align: center; display: flex; flex-direction: column; justify-content: space-between;">
        <div>
            <div class="icon-btn" style="width: 52px; height: 52px; margin: 0 auto 1.25rem; background: {{ $cat[3] }}; color: {{ $cat[4] }}; border-radius: var(--radius-md); font-size: 1.35rem; border: none;">
                <i class="fa-solid {{ $cat[2] }}"></i>
            </div>
            <h4 class="serif" style="margin-bottom: 6px; font-size: 1.15rem;">{{ $cat[0] }}</h4>
            <p class="text-muted" style="font-size: 0.825rem; margin-bottom: 1.5rem;">{{ $cat[1] }}</p>
        </div>
        
        <div style="display: flex; flex-direction: column; gap: 8px;">
            <button type="button" class="btn btn-secondary btn-sm btn-block">
                <span>Lihat Rekapitulasi</span>
            </button>
            <button type="button" class="btn btn-outline-primary btn-sm btn-block">
                <i class="fa-solid fa-file-pdf"></i>
                <span>Unduh PDF</span>
            </button>
        </div>
    </div>
    @endforeach
</div>

<!-- 3. Tabel Riwayat Dokumen Terakhir -->
<div class="card mb-4">
    <div class="card-title">
        <span><i class="fa-solid fa-file-shield text-primary" style="margin-right: 8px;"></i> Riwayat Berkas Laporan Tersahkan</span>
    </div>

    <div class="table-responsive">
        <table class="custom-table">
            <thead>
                <tr>
                    <th>NAMA LAPORAN KESEHATAN</th>
                    <th>PERIODE KEGIATAN</th>
                    <th>TANGGAL PENGESAHAN</th>
                    <th style="text-align: center;">TINDAKAN</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $history = [
                        ['Rekapitulasi Gizi Balita Stunting — RW 01', 'Oktober 2024', '02 Nov 2024, 09:15', 'fa-baby'],
                        ['Laporan Tahunan Skrining PTM Lansia', 'Sep - Okt 2024', '28 Okt 2024, 14:30', 'fa-person-walking-with-cane'],
                        ['Rekam Skrining Ibu Hamil Risiko KEK', 'September 2024', '01 Okt 2024, 10:00', 'fa-person-pregnant'],
                    ];
                @endphp

                @foreach($history as $item)
                <tr>
                    <td>
                        <div style="display: flex; align-items: center; gap: 12px;">
                            <div style="width: 36px; height: 36px; background: var(--bg-card-subtle); border-radius: var(--radius-sm); display: flex; align-items: center; justify-content: center; color: var(--primary); flex-shrink: 0;">
                                <i class="fa-solid {{ $item[3] }}"></i>
                            </div>
                            <span style="font-weight: 600;">{{ $item[0] }}</span>
                        </div>
                    </td>
                    <td class="text-muted">{{ $item[1] }}</td>
                    <td class="text-muted">{{ $item[2] }}</td>
                    <td style="text-align: center;">
                        <button type="button" class="btn btn-secondary btn-xs" title="Lihat Berkas">
                            <i class="fa-regular fa-eye"></i>
                            <span>Buka</span>
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
