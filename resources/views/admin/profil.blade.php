@extends('layouts.admin')

@section('title', 'Profil Warga — ' . $warga->nama_lengkap)
@section('breadcrumbs', 'Beranda > Daftar Anggota > ' . $warga->nama_lengkap)
@section('page_title', 'Profil Warga')

@section('content')
<p style="font-size: 0.88rem; color: #6b7280; margin-bottom: 1.5rem; margin-top: -0.25rem;">
    Catatan rinci identitas kependudukan, pemantauan kesehatan berkala, evaluasi KKA, dan rekam medis ILP.
</p>

<!-- 1. Tombol Aksi Navigasi Atas -->
<div style="display: flex; justify-content: flex-end; gap: 12px; margin-bottom: 1.5rem; flex-wrap: wrap;">
    <a href="{{ route('admin.daftar-anggota') }}" class="btn btn-secondary">
        <i class="fa-solid fa-arrow-left"></i>
        <span>Kembali ke Daftar</span>
    </a>
    <a href="{{ route('admin.pemeriksaan', ['nik' => $warga->NIK]) }}" class="btn btn-primary" style="background: #2d6a4f;">
        <i class="fa-solid fa-plus"></i>
        <span>Tambah Pengukuran Fisik</span>
    </a>
</div>

<!-- 2. Kartu Ringkasan Profil (Responsif Flex) -->
<div class="card mb-4" style="display: flex; gap: 24px; align-items: center; flex-wrap: wrap; border-radius: 18px; border: 1px solid #ebe6dd;">
    <img src="https://ui-avatars.com/api/?name={{ urlencode($warga->nama_lengkap) }}&background=2d6a4f&color=fff&size=120" 
         alt="{{ $warga->nama_lengkap }}" 
         style="width: 96px; height: 96px; border-radius: 16px; object-fit: cover; box-shadow: var(--shadow-sm); flex-shrink: 0;">
    
    <div style="flex-grow: 1; min-width: 240px;">
        <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 6px; flex-wrap: wrap;">
            <h3 class="serif" style="font-size: 1.6rem; margin: 0; color: #1f2937;">{{ $warga->nama_lengkap }}</h3>
            <span class="tag tag-success">{{ $warga->status ?? 'Balita' }}</span>
            <span class="tag tag-neutral">{{ $warga->jenis_kelamin }}</span>

            @if($warga->is_prematur)
                <span class="tag tag-warning" style="font-weight: 700;">
                    <i class="fa-solid fa-ribbon"></i> Bayi Prematur (Lahir Gestasi: {{ $warga->usia_kehamilan_minggu ?? 34 }} Minggu)
                </span>
            @endif
        </div>
        
        <p class="text-muted" style="font-size: 0.9rem; margin-bottom: 10px;">
            <strong>NIK:</strong> <code style="font-family: monospace; font-size: 0.95rem; color: #2d6a4f;">{{ $warga->NIK }}</code> 
            • <strong>Usia Kronologis:</strong> {{ \Carbon\Carbon::parse($warga->tanggal_lahir)->age }} Tahun ({{ \Carbon\Carbon::parse($warga->tanggal_lahir)->diffInMonths(now()) }} Bulan)
        </p>

        <div style="display: flex; gap: 8px; flex-wrap: wrap;">
            <span class="tag tag-success" style="font-size: 0.8rem; padding: 4px 10px;">
                <i class="fa-solid fa-circle-check"></i> Status: Aktif Terdaftar
            </span>

            @if($warga->is_prematur && $warga->usia_koreksi)
                <span class="tag tag-info" style="font-size: 0.8rem; padding: 4px 10px; font-weight: 600;">
                    <i class="fa-solid fa-clock-rotate-left"></i> Usia Koreksi: {{ $warga->usia_koreksi }}
                </span>
            @endif
        </div>
    </div>
</div>

