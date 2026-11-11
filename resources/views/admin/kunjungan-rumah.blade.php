@extends('layouts.admin')

@section('title', 'Kunjungan Rumah (Home Visit ILP) — e-Posyandu')
@section('breadcrumbs', 'Beranda > Kunjungan Rumah')
@section('page_title', 'Kunjungan Rumah')

@section('content')
<p style="font-size: 0.88rem; color: #6b7280; margin-bottom: 1.5rem; margin-top: -0.25rem;">
    Layanan integrasi pelayanan primer (ILP) melalui kunjungan rumah oleh kader untuk pemantauan sasaran berisiko (Bumil KEK, Balita Stunting, Remaja Anemia, dan Lansia PTM).
</p>

<!-- 1. Statistik Ringkasan Kunjungan Rumah -->
<div class="stats-grid" style="grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 16px; margin-bottom: 2rem;">
    <div class="card stat-card">
        <div class="stat-icon-wrapper" style="background: rgba(45, 106, 79, 0.1); color: #2d6a4f;">
            <i class="fa-solid fa-house-chimney-user"></i>
        </div>
        <div>
            <div class="stat-label">Total Kunjungan</div>
            <div class="stat-value">{{ $stats['total'] }}</div>
            <div style="font-size: 0.725rem; color: #6b7280; margin-top: 4px;">Kunjungan Terlaksana</div>
        </div>
    </div>

    <div class="card stat-card">
        <div class="stat-icon-wrapper" style="background: rgba(217, 119, 6, 0.1); color: #d97706;">
            <i class="fa-solid fa-person-pregnant"></i>
        </div>
        <div>
            <div class="stat-label">Bumil KEK / Resti</div>
            <div class="stat-value">{{ $stats['bumil'] }}</div>
            <div style="font-size: 0.725rem; color: #6b7280; margin-top: 4px;">Pemantauan Maternal</div>
        </div>
    </div>

    <div class="card stat-card">
        <div class="stat-icon-wrapper" style="background: rgba(13, 148, 136, 0.1); color: #0d9488;">
            <i class="fa-solid fa-baby"></i>
        </div>
        <div>
            <div class="stat-label">Balita Masalah Gizi</div>
            <div class="stat-value">{{ $stats['balita'] }}</div>
            <div style="font-size: 0.725rem; color: #6b7280; margin-top: 4px;">Deteksi Dini Stunting</div>
        </div>
    </div>

    <div class="card stat-card">
        <div class="stat-icon-wrapper" style="background: rgba(220, 38, 38, 0.1); color: #dc2626;">
            <i class="fa-solid fa-triangle-exclamation"></i>
        </div>
        <div>
            <div class="stat-label">Tanda Bahaya</div>
            <div class="stat-value" style="color: #dc2626;">{{ $stats['tanda_bahaya'] }}</div>
            <div style="font-size: 0.725rem; color: #dc2626; margin-top: 4px; font-weight: 600;">Perlu Intervensi Segera</div>
        </div>
    </div>

    <div class="card stat-card">
        <div class="stat-icon-wrapper" style="background: rgba(79, 70, 229, 0.1); color: #4f46e5;">
            <i class="fa-solid fa-truck-medical"></i>
        </div>
        <div>
            <div class="stat-label">Rujukan Puskesmas</div>
            <div class="stat-value">{{ $stats['rujukan'] }}</div>
            <div style="font-size: 0.725rem; color: #6b7280; margin-top: 4px;">Tindak Lanjut Medis</div>
        </div>
    </div>
</div>

