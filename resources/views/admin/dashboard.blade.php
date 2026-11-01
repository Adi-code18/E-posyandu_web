@extends('layouts.admin')

@section('title', 'Dashboard')
@section('breadcrumbs', 'Beranda > Dashboard')
@section('page_title', 'Selamat datang kembali, Ibu Kader')

@section('content')
<p class="text-muted mb-4">Pemantauan kesehatan bulanan aktif di Posyandu Anggrek</p>

<!-- Stats Grid -->
<div class="stats-grid">
    <div class="stat-card green">
        <div class="stat-label">Anak-Anak & Balita</div>
        <div class="stat-value">{{ $stats['balita'] }}</div>
        <div class="stat-trend">
            <i class="fa-solid fa-arrow-up"></i>
            <span>+{{ $stats['balita'] }} total</span>
        </div>
    </div>
    <div class="stat-card yellow">
        <div class="stat-label">Ibu Hamil</div>
        <div class="stat-value">{{ $stats['bumil'] }}</div>
        <div class="stat-trend">
            <i class="fa-solid fa-arrow-up"></i>
            <span>+{{ $stats['bumil'] }} total</span>
        </div>
    </div>
    <div class="stat-card beige">
        <div class="stat-label">Lansia</div>
        <div class="stat-value">{{ $stats['lansia'] }}</div>
        <div class="stat-trend">
            <i class="fa-solid fa-arrow-up"></i>
            <span>+{{ $stats['lansia'] }} total</span>
        </div>
    </div>
    <div class="stat-card purple">
        <div class="stat-label">Remaja & Usia Produktif</div>
        <div class="stat-value">{{ $stats['remaja'] }}</div>
        <div class="stat-trend">
            <i class="fa-solid fa-arrow-up"></i>
            <span>+{{ $stats['remaja'] }} total</span>
        </div>
    </div>
</div>


<!-- Main Dashboard Content -->
<div class="content-grid">
    <div class="card">
        <div class="card-title">
            <span>Grafik Kesehatan Bulanan</span>
            <select class="form-control" style="width: auto; padding: 4px 10px; font-size: 0.8rem;">
                <option>10 Bulan Terakhir</option>
            </select>
        </div>
        <div style="height: 350px;">
            <canvas id="healthChart"></canvas>
        </div>
    </div>

    <div class="card">
        <div class="card-title">
            <span>Pendaftaran Terbaru</span>
            <a href="{{ route('admin.daftar-anggota') }}" class="text-primary" style="font-size: 0.8rem; font-weight: 500;">Lihat Semua</a>
        </div>
        <div class="recent-list">
            @foreach($recentWarga as $item)
            <div style="display: flex; align-items: center; gap: 15px; margin-bottom: 20px;">
                <img src="https://ui-avatars.com/api/?name={{ urlencode($item->nama_lengkap) }}&background=random" style="width: 40px; height: 40px; border-radius: 50%;">
                <div style="flex-grow: 1;">
                    <div style="font-weight: 600; font-size: 0.95rem;">{{ $item->nama_lengkap }}</div>
                    <div style="font-size: 0.8rem; color: var(--text-muted);">{{ $item->status }} • {{ \Carbon\Carbon::parse($item->tanggal_lahir)->age }} Tahun</div>
                </div>
                <div style="font-size: 0.75rem; color: var(--text-muted);">{{ $item->created_at->diffForHumans() }}</div>
            </div>
            @endforeach
        </div>

        <a href="{{ route('admin.pendaftaran') }}" class="btn btn-primary" style="width: 100%; justify-content: center; margin-top: 10px; text-decoration: none;">
            <i class="fa-solid fa-user-plus"></i>
            Daftarkan Anggota Baru
        </a>
    </div>
</div>
@endsection

@section('scripts')
<script>
    const ctx = document.getElementById('healthChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['JAN', 'FEB', 'MAR', 'APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT'],
            datasets: [{
                label: 'Partisipasi',
                data: [35, 42, 38, 55, 48, 65, 60, 72, 68, 85],
                backgroundColor: function(context) {
                    const index = context.dataIndex;
                    return index === 9 ? '#4a7c59' : 'rgba(74, 124, 89, 0.2)';
                },
                borderRadius: 8,
                borderSkipped: false,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: { display: false },
                    border: { display: false }
                },
                x: {
                    grid: { display: false },
                    border: { display: false }
                }
            }
        }
    });
</script>
@endsection