<!-- 3. Navigasi Tab Interaktif Sesuai Standar Kemenkes ILP -->
<div style="display: flex; border-bottom: 2px solid var(--border-color); margin-bottom: 1.75rem; gap: 20px; overflow-x: auto;">
    <button type="button" class="tab-btn active" data-tab="health" 
            style="padding: 10px 4px; border: none; background: none; font-weight: 700; font-size: 0.925rem; cursor: pointer; color: var(--primary); border-bottom: 3px solid var(--primary); margin-bottom: -2px; white-space: nowrap;">
        <i class="fa-solid fa-user-circle" style="margin-right: 6px;"></i> Biodata & Rekam Medis
    </button>
    
    <button type="button" class="tab-btn" data-tab="growth" 
            style="padding: 10px 4px; border: none; background: none; font-weight: 600; font-size: 0.925rem; cursor: pointer; color: var(--text-muted); border-bottom: 3px solid transparent; margin-bottom: -2px; white-space: nowrap;">
        <i class="fa-solid fa-chart-line" style="margin-right: 6px;"></i> Grafik {{ $warga->is_prematur ? 'Fenton / Prematur' : 'Pertumbuhan WHO' }}
    </button>

    @if($warga->status === 'Balita')
    <button type="button" class="tab-btn" data-tab="kka" 
            style="padding: 10px 4px; border: none; background: none; font-weight: 600; font-size: 0.925rem; cursor: pointer; color: var(--text-muted); border-bottom: 3px solid transparent; margin-bottom: -2px; white-space: nowrap;">
        <i class="fa-solid fa-clipboard-check" style="margin-right: 6px;"></i> Kartu Kembang Anak (KKA - 7 Aspek)
    </button>
    @endif

    @if(in_array($warga->status, ['Ibu Hamil', 'Remaja']))
    <button type="button" class="tab-btn" data-tab="ttd" 
            style="padding: 10px 4px; border: none; background: none; font-weight: 600; font-size: 0.925rem; cursor: pointer; color: var(--text-muted); border-bottom: 3px solid transparent; margin-bottom: -2px; white-space: nowrap;">
        <i class="fa-solid fa-pills" style="margin-right: 6px;"></i> Kartu Kontrol TTD
    </button>
    @endif

    <button type="button" class="tab-btn" data-tab="kunjungan" 
            style="padding: 10px 4px; border: none; background: none; font-weight: 600; font-size: 0.925rem; cursor: pointer; color: var(--text-muted); border-bottom: 3px solid transparent; margin-bottom: -2px; white-space: nowrap;">
        <i class="fa-solid fa-house-chimney-medical" style="margin-right: 6px;"></i> Kunjungan Rumah ({{ $warga->kunjunganRumah->count() }})
    </button>
</div>

<!-- ========================================================================= -->
<!-- TAB 1: Biodata & Rekam Medis                                              -->
<!-- ========================================================================= -->
<div id="healthTabContent">
    <div class="content-grid">
        <div style="display: flex; flex-direction: column; gap: 20px;">
            <div class="card" style="border-radius: 16px;">
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
                        <label style="font-size: 0.75rem; color: var(--text-muted); display: block; font-weight: 600; text-transform: uppercase;">STATUS PREMATUR</label>
                        <div style="font-weight: 600; font-size: 0.95rem;">
                            {{ $warga->is_prematur ? 'Ya (' . ($warga->usia_kehamilan_minggu ?? 34) . ' Minggu Gestasi)' : 'Tidak (Cukup Bulan / Aterm)' }}
                        </div>
                    </div>
                    <div>
                        <label style="font-size: 0.75rem; color: var(--text-muted); display: block; font-weight: 600; text-transform: uppercase;">WILAYAH POSKO</label>
                        <div style="font-weight: 600; font-size: 0.95rem;">Posko Induk Anggrek (RW 01)</div>
                    </div>
                </div>
            </div>

            @if($warga->is_prematur)
            <!-- Modul Edukasi & Pemantauan Khusus Bayi Prematur -->
            <div class="card" style="border-radius: 16px; background: #fffdfa; border: 1px solid #f6e05e;">
                <div class="card-title">
                    <span><i class="fa-solid fa-ribbon text-warning" style="margin-right: 8px;"></i> Pemantauan Khusus Bayi Prematur (Kemenkes)</span>
                </div>
                <div style="font-size: 0.85rem; color: #4a5568; line-height: 1.6;">
                    <p style="margin-bottom: 8px;">
                        Bayi prematur menggunakan <strong>Kurva Fenton</strong> untuk memantau Berat Badan (BB), Panjang Badan (PB), dan Lingkar Kepala (LK) berdasarkan <strong>Usia Koreksi</strong> hingga usia 2 tahun (50 minggu post-menstrual).
                    </p>
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px; margin-top: 10px;">
                        <div style="background: #ffffff; padding: 10px; border-radius: 8px; border: 1px solid #edf2f7;">
                            <div style="font-size: 0.75rem; font-weight: 700; color: #2d6a4f;">Perawatan Metode Kanguru (PMK)</div>
                            <div style="font-size: 0.8rem; color: #718096; margin-top: 2px;">Skin-to-skin rutin minimal 60 menit per sesi untuk stabilitas suhu.</div>
                        </div>
                        <div style="background: #ffffff; padding: 10px; border-radius: 8px; border: 1px solid #edf2f7;">
                            <div style="font-size: 0.75rem; font-weight: 700; color: #c53030;">Tanda Bahaya Prematur</div>
                            <div style="font-size: 0.8rem; color: #718096; margin-top: 2px;">Segera bawa ke RS/Puskesmas jika demam, tak mau nyusu, atau kejang.</div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>

        <!-- Kolom Kanan: Evaluasi & Catatan Medis -->
        <div style="display: flex; flex-direction: column; gap: 20px;">
            <div class="card" style="border-radius: 16px;">
                <div class="card-title">
                    <span><i class="fa-solid fa-clipboard-user text-primary" style="margin-right: 8px;"></i> Evaluasi Bidan / Kader</span>
                </div>
                
                <div style="font-size: 0.85rem; line-height: 1.6; color: #4b5563;">
                    <p style="margin-bottom: 12px;">
                        Pemantauan berkala tercatat dalam sistem terpadu posyandu. Warga aktif mengikuti jadwal penimbangan dan skrining kesehatan rutin.
                    </p>
                    <div style="background: #faf8f5; border: 1px solid #ede8de; border-radius: 10px; padding: 12px;">
                        <div style="font-size: 0.75rem; font-weight: 700; color: #2d6a4f; text-transform: uppercase;">Rekomendasi Nakes:</div>
                        <div style="font-size: 0.825rem; margin-top: 4px;">
                            Lanjutkan pemantauan gizi seimbang "Isi Piringku", stimulasi tumbuh kembang aktif, dan jaga sanitasi lingkungan rumah.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ========================================================================= -->
