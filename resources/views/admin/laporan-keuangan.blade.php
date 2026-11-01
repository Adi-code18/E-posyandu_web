@extends('layouts.admin')

@section('title', 'Laporan Keuangan')
@section('breadcrumbs', 'Beranda > Laporan Keuangan')
@section('page_title', 'Laporan Keuangan Bulanan')

@section('content')
<p class="text-muted mb-4">Kelola dan unduh rekapitulasi data keuangan posyandu.</p>

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

<div style="display: flex; justify-content: flex-end; margin-bottom: 2rem;">
    <button class="btn" style="background: #4a7c59; color: white; border-radius: 10px;">
        <i class="fa-solid fa-file-excel" style="margin-right: 8px;"></i> Cetak Laporan Bulanan (XLSX)
    </button>
</div>

<!-- Financial Summary Cards -->
<div class="stats-grid" style="grid-template-columns: 1fr 1fr; max-width: 800px;">
    <div class="card" style="background: #f0f4f1; position: relative; overflow: hidden; border: none;">
        <div style="position: absolute; right: -20px; top: -20px; width: 100px; height: 100px; background: rgba(74, 124, 89, 0.05); border-radius: 50%;"></div>
        <div style="display: flex; align-items: center; gap: 15px; margin-bottom: 1rem;">
            <div class="icon-btn" style="background: #fff; color: var(--primary); width: 45px; height: 45px;"><i class="fa-solid fa-arrow-down"></i></div>
            <span style="font-weight: 600; color: var(--text-muted);">Total Pemasukan Kas</span>
        </div>
        <div style="font-size: 2.2rem; font-weight: 700; color: var(--primary);">Rp {{ number_format($totalKas ?? 12450000, 0, ',', '.') }}</div>
        <div style="font-size: 0.8rem; color: #27ae60; font-weight: 600; margin-top: 10px;">
            <i class="fa-solid fa-circle-check"></i> Sumber Dana Desa & Swadaya
        </div>
    </div>

    <div class="card" style="background: #fdf8f3; position: relative; overflow: hidden; border: none;">
        <div style="position: absolute; right: -20px; top: -20px; width: 100px; height: 100px; background: rgba(212, 163, 115, 0.05); border-radius: 50%;"></div>
        <div style="display: flex; align-items: center; gap: 15px; margin-bottom: 1rem;">
            <div class="icon-btn" style="background: #fff; color: #d4a373; width: 45px; height: 45px;"><i class="fa-solid fa-wallet"></i></div>
            <span style="font-weight: 600; color: var(--text-muted);">Saldo Kas Berjalan</span>
        </div>
        <div style="font-size: 2.2rem; font-weight: 700; color: #2c3e50;">Rp {{ number_format($saldo ?? 4330000, 0, ',', '.') }}</div>
        <div style="font-size: 0.8rem; color: #d4a373; font-weight: 600; margin-top: 10px;">
            <i class="fa-solid fa-circle-check"></i> Status: Sehat / Surplus
        </div>
    </div>
</div>

<!-- Transactions Table -->
<div class="card mt-4">
    <div class="card-title">
        <span>Detail Transaksi</span>
        <div style="display: flex; gap: 10px;">
            <button class="btn" style="padding: 6px 15px; font-size: 0.8rem; border: 1px solid #ddd; background: #fff;"><i class="fa-solid fa-filter"></i> Filter</button>
            <button class="btn" style="padding: 6px 15px; font-size: 0.8rem; border: 1px solid #ddd; background: #fff;"><i class="fa-solid fa-sort"></i> Urutkan</button>
        </div>
    </div>
    
    <table style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr style="text-align: left; color: var(--text-muted); font-size: 0.7rem; text-transform: uppercase; border-bottom: 1px solid #eee;">
                <th style="padding: 15px 10px;">Tanggal</th>
                <th style="padding: 15px 10px;">Nama Barang / Keperluan</th>
                <th style="padding: 15px 10px; text-align: center;">Jumlah</th>
                <th style="padding: 15px 10px; text-align: right;">Nominal</th>
                <th style="padding: 15px 10px; text-align: center;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @php
                $transactions = [
                    ['12 Okt 2023', 'Dana Desa Tahap II', 'TRN-2023-0102', '1', 'Rp 5.000.000', 'in'],
                    ['15 Okt 2023', 'Pembelian PMT Balita', 'TRN-2023-0105', '5', 'Rp 2.450.000', 'out'],
                    ['18 Okt 2023', 'Donasi Masyarakat Mandiri', 'TRN-2023-0108', '10', 'Rp 1.200.000', 'in'],
                    ['20 Okt 2023', 'Honorarium Kader (5 Orang)', 'TRN-2023-0110', '2', 'Rp 2.500.000', 'out'],
                    ['25 Okt 2023', 'Sewa Tenda & Sound System', 'TRN-2023-0115', '1', 'Rp 750.000', 'out'],
                ];
            @endphp

            @foreach($transactions as $trx)
            <tr style="border-bottom: 1px solid #fafafa; font-size: 0.9rem;">
                <td style="padding: 20px 10px;">{{ $trx[0] }}</td>
                <td style="padding: 20px 10px;">
                    <div style="font-weight: 600;">{{ $trx[1] }}</div>
                    <div style="font-size: 0.75rem; color: #aaa;">ID: {{ $trx[2] }}</div>
                </td>
                <td style="padding: 20px 10px; text-align: center;">{{ $trx[3] }}</td>
                <td style="padding: 20px 10px; text-align: right; font-weight: 700; color: {{ $trx[5] == 'in' ? '#27ae60' : '#2c3e50' }};">
                    {{ $trx[4] }}
                </td>
                <td style="padding: 20px 10px; text-align: center;">
                    <i class="fa-solid fa-ellipsis-vertical" style="color: #ccc; cursor: pointer;"></i>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 2rem;">
        <span style="font-size: 0.8rem; color: var(--text-muted);">Menampilkan 5 dari 42 transaksi</span>
        <div style="display: flex; gap: 5px;">
            <button class="icon-btn" style="width: 25px; height: 25px;"><i class="fa-solid fa-chevron-left" style="font-size: 0.6rem;"></i></button>
            <button class="icon-btn" style="width: 25px; height: 25px; background: var(--primary); color: #fff;">1</button>
            <button class="icon-btn" style="width: 25px; height: 25px;">2</button>
            <button class="icon-btn" style="width: 25px; height: 25px;">3</button>
            <button class="icon-btn" style="width: 25px; height: 25px;"><i class="fa-solid fa-chevron-right" style="font-size: 0.6rem;"></i></button>
        </div>
    </div>
</div>

<footer style="text-align: center; margin-top: 4rem; color: var(--text-muted); font-size: 0.8rem;">
    <div>Terra e-Posyandu Management System © 2023</div>
    <p>Laporan ini dibuat otomatis oleh sistem dan telah divalidasi oleh administrator.</p>
</footer>
@endsection
