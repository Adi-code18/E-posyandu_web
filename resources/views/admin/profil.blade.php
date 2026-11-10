{{--
    =============================================================================
    Halaman: Profil Warga & Riwayat Antropometri
    =============================================================================
    Fitur:
    - Kartu identitas komprehensif sasaran posyandu
    - Tab informasi kependudukan & riwayat pemeriksaan berkala
    - Tab grafik tren pertumbuhan balita (WHO Median Benchmark)
    - Tombol navigasi aksi tambah pengukuran baru
    =============================================================================
--}}
@extends('layouts.admin')

@section('title', 'Profil Warga — ' . $warga->nama_lengkap)
@section('breadcrumbs', 'Beranda > Daftar Anggota > ' . $warga->nama_lengkap)
@section('page_title', 'Profil Warga')

@section('content')
<p style="font-size: 0.88rem; color: #6b7280; margin-bottom: 1.5rem; margin-top: -0.25rem;">
    Catatan rinci identitas kependudukan, pemantauan kesehatan berkala, dan evaluasi riwayat medis.
</p>

<!-- 1. Tombol Aksi Navigasi Atas -->
<div style="display: flex; justify-content: flex-end; gap: 12px; margin-bottom: 1.5rem; flex-wrap: wrap;">
    <a href="{{ route('admin.daftar-anggota') }}" class="btn btn-secondary">
        <i class="fa-solid fa-arrow-left"></i>
        <span>Kembali ke Daftar</span>
    </a>
    <a href="{{ route('admin.pemeriksaan', ['nik' => $warga->NIK]) }}" class="btn btn-primary">
        <i class="fa-solid fa-plus"></i>
        <span>Tambah Pengukuran Baru</span>
    </a>
</div>

<!-- 2. Kartu Ringkasan Profil (Responsif Flex) -->
<div class="card mb-4" style="display: flex; gap: 24px; align-items: center; flex-wrap: wrap;">
    <img src="https://ui-avatars.com/api/?name={{ urlencode($warga->nama_lengkap) }}&background=2d6a4f&color=fff" 
         alt="{{ $warga->nama_lengkap }}" 
         style="width: 96px; height: 96px; border-radius: var(--radius-lg); object-fit: cover; box-shadow: var(--shadow-sm); flex-shrink: 0;">
    
    <div style="flex-grow: 1; min-width: 240px;">
        <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 6px; flex-wrap: wrap;">
            <h3 class="serif" style="font-size: 1.6rem; margin: 0;">{{ $warga->nama_lengkap }}</h3>
            <span class="tag tag-success">{{ $warga->status ?? 'Balita' }}</span>
            <span class="tag tag-neutral">{{ $warga->jenis_kelamin }}</span>
        </div>
        
        <p class="text-muted" style="font-size: 0.9rem; margin-bottom: 12px;">
            <strong>NIK:</strong> <code style="font-family: monospace; font-size: 0.95rem;">{{ $warga->NIK }}</code> 
            • <strong>Usia:</strong> {{ \Carbon\Carbon::parse($warga->tanggal_lahir)->age }} Tahun
        </p>

        <div style="display: flex; gap: 10px; flex-wrap: wrap;">
            <span class="tag tag-success" style="font-size: 0.8rem; padding: 6px 12px;">
                <i class="fa-solid fa-circle-check"></i> Status: Aktif Terdaftar
            </span>
        </div>
    </div>
</div>

<!-- 3. Navigasi Tab Interaktif -->
<div style="display: flex; border-bottom: 2px solid var(--border-color); margin-bottom: 2rem; gap: 24px; overflow-x: auto;">
    <button type="button" class="tab-btn active" data-tab="health" 
            style="padding: 12px 4px; border: none; background: none; font-weight: 700; font-size: 0.95rem; cursor: pointer; color: var(--primary); border-bottom: 3px solid var(--primary); margin-bottom: -2px; white-space: nowrap;">
        <i class="fa-solid fa-user-circle" style="margin-right: 6px;"></i> Biodata & Rekam Medis
    </button>
    <button type="button" class="tab-btn" data-tab="growth" 
            style="padding: 12px 4px; border: none; background: none; font-weight: 600; font-size: 0.95rem; cursor: pointer; color: var(--text-muted); border-bottom: 3px solid transparent; margin-bottom: -2px; white-space: nowrap;">
        <i class="fa-solid fa-chart-line" style="margin-right: 6px;"></i> Grafik Pertumbuhan
    </button>