<!-- TAB 2: Grafik Pertumbuhan (WHO / Kurva Fenton)                           -->
<!-- ========================================================================= -->
<div id="growthTabContent" style="display: none;">
    <div class="card" style="border-radius: 16px;">
        <div class="card-title">
            <span><i class="fa-solid fa-chart-line text-primary" style="margin-right: 8px;"></i> Grafik Tumbuh Kembang {{ $warga->is_prematur ? '(Kurva Fenton Usia Koreksi)' : '(Standar WHO)' }}</span>
            <span class="tag {{ $warga->is_prematur ? 'tag-warning' : 'tag-success' }}" style="font-size: 0.75rem;">
                {{ $warga->is_prematur ? 'Dataset Fenton Prematur' : 'WHO Growth Standard' }}
            </span>
        </div>
        <div style="height: 380px; position: relative;">
            <canvas id="growthChart"></canvas>
        </div>
    </div>
</div>

<!-- ========================================================================= -->
<!-- TAB 3: Kartu Kembang Anak (KKA - 7 Aspek Perkembangan Kemenkes)           -->
<!-- ========================================================================= -->
@if($warga->status === 'Balita')
<div id="kkaTabContent" style="display: none;">
    <!-- Alert Peringatan Rujukan Puskesmas sesuai BR-03 & UAC-01 -->
    @php
        $latestKka = $warga->kartuKembangAnak->first();
    @endphp

    @if($latestKka && $latestKka->status_rujuk === 'Rujuk ke Puskesmas')
    <div style="background: #fee2e2; border: 1px solid #ef4444; border-radius: 14px; padding: 16px 20px; color: #991b1b; margin-bottom: 1.5rem; display: flex; align-items: flex-start; gap: 14px;">
        <i class="fa-solid fa-triangle-exclamation" style="font-size: 1.6rem; color: #dc2626; margin-top: 2px;"></i>
        <div>
            <div style="font-weight: 700; font-size: 1rem; margin-bottom: 4px;">
                PERINGATAN SISTEM: RUJUK KE PUSKESMAS (Aturan Bisnis BR-03 / UAC-01)
            </div>
            <div style="font-size: 0.85rem; line-height: 1.5;">
                Anak tercatat <strong>tidak mencapai tugas perkembangan selama 2 bulan berturut-turut</strong> (titik potong di bawah garis merah). Wajib segera dirujuk ke Tenaga Medis (Bidan/Dokter Puskesmas) untuk evaluasi tumbuh kembang lebih lanjut.
            </div>
        </div>
    </div>
    @endif

    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.25rem; flex-wrap: wrap; gap: 10px;">
        <div>
            <h4 class="serif" style="margin: 0; font-size: 1.15rem; color: #1f2937;">Riwayat Evaluasi 7 Aspek Perkembangan KKA</h4>
            <p style="font-size: 0.8rem; color: #6b7280; margin: 2px 0 0 0;">Standar pemantauan motorik dan kognitif balita usia 0–72 bulan.</p>
        </div>
        <button type="button" class="btn btn-primary" onclick="openModal('inputKkaModal')" style="border-radius: 9999px; background: #2d6a4f; font-size: 0.825rem;">
            <i class="fa-solid fa-plus" style="margin-right: 4px;"></i> Catat KKA Bulan Ini
        </button>
    </div>

    <!-- Tabel Riwayat KKA -->
    <div class="card" style="padding: 0; overflow: hidden; border-radius: 16px; border: 1px solid #ebe6dd;">
        <table class="table" style="margin: 0; width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="background: #faf8f5; border-bottom: 1px solid #ede8de;">
                    <th style="padding: 12px 16px; font-size: 0.75rem; text-transform: uppercase; color: #6b7280; font-weight: 700;">Usia & Tanggal</th>
                    <th style="padding: 12px 16px; font-size: 0.75rem; text-transform: uppercase; color: #6b7280; font-weight: 700;">7 Aspek Terpenuhi</th>
                    <th style="padding: 12px 16px; font-size: 0.75rem; text-transform: uppercase; color: #6b7280; font-weight: 700;">Garis Merah</th>
                    <th style="padding: 12px 16px; font-size: 0.75rem; text-transform: uppercase; color: #6b7280; font-weight: 700;">Status Rujukan</th>
                    <th style="padding: 12px 16px; font-size: 0.75rem; text-transform: uppercase; color: #6b7280; font-weight: 700;">Catatan</th>
                </tr>
            </thead>
            <tbody>
                @forelse($warga->kartuKembangAnak as $kka)
                <tr style="border-bottom: 1px solid #f3f4f6;">
                    <td style="padding: 12px 16px;">
                        <div style="font-weight: 700; font-size: 0.88rem; color: #1f2937;">Usia {{ $kka->usia_bulan }} Bulan</div>
                        <div style="font-size: 0.75rem; color: #9ca3af;">{{ \Carbon\Carbon::parse($kka->tanggal_pemeriksaan)->translatedFormat('d M Y') }}</div>
                    </td>
                    <td style="padding: 12px 16px;">
                        <div style="display: flex; gap: 4px; flex-wrap: wrap;">
                            <span class="tag {{ $kka->gerak_kasar ? 'tag-success' : 'tag-danger' }}" style="font-size: 0.65rem;" title="Gerak Kasar">GK</span>
                            <span class="tag {{ $kka->gerak_halus ? 'tag-success' : 'tag-danger' }}" style="font-size: 0.65rem;" title="Gerak Halus">GH</span>
                            <span class="tag {{ $kka->komunikasi_pasif ? 'tag-success' : 'tag-danger' }}" style="font-size: 0.65rem;" title="Komunikasi Pasif">KP</span>
                            <span class="tag {{ $kka->komunikasi_aktif ? 'tag-success' : 'tag-danger' }}" style="font-size: 0.65rem;" title="Komunikasi Aktif">KA</span>
                            <span class="tag {{ $kka->kecerdasan ? 'tag-success' : 'tag-danger' }}" style="font-size: 0.65rem;" title="Kecerdasan">KC</span>
                            <span class="tag {{ $kka->menolong_diri_sendiri ? 'tag-success' : 'tag-danger' }}" style="font-size: 0.65rem;" title="Menolong Diri Sendiri">MD</span>
                            <span class="tag {{ $kka->tingkah_laku_sosial ? 'tag-success' : 'tag-danger' }}" style="font-size: 0.65rem;" title="Tingkah Laku Sosial">TS</span>
                        </div>
                    </td>
                    <td style="padding: 12px 16px;">
                        @if($kka->capai_garis_merah)
                            <span class="tag tag-danger" style="font-size: 0.725rem; font-weight: 700;">Di Bawah Garis Merah</span>
                        @else
                            <span class="tag tag-success" style="font-size: 0.725rem; font-weight: 600;">Normal</span>
                        @endif
                    </td>
                    <td style="padding: 12px 16px;">
                        @if($kka->status_rujuk === 'Rujuk ke Puskesmas')
                            <span class="tag tag-danger" style="font-size: 0.75rem; font-weight: 700;">
                                <i class="fa-solid fa-triangle-exclamation"></i> Rujuk ke Puskesmas
                            </span>
                        @elseif($kka->status_rujuk === 'Perlu Pemantauan')
                            <span class="tag tag-warning" style="font-size: 0.75rem; font-weight: 600;">Perlu Pemantauan</span>
                        @else
                            <span class="tag tag-success" style="font-size: 0.75rem; font-weight: 600;">Perkembangan Sesuai</span>
                        @endif
                    </td>
                    <td style="padding: 12px 16px; font-size: 0.8rem; color: #6b7280;">
                        {{ $kka->catatan ?? '-' }}
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" style="padding: 2.5rem; text-align: center; color: #9ca3af;">
                        <i class="fa-solid fa-clipboard-question" style="font-size: 1.8rem; margin-bottom: 6px; color: #cbd5e1;"></i>
                        <div>Belum ada data evaluasi KKA yang tercatat untuk anak ini.</div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endif

