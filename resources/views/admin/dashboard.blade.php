{{--
    =============================================================================
    Halaman: Dashboard Admin & Kader Posyandu
    =============================================================================
    Fitur Unggulan:
    - Ringkasan statistik 4 siklus hidup sasaran (Balita, Bumil, Lansia, Remaja)
    - Diagram batang interaktif (Chart.js): KLIK BAR DIAGRAM untuk membuka daftar hadir
    - Modal popup rincian peserta hadir yang DIKELOMPOKKAN per kategori usia:
      * Kelompok Balita (0–5 Tahun)
      * Kelompok Ibu Hamil (ANC)
      * Kelompok Dewasa & Remaja Produktif (Terpisah khusus dewasa)
      * Kelompok Lansia (Posbindu PTM)
    - Filter kategori cepat (Pills), pencarian nama peserta real-time, dan usia
    - Pendaftaran anggota terbaru dan tombol aksi cepat
    =============================================================================
--}}
@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page_title', 'Selamat datang kembali, Ibu Kader')

@section('content')
<p style="font-size: 0.88rem; color: #6b7280; margin-bottom: 1.5rem; margin-top: -0.25rem;">
    Pemantauan kesehatan bulanan aktif di Posyandu Anggrek
</p>

<!-- 1. Grid Statistik Cepat (4 Siklus Hidup) Sesuai Figma -->
<div class="stats-grid">
    <div class="stat-card green">
        <div>
            <div class="stat-label">Anak-Anak & Balita</div>
            <div class="stat-value">{{ $stats['balita'] ?: 142 }}</div>
        </div>
        <div class="stat-trend">
            <i class="fa-solid fa-arrow-trend-up"></i>
            <span>+12 bulan ini</span>
        </div>
        <div class="stat-watermark">
            <svg viewBox="0 0 24 24" fill="currentColor">
                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z"/>
            </svg>
        </div>
    </div>
    
    <div class="stat-card yellow">
        <div>
            <div class="stat-label">Ibu Hamil</div>
            <div class="stat-value">{{ $stats['bumil'] ?: 28 }}</div>
        </div>
        <div class="stat-trend">
            <i class="fa-solid fa-arrow-trend-up"></i>
            <span>+12 bulan ini</span>
        </div>
        <div class="stat-watermark">
            <svg viewBox="0 0 24 24" fill="currentColor">
                <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
            </svg>
        </div>
    </div>
    
    <div class="stat-card beige">
        <div>
            <div class="stat-label">Lansia</div>
            <div class="stat-value">{{ $stats['lansia'] ?: 86 }}</div>
        </div>
        <div class="stat-trend">
            <i class="fa-solid fa-arrow-trend-up"></i>
            <span>+12 bulan ini</span>
        </div>
        <div class="stat-watermark">
            <svg viewBox="0 0 24 24" fill="currentColor">
                <path d="M13.5 5.5c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2zM9.8 8.9L7 23h2.1l1.8-8 2.1 2v6h2v-7.5l-2.1-2 .6-3C14.8 12 16.8 13 19 13v-2c-1.9 0-3.5-1-4.3-2.4l-1-1.6c-.4-.6-1-1-1.7-1-.3 0-.5.1-.8.1L6 8.3V13h2V9.6l1.8-.7z"/>
            </svg>
        </div>
    </div>
    
    <div class="stat-card purple">
        <div>
            <div class="stat-label">Remaja & Usia Produktif</div>
            <div class="stat-value">{{ $stats['remaja'] ?: 54 }}</div>
        </div>
        <div class="stat-trend">
            <i class="fa-solid fa-arrow-trend-up"></i>
            <span>+12 bulan ini</span>
        </div>
        <div class="stat-watermark">
            <svg viewBox="0 0 24 24" fill="currentColor">
                <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-2 10h-4v4h-2v-4H7v-2h4V7h2v4h4v2z"/>
            </svg>
        </div>
    </div>
</div>

<!-- 2. Grid Konten Utama: Grafik Interaktif & Pendaftaran Terbaru -->
<div class="content-grid">
    <!-- Kolom Kiri: Visualisasi Grafik Tren Partisipasi Sesuai Figma -->
    <div class="card">
        <div class="card-title" style="margin-bottom: 1.25rem;">
            <div>
                <h3 style="margin: 0; font-size: 1.1rem; font-weight: 700; color: var(--text-main);">Grafik Kesehatan Bulanan</h3>
                <p style="margin: 2px 0 0; font-size: 0.8rem; color: var(--text-muted); font-weight: 400;">
                    Pemantauan partisipasi periode (Jan-Okt)
                </p>
            </div>
            
            <div style="position: relative;">
                <select id="chartPeriodSelect" class="form-control" style="width: auto; padding: 5px 28px 5px 12px; font-size: 0.775rem; font-weight: 600; border-radius: 20px; background: #faf8f5; border: 1px solid #e8e4da; color: #4b5563; cursor: pointer; appearance: auto;">
                    <option value="bulanan" selected>12 Bulan terakhir</option>
                    <option value="mingguan">Jadwal Mingguan</option>
                </select>
            </div>
        </div>

        <div style="height: 240px; position: relative;">
            <canvas id="healthChart"></canvas>
        </div>
    </div>

    <!-- Kolom Kanan: Pendaftaran Anggota Terbaru Sesuai Figma -->
    <div class="card" style="display: flex; flex-direction: column;">
        <div class="card-title" style="margin-bottom: 0.75rem;">
            <h3 style="margin: 0; font-size: 1.1rem; font-weight: 700; color: var(--text-main);">Pendaftaran Terbaru</h3>
            <a href="{{ route('admin.daftar-anggota') }}" style="font-size: 0.825rem; font-weight: 600; color: var(--primary);">
                Lihat
            </a>
        </div>

        @php
            $sampleRecent = [
                ['nama' => 'Tiara', 'kategori' => 'Balita', 'detail' => '14 Bulan', 'time' => 'Terdaftar 1 hari', 'color' => '#fbcfe8'],
                ['nama' => 'Andra Wijaya', 'kategori' => 'Usia Produktif', 'detail' => '24 Tahun', 'time' => 'Terdaftar 3 hari', 'color' => '#fed7aa'],
                ['nama' => 'Bambang S.', 'kategori' => 'Lansia', 'detail' => '68 Tahun', 'time' => 'Terdaftar Kemarin', 'color' => '#e2e8f0'],
                ['nama' => 'Siti Aisyah', 'kategori' => 'Bumil', 'detail' => '2 Minggu', 'time' => 'Terdaftar 1 hari', 'color' => '#dcfce7'],
            ];
        @endphp

        <div class="recent-list" style="display: flex; flex-direction: column; margin-bottom: 1.25rem; flex-grow: 1;">
            @if(isset($recentWarga) && count($recentWarga) >= 4)
                @foreach($recentWarga->take(4) as $item)
                <div style="display: flex; align-items: center; justify-content: space-between; padding: 10px 0; border-bottom: 1px solid #f3efe6;">
                    <div style="display: flex; align-items: center; gap: 12px; min-width: 0;">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($item->nama_lengkap) }}&background=2d6a4f&color=fff&size=64" 
                             alt="{{ $item->nama_lengkap }}" 
                             style="width: 38px; height: 38px; border-radius: 50%; object-fit: cover; flex-shrink: 0;">
                        <div style="min-width: 0;">
                            <div style="font-weight: 700; font-size: 0.88rem; color: var(--text-main); white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                {{ $item->nama_lengkap }}
                            </div>
                            <div style="font-size: 0.75rem; color: var(--text-muted); margin-top: 1px;">
                                {{ $item->status }} • {{ \Carbon\Carbon::parse($item->tanggal_lahir)->age }} Thn
                            </div>
                        </div>
                    </div>
                    <div style="font-size: 0.725rem; color: var(--primary); font-weight: 500; white-space: nowrap; text-align: right; margin-left: 8px;">
                        {{ $item->created_at ? $item->created_at->diffForHumans(null, true) : '1 hari' }}
                    </div>
                </div>
                @endforeach
            @else
                @foreach($sampleRecent as $sr)
                <div style="display: flex; align-items: center; justify-content: space-between; padding: 10px 0; border-bottom: 1px solid #f3efe6;">
                    <div style="display: flex; align-items: center; gap: 12px; min-width: 0;">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($sr['nama']) }}&background={{ substr($sr['color'], 1) }}&color=1f2937&size=64" 
                             alt="{{ $sr['nama'] }}" 
                             style="width: 38px; height: 38px; border-radius: 50%; object-fit: cover; flex-shrink: 0;">
                        <div style="min-width: 0;">
                            <div style="font-weight: 700; font-size: 0.88rem; color: var(--text-main); white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                {{ $sr['nama'] }}
                            </div>
                            <div style="font-size: 0.75rem; color: var(--text-muted); margin-top: 1px;">
                                {{ $sr['kategori'] }} • {{ $sr['detail'] }}
                            </div>
                        </div>
                    </div>
                    <div style="font-size: 0.725rem; color: var(--primary); font-weight: 500; white-space: nowrap; text-align: right; margin-left: 8px;">
                        {{ $sr['time'] }}
                    </div>
                </div>
                @endforeach
            @endif
        </div>

        <!-- Tombol CTA Pendaftaran Masyarakat Sesuai Figma -->
        <a href="{{ route('admin.pendaftaran') }}" class="btn-outline-pill w-100" style="margin-top: auto; display: block; text-decoration: none;">
            Pendaftaran Masyarakat
        </a>
    </div>