</div>

<!-- 4. Konten Tab 1: Biodata & Riwayat -->
<div id="healthTabContent">
    <div class="content-grid">
        <!-- Kolom Kiri: Detail Informasi -->
        <div style="display: flex; flex-direction: column; gap: 20px;">
            <div class="card">
                <div class="card-title">
                    <span><i class="fa-solid fa-id-badge text-primary" style="margin-right: 8px;"></i> Informasi Kependudukan</span>
                </div>
                
                <div class="form-row" style="row-gap: 16px;">
                    <div>
                        <label style="font-size: 0.75rem; color: var(--text-muted); display: block; font-weight: 600; text-transform: uppercase;">NAMA LENGKAP</label>
                        <div style="font-weight: 600; font-size: 0.95rem;">{{ $warga->nama_lengkap }}</div>
                    </div>
                    <div>
                        <label style="font-size: 0.75rem; color: var(--text-muted); display: block; font-weight: 600; text-transform: uppercase;">TANGGAL LAHIR</label>
                        <div style="font-weight: 600; font-size: 0.95rem;">{{ \Carbon\Carbon::parse($warga->tanggal_lahir)->translatedFormat('d F Y') }}</div>
                    </div>
                    <div>
                        <label style="font-size: 0.75rem; color: var(--text-muted); display: block; font-weight: 600; text-transform: uppercase;">NAMA IBU KANDUNG</label>
                        <div style="font-weight: 600; font-size: 0.95rem;">{{ $warga->nama_ibu ?? '-' }}</div>
                    </div>
                    <div>
                        <label style="font-size: 0.75rem; color: var(--text-muted); display: block; font-weight: 600; text-transform: uppercase;">NAMA AYAH / SUAMI</label>
                        <div style="font-weight: 600; font-size: 0.95rem;">{{ $warga->nama_ayah ?? '-' }}</div>
                    </div>
                    <div>
                        <label style="font-size: 0.75rem; color: var(--text-muted); display: block; font-weight: 600; text-transform: uppercase;">KATEGORI POSYANDU</label>
                        <div style="font-weight: 600; font-size: 0.95rem;">{{ $warga->status ?? '-' }}</div>
                    </div>
                    <div>
                        <label style="font-size: 0.75rem; color: var(--text-muted); display: block; font-weight: 600; text-transform: uppercase;">WILAYAH TUGAS</label>
                        <div style="font-weight: 600; font-size: 0.95rem;">RT 01 / RW 01</div>
                    </div>
                </div>
            </div>

            <!-- Catatan Evaluasi Kesehatan Petugas -->
            <div class="card" style="background: var(--bg-card-subtle);">
                <div class="card-title">
                    <span><i class="fa-solid fa-notes-medical text-primary" style="margin-right: 8px;"></i> Catatan Klinis Bidan / Kader</span>
                </div>
                <p style="font-style: italic; font-size: 0.9rem; color: var(--text-main); line-height: 1.6; margin: 0;">
                    "Pertumbuhan berat badan dan tinggi badan sasaran berada dalam kurva hijau standar WHO. Anjurkan pemberian makanan kaya zat besi, protein hewani, dan kehadiran rutin pada posyandu bulan berikutnya."
                </p>
            </div>
        </div>

        <!-- Kolom Kanan: Riwayat Pengukuran -->
        <div style="display: flex; flex-direction: column; gap: 20px;">
            <div class="card">
                <div class="card-title">
                    <span><i class="fa-solid fa-clock-rotate-left text-primary" style="margin-right: 8px;"></i> Riwayat 3 Pengukuran</span>
                </div>
                
                <div class="table-responsive">
                    <table class="custom-table" style="font-size: 0.85rem;">
                        <thead>
                            <tr>
                                <th>TANGGAL</th>
                                <th>BERAT</th>
                                <th>TINGGI</th>
                                <th>STATUS</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach([['12 Nov 2024', '12.4 kg', '88.5 cm', 'Normal'], ['10 Okt 2024', '11.8 kg', '87.2 cm', 'Normal'], ['08 Sep 2024', '11.2 kg', '85.9 cm', 'Normal']] as $rec)
                            <tr>
                                <td style="font-weight: 600;">{{ $rec[0] }}</td>
                                <td>{{ $rec[1] }}</td>
                                <td>{{ $rec[2] }}</td>
                                <td><span class="tag tag-success" style="font-size: 0.7rem;">{{ $rec[3] }}</span></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Kartu Agenda Jadwal Berikutnya -->
            <div class="card" style="border-left: 4px solid var(--accent); background: var(--bg-card-subtle);">
                <div style="font-size: 0.75rem; color: var(--text-muted); text-transform: uppercase; font-weight: 700; margin-bottom: 6px;">
                    JADWAL POSYANDU BERIKUTNYA
                </div>
                <div style="font-weight: 700; font-size: 1.15rem; display: flex; align-items: center; gap: 10px; color: var(--text-main);">
                    <i class="fa-solid fa-calendar-day" style="color: var(--accent);"></i>
                    <span>15 Desember 2024</span>
                </div>
                <div style="font-size: 0.8rem; color: var(--text-muted); margin-top: 4px;">
                    Penimbangan Serentak & Vitamin A Tambahan
                </div>
            </div>
        </div>
    </div>