<!-- ========================================================================= -->
<!-- TAB 4: Kartu Kontrol Tablet Tambah Darah (TTD)                            -->
<!-- ========================================================================= -->
@if(in_array($warga->status, ['Ibu Hamil', 'Remaja']))
<div id="ttdTabContent" style="display: none;">
    <!-- Progress Konsumsi TTD -->
    @php
        $totalTtd = $warga->kontrolTtd->sum('jumlah_tablet');
        $targetTtd = $warga->status === 'Ibu Hamil' ? 90 : 48; // Bumil min 90 tablet, Remaja 1 tablet/minggu
        $persenTtd = min(100, round(($totalTtd / $targetTtd) * 100));
        $latestHb = $warga->kontrolTtd->whereNotNull('kadar_hb')->first();
    @endphp

    <div class="card mb-4" style="border-radius: 16px; background: #faf8f5; border: 1px solid #ebe6dd;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px; flex-wrap: wrap; gap: 8px;">
            <div>
                <h4 class="serif" style="margin: 0; font-size: 1.15rem; color: #1f2937;">
                    Target Kepatuhan Minum TTD (Standar Kemenkes BR-05)
                </h4>
                <div style="font-size: 0.8rem; color: #6b7280; margin-top: 2px;">
                    {{ $warga->status === 'Ibu Hamil' ? 'Target Minimal: 90 tablet selama kehamilan' : 'Target Rutin: 1 tablet setiap minggu bagi Remaja Putri' }}
                </div>
            </div>
            <div style="font-weight: 700; font-size: 1.25rem; color: #2d6a4f;">
                {{ $totalTtd }} / {{ $targetTtd }} Tablet ({{ $persenTtd }}%)
            </div>
        </div>

        <!-- Progress Bar -->
        <div style="height: 10px; background: #e5e7eb; border-radius: 9999px; overflow: hidden; margin-bottom: 12px;">
            <div style="width: {{ $persenTtd }}%; height: 100%; background: #2d6a4f; transition: width 0.3s ease;"></div>
        </div>

        @if($latestHb && $latestHb->status_anemia)
        <div style="background: #fee2e2; border: 1px solid #f87171; border-radius: 10px; padding: 10px 14px; font-size: 0.825rem; color: #991b1b; display: flex; align-items: center; gap: 10px;">
            <i class="fa-solid fa-droplet" style="color: #dc2626; font-size: 1.1rem;"></i>
            <div>
                <strong>Skrining Anemia (UAC-04):</strong> Terdeteksi kadar Hb {{ $latestHb->kadar_hb }} gr/dl (< 12 gr/dl). Wajib pemantauan TTD 1x/minggu dan konsultasi nutrisi!
            </div>
        </div>
        @endif
    </div>

    <!-- Tombol Tambah TTD -->
    <div style="display: flex; justify-content: flex-end; margin-bottom: 1rem;">
        <button type="button" class="btn btn-primary" onclick="openModal('inputTtdModal')" style="border-radius: 9999px; background: #2d6a4f; font-size: 0.825rem;">
            <i class="fa-solid fa-plus" style="margin-right: 4px;"></i> Catat Konsumsi TTD
        </button>
    </div>

    <!-- Tabel Riwayat TTD -->
    <div class="card" style="padding: 0; overflow: hidden; border-radius: 16px; border: 1px solid #ebe6dd;">
        <table class="table" style="margin: 0; width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="background: #faf8f5; border-bottom: 1px solid #ede8de;">
                    <th style="padding: 12px 16px; font-size: 0.75rem; text-transform: uppercase; color: #6b7280; font-weight: 700;">Tanggal Minum</th>
                    <th style="padding: 12px 16px; font-size: 0.75rem; text-transform: uppercase; color: #6b7280; font-weight: 700;">Jumlah Tablet</th>
                    <th style="padding: 12px 16px; font-size: 0.75rem; text-transform: uppercase; color: #6b7280; font-weight: 700;">Kadar Hb (gr/dl)</th>
                    <th style="padding: 12px 16px; font-size: 0.75rem; text-transform: uppercase; color: #6b7280; font-weight: 700;">Efek Samping</th>
                    <th style="padding: 12px 16px; font-size: 0.75rem; text-transform: uppercase; color: #6b7280; font-weight: 700;">Catatan</th>
                </tr>
            </thead>
            <tbody>
                @forelse($warga->kontrolTtd as $ttd)
                <tr style="border-bottom: 1px solid #f3f4f6;">
                    <td style="padding: 12px 16px; font-weight: 600; color: #1f2937;">
                        {{ \Carbon\Carbon::parse($ttd->tanggal_konsumsi)->translatedFormat('d M Y') }}
                    </td>
                    <td style="padding: 12px 16px;">
                        <span class="tag tag-success" style="font-weight: 700;">{{ $ttd->jumlah_tablet }} Tablet</span>
                    </td>
                    <td style="padding: 12px 16px;">
                        @if($ttd->kadar_hb)
                            <span class="tag {{ $ttd->status_anemia ? 'tag-danger' : 'tag-success' }}" style="font-weight: 700;">
                                {{ $ttd->kadar_hb }} gr/dl {{ $ttd->status_anemia ? '(Anemia)' : '(Normal)' }}
                            </span>
                        @else
                            <span style="color: #9ca3af;">-</span>
                        @endif
                    </td>
                    <td style="padding: 12px 16px; font-size: 0.825rem; color: #4b5563;">
                        {{ $ttd->efek_samping ?? 'Tidak Ada' }}
                    </td>
                    <td style="padding: 12px 16px; font-size: 0.8rem; color: #6b7280;">
                        {{ $ttd->catatan ?? '-' }}
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" style="padding: 2.5rem; text-align: center; color: #9ca3af;">
                        <i class="fa-solid fa-pills" style="font-size: 1.8rem; margin-bottom: 6px; color: #cbd5e1;"></i>
                        <div>Belum ada catatan kepatuhan konsumsi TTD untuk sasaran ini.</div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endif

