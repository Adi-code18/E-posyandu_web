{{--
    =============================================================================
    Halaman: Pendaftaran Anggota Baru Posyandu
    =============================================================================
    Fitur:
    - Input kependudukan komprehensif (NIK 16 digit, Nama, Tgl Lahir, Gender)
    - Pilihan kategori sasaran siklus hidup (Balita, Bumil, Remaja, Lansia)
    - Kartu panduan ketentuan registrasi terintegrasi
    - Tombol aksi simpan dan reset responsif
    =============================================================================
--}}
@extends('layouts.admin')

@section('title', 'Pendaftaran Masyarakat — e-Posyandu')
@section('breadcrumbs', 'Beranda > Pendaftaran Masyarakat')
@section('page_title', 'Pendaftaran Masyarakat')

@section('content')
<p style="font-size: 0.88rem; color: #6b7280; margin-bottom: 1.5rem; margin-top: -0.25rem;">
    Daftarkan anggota masyarakat baru untuk memulai pemantauan tumbuh kembang dan riwayat rekam medis posyandu.
</p>

<div class="content-grid">
    <!-- Kolom Formulir Utama -->
    <div class="card">
        <div class="card-title">
            <span><i class="fa-solid fa-id-card text-primary" style="margin-right: 8px;"></i> Formulir Biodata Warga</span>
            <span style="font-size: 0.75rem; color: var(--danger); font-weight: 500;">* Bidang wajib diisi</span>
        </div>
        
        <form action="{{ route('admin.warga.store') }}" method="POST">
            @csrf

            <!-- Nama Lengkap -->
            <div class="form-group">
                <label class="form-label">Nama Lengkap Sasaran <span class="text-danger">*</span></label>
                <input type="text" 
                       name="nama_lengkap" 
                       value="{{ old('nama_lengkap') }}" 
                       class="form-control" 
                       placeholder="Contoh: Muhammad Rizky Pratama" 
                       required>
            </div>

            <!-- NIK & Tanggal Lahir (2 Kolom Responsif) -->
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">NIK (16 Digit Angka) <span class="text-danger">*</span></label>
                    <input type="text" 
                           name="NIK" 
                           value="{{ old('NIK') }}" 
                           class="form-control" 
                           placeholder="3201020304050001" 
                           maxlength="16" 
                           pattern="[0-9]{16}"
                           title="Harap masukkan 16 digit angka NIK yang valid"
                           required>
                </div>
                <div class="form-group">
                    <label class="form-label">Tanggal Lahir <span class="text-danger">*</span></label>
                    <input type="date" 
                           name="tanggal_lahir" 
                           value="{{ old('tanggal_lahir') }}" 
                           class="form-control" 
                           required>
                </div>
            </div>

            <!-- Jenis Kelamin & RT/RW (2 Kolom Responsif) -->
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Jenis Kelamin <span class="text-danger">*</span></label>
                    <select name="jenis_kelamin" class="form-control" required>
                        <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Wilayah RT / Dusun</label>
                    <select name="rt" class="form-control">
                        <option value="01">RT 01 / RW 01 (Pos Mawar)</option>
                        <option value="02">RT 02 / RW 02 (Pos Melati)</option>
                        <option value="03">RT 03 / RW 03 (Pos Dahlia)</option>
                        <option value="04">RT 04 / RW 04 (Pos Anggrek)</option>
                    </select>
                </div>
            </div>

            <!-- Status / Kategori Siklus Hidup -->
            <div class="form-group">
                <label class="form-label">Kategori Sasaran Siklus Hidup <span class="text-danger">*</span></label>
                <select name="status" id="statusSasaranSelect" class="form-control" required onchange="togglePrematurField()">
                    <option value="Balita" {{ old('status') == 'Balita' ? 'selected' : '' }}>Bayi & Balita (0–5 Tahun)</option>
                    <option value="Ibu Hamil" {{ old('status') == 'Ibu Hamil' ? 'selected' : '' }}>Ibu Hamil (ANC)</option>
                    <option value="Remaja" {{ old('status') == 'Remaja' ? 'selected' : '' }}>Remaja & Usia Produktif</option>
                    <option value="Lansia" {{ old('status') == 'Lansia' ? 'selected' : '' }}>Lansia (Posbindu PTM)</option>
                </select>
            </div>

            <!-- Modul Khusus Bayi Prematur (Standar Kemenkes / Kurva Fenton) -->
            <div id="prematurContainer" style="background: #faf8f5; border: 1px solid #ebe6dd; border-radius: 12px; padding: 14px 16px; margin-top: 1rem; margin-bottom: 1.25rem;">
                <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 8px;">
                    <label style="display: flex; align-items: center; gap: 8px; font-weight: 700; font-size: 0.88rem; color: #1f2937; margin: 0; cursor: pointer;">
                        <input type="checkbox" name="is_prematur" id="isPrematurCheck" value="1" {{ old('is_prematur') ? 'checked' : '' }} onchange="toggleGestasiInput()">
                        <span>Kelahiran Prematur (< 37 Minggu)</span>
                    </label>
                    <span class="tag tag-warning" style="font-size: 0.7rem;">Kurva Fenton ILP</span>
                </div>
                <p style="font-size: 0.775rem; color: #6b7280; margin: 0 0 10px 0;">
                    Sistem otomatis menghitung <strong>Usia Koreksi</strong> = Usia Kronologis - (40 minggu - Usia Gestasi) untuk kurva pertumbuhan Fenton hingga usia 2 tahun (Standar Kemenkes BR-02).
                </p>
                <div id="gestasiInputWrap" style="display: none;">
                    <label class="form-label" style="font-size: 0.8rem;">Usia Kehamilan saat Lahir (Minggu Gestasi)</label>
                    <input type="number" 
                           name="usia_kehamilan_minggu" 
                           id="usiaKehamilanInput" 
                           value="{{ old('usia_kehamilan_minggu', 34) }}" 
                           class="form-control" 
                           min="20" 
                           max="42" 
                           placeholder="Contoh: 34 (Minggu)">
                </div>
            </div>

            <!-- Sub-Heading Informasi Orang Tua / Keluarga -->
            <div style="border-top: 1px solid var(--border-color); padding-top: 1.25rem; margin-top: 1.5rem; margin-bottom: 1rem;">
                <h4 class="serif" style="font-size: 1.05rem; color: var(--primary);">
                    <i class="fa-solid fa-people-roof" style="margin-right: 8px;"></i>
                    Informasi Orang Tua / Penanggung Jawab
                </h4>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Nama Ibu Kandung</label>
                    <input type="text" 
                           name="nama_ibu" 
                           value="{{ old('nama_ibu') }}" 
                           class="form-control" 
                           placeholder="Nama Ibu Kandung">
                </div>
                <div class="form-group">
                    <label class="form-label">Nama Ayah / Suami</label>
                    <input type="text" 
                           name="nama_ayah" 
                           value="{{ old('nama_ayah') }}" 
                           class="form-control" 
                           placeholder="Nama Ayah / Suami">
                </div>
            </div>

            <!-- Tombol Aksi Formulir -->
            <div style="display: flex; justify-content: flex-end; gap: 12px; margin-top: 2rem; flex-wrap: wrap;">
                <button type="reset" class="btn btn-secondary">
                    <i class="fa-solid fa-rotate-left"></i>
                    <span>Bersihkan</span>
                </button>
                <button type="submit" class="btn btn-primary">
                    <i class="fa-solid fa-user-plus"></i>
                    <span>Daftarkan Anggota Baru</span>
                </button>
            </div>
        </form>
    </div>

    <!-- Kolom Kanan: Panduan Registrasi -->
    <div style="display: flex; flex-direction: column; gap: 20px;">
        <div class="card" style="background: var(--bg-card-subtle);">
            <div class="card-title">
                <span><i class="fa-solid fa-circle-info text-primary" style="margin-right: 8px;"></i> Petunjuk Registrasi</span>
            </div>
            
            <ul style="padding-left: 20px; font-size: 0.85rem; color: var(--text-muted); display: flex; flex-direction: column; gap: 10px; margin: 0;">
                <li>Pastikan <strong>16 digit NIK</strong> sesuai dengan Kartu Keluarga (KK) atau KTP warga.</li>
                <li>Pilihan kategori sasaran menentukan parameter pemeriksaan fisik yang akan diinput.</li>
                <li>Bagi sasaran <strong>Balita</strong>, nama ibu kandung wajib dilengkapi untuk keperluan data buku KIA.</li>
                <li>Setelah pendaftaran berhasil, warga langsung dapat dicari pada menu <strong>Daftar Anggota</strong>.</li>
            </ul>
        </div>

        <div class="card" style="background: var(--primary-light); border-color: var(--primary-border);">
            <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 8px;">
                <i class="fa-solid fa-mobile-screen-button text-primary" style="font-size: 1.4rem;"></i>
                <div style="font-weight: 700; color: var(--primary); font-size: 0.95rem;">Integrasi Aplikasi Mobile</div>
            </div>
            <p style="font-size: 0.825rem; color: var(--text-main); margin: 0;">
                Warga yang didaftarkan otomatis dapat mengakses data rekam medisnya melalui aplikasi Android (Kotlin) menggunakan NIK dan tanggal lahir.
            </p>
        </div>
    </div>
</div>

<script>
function togglePrematurField() {
    const status = document.getElementById('statusSasaranSelect').value;
    const container = document.getElementById('prematurContainer');
    if (status === 'Balita') {
        container.style.display = 'block';
    } else {
        container.style.display = 'none';
        document.getElementById('isPrematurCheck').checked = false;
        toggleGestasiInput();
    }
}

function toggleGestasiInput() {
    const isChecked = document.getElementById('isPrematurCheck').checked;
    const wrap = document.getElementById('gestasiInputWrap');
    wrap.style.display = isChecked ? 'block' : 'none';
}

document.addEventListener('DOMContentLoaded', function() {
    togglePrematurField();
    toggleGestasiInput();
});
</script>
@endsection