</div>

<!-- 5. Konten Tab 2: Grafik Pertumbuhan (Awalnya Sembunyi) -->
<div id="growthTabContent" style="display: none;">
    <div class="card">
        <div class="card-title">
            <span><i class="fa-solid fa-chart-line text-primary" style="margin-right: 8px;"></i> Tren Pertumbuhan Berat Badan vs Usia (Standar WHO)</span>
            <div class="btn-group">
                <button type="button" class="btn btn-primary btn-xs">Berat Badan</button>
                <button type="button" class="btn btn-secondary btn-xs">Tinggi Badan</button>
            </div>
        </div>
        <div style="height: 400px; position: relative;">
            <canvas id="growthChart"></canvas>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Logika Pengalihan Tab Antar Biodata & Grafik
    const tabBtns = document.querySelectorAll('.tab-btn');
    const healthTab = document.getElementById('healthTabContent');
    const growthTab = document.getElementById('growthTabContent');

    tabBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            tabBtns.forEach(b => {
                b.classList.remove('active');
                b.style.color = 'var(--text-muted)';
                b.style.borderBottom = '3px solid transparent';
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
                initGrowthChart();
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
                labels: ['0 Bln', '3 Bln', '6 Bln', '9 Bln', '12 Bln', '15 Bln', '18 Bln', '21 Bln', '24 Bln'],
                datasets: [
                    {
                        label: "Berat Badan {{ $warga->nama_lengkap }} (kg)",
                        data: [3.2, 5.8, 7.5, 8.8, 9.6, 10.5, 11.2, 12.4, 13.1],
                        borderColor: '#2d6a4f',
                        backgroundColor: 'rgba(45, 106, 79, 0.1)',
                        fill: true,
                        tension: 0.35,
                        borderWidth: 3,
                        pointBackgroundColor: '#2d6a4f',
                        pointRadius: 4
                    },
                    {
                        label: "Median Standar WHO (kg)",
                        data: [3.3, 6.4, 7.9, 9.2, 10.2, 11.0, 11.8, 12.5, 13.2],
                        borderColor: '#9ca3af',
                        borderDash: [5, 5],
                        fill: false,
                        tension: 0.35,
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
                        title: { display: true, text: 'Berat Badan (kg)', font: { family: 'Inter', size: 12 } }
                    },
                    x: {
                        title: { display: true, text: 'Kelompok Usia', font: { family: 'Inter', size: 12 } }
                    }
                }
            }
        });
        chartInitialized = true;
    }
</script>
@endsection