<!-- 2. Baris Aksi & Filter -->
<div style="display: flex; justify-content: space-between; align-items: center; gap: 16px; margin-bottom: 1.5rem; flex-wrap: wrap;">
    <!-- Filter Kategori -->
    <div style="display: flex; gap: 8px; flex-wrap: wrap; align-items: center;">
        <span style="font-size: 0.8rem; font-weight: 600; color: #4b5563;">Filter:</span>
        @php
            $currentKategori = request('kategori', 'Semua');
            $filters = ['Semua', 'Bumil KEK / Resti', 'Balita Masalah Gizi', 'Remaja Anemia', 'Lansia PTM'];
        @endphp
        @foreach($filters as $f)
            @php $isActive = $currentKategori === $f; @endphp
            <a href="{{ route('admin.kunjungan-rumah', array_merge(request()->except('page'), ['kategori' => $f])) }}"
               class="btn {{ $isActive ? 'btn-primary' : 'btn-secondary' }}"
               style="border-radius: 9999px; padding: 5px 14px; font-size: 0.8rem; font-weight: 600; {{ $isActive ? 'background: #2d6a4f; color: #fff;' : 'background: #fff; color: #4b5563;' }}">
                {{ $f }}
            </a>
        @endforeach
    </div>

    <!-- Tombol Aksi Tambah & Integrasi ASIK WA -->
    <div style="display: flex; gap: 10px; flex-wrap: wrap;">
        <button type="button" class="btn btn-secondary" onclick="openModal('asikModal')" style="border-radius: 9999px; font-size: 0.825rem; border-color: #25d366; color: #128c7e;">
            <i class="fa-brands fa-whatsapp" style="font-size: 0.95rem; margin-right: 4px; color: #25d366;"></i>
            <span>Format Chatbot WA ASIK</span>
        </button>
        <button type="button" class="btn btn-primary" onclick="openModal('kunjunganModal')" style="border-radius: 9999px; font-size: 0.825rem; background: #2d6a4f;">
            <i class="fa-solid fa-plus" style="margin-right: 4px;"></i>
            <span>Catat Kunjungan Rumah</span>
        </button>
    </div>
</div>