<!-- ========================================================================= -->
<!-- TAB 5: Riwayat Kunjungan Rumah (Home Visit ILP)                           -->
<!-- ========================================================================= -->
<div id="kunjunganTabContent" style="display: none;">
    <div class="card" style="padding: 0; overflow: hidden; border-radius: 16px; border: 1px solid #ebe6dd;">
        <table class="table" style="margin: 0; width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="background: #faf8f5; border-bottom: 1px solid #ede8de;">
                    <th style="padding: 12px 16px; font-size: 0.75rem; text-transform: uppercase; color: #6b7280; font-weight: 700;">Tanggal</th>
                    <th style="padding: 12px 16px; font-size: 0.75rem; text-transform: uppercase; color: #6b7280; font-weight: 700;">Kategori Sasaran</th>
                    <th style="padding: 12px 16px; font-size: 0.75rem; text-transform: uppercase; color: #6b7280; font-weight: 700;">Tanda Bahaya</th>
                    <th style="padding: 12px 16px; font-size: 0.75rem; text-transform: uppercase; color: #6b7280; font-weight: 700;">Tindak Lanjut</th>
                    <th style="padding: 12px 16px; font-size: 0.75rem; text-transform: uppercase; color: #6b7280; font-weight: 700;">Catatan</th>
                </tr>
            </thead>
            <tbody>
                @forelse($warga->kunjunganRumah as $kunj)
                <tr style="border-bottom: 1px solid #f3f4f6;">
                    <td style="padding: 12px 16px; font-weight: 600; color: #1f2937;">
                        {{ \Carbon\Carbon::parse($kunj->tanggal)->translatedFormat('d M Y') }}
                    </td>
                    <td style="padding: 12px 16px;">
                        <span class="tag tag-neutral">{{ $kunj->kategori_sasaran }}</span>
                    </td>
                    <td style="padding: 12px 16px;">
                        @if($kunj->tanda_bahaya_ditemukan)
                            <span class="tag tag-danger" style="font-weight: 700;">Ditemukan</span>
                        @else
                            <span class="tag tag-success">Tidak Ada</span>
                        @endif
                    </td>
                    <td style="padding: 12px 16px;">
                        <span class="tag {{ str_contains($kunj->status_tindak_lanjut, 'Rujuk') ? 'tag-warning' : 'tag-info' }}">
                            {{ $kunj->status_tindak_lanjut }}
                        </span>
                    </td>
                    <td style="padding: 12px 16px; font-size: 0.8rem; color: #6b7280;">
                        {{ $kunj->catatan ?? '-' }}
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" style="padding: 2.5rem; text-align: center; color: #9ca3af;">
                        <i class="fa-solid fa-house-chimney" style="font-size: 1.8rem; margin-bottom: 6px; color: #cbd5e1;"></i>
                        <div>Belum ada riwayat kunjungan rumah untuk warga ini.</div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- ========================================================================= -->
