@extends('layouts.admin')

@section('title', 'Profil Warga')
@section('breadcrumbs', 'Beranda > Daftar Anggota > ' . $warga->nama_lengkap)
@section('page_title', 'Profil Warga')

@section('content')
<p class="text-muted mb-4">Catatan rinci untuk pemantauan dan evaluasi kesehatan.</p>

<!-- Header Action Buttons -->
<div style="display: flex; justify-content: flex-end; gap: 10px; margin-bottom: 2rem;">
    <a href="{{ route('admin.daftar-anggota') }}" class="btn" style="background: #fff; border: 1px solid #ddd; color: var(--text-main); text-decoration: none;">
        <i class="fa-solid fa-arrow-left" style="margin-right: 8px;"></i> Kembali
    </a>
    <a href="{{ route('admin.pemeriksaan', ['nik' => $warga->NIK]) }}" class="btn btn-primary" style="text-decoration: none;">
        <i class="fa-solid fa-plus" style="margin-right: 8px;"></i> Tambah Pengukuran Baru
    </a>
</div>

<!-- Profile Summary Card -->
<div class="card mb-4" style="padding: 2rem; display: flex; align-items: center; gap: 30px; background: linear-gradient(135deg, #fff 0%, #fdfdfd 100%);">
    <img src="https://ui-avatars.com/api/?name={{ urlencode($warga->nama_lengkap) }}&background=random" style="width: 120px; height: 120px; border-radius: 20px; object-fit: cover; box-shadow: var(--shadow);">
    <div style="flex-grow: 1;">
        <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 8px;">
            <h3 class="serif" style="font-size: 1.8rem; margin: 0;">{{ $warga->nama_lengkap }}</h3>
            <span style="background: #f0f4f1; color: var(--primary); font-size: 0.65rem; font-weight: 700; padding: 4px 10px; border-radius: 20px; text-transform: uppercase;">{{ $warga->jenis_kelamin == 'Laki-laki' ? 'MALE' : 'FEMALE' }}</span>
        </div>
        <p style="margin-bottom: 15px; font-size: 0.95rem;">NIK: {{ $warga->NIK }} • {{ \Carbon\Carbon::parse($warga->tanggal_lahir)->age }} years old</p>
        
        <div style="display: flex; gap: 15px;">
            <div style="background: #fff; border: 1px solid #eee; padding: 8px 15px; border-radius: 12px; display: flex; align-items: center; gap: 10px;">
                <span style="font-size: 0.7rem; color: var(--text-muted); text-transform: uppercase;">Status</span>
                <span style="font-weight: 700; color: #27ae60;">{{ $warga->status ?? 'Normal' }} <i class="fa-solid fa-circle-check"></i></span>
            </div>
        </div>
    </div>
</div>


<!-- Tabs Navigation -->
<div style="display: flex; border-bottom: 1px solid #eee; margin-bottom: 2.5rem; gap: 40px;">
    <button class="tab-btn active" data-tab="health" style="padding: 15px 0; border: none; background: none; font-weight: 600; cursor: pointer; color: var(--primary); border-bottom: 3px solid var(--primary);">
        Informasi Pribadi & Riwayat Kesehatan
    </button>
    <button class="tab-btn" data-tab="growth" style="padding: 15px 0; border: none; background: none; font-weight: 600; cursor: pointer; color: var(--text-muted);">
        Grafik Pertumbuhan
    </button>
</div>