<!-- 3. Tabel Riwayat Kunjungan Rumah -->
<div class="card" style="padding: 0; overflow: hidden; border-radius: 16px; border: 1px solid #ebe6dd;">
    <div style="overflow-x: auto;">
        <table class="table" style="margin: 0; width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="background: #faf8f5; border-bottom: 1px solid #ede8de;">
                    <th style="padding: 14px 16px; font-size: 0.75rem; text-transform: uppercase; color: #6b7280; font-weight: 700;">Tanggal & Kader</th>
                    <th style="padding: 14px 16px; font-size: 0.75rem; text-transform: uppercase; color: #6b7280; font-weight: 700;">Sasaran Warga</th>
                    <th style="padding: 14px 16px; font-size: 0.75rem; text-transform: uppercase; color: #6b7280; font-weight: 700;">Kategori Sasaran</th>
                    <th style="padding: 14px 16px; font-size: 0.75rem; text-transform: uppercase; color: #6b7280; font-weight: 700;">Status Tanda Bahaya</th>
                    <th style="padding: 14px 16px; font-size: 0.75rem; text-transform: uppercase; color: #6b7280; font-weight: 700;">Tindak Lanjut ILP</th>
                    <th style="padding: 14px 16px; font-size: 0.75rem; text-transform: uppercase; color: #6b7280; font-weight: 700; text-align: right;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($kunjunganList as $item)
                <tr style="border-bottom: 1px solid #f3f4f6;">
                    <td style="padding: 14px 16px;">
                        <div style="font-weight: 700; font-size: 0.88rem; color: #1f2937;">
                            {{ \Carbon\Carbon::parse($item->tanggal)->translatedFormat('d M Y') }}
                        </div>
                        <div style="font-size: 0.75rem; color: #9ca3af; margin-top: 2px;">
                            <i class="fa-solid fa-user-tag" style="margin-right: 3px;"></i> {{ $item->kader->nama_kader ?? 'Kader Posko' }}
                        </div>
                    </td>
                    <td style="padding: 14px 16px;">
                        @if($item->warga)
                            <a href="{{ route('admin.profil', ['nik' => $item->warga->NIK]) }}" style="font-weight: 700; font-size: 0.88rem; color: #2d6a4f; text-decoration: none;">
                                {{ $item->warga->nama_lengkap }}
                            </a>
                            <div style="font-size: 0.75rem; color: #9ca3af; font-family: monospace; margin-top: 2px;">
                                {{ $item->warga->NIK }}
                            </div>
                        @else
                            <span style="color: #9ca3af;">-</span>
                        @endif
                    </td>
                    <td style="padding: 14px 16px;">
                        <span class="tag tag-neutral" style="font-size: 0.75rem; font-weight: 600;">
                            {{ $item->kategori_sasaran }}
                        </span>
                    </td>
                    <td style="padding: 14px 16px;">
                        @if($item->tanda_bahaya_ditemukan)
                            <span class="tag tag-danger" style="font-size: 0.725rem; font-weight: 700;">
                                <i class="fa-solid fa-triangle-exclamation"></i> Ada Tanda Bahaya
                            </span>
                        @else
                            <span class="tag tag-success" style="font-size: 0.725rem; font-weight: 600;">
                                <i class="fa-solid fa-circle-check"></i> Tidak Ada
                            </span>
                        @endif
                    </td>
                    <td style="padding: 14px 16px;">
                        @php
                            $badgeClass = str_contains($item->status_tindak_lanjut, 'Rujuk') ? 'tag-warning' : 'tag-info';
                        @endphp
                        <span class="tag {{ $badgeClass }}" style="font-size: 0.75rem; font-weight: 600;">
                            {{ $item->status_tindak_lanjut }}
                        </span>
                        @if(!empty($item->catatan))
                            <div style="font-size: 0.75rem; color: #6b7280; margin-top: 4px; max-width: 250px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                {{ $item->catatan }}
                            </div>
                        @endif
                    </td>
                    <td style="padding: 14px 16px; text-align: right;">
                        <button type="button" class="btn btn-secondary btn-sm" onclick="showDetailKunjungan({{ json_encode($item) }})" style="border-radius: 9999px; font-size: 0.75rem; padding: 4px 10px;">
                            <i class="fa-solid fa-eye"></i> Detail
                        </button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="padding: 3rem; text-align: center; color: #9ca3af;">
                        <div style="font-size: 2rem; color: #d1d5db; margin-bottom: 0.5rem;">
                            <i class="fa-solid fa-house-chimney-crack"></i>
                        </div>
                        <h4 style="font-size: 1rem; color: #4b5563; margin-bottom: 4px;">Belum Ada Data Kunjungan Rumah</h4>
                        <p style="font-size: 0.8rem; margin: 0;">Gunakan tombol "Catat Kunjungan Rumah" di atas untuk menambahkan laporan ILP.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Paginasi Kunjungan Rumah -->
    @if($kunjunganList->hasPages())
    <div style="padding: 1rem 1.25rem; border-top: 1px solid #ede8de;">
        {{ $kunjunganList->appends(request()->query())->links() }}
    </div>
    @endif
</div>