<!-- MODAL: Input Evaluasi KKA (7 Aspek Kemenkes)                             -->
<!-- ========================================================================= -->
@if($warga->status === 'Balita')
<div class="modal-overlay" id="inputKkaModal">
    <div class="modal-box modal-md" style="max-width: 560px;">
        <div class="modal-header">
            <div>
                <h3 class="serif" style="font-size: 1.25rem; margin: 0; color: #1f2937; display: flex; align-items: center; gap: 8px;">
                    <i class="fa-solid fa-clipboard-check text-primary"></i>
                    Formulir Evaluasi 7 Aspek KKA
                </h3>
                <div style="font-size: 0.8rem; color: #6b7280; margin-top: 2px;">
                    Pemantauan tumbuh kembang balita sesuai standar Kemenkes RI.
                </div>
            </div>
            <button type="button" class="modal-close-btn" onclick="closeModal('inputKkaModal')" aria-label="Tutup">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>

        <form action="{{ route('admin.kka.store') }}" method="POST">
            @csrf
            <input type="hidden" name="NIK" value="{{ $warga->NIK }}">

            <div class="form-row mb-3" style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px;">
                <div class="form-group">
                    <label class="form-label">Tanggal Pemeriksaan <span class="text-danger">*</span></label>
                    <input type="date" name="tanggal_pemeriksaan" value="{{ now()->toDateString() }}" class="form-control" required style="border-radius: 12px;">
                </div>
                <div class="form-group">
                    <label class="form-label">Usia saat Evaluasi (Bulan) <span class="text-danger">*</span></label>
                    <input type="number" name="usia_bulan" value="{{ \Carbon\Carbon::parse($warga->tanggal_lahir)->diffInMonths(now()) }}" class="form-control" min="0" max="72" required style="border-radius: 12px;">
                </div>
            </div>

            <!-- 7 Aspek Perkembangan Kemenkes -->
            <div style="background: #faf8f5; border: 1px solid #ebe6dd; border-radius: 14px; padding: 14px 16px; margin-bottom: 1.25rem;">
                <div style="font-weight: 700; font-size: 0.85rem; color: #1f2937; margin-bottom: 10px; display: flex; align-items: center; gap: 6px;">
                    <i class="fa-solid fa-list-check text-primary"></i> Tandai aspek yang TELAH TERCAPAI oleh balita:
                </div>
                <div style="display: flex; flex-direction: column; gap: 8px; font-size: 0.825rem; color: #374151;">
                    <label style="display: flex; align-items: center; gap: 10px; cursor: pointer; padding: 6px 8px; border-radius: 8px; transition: background 0.15s ease;">
                        <input type="checkbox" name="gerak_kasar" value="1" checked style="width: 17px; height: 17px; accent-color: #2d6a4f;">
                        <span>1. <strong>Gerak Kasar</strong> (berdiri, berjalan, melompat bebas)</span>
                    </label>
                    <label style="display: flex; align-items: center; gap: 10px; cursor: pointer; padding: 6px 8px; border-radius: 8px; transition: background 0.15s ease;">
                        <input type="checkbox" name="gerak_halus" value="1" checked style="width: 17px; height: 17px; accent-color: #2d6a4f;">
                        <span>2. <strong>Gerak Halus</strong> (menjepit, memegang sendok/pensil, balok)</span>
                    </label>
                    <label style="display: flex; align-items: center; gap: 10px; cursor: pointer; padding: 6px 8px; border-radius: 8px; transition: background 0.15s ease;">
                        <input type="checkbox" name="komunikasi_pasif" value="1" checked style="width: 17px; height: 17px; accent-color: #2d6a4f;">
                        <span>3. <strong>Komunikasi Pasif</strong> (mengerti instruksi, menoleh respon nama)</span>
                    </label>
                    <label style="display: flex; align-items: center; gap: 10px; cursor: pointer; padding: 6px 8px; border-radius: 8px; transition: background 0.15s ease;">
                        <input type="checkbox" name="komunikasi_aktif" value="1" checked style="width: 17px; height: 17px; accent-color: #2d6a4f;">
                        <span>4. <strong>Komunikasi Aktif</strong> (mengucapkan kata, bertanya, bercerita)</span>
                    </label>
                    <label style="display: flex; align-items: center; gap: 10px; cursor: pointer; padding: 6px 8px; border-radius: 8px; transition: background 0.15s ease;">
                        <input type="checkbox" name="kecerdasan" value="1" checked style="width: 17px; height: 17px; accent-color: #2d6a4f;">
                        <span>5. <strong>Kecerdasan</strong> (mengenal warna, bentuk, hitung sederhana)</span>
                    </label>
                    <label style="display: flex; align-items: center; gap: 10px; cursor: pointer; padding: 6px 8px; border-radius: 8px; transition: background 0.15s ease;">
                        <input type="checkbox" name="menolong_diri_sendiri" value="1" checked style="width: 17px; height: 17px; accent-color: #2d6a4f;">
                        <span>6. <strong>Menolong Diri Sendiri</strong> (makan sendiri, pakai baju, toilet)</span>
                    </label>
                    <label style="display: flex; align-items: center; gap: 10px; cursor: pointer; padding: 6px 8px; border-radius: 8px; transition: background 0.15s ease;">
                        <input type="checkbox" name="tingkah_laku_sosial" value="1" checked style="width: 17px; height: 17px; accent-color: #2d6a4f;">
                        <span>7. <strong>Tingkah Laku Sosial</strong> (bermain bersama teman, mandiri, patuh)</span>
                    </label>
                </div>
            </div>

            <div class="form-group mb-4">
                <label class="form-label">Catatan Tambahan Kader / Bidan</label>
                <textarea name="catatan" rows="2" class="form-control" style="border-radius: 12px;" placeholder="Contoh: Stimulasi motorik halus perlu ditingkatkan di rumah..."></textarea>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeModal('inputKkaModal')" style="border-radius: 9999px; padding: 8px 18px;">Batal</button>
                <button type="submit" class="btn btn-primary" style="background: #2d6a4f; border-radius: 9999px; padding: 8px 20px;">
                    <i class="fa-solid fa-floppy-disk" style="margin-right: 4px;"></i> Simpan Evaluasi KKA
                </button>
            </div>
        </form>
    </div>