<!-- Tab Content: Health & Info -->
<div id="healthTabContent">
    <div class="content-grid">
        <div style="display: flex; flex-direction: column; gap: 24px;">
            <div class="card">
                <h4 class="serif mb-4"><i class="fa-solid fa-user-circle" style="color: var(--primary); margin-right: 10px;"></i> Informasi Pribadi</h4>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                    <div>
                        <label style="font-size: 0.75rem; color: var(--text-muted); display: block; margin-bottom: 4px;">NAMA LENGKAP</label>
                        <div style="font-weight: 600;">{{ $warga->nama_lengkap }}</div>
                    </div>
                    <div>
                        <label style="font-size: 0.75rem; color: var(--text-muted); display: block; margin-bottom: 4px;">TANGGAL LAHIR</label>
                        <div style="font-weight: 600;">{{ \Carbon\Carbon::parse($warga->tanggal_lahir)->translatedFormat('d F Y') }}</div>
                    </div>
                    <div>
                        <label style="font-size: 0.75rem; color: var(--text-muted); display: block; margin-bottom: 4px;">NAMA IBU</label>
                        <div style="font-weight: 600;">{{ $warga->nama_ibu ?? '-' }}</div>
                    </div>
                    <div>
                        <label style="font-size: 0.75rem; color: var(--text-muted); display: block; margin-bottom: 4px;">NAMA AYAH</label>
                        <div style="font-weight: 600;">{{ $warga->nama_ayah ?? '-' }}</div>
                    </div>
                    <div>
                        <label style="font-size: 0.75rem; color: var(--text-muted); display: block; margin-bottom: 4px;">STATUS / KELOMPOK</label>
                        <div style="font-weight: 600;">{{ $warga->status ?? '-' }}</div>
                    </div>
                </div>
            </div>

            <div class="card" style="background: #fdf8f3;">
                <h4 class="serif mb-3">Catatan Kesehatan</h4>
                <p style="font-style: italic; font-size: 0.9rem; color: #555; line-height: 1.7;">
                    "Arlo menunjukkan nafsu makan yang besar selama kunjungan terakhir. Ibu didorong untuk melanjutkan pemberian ASI eksklusif dan makanan padat bergizi."
                </p>
            </div>
        </div>

        <div style="display: flex; flex-direction: column; gap: 24px;">
            <div class="card">
                <div class="card-title">
                    <span><i class="fa-solid fa-clock-rotate-left" style="color: var(--primary); margin-right: 10px;"></i> Riwayat Kesehatan</span>
                    <a href="#" class="text-primary" style="font-size: 0.8rem;">Lihat Semua</a>
                </div>
                <table style="width: 100%; border-collapse: collapse; font-size: 0.85rem;">
                    <thead>
                        <tr style="text-align: left; color: var(--text-muted); border-bottom: 1px solid #eee;">
                            <th style="padding: 12px 0;">TANGGAL</th>
                            <th>BERAT</th>
                            <th>TINGGI</th>
                            <th>STATUS</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach([['Nov 12, 2023', '12.4', '88.5', 'Normal'], ['Oct 10, 2023', '11.8', '87.2', 'Normal'], ['Sep 08, 2023', '11.2', '85.9', 'Normal']] as $record)
                        <tr style="border-bottom: 1px solid #fafafa;">
                            <td style="padding: 15px 0; font-weight: 600;">{{ $record[0] }}</td>
                            <td>{{ $record[1] }} kg</td>
                            <td>{{ $record[2] }} cm</td>
                            <td><span style="color: #27ae60; font-weight: 600;"><i class="fa-solid fa-circle-check"></i> {{ $record[3] }}</span></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                <div class="card" style="padding: 1.2rem; background: #f0f4f1;">
                    <div style="font-size: 0.65rem; color: var(--text-muted); text-transform: uppercase;">BERAT BADAN</div>
                    <div style="font-size: 1.2rem; font-weight: 700; color: var(--primary);">+0.6kg</div>
                    <div style="font-size: 0.7rem; color: #888;">Last 30 days</div>
                </div>
                <div class="card" style="padding: 1.2rem; background: #f0f4f1;">
                    <div style="font-size: 0.65rem; color: var(--text-muted); text-transform: uppercase;">TINGGI BADAN</div>
                    <div style="font-size: 1.2rem; font-weight: 700; color: var(--primary);">+1.3cm</div>
                    <div style="font-size: 0.7rem; color: #888;">Last 30 days</div>
                </div>
            </div>

            <div class="card" style="background: var(--bg-card); border-left: 4px solid #d4a373;">
                <div style="font-size: 0.7rem; color: var(--text-muted); text-transform: uppercase; margin-bottom: 5px;">NEXT SCHEDULE</div>
                <div style="font-weight: 700; font-size: 1.1rem; display: flex; align-items: center; gap: 10px;">
                    <i class="fa-solid fa-calendar-day" style="color: #d4a373;"></i>
                    Dec 15, 2023
                </div>
                <div style="font-size: 0.75rem; color: #888; margin-top: 4px;">DPT-HB-Hib 3 Vaccination</div>
            </div>
        </div>
    </div>
</div>

<!-- Tab Content: Growth Chart (Hidden initially) -->
<div id="growthTabContent" style="display: none;">
    <div class="card">
        <div class="card-title">
            <span><i class="fa-solid fa-chart-line" style="color: var(--primary); margin-right: 10px;"></i> Growth Trend (Weight-for-Age)</span>
            <div style="display: flex; gap: 8px;">
                <button class="btn" style="padding: 4px 12px; font-size: 0.7rem; background: var(--primary); color: #fff;">Weight</button>
                <button class="btn" style="padding: 4px 12px; font-size: 0.7rem; background: #eee;">Height</button>
            </div>
        </div>
        <div style="height: 450px;">
            <canvas id="growthChart"></canvas>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    // Tab Switching Logic
    const tabBtns = document.querySelectorAll('.tab-btn');
    const healthTab = document.getElementById('healthTabContent');
    const growthTab = document.getElementById('growthTabContent');

    tabBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            tabBtns.forEach(b => {
                b.classList.remove('active');
                b.style.color = 'var(--text-muted)';
                b.style.borderBottom = 'none';
            });
            btn.classList.add('active');
            btn.style.color = 'var(--primary)';
            btn.style.borderBottom = '3px solid var(--primary)';

            if (btn.dataset.tab === 'health') {
                healthTab.style.display = 'block';
                growthTab.style.display = 'none';
            } else {
                healthTab.style.display = 'none';
                growthTab.style.display = 'block';
                initGrowthChart(); // Init chart only when tab is visible
            }
        });
    });

    let chartInitialized = false;
    function initGrowthChart() {
        if (chartInitialized) return;
        const ctx = document.getElementById('growthChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['0m', '3m', '6m', '9m', '12m', '15m', '18m', '21m', '24m', '28m'],
                datasets: [
                    {
                        label: "Arlo's Weight",
                        data: [3.2, 5.8, 7.5, 8.8, 9.6, 10.5, 11.2, 12.4, 13.1, 14.2],
                        borderColor: '#4a7c59',
                        backgroundColor: 'rgba(74, 124, 89, 0.1)',
                        fill: true,
                        tension: 0.4,
                        borderWidth: 3,
                        pointBackgroundColor: '#4a7c59'
                    },
                    {
                        label: "WHO Median",
                        data: [3.3, 6.4, 7.9, 9.2, 10.2, 11.0, 11.8, 12.5, 13.2, 14.5],
                        borderColor: '#ccc',
                        borderDash: [5, 5],
                        fill: false,
                        tension: 0.4,
                        pointRadius: 0
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { position: 'bottom' }
                },
                scales: {
                    y: {
                        beginAtZero: false,
                        title: { display: true, text: 'Weight (kg)' }
                    },
                    x: {
                        title: { display: true, text: 'Age (Months)' }
                    }
                }
            }
        });
        chartInitialized = true;
    }
</script>
@endsection