<!-- Modal 1: Formulir Kunjungan Rumah Baru -->
<div class="modal-overlay" id="kunjunganModal">
    <div class="modal-box modal-lg" style="max-width: 620px;">
        <div class="modal-header">
            <div>
                <h3 class="serif" style="font-size: 1.25rem; margin: 0; color: #1f2937; display: flex; align-items: center; gap: 8px;">
                    <i class="fa-solid fa-house-chimney-medical text-primary"></i>
                    Formulir Kunjungan Rumah (Home Visit ILP)
                </h3>
                <div style="font-size: 0.8rem; color: #6b7280; margin-top: 3px;">
                    Pencatatan pemantauan berkala kondisi kesehatan sasaran di rumah.
                </div>
            </div>
            <button type="button" class="modal-close-btn" onclick="closeModal('kunjunganModal')" aria-label="Tutup">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>

        <form action="{{ route('admin.kunjungan-rumah.store') }}" method="POST">
            @csrf
            <div class="form-group mb-3">
                <label class="form-label">Sasaran Warga <span class="text-danger">*</span></label>
                <select name="NIK" class="form-control" required style="border-radius: 12px; padding: 10px 14px;">
                    <option value="">-- Pilih Warga Sasaran --</option>
                    @foreach($daftarWarga as $w)
                        <option value="{{ $w->NIK }}">{{ $w->nama_lengkap }} ({{ $w->NIK }}) - {{ $w->status }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-row mb-3" style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px;">
                <div class="form-group">
                    <label class="form-label">Tanggal Kunjungan <span class="text-danger">*</span></label>
                    <input type="date" name="tanggal" value="{{ now()->toDateString() }}" class="form-control" required style="border-radius: 12px;">
                </div>
                <div class="form-group">
                    <label class="form-label">Kategori Sasaran <span class="text-danger">*</span></label>
                    <select name="kategori_sasaran" class="form-control" required style="border-radius: 12px;">
                        <option value="Ibu Hamil KEK / Resti">Ibu Hamil KEK / Resti</option>
                        <option value="Balita Masalah Gizi & Stunting">Balita Masalah Gizi & Stunting</option>
                        <option value="Remaja Putri Anemia">Remaja Putri Anemia</option>
                        <option value="Lansia PTM">Lansia PTM</option>
                    </select>
                </div>
            </div>

            <!-- Checklist Standar ILP Kemenkes -->
            <div style="background: #faf8f5; border: 1px solid #ebe6dd; border-radius: 14px; padding: 14px 16px; margin-bottom: 1.25rem;">
                <div style="font-weight: 700; font-size: 0.85rem; color: #1f2937; margin-bottom: 10px; display: flex; align-items: center; gap: 6px;">
                    <i class="fa-solid fa-list-check text-primary"></i> Checklist Pemantauan ILP Kemenkes
                </div>
                <div style="display: flex; flex-direction: column; gap: 9px; font-size: 0.825rem; color: #374151;">
                    <label style="display: flex; align-items: center; gap: 10px; cursor: pointer; padding: 6px 8px; border-radius: 8px; transition: background 0.15s ease;">
                        <input type="checkbox" name="checklist[]" value="Sanitasi & Air Bersih Layak" checked style="width: 17px; height: 17px; accent-color: #2d6a4f;">
                        <span>Sanitasi lingkungan dan ketersediaan air bersih layak</span>
                    </label>
                    <label style="display: flex; align-items: center; gap: 10px; cursor: pointer; padding: 6px 8px; border-radius: 8px; transition: background 0.15s ease;">
                        <input type="checkbox" name="checklist[]" value="Pola Makan Sesuai Isi Piringku" checked style="width: 17px; height: 17px; accent-color: #2d6a4f;">
                        <span>Pola asupan gizi seimbang sesuai prinsip "Isi Piringku"</span>
                    </label>
                    <label style="display: flex; align-items: center; gap: 10px; cursor: pointer; padding: 6px 8px; border-radius: 8px; transition: background 0.15s ease;">
                        <input type="checkbox" name="checklist[]" value="Kepatuhan Minum Suplemen / TTD / Obat" checked style="width: 17px; height: 17px; accent-color: #2d6a4f;">
                        <span>Kepatuhan konsumsi TTD, Vitamin A, atau obat rutin</span>
                    </label>
                    <label style="display: flex; align-items: center; gap: 10px; cursor: pointer; padding: 6px 8px; border-radius: 8px; transition: background 0.15s ease;">
                        <input type="checkbox" name="checklist[]" value="Kepemilikan & Pengisian Buku KIA/KMS" checked style="width: 17px; height: 17px; accent-color: #2d6a4f;">
                        <span>Buku KIA / KMS digital terisi dan aktif dibawa saat posyandu</span>
                    </label>
                </div>
            </div>

            <!-- Indikator Tanda Bahaya -->
            <div class="form-group mb-3" style="background: #fff5f5; border: 1px solid #fed7d7; border-radius: 12px; padding: 12px 16px;">
                <label style="display: flex; align-items: center; gap: 10px; cursor: pointer; margin: 0; font-weight: 600; color: #c53030; font-size: 0.85rem;">
                    <input type="checkbox" name="tanda_bahaya" value="1" style="width: 18px; height: 18px; accent-color: #dc2626;">
                    <span>Ditemukan Tanda Bahaya / Gejala Kritis (Demam tinggi, perdarahan bumil, sesak, lemas ekstrim)</span>
                </label>
            </div>

            <!-- Status Tindak Lanjut -->
            <div class="form-group mb-3">
                <label class="form-label">Rencana Tindak Lanjut <span class="text-danger">*</span></label>
                <select name="status_tindak_lanjut" class="form-control" required style="border-radius: 12px;">
                    <option value="Edukasi & Pendampingan Rutin">Edukasi & Pendampingan Rutin</option>
                    <option value="Kunjungan Rumah Ulang (1 Minggu)">Kunjungan Rumah Ulang (1 Minggu)</option>
                    <option value="Rujuk ke Puskesmas / Pustu">Rujuk ke Puskesmas / Pustu (Segera)</option>
                </select>
            </div>

            <!-- Catatan Tambahan -->
            <div class="form-group mb-4">
                <label class="form-label">Catatan Tambahan Kader</label>
                <textarea name="catatan" rows="3" class="form-control" style="border-radius: 12px;" placeholder="Tuliskan temuan kondisi keluarga, respon warga, atau rekomendasi makanan..."></textarea>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeModal('kunjunganModal')" style="border-radius: 9999px; padding: 8px 18px;">Batal</button>
                <button type="submit" class="btn btn-primary" style="background: #2d6a4f; border-radius: 9999px; padding: 8px 20px;">
                    <i class="fa-solid fa-floppy-disk" style="margin-right: 4px;"></i> Simpan Data Kunjungan
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Modal 2: Generator Format Chatbot WhatsApp ASIK Kemenkes -->
<div class="modal-overlay" id="asikModal">
    <div class="modal-box modal-md" style="max-width: 540px;">
        <div class="modal-header">
            <div>
                <h3 class="serif" style="font-size: 1.25rem; margin: 0; color: #1f2937; display: flex; align-items: center; gap: 8px;">
                    <i class="fa-brands fa-whatsapp text-success" style="color: #25d366;"></i>
                    Format Chatbot WhatsApp ASIK
                </h3>
                <div style="font-size: 0.8rem; color: #6b7280; margin-top: 3px;">
                    Format pelaporan ke layanan resmi Chatbot WhatsApp ASIK Kemenkes RI.
                </div>
            </div>
            <button type="button" class="modal-close-btn" onclick="closeModal('asikModal')" aria-label="Tutup">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>

        <p style="font-size: 0.85rem; color: #6b7280; margin-bottom: 1rem; line-height: 1.5;">
            Salin format pesan di bawah ini untuk dikirimkan langsung ke nomor WhatsApp Chatbot ASIK Kemenkes:
        </p>

        <div style="position: relative; margin-bottom: 1.25rem;">
            <textarea id="asikTextTemplate" rows="8" readonly class="form-control" style="font-family: monospace; font-size: 0.825rem; background: #faf8f5; border: 1px solid #e5e7eb; border-radius: 12px; line-height: 1.5; padding: 12px;">#LAPORAN_ILP#
KODE_POSYANDU: POSKO_ANGGREK_01
TANGGAL: {{ now()->format('Y-m-d') }}
TOTAL_KUNJUNGAN: {{ $stats['total'] }}
BUMIL_KEK: {{ $stats['bumil'] }}
BALITA_STUNTING: {{ $stats['balita'] }}
TANDA_BAHAYA: {{ $stats['tanda_bahaya'] }}
RUJUKAN_FASKES: {{ $stats['rujukan'] }}
STATUS: TERVERIFIKASI_KADER</textarea>
        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" onclick="closeModal('asikModal')" style="border-radius: 9999px; padding: 8px 18px;">Tutup</button>
            <button type="button" class="btn btn-primary" onclick="copyAsikText()" style="background: #128c7e; border-color: #128c7e; border-radius: 9999px; padding: 8px 20px;">
                <i class="fa-solid fa-copy" style="margin-right: 4px;"></i>
                <span id="copyBtnText">Salin Teks ke Clipboard</span>
            </button>
        </div>
    </div>
</div>

<!-- Modal 3: Rincian Detail Kunjungan Rumah (Modern Popup Menggantikan alert) -->
<div class="modal-overlay" id="detailKunjunganModal">
    <div class="modal-box modal-md" style="max-width: 540px;">
        <div class="modal-header">
            <div>
                <h3 class="serif" style="font-size: 1.25rem; margin: 0; color: #1f2937; display: flex; align-items: center; gap: 8px;">
                    <i class="fa-solid fa-house-chimney-user text-primary"></i>
                    Rincian Kunjungan Rumah ILP
                </h3>
                <div style="font-size: 0.8rem; color: #6b7280; margin-top: 3px;" id="detailTanggalKader">
                    Tanggal & Petugas Lapangan
                </div>
            </div>
            <button type="button" class="modal-close-btn" onclick="closeModal('detailKunjunganModal')" aria-label="Tutup">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>

        <div style="display: flex; flex-direction: column; gap: 14px;">
            <!-- Profil Singkat Sasaran -->
            <div style="display: flex; align-items: center; justify-content: space-between; padding: 12px 14px; background: #faf8f5; border: 1px solid #ede8de; border-radius: 14px;">
                <div>
                    <div style="font-weight: 700; font-size: 0.95rem; color: #1f2937;" id="detailNamaWarga">-</div>
                    <div style="font-size: 0.75rem; color: #6b7280; font-family: monospace; margin-top: 2px;" id="detailNikWarga">-</div>
                </div>
                <span class="tag tag-neutral" id="detailKategoriBadge" style="font-weight: 600;">-</span>
            </div>

            <!-- Tanda Bahaya & Tindak Lanjut Grid -->
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px;">
                <div style="padding: 12px; background: #ffffff; border: 1px solid #e5e7eb; border-radius: 12px;">
                    <div style="font-size: 0.7rem; color: #9ca3af; text-transform: uppercase; font-weight: 700;">Status Tanda Bahaya</div>
                    <div style="margin-top: 6px;" id="detailTandaBahayaTag">-</div>
                </div>
                <div style="padding: 12px; background: #ffffff; border: 1px solid #e5e7eb; border-radius: 12px;">
                    <div style="font-size: 0.7rem; color: #9ca3af; text-transform: uppercase; font-weight: 700;">Rencana Tindak Lanjut</div>
                    <div style="font-weight: 600; font-size: 0.85rem; color: #1f2937; margin-top: 6px;" id="detailTindakLanjutText">-</div>
                </div>
            </div>

            <!-- Checklist Temuan ILP -->
            <div style="background: #ffffff; border: 1px solid #e5e7eb; border-radius: 14px; padding: 14px;">
                <div style="font-size: 0.75rem; font-weight: 700; color: #374151; text-transform: uppercase; margin-bottom: 8px; letter-spacing: 0.05em;">
                    Checklist Pemantauan Terpenuhi:
                </div>
                <div id="detailChecklistList" style="display: flex; flex-direction: column; gap: 6px; font-size: 0.825rem; color: #4b5563;">
                    <!-- Diisi dinamis lewat JS -->
                </div>
            </div>

            <!-- Catatan Evaluasi Kader -->
            <div style="background: #faf8f5; border: 1px solid #ede8de; border-radius: 14px; padding: 14px;">
                <div style="font-size: 0.75rem; font-weight: 700; color: #2d6a4f; text-transform: uppercase; margin-bottom: 4px;">
                    Catatan Evaluasi Kader:
                </div>
                <div style="font-size: 0.85rem; color: #374151; line-height: 1.5;" id="detailCatatanText">-</div>
            </div>
        </div>

        <div class="modal-footer" style="justify-content: space-between;">
            <button type="button" class="btn btn-secondary" onclick="closeModal('detailKunjunganModal')" style="border-radius: 9999px; padding: 8px 18px;">Tutup</button>
            <a href="#" id="detailProfilLink" class="btn btn-primary" style="background: #2d6a4f; border-radius: 9999px; padding: 8px 20px;">
                <i class="fa-solid fa-user-circle" style="margin-right: 4px;"></i>
                <span>Buka Rekam Medis</span>
            </a>
        </div>
    </div>
</div>

<script>
function copyAsikText() {
    const copyText = document.getElementById("asikTextTemplate");
    copyText.select();
    copyText.setSelectionRange(0, 99999);
    navigator.clipboard.writeText(copyText.value).then(function() {
        const btn = document.getElementById("copyBtnText");
        btn.innerText = "Tersalin!";
        setTimeout(() => { btn.innerText = "Salin Teks ke Clipboard"; }, 2000);
    });
}

function showDetailKunjungan(data) {
    document.getElementById("detailTanggalKader").innerText = data.tanggal + " • Petugas: " + (data.kader ? data.kader.nama_kader : 'Kader Posko');
    document.getElementById("detailNamaWarga").innerText = data.warga ? data.warga.nama_lengkap : 'Warga';
    document.getElementById("detailNikWarga").innerText = data.warga ? "NIK: " + data.warga.NIK : '';
    document.getElementById("detailKategoriBadge").innerText = data.kategori_sasaran || '-';

    // Tanda Bahaya Tag
    const tbTag = document.getElementById("detailTandaBahayaTag");
    if (data.tanda_bahaya_ditemukan) {
        tbTag.innerHTML = '<span class="tag tag-danger" style="font-weight:700;"><i class="fa-solid fa-triangle-exclamation"></i> Ada Tanda Bahaya</span>';
    } else {
        tbTag.innerHTML = '<span class="tag tag-success" style="font-weight:600;"><i class="fa-solid fa-circle-check"></i> Tidak Ditemukan</span>';
    }

    document.getElementById("detailTindakLanjutText").innerText = data.status_tindak_lanjut || '-';
    document.getElementById("detailCatatanText").innerText = data.catatan || 'Tidak ada catatan tambahan dari kader.';

    // Checklist Items
    const clContainer = document.getElementById("detailChecklistList");
    clContainer.innerHTML = '';
    let items = Array.isArray(data.checklist_hasil) ? data.checklist_hasil : [];
    if (items.length > 0) {
        items.forEach(function(item) {
            const row = document.createElement("div");
            row.style.display = "flex";
            row.style.alignItems = "center";
            row.style.gap = "8px";
            row.innerHTML = '<i class="fa-solid fa-circle-check text-primary" style="font-size:0.85rem; color:#2d6a4f;"></i> <span>' + item + '</span>';
            clContainer.appendChild(row);
        });
    } else {
        clContainer.innerHTML = '<span style="color:#9ca3af;">Tidak ada checklist tercatat.</span>';
    }

    // Profil Link
    const linkBtn = document.getElementById("detailProfilLink");
    if (data.warga) {
        linkBtn.href = "/admin/profil/" + data.warga.NIK;
        linkBtn.style.display = "inline-flex";
    } else {
        linkBtn.style.display = "none";
    }

    openModal('detailKunjunganModal');
}
</script>
@endsection