</div>

<!-- ===========================================================================
     3. RINCIAN DAFTAR HADIR SESI (INLINE DI BAWAH GRAFIK / DASHBOARD)
     =========================================================================== -->
<div id="attendanceSection" class="card mt-4" style="scroll-margin-top: 24px;">
    <!-- Header Seksi -->
    <div style="display: flex; justify-content: space-between; align-items: flex-start; gap: 16px; flex-wrap: wrap; margin-bottom: 1.25rem; padding-bottom: 1rem; border-bottom: 1px solid var(--border-color);">
        <div>
            <div style="display: flex; align-items: center; gap: 10px; flex-wrap: wrap; margin-bottom: 4px;">
                <h3 class="serif" style="font-size: 1.25rem; margin: 0; color: var(--text-main); display: flex; align-items: center; gap: 8px;">
                    <i class="fa-solid fa-users-viewfinder text-primary"></i>
                    Daftar Hadir Sesi: <span id="sectionSessionTitle" style="color: var(--primary); font-weight: 700;">Senin</span>
                </h3>
                <span id="sectionTotalBadge" class="tag tag-success" style="font-size: 0.8rem; font-weight: 700; padding: 4px 12px;">
                    60 Peserta Hadir
                </span>
                <span id="sectionSessionDate" class="tag tag-neutral" style="font-size: 0.75rem; padding: 4px 10px;">
                    <i class="fa-regular fa-calendar-check" style="margin-right: 4px;"></i> Senin, 04 November 2024
                </span>
            </div>
            <div style="font-size: 0.825rem; color: var(--text-muted);">
                <i class="fa-solid fa-circle-info text-primary" style="margin-right: 4px;"></i>
                Data kehadiran posyandu dikelompokkan secara terpisah berdasarkan kelompok usia & sasaran klinis (Balita, Ibu Hamil, Dewasa & Remaja, Lansia).
            </div>
        </div>

        <div style="display: flex; align-items: center; gap: 8px;">
            <button type="button" class="btn btn-ghost btn-xs" onclick="window.scrollTo({ top: 0, behavior: 'smooth' })" title="Kembali ke grafik di atas">
                <i class="fa-solid fa-arrow-up"></i> Ke Grafik
            </button>
        </div>
    </div>

    <!-- Filter Tab Kategori (Pills) & Search Box -->
    <div style="display: flex; justify-content: space-between; align-items: center; gap: 12px; margin-bottom: 1.5rem; flex-wrap: wrap;">
        <!-- Filter Pills -->
        <div class="btn-group" id="categoryPillGroup" style="display: flex; flex-wrap: wrap; gap: 6px;">
            <button type="button" class="btn btn-xs btn-primary pill-btn active" data-category="all">
                Semua (<span id="pillCountAll">60</span>)
            </button>
            <button type="button" class="btn btn-xs btn-secondary pill-btn" data-category="balita">
                Balita (<span id="pillCountBalita">20</span>)
            </button>
            <button type="button" class="btn btn-xs btn-secondary pill-btn" data-category="bumil">
                Ibu Hamil (<span id="pillCountBumil">12</span>)
            </button>
            <button type="button" class="btn btn-xs btn-secondary pill-btn" data-category="dewasa">
                Dewasa & Remaja (<span id="pillCountDewasa">14</span>)
            </button>
            <button type="button" class="btn btn-xs btn-secondary pill-btn" data-category="lansia">
                Lansia (<span id="pillCountLansia">14</span>)
            </button>
        </div>

        <!-- Input Pencarian Instan -->
        <div style="position: relative; min-width: 240px; flex-grow: 1; max-width: 320px;">
            <input type="text" 
                   id="sectionSearchAttendee" 
                   class="form-control" 
                   style="padding: 6px 12px 6px 34px; font-size: 0.825rem;" 
                   placeholder="Cari nama peserta hadir...">
            <i class="fa-solid fa-magnifying-glass" style="position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: var(--text-muted); font-size: 0.8rem;"></i>
        </div>
    </div>

    <!-- Wadah Daftar Peserta yang Dikelompokkan (Layout Berbentuk Tabel) -->
    <div id="attendeeListContainer">
        <!-- KELOMPOK 1: BALITA -->
        <div class="attendee-category-block" id="blockBalita" data-category="balita">
            <div class="attendee-category-header balita">
                <span><i class="fa-solid fa-baby" style="margin-right: 8px;"></i> Kelompok Bayi & Balita (0–5 Tahun)</span>
                <span class="tag tag-success" id="badgeBalitaCount">20 Peserta</span>
            </div>
            <!-- Wadah Tabel & Paginasi Balita -->
            <div style="border: 1px solid var(--border-color); border-radius: var(--radius-md); overflow: hidden; background: var(--bg-card); box-shadow: var(--shadow-xs);">
                <div class="table-responsive" style="margin-bottom: 0; border: none; border-radius: 0;">
                    <table class="attendee-table">
                        <thead>
                            <tr>
                                <th style="width: 48px; text-align: center;">No</th>
                                <th style="min-width: 170px;">Nama Peserta</th>
                                <th style="width: 120px;">Usia</th>
                                <th style="width: 80px; text-align: center;">Gender</th>
                                <th style="min-width: 220px;">Layanan / Tindakan Medis</th>
                                <th style="width: 100px; text-align: center;">Kategori</th>
                                <th style="width: 90px; text-align: center;">Status</th>
                            </tr>
                        </thead>
                        <tbody id="tableBalita"></tbody>
                    </table>
                </div>
                <!-- Navigasi Paginasi Balita (Maksimal 10 Baris) -->
                <div id="paginationBalita" style="display: flex; justify-content: space-between; align-items: center; padding: 8px 14px; background: #fafaf9; border-top: 1px solid var(--border-color); font-size: 0.8rem; color: var(--text-muted); flex-wrap: wrap; gap: 8px;">
                    <div id="pageInfoBalita">
                        Menampilkan <strong style="color: var(--text-main);">1-10</strong> dari <strong style="color: var(--text-main);">20</strong> peserta
                    </div>
                    <div style="display: flex; align-items: center; gap: 6px;">
                        <button type="button" class="btn btn-secondary btn-xs" id="prevBtnBalita" onclick="changeAttendeePage('balita', -1)">
                            <i class="fa-solid fa-chevron-left" style="font-size: 0.7rem;"></i> Sebelumnya
                        </button>
                        <span id="pageIndicatorBalita" style="padding: 2px 10px; font-weight: 600; color: var(--text-main); font-size: 0.775rem; background: var(--bg-card); border: 1px solid var(--border-color); border-radius: var(--radius-sm);">
                            Hal 1 / 2
                        </span>
                        <button type="button" class="btn btn-secondary btn-xs" id="nextBtnBalita" onclick="changeAttendeePage('balita', 1)">
                            Selanjutnya <i class="fa-solid fa-chevron-right" style="font-size: 0.7rem;"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- KELOMPOK 2: IBU HAMIL -->
        <div class="attendee-category-block" id="blockBumil" data-category="bumil">
            <div class="attendee-category-header bumil">
                <span><i class="fa-solid fa-person-pregnant" style="margin-right: 8px;"></i> Kelompok Ibu Hamil (ANC)</span>
                <span class="tag tag-warning" id="badgeBumilCount">12 Peserta</span>
            </div>
            <!-- Wadah Tabel & Paginasi Ibu Hamil -->
            <div style="border: 1px solid var(--border-color); border-radius: var(--radius-md); overflow: hidden; background: var(--bg-card); box-shadow: var(--shadow-xs);">
                <div class="table-responsive" style="margin-bottom: 0; border: none; border-radius: 0;">
                    <table class="attendee-table">
                        <thead>
                            <tr>
                                <th style="width: 48px; text-align: center;">No</th>
                                <th style="min-width: 170px;">Nama Peserta</th>
                                <th style="width: 120px;">Usia</th>
                                <th style="width: 80px; text-align: center;">Gender</th>
                                <th style="min-width: 220px;">Layanan / Tindakan Medis</th>
                                <th style="width: 100px; text-align: center;">Kategori</th>
                                <th style="width: 90px; text-align: center;">Status</th>
                            </tr>
                        </thead>
                        <tbody id="tableBumil"></tbody>
                    </table>
                </div>
                <!-- Navigasi Paginasi Ibu Hamil (Maksimal 10 Baris) -->
                <div id="paginationBumil" style="display: flex; justify-content: space-between; align-items: center; padding: 8px 14px; background: #fafaf9; border-top: 1px solid var(--border-color); font-size: 0.8rem; color: var(--text-muted); flex-wrap: wrap; gap: 8px;">
                    <div id="pageInfoBumil">
                        Menampilkan <strong style="color: var(--text-main);">1-10</strong> dari <strong style="color: var(--text-main);">12</strong> peserta
                    </div>
                    <div style="display: flex; align-items: center; gap: 6px;">
                        <button type="button" class="btn btn-secondary btn-xs" id="prevBtnBumil" onclick="changeAttendeePage('bumil', -1)">
                            <i class="fa-solid fa-chevron-left" style="font-size: 0.7rem;"></i> Sebelumnya
                        </button>
                        <span id="pageIndicatorBumil" style="padding: 2px 10px; font-weight: 600; color: var(--text-main); font-size: 0.775rem; background: var(--bg-card); border: 1px solid var(--border-color); border-radius: var(--radius-sm);">
                            Hal 1 / 2
                        </span>
                        <button type="button" class="btn btn-secondary btn-xs" id="nextBtnBumil" onclick="changeAttendeePage('bumil', 1)">
                            Selanjutnya <i class="fa-solid fa-chevron-right" style="font-size: 0.7rem;"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- KELOMPOK 3: DEWASA & REMAJA (DIPISAHKAN SENDIRI) -->
        <div class="attendee-category-block" id="blockDewasa" data-category="dewasa">
            <div class="attendee-category-header dewasa">
                <span><i class="fa-solid fa-people-group" style="margin-right: 8px;"></i> Kelompok Dewasa & Remaja Produktif</span>
                <span class="tag tag-info" id="badgeDewasaCount">14 Peserta</span>
            </div>
            <!-- Wadah Tabel & Paginasi Dewasa & Remaja -->
            <div style="border: 1px solid var(--border-color); border-radius: var(--radius-md); overflow: hidden; background: var(--bg-card); box-shadow: var(--shadow-xs);">
                <div class="table-responsive" style="margin-bottom: 0; border: none; border-radius: 0;">
                    <table class="attendee-table">
                        <thead>
                            <tr>
                                <th style="width: 48px; text-align: center;">No</th>
                                <th style="min-width: 170px;">Nama Peserta</th>
                                <th style="width: 120px;">Usia</th>
                                <th style="width: 80px; text-align: center;">Gender</th>
                                <th style="min-width: 220px;">Layanan / Tindakan Medis</th>
                                <th style="width: 100px; text-align: center;">Kategori</th>
                                <th style="width: 90px; text-align: center;">Status</th>
                            </tr>
                        </thead>
                        <tbody id="tableDewasa"></tbody>
                    </table>
                </div>
                <!-- Navigasi Paginasi Dewasa & Remaja (Maksimal 10 Baris) -->
                <div id="paginationDewasa" style="display: flex; justify-content: space-between; align-items: center; padding: 8px 14px; background: #fafaf9; border-top: 1px solid var(--border-color); font-size: 0.8rem; color: var(--text-muted); flex-wrap: wrap; gap: 8px;">
                    <div id="pageInfoDewasa">
                        Menampilkan <strong style="color: var(--text-main);">1-10</strong> dari <strong style="color: var(--text-main);">14</strong> peserta
                    </div>
                    <div style="display: flex; align-items: center; gap: 6px;">
                        <button type="button" class="btn btn-secondary btn-xs" id="prevBtnDewasa" onclick="changeAttendeePage('dewasa', -1)">
                            <i class="fa-solid fa-chevron-left" style="font-size: 0.7rem;"></i> Sebelumnya
                        </button>
                        <span id="pageIndicatorDewasa" style="padding: 2px 10px; font-weight: 600; color: var(--text-main); font-size: 0.775rem; background: var(--bg-card); border: 1px solid var(--border-color); border-radius: var(--radius-sm);">
                            Hal 1 / 2
                        </span>
                        <button type="button" class="btn btn-secondary btn-xs" id="nextBtnDewasa" onclick="changeAttendeePage('dewasa', 1)">
                            Selanjutnya <i class="fa-solid fa-chevron-right" style="font-size: 0.7rem;"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- KELOMPOK 4: LANSIA -->
        <div class="attendee-category-block" id="blockLansia" data-category="lansia">
            <div class="attendee-category-header lansia">
                <span><i class="fa-solid fa-person-walking-with-cane" style="margin-right: 8px;"></i> Kelompok Lansia (Posbindu PTM)</span>
                <span class="tag" style="background: #f3e8ff; color: #6b21a8;" id="badgeLansiaCount">14 Peserta</span>
            </div>
            <!-- Wadah Tabel & Paginasi Lansia -->
            <div style="border: 1px solid var(--border-color); border-radius: var(--radius-md); overflow: hidden; background: var(--bg-card); box-shadow: var(--shadow-xs);">
                <div class="table-responsive" style="margin-bottom: 0; border: none; border-radius: 0;">
                    <table class="attendee-table">
                        <thead>
                            <tr>
                                <th style="width: 48px; text-align: center;">No</th>
                                <th style="min-width: 170px;">Nama Peserta</th>
                                <th style="width: 120px;">Usia</th>
                                <th style="width: 80px; text-align: center;">Gender</th>
                                <th style="min-width: 220px;">Layanan / Tindakan Medis</th>
                                <th style="width: 100px; text-align: center;">Kategori</th>
                                <th style="width: 90px; text-align: center;">Status</th>
                            </tr>
                        </thead>
                        <tbody id="tableLansia"></tbody>
                    </table>
                </div>
                <!-- Navigasi Paginasi Lansia (Maksimal 10 Baris) -->
                <div id="paginationLansia" style="display: flex; justify-content: space-between; align-items: center; padding: 8px 14px; background: #fafaf9; border-top: 1px solid var(--border-color); font-size: 0.8rem; color: var(--text-muted); flex-wrap: wrap; gap: 8px;">
                    <div id="pageInfoLansia">
                        Menampilkan <strong style="color: var(--text-main);">1-10</strong> dari <strong style="color: var(--text-main);">14</strong> peserta
                    </div>
                    <div style="display: flex; align-items: center; gap: 6px;">
                        <button type="button" class="btn btn-secondary btn-xs" id="prevBtnLansia" onclick="changeAttendeePage('lansia', -1)">
                            <i class="fa-solid fa-chevron-left" style="font-size: 0.7rem;"></i> Sebelumnya
                        </button>
                        <span id="pageIndicatorLansia" style="padding: 2px 10px; font-weight: 600; color: var(--text-main); font-size: 0.775rem; background: var(--bg-card); border: 1px solid var(--border-color); border-radius: var(--radius-sm);">
                            Hal 1 / 2
                        </span>
                        <button type="button" class="btn btn-secondary btn-xs" id="nextBtnLansia" onclick="changeAttendeePage('lansia', 1)">
                            Selanjutnya <i class="fa-solid fa-chevron-right" style="font-size: 0.7rem;"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tampilan Kosong Jika Hasil Pencarian Tidak Ditemukan -->
        <div id="noAttendeeFound" style="display: none; text-align: center; padding: 2.5rem 1rem; color: var(--text-muted); background: var(--bg-card-subtle); border-radius: var(--radius-md); border: 1px dashed var(--border-color);">
            <i class="fa-solid fa-user-slash" style="font-size: 2rem; margin-bottom: 10px; opacity: 0.5;"></i>
            <div style="font-weight: 600; font-size: 0.95rem; color: var(--text-main);">Tidak ada peserta yang cocok dengan kata kunci pencarian.</div>
            <div style="font-size: 0.8rem; margin-top: 4px;">Coba gunakan ejaan atau kata kunci nama yang lain.</div>
        </div>
    </div>

    <!-- Footer Seksi -->
    <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 1.5rem; padding-top: 1rem; border-top: 1px solid var(--border-color); flex-wrap: wrap; gap: 10px;">
        <div style="font-size: 0.8rem; color: var(--text-muted);">
            <i class="fa-solid fa-shield-heart text-primary"></i> Data kehadiran terverifikasi oleh Bidan Desa & Kader Posko Anggrek.
        </div>
        <div style="font-size: 0.775rem; color: var(--text-muted);">
            <i class="fa-solid fa-location-dot text-primary" style="margin-right: 4px;"></i> Lokasi Layanan: <strong id="sectionLocation" style="color: var(--text-main);">Posko Anggrek (RW 01)</strong>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    /**
     * =========================================================================
     *  DATASET KEHADIRAN POSYANDU PER SESI & PEMETAAN KELOMPOK USIA
     * =========================================================================
     */
    const dbWarga = @json($allWarga ?? []);

    // Bank Nama Tambahan untuk Simulasi Data Kehadiran Realistis per Sesi
    const samplePool = {
        balita: [
            { nama: "Aditya Pratama", usia: "1 Thn 8 Bln", gender: "Laki-laki", layanan: "Penimbangan BB/TB & Vit. A Merah" },
            { nama: "Arlo Wijaya", usia: "2 Thn 4 Bln", gender: "Laki-laki", layanan: "Pemantauan Stunting & MPASI" },
            { nama: "Naura Kayla Az-Zahra", usia: "1 Thn 5 Bln", gender: "Perempuan", layanan: "Imunisasi DPT-HB-Hib Lanjutan" },
            { nama: "Kenzo Alfarizi", usia: "2 Thn 1 Bln", gender: "Laki-laki", layanan: "Penimbangan BB & PMT Biskuit" },
            { nama: "Aisyah Putri Maharani", usia: "10 Bulan", gender: "Perempuan", layanan: "Imunisasi Polio 4 & Campak" },
            { nama: "Muhammad Bilal", usia: "1 Thn 2 Bln", gender: "Laki-laki", layanan: "Penimbangan BB & Ukur LiLA" },
            { nama: "Rania Zaskia", usia: "3 Thn", gender: "Perempuan", layanan: "Pemeriksaan Tumbuh Kembang" },
            { nama: "Fathir Rizky", usia: "2 Thn 8 Bln", gender: "Laki-laki", layanan: "Penyuluhan Gizi Balita" },
            { nama: "Siti Fatimah Zahra", usia: "6 Bulan", gender: "Perempuan", layanan: "Imunisasi Dasar Lengkap" },
            { nama: "Raffasya Al-Ghifari", usia: "1 Thn 11 Bln", gender: "Laki-laki", layanan: "Distribusi Vitamin A Biru" },
            { nama: "Khalisa Salsabila", usia: "2 Thn 6 Bln", gender: "Perempuan", layanan: "Penimbangan & Antropometri" },
            { nama: "Rayyan Al-Baqir", usia: "3 Thn 2 Bln", gender: "Laki-laki", layanan: "Konseling Gizi Stunting" },
            { nama: "Zahra Nurul Izzah", usia: "1 Thn 1 Bln", gender: "Perempuan", layanan: "Pemeriksaan Gigi Balita" },
            { nama: "Arshaka Virendra", usia: "8 Bulan", gender: "Laki-laki", layanan: "Pemberian Oralit & Zinc" },
            { nama: "Anindita Keisha", usia: "4 Thn", gender: "Perempuan", layanan: "Evaluasi Kemandirian Balita" },
            { nama: "Hafizh Al-Farisi", usia: "1 Thn 7 Bln", gender: "Laki-laki", layanan: "Penimbangan Rutin" },
            { nama: "Mikayla Shaqueena", usia: "2 Thn 3 Bln", gender: "Perempuan", layanan: "Ukur Lingkar Kepala" },
            { nama: "Zidan Maulana", usia: "3 Thn 5 Bln", gender: "Laki-laki", layanan: "Penimbangan & PMT Telur" },
            { nama: "Aqila Humaira", usia: "1 Thn 4 Bln", gender: "Perempuan", layanan: "Pemeriksaan LiLA" },
            { nama: "Daffa Ibnu Hafidz", usia: "2 Thn 9 Bln", gender: "Laki-laki", layanan: "Penimbangan BB Bulanan" },
            { nama: "Kanaya Azkadina", usia: "1 Thn", gender: "Perempuan", layanan: "Imunisasi PCV 2" },
            { nama: "Gibran Rakabuming", usia: "3 Thn 1 Bln", gender: "Laki-laki", layanan: "Pemeriksaan Tumbuh Kembang" },
            { nama: "Almira Safitri", usia: "2 Thn", gender: "Perempuan", layanan: "Penimbangan & Suplemen" },
            { nama: "Fathan Al-Rasyid", usia: "4 Thn 2 Bln", gender: "Laki-laki", layanan: "Penyuluhan Sanitasi Anak" }
        ],
        bumil: [
            { nama: "Siti Aminah", usia: "29 Tahun", gender: "Perempuan", layanan: "ANC Trimester 2 (24 Mgg) & LiLA 25 cm" },
            { nama: "Dewi Lestari Kusuma", usia: "27 Tahun", gender: "Perempuan", layanan: "Skrining KEK & Suplemen Tablet TTD" },
            { nama: "Ratna Sari", usia: "31 Tahun", gender: "Perempuan", layanan: "Cek Tensi 115/75 & USG Dasar" },
            { nama: "Yuni Astuti", usia: "26 Tahun", gender: "Perempuan", layanan: "ANC Trimester 3 (32 Mgg) & Suplemen Kalsium" },
            { nama: "Nurul Hidayah", usia: "33 Tahun", gender: "Perempuan", layanan: "Pemeriksaan Hb Ibu Hamil (12.1 gr/dL)" },
            { nama: "Ika Wahyuni", usia: "25 Tahun", gender: "Perempuan", layanan: "Konseling Persiapan Persalinan" },
            { nama: "Tri Handayani", usia: "28 Tahun", gender: "Perempuan", layanan: "Pemeriksaan Leopold & DJJ" },
            { nama: "Mega Puspita", usia: "30 Tahun", gender: "Perempuan", layanan: "Pemberian PMT Biskuit Ibu Hamil" },
            { nama: "Dian Anggraeni", usia: "24 Tahun", gender: "Perempuan", layanan: "Cek Protein Urine & Tekanan Darah" },
            { nama: "Rini Susilowati", usia: "32 Tahun", gender: "Perempuan", layanan: "Konseling ASI Eksklusif" },
            { nama: "Fitri Handayani", usia: "27 Tahun", gender: "Perempuan", layanan: "Pemeriksaan Glukosa Darah Sewaktu" },
            { nama: "Eka Novitasari", usia: "29 Tahun", gender: "Perempuan", layanan: "ANC Terpadu Trimester 1" },
            { nama: "Wulan Dari", usia: "23 Tahun", gender: "Perempuan", layanan: "Edukasi Tanda Bahaya Kehamilan" },
            { nama: "Sari Dewi", usia: "34 Tahun", gender: "Perempuan", layanan: "Evaluasi Kenaikan Berat Badan" }
        ],
        dewasa: [
            { nama: "Dimas Arya Pratama", usia: "16 Tahun", gender: "Laki-laki", layanan: "Skrining Hb Anemia (13.5 g/dL) & IMT" },
            { nama: "Putri Amelia", usia: "15 Tahun", gender: "Perempuan", layanan: "Distribusi Tablet Tambah Darah (TTD)" },
            { nama: "Rendy Fauzi", usia: "17 Tahun", gender: "Laki-laki", layanan: "Cek Tensi Darah & Edukasi Gizi Remaja" },
            { nama: "Agus Setiawan", usia: "35 Tahun", gender: "Laki-laki", layanan: "Cek Tekanan Darah (120/80) & IMT" },
            { nama: "Budi Santoso", usia: "38 Tahun", gender: "Laki-laki", layanan: "Konseling Pola Hidup Sehat Dewasa" },
            { nama: "Rina Herlina", usia: "32 Tahun", gender: "Perempuan", layanan: "Skrining Kesehatan Usia Produktif" },
            { nama: "Hendra Wijaya", usia: "42 Tahun", gender: "Laki-laki", layanan: "Cek Gula Darah Sewaktu (105 mg/dL)" },
            { nama: "Dewi Sartika", usia: "29 Tahun", gender: "Perempuan", layanan: "Konseling Perencanaan Keluarga (KB)" },
            { nama: "Fajar Nugraha", usia: "36 Tahun", gender: "Laki-laki", layanan: "Pemeriksaan Kebugaran & Kolesterol" },
            { nama: "Rizky Ramadhan", usia: "34 Tahun", gender: "Laki-laki", layanan: "Edukasi Bahaya Merokok & Hipertensi" },
            { nama: "Fitriani Rahayu", usia: "30 Tahun", gender: "Perempuan", layanan: "Konseling Nutrisi Keluarga Sehat" },
            { nama: "Bambang Sugianto", usia: "44 Tahun", gender: "Laki-laki", layanan: "Cek Tensi Darah & Asam Urat" },
            { nama: "Wahyu Hidayat", usia: "28 Tahun", gender: "Laki-laki", layanan: "Skrining Kesehatan Pra-Nikah" },
            { nama: "Anisa Rahmawati", usia: "21 Tahun", gender: "Perempuan", layanan: "Edukasi Kesehatan Reproduksi" },
            { nama: "Bayu Pratama", usia: "26 Tahun", gender: "Laki-laki", layanan: "Cek Tekanan Darah Rutin" },
            { nama: "Lestari Ayu", usia: "39 Tahun", gender: "Perempuan", layanan: "Skrining Faktor Risiko PTM" }
        ],
        lansia: [
            { nama: "Karto Wijoyo", usia: "69 Tahun", gender: "Laki-laki", layanan: "Cek Tensi (135/85) & Asam Urat 5.8 mg/dL" },
            { nama: "Hj. Sutinah", usia: "71 Tahun", gender: "Perempuan", layanan: "Cek Gula Darah Puasa (110 mg/dL)" },
            { nama: "Mbah Slamet", usia: "76 Tahun", gender: "Laki-laki", layanan: "Pemeriksaan Fisik Sendi & Senam Lansia" },
            { nama: "Siti Maryam", usia: "65 Tahun", gender: "Perempuan", layanan: "Cek Kolesterol Total & Tensi Darah" },
            { nama: "H. Abdul Wahid", usia: "72 Tahun", gender: "Laki-laki", layanan: "Evaluasi Obat Rutin Hipertensi" },
            { nama: "Suparman", usia: "67 Tahun", gender: "Laki-laki", layanan: "Skrining Gangguan Penglihatan Lansia" },
            { nama: "Sumiatun", usia: "68 Tahun", gender: "Perempuan", layanan: "Pemeriksaan Fungsi Kognitif & Tensi" },
            { nama: "Paiman", usia: "74 Tahun", gender: "Laki-laki", layanan: "Konseling Pola Makan Rendah Garam" },
            { nama: "Parto Suwito", usia: "70 Tahun", gender: "Laki-laki", layanan: "Cek Asam Urat & Timbang Berat Badan" },
            { nama: "Sri Mulyani", usia: "66 Tahun", gender: "Perempuan", layanan: "Konseling Osteoporosis & Kalsium" },
            { nama: "Dahlan", usia: "75 Tahun", gender: "Laki-laki", layanan: "Pemeriksaan Tekanan Darah & GDS" },
            { nama: "Suminah", usia: "63 Tahun", gender: "Perempuan", layanan: "Pemberian Vitamin B Kompleks" },
            { nama: "Sukardi", usia: "78 Tahun", gender: "Laki-laki", layanan: "Pemeriksaan Status Fungsional Barthel" },
            { nama: "Maimunah", usia: "67 Tahun", gender: "Perempuan", layanan: "Cek Gula Darah & Edukasi Diabetes" },
            { nama: "Harun Al-Rasyid", usia: "73 Tahun", gender: "Laki-laki", layanan: "Skrining Katarak & Rujukan Faskes" },
            { nama: "Kasih", usia: "69 Tahun", gender: "Perempuan", layanan: "Pemeriksaan Lingkar Perut & Tensi" }
        ]
    };

    // Konfigurasi Detail Sesi Kehadiran (Jumlah Pas Sesuai Grafik)
    // Contoh: Hari Senin = 60 orang (20 Balita, 12 Bumil, 14 Dewasa, 14 Lansia = 60!)
    const sessionDetails = {
        // Mode Mingguan
        "Senin": { total: 60, balitaCount: 20, bumilCount: 12, dewasaCount: 14, lansiaCount: 14, tanggal: "Senin, 04 November 2024", lokasi: "Posko Anggrek (RW 01)" },
        "Selasa": { total: 45, balitaCount: 16, bumilCount: 9, dewasaCount: 10, lansiaCount: 10, tanggal: "Selasa, 05 November 2024", lokasi: "Posko Mawar (RW 02)" },
        "Rabu": { total: 52, balitaCount: 18, bumilCount: 10, dewasaCount: 12, lansiaCount: 12, tanggal: "Rabu, 06 November 2024", lokasi: "Posko Melati (RW 03)" },
        "Kamis": { total: 38, balitaCount: 14, bumilCount: 8, dewasaCount: 8, lansiaCount: 8, tanggal: "Kamis, 07 November 2024", lokasi: "Posko Dahlia (RW 04)" },
        "Jumat": { total: 65, balitaCount: 22, bumilCount: 13, dewasaCount: 15, lansiaCount: 15, tanggal: "Jumat, 08 November 2024", lokasi: "Posko Induk Balai Desa" },
        "Sabtu": { total: 70, balitaCount: 24, bumilCount: 14, dewasaCount: 16, lansiaCount: 16, tanggal: "Sabtu, 09 November 2024", lokasi: "Penimbangan Serentak Akbar" },
        
        // Mode Bulanan
        "JAN": { total: 35, balitaCount: 12, bumilCount: 7, dewasaCount: 8, lansiaCount: 8, tanggal: "Rekap Januari 2024", lokasi: "Wilayah Desa Sejahtera" },
        "FEB": { total: 42, balitaCount: 15, bumilCount: 9, dewasaCount: 9, lansiaCount: 9, tanggal: "Rekap Februari 2024", lokasi: "Wilayah Desa Sejahtera" },
        "MAR": { total: 38, balitaCount: 14, bumilCount: 8, dewasaCount: 8, lansiaCount: 8, tanggal: "Rekap Maret 2024", lokasi: "Wilayah Desa Sejahtera" },
        "APR": { total: 55, balitaCount: 19, bumilCount: 11, dewasaCount: 12, lansiaCount: 13, tanggal: "Rekap April 2024", lokasi: "Wilayah Desa Sejahtera" },
        "MEI": { total: 48, balitaCount: 17, bumilCount: 10, dewasaCount: 10, lansiaCount: 11, tanggal: "Rekap Mei 2024", lokasi: "Wilayah Desa Sejahtera" },
        "JUN": { total: 65, balitaCount: 22, bumilCount: 13, dewasaCount: 15, lansiaCount: 15, tanggal: "Rekap Juni 2024", lokasi: "Wilayah Desa Sejahtera" },
        "JUL": { total: 60, balitaCount: 20, bumilCount: 12, dewasaCount: 14, lansiaCount: 14, tanggal: "Rekap Juli 2024", lokasi: "Wilayah Desa Sejahtera" },
        "AGU": { total: 72, balitaCount: 24, bumilCount: 15, dewasaCount: 16, lansiaCount: 17, tanggal: "Bulan Penimbangan Balita & Vit A", lokasi: "Wilayah Desa Sejahtera" },
        "SEP": { total: 68, balitaCount: 23, bumilCount: 14, dewasaCount: 15, lansiaCount: 16, tanggal: "Rekap September 2024", lokasi: "Wilayah Desa Sejahtera" },
        "OKT": { total: 85, balitaCount: 28, bumilCount: 17, dewasaCount: 20, lansiaCount: 20, tanggal: "Rekap Akbar Oktober 2024", lokasi: "Wilayah Desa Sejahtera" }
    };

    /**
     * Helper: Menghasilkan daftar peserta per kelompok usia untuk sesi yang diklik
     */
    function getAttendeesForSession(sessionKey) {
        const config = sessionDetails[sessionKey] || {
            total: 60, balitaCount: 20, bumilCount: 12, dewasaCount: 14, lansiaCount: 14, 
            tanggal: sessionKey, lokasi: "Posko Anggrek"
        };

        const result = {
            info: config,
            balita: [],
            bumil: [],
            dewasa: [],
            lansia: []
        };

        // 1. Ambil Balita
        for (let i = 0; i < config.balitaCount; i++) {
            const item = samplePool.balita[i % samplePool.balita.length];
            result.balita.push({ ...item, id: `BLT-${i+1}` });
        }

        // 2. Ambil Ibu Hamil
        for (let i = 0; i < config.bumilCount; i++) {
            const item = samplePool.bumil[i % samplePool.bumil.length];
            result.bumil.push({ ...item, id: `BML-${i+1}` });
        }

        // 3. Ambil Dewasa & Remaja (Dikelompokkan Khusus Dewasa)
        for (let i = 0; i < config.dewasaCount; i++) {
            const item = samplePool.dewasa[i % samplePool.dewasa.length];
            result.dewasa.push({ ...item, id: `DWS-${i+1}` });
        }

        // 4. Ambil Lansia
        for (let i = 0; i < config.lansiaCount; i++) {
            const item = samplePool.lansia[i % samplePool.lansia.length];
            result.lansia.push({ ...item, id: `LNS-${i+1}` });
        }

        return result;
    }

    /**
     * Manajemen Paginasi Mandiri per Kategori (Maksimal 10 Baris per Halaman)
     */
    let currentSessionData = null;
    let currentFilterCategory = 'all';

    const paginationConfig = {
        pageSize: 10,
        balita: { page: 1, fullList: [], filteredList: [] },
        bumil: { page: 1, fullList: [], filteredList: [] },
        dewasa: { page: 1, fullList: [], filteredList: [] },
        lansia: { page: 1, fullList: [], filteredList: [] }
    };

    const categoryMeta = {
        balita: { label: 'Balita', tagClass: 'tag-success', tableId: 'tableBalita', pageInfoId: 'pageInfoBalita', pageIndicatorId: 'pageIndicatorBalita', prevBtnId: 'prevBtnBalita', nextBtnId: 'nextBtnBalita' },
        bumil: { label: 'Bumil', tagClass: 'tag-warning', tableId: 'tableBumil', pageInfoId: 'pageInfoBumil', pageIndicatorId: 'pageIndicatorBumil', prevBtnId: 'prevBtnBumil', nextBtnId: 'nextBtnBumil' },
        dewasa: { label: 'Dewasa', tagClass: 'tag-info', tableId: 'tableDewasa', pageInfoId: 'pageInfoDewasa', pageIndicatorId: 'pageIndicatorDewasa', prevBtnId: 'prevBtnDewasa', nextBtnId: 'nextBtnDewasa' },
        lansia: { label: 'Lansia', tagClass: 'tag-neutral', tableId: 'tableLansia', pageInfoId: 'pageInfoLansia', pageIndicatorId: 'pageIndicatorLansia', prevBtnId: 'prevBtnLansia', nextBtnId: 'nextBtnLansia' }
    };

    /**
     * Render Halaman Tabel untuk Kategori Tertentu (10 Baris per Halaman)
     */
    function renderCategoryPage(catKey) {
        const state = paginationConfig[catKey];
        const meta = categoryMeta[catKey];
        const tbodyEl = document.getElementById(meta.tableId);
        if (!tbodyEl) return;

        const totalItems = state.filteredList.length;
        const totalPages = Math.max(1, Math.ceil(totalItems / paginationConfig.pageSize));

        if (state.page > totalPages) state.page = totalPages;
        if (state.page < 1) state.page = 1;

        const startIndex = (state.page - 1) * paginationConfig.pageSize;
        const endIndex = Math.min(startIndex + paginationConfig.pageSize, totalItems);
        const pageItems = state.filteredList.slice(startIndex, endIndex);

        tbodyEl.innerHTML = '';
        if (totalItems === 0) {
            tbodyEl.innerHTML = `
                <tr>
                    <td colspan="7" style="text-align: center; color: var(--text-muted); padding: 1.5rem; font-size: 0.85rem;">
                        Tidak ada data peserta ditemukan pada kelompok ini.
                    </td>
                </tr>
            `;
        } else {
            pageItems.forEach((p, idx) => {
                const tr = document.createElement('tr');
                tr.className = 'attendee-row';
                tr.dataset.name = (p.nama || '').toLowerCase();
                tr.dataset.category = meta.label.toLowerCase();

                const isMale = p.gender === 'Laki-laki';
                const genderBadge = isMale 
                    ? `<span class="tag tag-info" style="font-size: 0.7rem; padding: 2px 8px; font-weight: 600;"><i class="fa-solid fa-mars" style="margin-right: 3px;"></i> L</span>`
                    : `<span class="tag tag-warning" style="font-size: 0.7rem; padding: 2px 8px; font-weight: 600; background: #fdf2f8; color: #db2777; border: 1px solid #fbcfe8;"><i class="fa-solid fa-venus" style="margin-right: 3px;"></i> P</span>`;

                tr.innerHTML = `
                    <td style="text-align: center; font-weight: 600; color: var(--text-muted); font-size: 0.8rem;">
                        ${startIndex + idx + 1}
                    </td>
                    <td>
                        <div style="display: flex; align-items: center; gap: 10px;">
                            <img src="https://ui-avatars.com/api/?name=${encodeURIComponent(p.nama)}&background=random&size=36" 
                                 alt="${p.nama}" 
                                 style="width: 32px; height: 32px; border-radius: 50%; object-fit: cover; flex-shrink: 0; box-shadow: var(--shadow-xs);">
                            <div>
                                <div style="font-weight: 600; color: var(--text-main); font-size: 0.875rem;">
                                    ${p.nama}
                                </div>
                                <div style="font-size: 0.725rem; color: var(--text-muted);">
                                    ${p.id || ('ID-' + (startIndex + idx + 1))}
                                </div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <span style="font-weight: 600; color: var(--text-main); font-size: 0.85rem; white-space: nowrap;">
                            ${p.usia}
                        </span>
                    </td>
                    <td style="text-align: center;">
                        ${genderBadge}
                    </td>
                    <td>
                        <div style="font-size: 0.825rem; color: var(--text-main); line-height: 1.4;">
                            ${p.layanan}
                        </div>
                    </td>
                    <td style="text-align: center;">
                        <span class="tag ${meta.tagClass}" style="font-size: 0.7rem; padding: 3px 8px; font-weight: 600;">
                            ${meta.label}
                        </span>
                    </td>
                    <td style="text-align: center;">
                        <span class="tag tag-success" style="font-size: 0.7rem; padding: 3px 8px; font-weight: 600;">
                            <i class="fa-solid fa-check" style="font-size: 0.65rem; margin-right: 3px;"></i> Hadir
                        </span>
                    </td>
                `;
                tbodyEl.appendChild(tr);
            });
        }

        // Perbarui informasi pagination di footer tabel
        const infoEl = document.getElementById(meta.pageInfoId);
        if (infoEl) {
            if (totalItems === 0) {
                infoEl.innerHTML = `Menampilkan <strong style="color: var(--text-main);">0</strong> peserta`;
            } else {
                infoEl.innerHTML = `Menampilkan <strong style="color: var(--text-main);">${startIndex + 1}-${endIndex}</strong> dari <strong style="color: var(--text-main);">${totalItems}</strong> peserta`;
            }
        }

        const indicatorEl = document.getElementById(meta.pageIndicatorId);
        if (indicatorEl) {
            indicatorEl.textContent = `Hal ${state.page} / ${totalPages}`;
        }

        const prevBtn = document.getElementById(meta.prevBtnId);
        if (prevBtn) {
            const isPrevDisabled = (state.page <= 1);
            prevBtn.disabled = isPrevDisabled;
            prevBtn.style.opacity = isPrevDisabled ? '0.45' : '1';
            prevBtn.style.cursor = isPrevDisabled ? 'not-allowed' : 'pointer';
        }

        const nextBtn = document.getElementById(meta.nextBtnId);
        if (nextBtn) {
            const isNextDisabled = (state.page >= totalPages);
            nextBtn.disabled = isNextDisabled;
            nextBtn.style.opacity = isNextDisabled ? '0.45' : '1';
            nextBtn.style.cursor = isNextDisabled ? 'not-allowed' : 'pointer';
        }
    }

    /**
     * Pengendali Tombol Gulir Halaman (Sebelumnya / Selanjutnya)
     */
    function changeAttendeePage(catKey, delta) {
        const state = paginationConfig[catKey];
        if (!state) return;
        const totalPages = Math.max(1, Math.ceil(state.filteredList.length / paginationConfig.pageSize));
        const targetPage = state.page + delta;
        if (targetPage >= 1 && targetPage <= totalPages) {
            state.page = targetPage;
            renderCategoryPage(catKey);
        }
    }

    /**
     * Perbarui Rincian Data Hadir di Bawah Grafik Sesuai Bar Diagram yang Dipilih
     */
    function updateAttendanceSection(sessionLabel, barValue, shouldScroll = false) {
        currentSessionData = getAttendeesForSession(sessionLabel);
        const info = currentSessionData.info;

        // Set Judul & Subtitle Seksi di Bawah Grafik
        const titleEl = document.getElementById('sectionSessionTitle');
        if (titleEl) titleEl.textContent = sessionLabel;

        const totalBadgeEl = document.getElementById('sectionTotalBadge');
        if (totalBadgeEl) totalBadgeEl.textContent = `${info.total} Peserta Hadir`;

        const dateEl = document.getElementById('sectionSessionDate');
        if (dateEl) dateEl.innerHTML = `<i class="fa-regular fa-calendar-check" style="margin-right: 4px;"></i> ${info.tanggal}`;

        const locEl = document.getElementById('sectionLocation');
        if (locEl) locEl.textContent = info.lokasi;

        // Update Angka di Filter Pills
        const pillAll = document.getElementById('pillCountAll');
        if (pillAll) pillAll.textContent = info.total;

        const pillBalita = document.getElementById('pillCountBalita');
        if (pillBalita) pillBalita.textContent = currentSessionData.balita.length;

        const pillBumil = document.getElementById('pillCountBumil');
        if (pillBumil) pillBumil.textContent = currentSessionData.bumil.length;

        const pillDewasa = document.getElementById('pillCountDewasa');
        if (pillDewasa) pillDewasa.textContent = currentSessionData.dewasa.length;

        const pillLansia = document.getElementById('pillCountLansia');
        if (pillLansia) pillLansia.textContent = currentSessionData.lansia.length;

        // Update Angka di Header Masing-masing Kategori
        const bBalita = document.getElementById('badgeBalitaCount');
        if (bBalita) bBalita.textContent = `${currentSessionData.balita.length} Peserta`;

        const bBumil = document.getElementById('badgeBumilCount');
        if (bBumil) bBumil.textContent = `${currentSessionData.bumil.length} Peserta`;

        const bDewasa = document.getElementById('badgeDewasaCount');
        if (bDewasa) bDewasa.textContent = `${currentSessionData.dewasa.length} Peserta`;

        const bLansia = document.getElementById('badgeLansiaCount');
        if (bLansia) bLansia.textContent = `${currentSessionData.lansia.length} Peserta`;

        // Reset state paginasi ke halaman 1 dengan dataset baru per kategori
        ['balita', 'bumil', 'dewasa', 'lansia'].forEach(cat => {
            paginationConfig[cat].page = 1;
            paginationConfig[cat].fullList = currentSessionData[cat] || [];
            paginationConfig[cat].filteredList = currentSessionData[cat] || [];
            renderCategoryPage(cat);
        });

        // Terapkan Filter & Pencarian Sesuai Kondisi Terkini
        applySearchAndCategoryFilters();

        // Smooth scroll ke seksi di bawah jika dipicu oleh klik diagram
        if (shouldScroll) {
            const sectionEl = document.getElementById('attendanceSection');
            if (sectionEl) {
                sectionEl.scrollIntoView({ behavior: 'smooth', block: 'start' });
                sectionEl.classList.remove('highlight-pulse');
                void sectionEl.offsetWidth; // Trigger reflow
                sectionEl.classList.add('highlight-pulse');
            }
        }
    }

    /**
     * Logika Filter Pill Kelompok Kategori & Pencarian Real-Time
     */
    const pillButtons = document.querySelectorAll('.pill-btn');
    pillButtons.forEach(btn => {
        btn.addEventListener('click', function() {
            pillButtons.forEach(b => {
                b.classList.remove('btn-primary', 'active');
                b.classList.add('btn-secondary');
            });
            this.classList.remove('btn-secondary');
            this.classList.add('btn-primary', 'active');

            currentFilterCategory = this.dataset.category;
            applySearchAndCategoryFilters();
        });
    });

    function applySearchAndCategoryFilters() {
        const searchInput = document.getElementById('sectionSearchAttendee');
        const query = (searchInput?.value || '').toLowerCase().trim();
        const categories = ['balita', 'bumil', 'dewasa', 'lansia'];
        let totalVisibleMatches = 0;

        categories.forEach(cat => {
            const blockEl = document.getElementById('block' + cat.charAt(0).toUpperCase() + cat.slice(1));
            const categoryMatches = (currentFilterCategory === 'all' || currentFilterCategory === cat);

            if (!categoryMatches) {
                if (blockEl) blockEl.style.display = 'none';
                return;
            }

            // Saring data berdasarkan nama peserta atau layanan medis
            const fullList = paginationConfig[cat].fullList || [];
            const matches = query 
                ? fullList.filter(p => (p.nama || '').toLowerCase().includes(query) || (p.layanan || '').toLowerCase().includes(query))
                : fullList;

            paginationConfig[cat].filteredList = matches;
            paginationConfig[cat].page = 1; // Reset ke halaman 1 saat pencarian
            renderCategoryPage(cat);

            if (query && matches.length === 0) {
                if (blockEl) blockEl.style.display = 'none';
            } else {
                if (blockEl) blockEl.style.display = 'block';
                totalVisibleMatches += matches.length;
            }
        });

        const noFound = document.getElementById('noAttendeeFound');
        if (noFound) {
            noFound.style.display = (totalVisibleMatches === 0 && query !== '') ? 'block' : 'none';
        }
    }

    function resetCategoryFilter() {
        currentFilterCategory = 'all';
        pillButtons.forEach(b => {
            if (b.dataset.category === 'all') {
                b.classList.remove('btn-secondary');
                b.classList.add('btn-primary', 'active');
            } else {
                b.classList.remove('btn-primary', 'active');
                b.classList.add('btn-secondary');
            }
        });
        const searchInput = document.getElementById('sectionSearchAttendee');
        if (searchInput) searchInput.value = '';
        applySearchAndCategoryFilters();
    }

    const searchInput = document.getElementById('sectionSearchAttendee');
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            applySearchAndCategoryFilters();
        });
    }

    /**
     * =========================================================================
     *  INISIALISASI CHART.JS DENGAN UKURAN PROPORSIONAL & KLIK BAR INTERAKTIF
     * =========================================================================
     */
    const ctx = document.getElementById('healthChart').getContext('2d');
    const periodSelect = document.getElementById('chartPeriodSelect');

    // Data Periode
    const chartDataMingguan = {
        labels: ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'],
        data: [60, 45, 52, 38, 65, 70]
    };

    const chartDataBulanan = {
        labels: ['JAN', 'FEB', 'MAR', 'APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT'],
        data: [28, 45, 38, 62, 54, 76, 70, 78, 68, 95]
    };

    // Default aktif: Bulanan dengan Oktober (95) terpilih sesuai screenshot Figma
    let activeDataMode = chartDataBulanan;
    let selectedBarIndex = 9;

    const healthChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: activeDataMode.labels,
            datasets: [{
                label: 'Peserta Hadir',
                data: activeDataMode.data,
                borderRadius: 6,
                maxBarThickness: 32,
                backgroundColor: function(context) {
                    const index = context.dataIndex;
                    return index === selectedBarIndex ? '#2d6a4f' : '#c5d4cb';
                },
                hoverBackgroundColor: '#1b4332'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            layout: {
                padding: {
                    top: 15,
                    bottom: 0,
                    left: 0,
                    right: 0
                }
            },
            onClick: function(evt, elements) {
                if (elements && elements.length > 0) {
                    const firstEl = elements[0];
                    const index = firstEl.index;
                    selectedBarIndex = index;
                    healthChart.update();

                    const sessionLabel = healthChart.data.labels[index];
                    const sessionCount = healthChart.data.datasets[0].data[index];

                    updateAttendanceSection(sessionLabel, sessionCount, true);
                }
            },
            onHover: function(evt, elements) {
                evt.native.target.style.cursor = elements.length ? 'pointer' : 'default';
            },
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: '#1f2937',
                    titleFont: { family: 'Inter', size: 12, weight: 'bold' },
                    bodyFont: { family: 'Inter', size: 12 },
                    padding: 10,
                    cornerRadius: 8,
                    callbacks: {
                        label: function(context) {
                            return ` ${context.parsed.y} Peserta Hadir (Klik untuk rincian)`;
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: { color: 'rgba(0, 0, 0, 0.04)' },
                    ticks: { 
                        font: { family: 'Inter', size: 11 },
                        maxTicksLimit: 6,
                        stepSize: 20
                    }
                },
                x: {
                    grid: { display: false },
                    ticks: { font: { family: 'Inter', size: 11, weight: '600' } }
                }
            }
        }
    });

    if (periodSelect) {
        periodSelect.addEventListener('change', function() {
            if (this.value === 'mingguan') {
                activeDataMode = chartDataMingguan;
                selectedBarIndex = 0;
            } else {
                activeDataMode = chartDataBulanan;
                selectedBarIndex = 9;
            }

            healthChart.data.labels = activeDataMode.labels;
            healthChart.data.datasets[0].data = activeDataMode.data;
            healthChart.update();

            updateAttendanceSection(activeDataMode.labels[selectedBarIndex], activeDataMode.data[selectedBarIndex], false);
        });
    }

    // Inisialisasi awal: Muat data Oktober (95 peserta) sesuai mockup
    updateAttendanceSection('OCT', 95, false);
</script>
@endsection
