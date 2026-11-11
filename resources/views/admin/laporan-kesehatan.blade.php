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

<!-- 1. Baris Filter Periode & Integrasi Chatbot ASIK -->
<div style="display: flex; justify-content: space-between; align-items: center; gap: 12px; margin-bottom: 2rem; flex-wrap: wrap;">
    <button type="button" class="btn btn-secondary" onclick="openModal('asikLaporanModal')" style="border-radius: 9999px; border-color: #25d366; color: #128c7e; font-size: 0.825rem;">
        <i class="fa-brands fa-whatsapp" style="color: #25d366; font-size: 0.95rem; margin-right: 4px;"></i>
        <span>Ekspor Chatbot WA ASIK Kemenkes</span>
    </button>

    <div style="display: flex; gap: 10px; align-items: center; flex-wrap: wrap;">
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

<!-- Modal Chatbot WhatsApp ASIK Kemenkes -->
<div class="modal-overlay" id="asikLaporanModal">
    <div class="modal-box modal-md" style="max-width: 540px;">
        <div class="modal-header">
            <div>
                <h3 class="serif" style="font-size: 1.25rem; margin: 0; color: #1f2937; display: flex; align-items: center; gap: 8px;">
                    <i class="fa-brands fa-whatsapp text-success" style="color: #25d366;"></i>
                    Format Chatbot WhatsApp ASIK
                </h3>
                <div style="font-size: 0.8rem; color: #6b7280; margin-top: 2px;">
                    Format rekapitulasi data bulanan untuk pelaporan Kemenkes RI.
                </div>
            </div>
            <button type="button" class="modal-close-btn" onclick="closeModal('asikLaporanModal')" aria-label="Tutup">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>

        <p style="font-size: 0.85rem; color: #6b7280; margin-bottom: 1rem; line-height: 1.5;">
            Format data agregat Posyandu siap kirim ke Chatbot WA ASIK Kemenkes untuk rekapitulasi capaian bulanan:
        </p>

        <div style="margin-bottom: 1.25rem;">
            <textarea id="asikLaporanText" rows="9" readonly class="form-control" style="font-family: monospace; font-size: 0.825rem; background: #faf8f5; border: 1px solid #e5e7eb; border-radius: 12px; line-height: 1.5; padding: 12px;">#REKAP_POSYANDU_BULANAN#
POSKO: POS_ANGGREK_RW01
PERIODE: {{ now()->translatedFormat('F Y') }}
TOTAL_SASARAN: 13
KUNJUNGAN_BALITA: 42
BALITA_T_NAIK: 38
BALITA_BGM_STUNTING: 4
ANC_BUMIL_TERPERIKSA: 12
BUMIL_KEK: 1
TTD_BUMIL_TERDISTRIBUSI: 85
SKRINING_REMAJA_ANEMIA: 28
LANSIA_POSBINDU_PTM: 35
STATUS_VERIFIKASI: VALID_BIDAN_DESA</textarea>
        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" onclick="closeModal('asikLaporanModal')" style="border-radius: 9999px; padding: 8px 18px;">Tutup</button>
            <button type="button" class="btn btn-primary" onclick="copyAsikLaporan()" style="background: #128c7e; border-color: #128c7e; border-radius: 9999px; padding: 8px 20px;">
                <i class="fa-solid fa-copy" style="margin-right: 4px;"></i>
                <span id="copyLaporanBtnText">Salin Teks Chatbot</span>
            </button>
        </div>
    </div>
</div>

<script>
function copyAsikLaporan() {
    const copyText = document.getElementById("asikLaporanText");
    copyText.select();
    copyText.setSelectionRange(0, 99999);
    navigator.clipboard.writeText(copyText.value).then(function() {
        const btn = document.getElementById("copyLaporanBtnText");
        btn.innerText = "Tersalin!";
        setTimeout(() => { btn.innerText = "Salin Teks Chatbot"; }, 2000);
    });
}
</script>
@endsection