</div>
@endif

<!-- ========================================================================= -->
<!-- MODAL: Input Konsumsi Tablet Tambah Darah (TTD)                           -->
<!-- ========================================================================= -->
@if(in_array($warga->status, ['Ibu Hamil', 'Remaja']))
<div class="modal-overlay" id="inputTtdModal">
    <div class="modal-box modal-md" style="max-width: 520px;">
        <div class="modal-header">
            <div>
                <h3 class="serif" style="font-size: 1.25rem; margin: 0; color: #1f2937; display: flex; align-items: center; gap: 8px;">
                    <i class="fa-solid fa-pills text-primary"></i>
                    Catat Konsumsi TTD (Tablet Tambah Darah)
                </h3>
                <div style="font-size: 0.8rem; color: #6b7280; margin-top: 2px;">
                    Pencegahan anemia untuk sasaran {{ $warga->status === 'Ibu Hamil' ? 'Ibu Hamil' : 'Remaja Putri' }}.
                </div>
            </div>
            <button type="button" class="modal-close-btn" onclick="closeModal('inputTtdModal')" aria-label="Tutup">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>

        <form action="{{ route('admin.kontrol-ttd.store') }}" method="POST">
            @csrf
            <input type="hidden" name="NIK" value="{{ $warga->NIK }}">
            <input type="hidden" name="status_sasaran" value="{{ $warga->status === 'Ibu Hamil' ? 'Ibu Hamil' : 'Remaja Putri' }}">

            <div class="form-row mb-3" style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px;">
                <div class="form-group">
                    <label class="form-label">Tanggal Minum <span class="text-danger">*</span></label>
                    <input type="date" name="tanggal_konsumsi" value="{{ now()->toDateString() }}" class="form-control" required style="border-radius: 12px;">
                </div>
                <div class="form-group">
                    <label class="form-label">Jumlah Tablet Diminum <span class="text-danger">*</span></label>
                    <input type="number" name="jumlah_tablet" value="1" min="1" max="10" class="form-control" required style="border-radius: 12px;">
                </div>
            </div>

            <div class="form-row mb-3" style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px;">
                <div class="form-group">
                    <label class="form-label">Kadar Hb (Opsional)</label>
                    <input type="number" step="0.1" name="kadar_hb" class="form-control" placeholder="Contoh: 12.5 (gr/dl)" style="border-radius: 12px;">
                </div>
                <div class="form-group">
                    <label class="form-label">Keluhan Efek Samping</label>
                    <select name="efek_samping" class="form-control" style="border-radius: 12px;">
                        <option value="Tidak Ada">Tidak Ada Keluhan</option>
                        <option value="Mual">Mual Ringan</option>
                        <option value="Konstipasi">Sembelit / Konstipasi</option>
                        <option value="Tinja Gelap">Tinja Berwarna Gelap</option>
                    </select>
                </div>
            </div>

            <div class="form-group mb-4">
                <label class="form-label">Catatan Tambahan</label>
                <input type="text" name="catatan" class="form-control" placeholder="Diminum bersama air putih / jus jeruk..." style="border-radius: 12px;">
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeModal('inputTtdModal')" style="border-radius: 9999px; padding: 8px 18px;">Batal</button>
                <button type="submit" class="btn btn-primary" style="background: #2d6a4f; border-radius: 9999px; padding: 8px 20px;">
                    <i class="fa-solid fa-floppy-disk" style="margin-right: 4px;"></i> Simpan Data TTD
                </button>
            </div>
        </form>
    </div>
