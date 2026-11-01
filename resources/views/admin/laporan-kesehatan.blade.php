@extends('layouts.admin')

@section('title', 'Laporan Kesehatan')
@section('breadcrumbs', 'Beranda > Laporan Kesehatan')
@section('page_title', 'Laporan Kesehatan Bulanan')

@section('content')
<p class="text-muted mb-4">Kelola dan unduh rekapitulasi data kesehatan warga bulanan.</p>

<!-- Filters -->
<div style="display: flex; justify-content: flex-end; align-items: center; gap: 15px; margin-bottom: 2.5rem;">
    <div style="display: flex; gap: 8px; align-items: center;">
        <span style="font-size: 0.7rem; color: var(--text-muted); font-weight: 700; text-transform: uppercase;">Bulan</span>
        <select class="form-control" style="width: auto; padding: 4px 10px;">
            <option>November</option>
            <option>Oktober</option>
        </select>
    </div>
    <div style="display: flex; gap: 8px; align-items: center;">
        <span style="font-size: 0.7rem; color: var(--text-muted); font-weight: 700; text-transform: uppercase;">Tahun</span>
        <select class="form-control" style="width: auto; padding: 4px 10px;">
            <option>2024</option>
            <option>2023</option>
        </select>
    </div>
    <div class="icon-btn" style="border-radius: 8px; background: var(--primary); color: #fff;">
        <i class="fa-solid fa-filter"></i>
    </div>
</div>

<!-- Report Categories -->
<div class="stats-grid" style="grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));">
    @php
        $categories = [
            ['Bayi & Balita', '42 kunjungan tercatat', 'fa-baby', '#f0f4f1', '#4a7c59'],
            ['Ibu Hamil', '12 pemeriksaan rutin', 'fa-person-pregnant', '#fdf8f3', '#d4a373'],
            ['Remaja & Produktif', '28 skrining kesehatan', 'fa-people-group', '#f5f5f0', '#a5a58d'],
            ['Lansia', '35 cek tensi & gula', 'fa-person-walking-with-cane', '#f0f4f1', '#4a7c59'],
        ];
    @endphp

    @foreach($categories as $cat)
    <div class="card" style="text-align: center; padding: 2rem 1.5rem;">
        <div class="icon-btn" style="width: 50px; height: 50px; margin: 0 auto 1.5rem; background: {{ $cat[3] }}; color: {{ $cat[4] }}; border-radius: 12px; font-size: 1.2rem;">
            <i class="fa-solid {{ $cat[2] }}"></i>
        </div>
        <h4 class="serif" style="margin-bottom: 8px;">{{ $cat[0] }}</h4>
        <p style="font-size: 0.8rem; color: var(--text-muted); margin-bottom: 1.5rem;">{{ $cat[1] }}</p>
        
        <div style="display: flex; flex-direction: column; gap: 10px;">
            <button class="btn" style="background: #fff; border: 1px solid #ddd; font-size: 0.8rem; justify-content: center; padding: 8px;">
                Lihat Detail
            </button>
            <button class="btn" style="background: #fdf8f3; color: #d4a373; font-size: 0.8rem; justify-content: center; padding: 8px;">
                <i class="fa-solid fa-download"></i> Unduh PDF
            </button>
        </div>
    </div>
    @endforeach
</div>

<!-- Recent History -->
<div class="card mt-4">
    <div class="card-title">
        <span>Riwayat Laporan Terakhir</span>
        <a href="#" class="text-primary" style="font-size: 0.8rem; font-weight: 600;">Lihat Semua Riwayat <i class="fa-solid fa-arrow-right"></i></a>
    </div>

    <table style="width: 100%; border-collapse: collapse; margin-top: 1rem;">
        <thead>
            <tr style="text-align: left; color: var(--text-muted); font-size: 0.7rem; text-transform: uppercase; border-bottom: 1px solid #eee;">
                <th style="padding: 15px 10px;">Nama Laporan</th>
                <th style="padding: 15px 10px;">Periode</th>
                <th style="padding: 15px 10px;">Tanggal Unduh</th>
                <th style="padding: 15px 10px; text-align: center;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @php
                $history = [
                    ['Rekapitulasi Balita - Unit 04', 'Oktober 2024', '02 Nov 2024, 09:15', 'fa-file-invoice'],
                    ['Laporan Lansia Tahunan', 'Sep - Okt 2024', '28 Okt 2024, 14:30', 'fa-hospital-user'],
                    ['Data Bumil KEK', 'September 2024', '01 Okt 2024, 10:00', 'fa-person-pregnant'],
                ];
            @endphp

            @foreach($history as $item)
            <tr style="border-bottom: 1px solid #fafafa; font-size: 0.9rem;">
                <td style="padding: 20px 10px;">
                    <div style="display: flex; align-items: center; gap: 15px;">
                        <i class="fa-solid {{ $item[3] }}" style="color: #d4a373;"></i>
                        <div style="font-weight: 600;">{{ $item[0] }}</div>
                    </div>
                </td>
                <td style="padding: 20px 10px; color: #666;">{{ $item[1] }}</td>
                <td style="padding: 20px 10px; color: #666;">{{ $item[2] }}</td>
                <td style="padding: 20px 10px; text-align: center;">
                    <i class="fa-regular fa-eye" style="color: var(--primary); cursor: pointer;"></i>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