</div>
@endif

<script>
    // Interaktivitas Penggantian Tab
    const tabBtns = document.querySelectorAll('.tab-btn');
    const tabContents = {
        'health': document.getElementById('healthTabContent'),
        'growth': document.getElementById('growthChart') ? document.getElementById('growthTabContent') : null,
        'kka': document.getElementById('kkaTabContent'),
        'ttd': document.getElementById('ttdTabContent'),
        'kunjungan': document.getElementById('kunjunganTabContent')
    };

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

            const targetTab = btn.dataset.tab;
            Object.keys(tabContents).forEach(key => {
                if (tabContents[key]) {
                    tabContents[key].style.display = (key === targetTab) ? 'block' : 'none';
                }
            });

            if (targetTab === 'growth') {
                initGrowthChart();
            }
        });
    });

    let chartInitialized = false;
    function initGrowthChart() {
        if (chartInitialized) return;
        const canvas = document.getElementById('growthChart');
        if (!canvas) return;
        const ctx = canvas.getContext('2d');
        
        const isPrematur = {{ $warga->is_prematur ? 'true' : 'false' }};
        const mainLabel = isPrematur 
            ? "BB {{ $warga->nama_lengkap }} (Usia Koreksi Kurva Fenton)" 
            : "Berat Badan {{ $warga->nama_lengkap }} (kg)";
        const benchmarkLabel = isPrematur 
            ? "Median Standar Kurva Fenton (kg)" 
            : "Median Standar WHO (kg)";

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['0 Bln', '3 Bln', '6 Bln', '9 Bln', '12 Bln', '15 Bln', '18 Bln', '21 Bln', '24 Bln'],
                datasets: [
                    {
                        label: mainLabel,
                        data: isPrematur ? [2.1, 4.6, 6.7, 8.0, 9.1, 10.0, 10.8, 11.5, 12.2] : [3.2, 5.8, 7.5, 8.8, 9.6, 10.5, 11.2, 12.4, 13.1],
                        borderColor: '#2d6a4f',
                        backgroundColor: 'rgba(45, 106, 79, 0.1)',
                        fill: true,
                        tension: 0.35,
                        borderWidth: 3,
                        pointBackgroundColor: '#2d6a4f',
                        pointRadius: 4
                    },
                    {
                        label: benchmarkLabel,
                        data: isPrematur ? [2.2, 4.8, 7.0, 8.3, 9.4, 10.3, 11.1, 11.8, 12.5] : [3.3, 6.4, 7.9, 9.2, 10.2, 11.0, 11.8, 12.5, 13.2],
                        borderColor: isPrematur ? '#d97706' : '#9ca3af',
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
                        title: { display: true, text: 'Kelompok Usia' + (isPrematur ? ' (Terkoreksi)' : ''), font: { family: 'Inter', size: 12 } }
                    }
                }
            }
        });
        chartInitialized = true;
    }
</script>
@endsection
