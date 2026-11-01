@extends('layouts.admin')

@section('title', 'Pendaftaran Anggota')
@section('breadcrumbs', 'Beranda > Pendaftaran Anggota')
@section('page_title', 'Pendaftaran Anggota')

@section('content')
<p class="text-muted mb-4">Daftarkan anggota komunitas baru untuk melacak perkembangan kesehatan dan riwayat medis mereka.</p>

<div class="content-grid" style="grid-template-columns: 2fr 1fr;">
    <div class="card">
        <h3 class="serif mb-4" style="font-size: 1.2rem; color: var(--primary);">
            <i class="fa-solid fa-user-tag" style="margin-right: 10px;"></i>
            Informasi Pribadi
        </h3>
        
        <form action="{{ route('admin.warga.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label class="form-label">Nama Lengkap</label>
                <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap') }}" class="form-control" placeholder="Masukkan nama lengkap" required>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                <div class="form-group">
                    <label class="form-label">NIK (Nomor Induk Kewarganegaraan)</label>
                    <input type="text" name="NIK" value="{{ old('NIK') }}" class="form-control" placeholder="16-digit NIK" maxlength="16" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" class="form-control" required>
                </div>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                <div class="form-group">
                    <label class="form-label">Jenis Kelamin</label>
                    <select name="jenis_kelamin" class="form-control" required>
                        <option value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">RT</label>
                    <select name="rt" class="form-control">
                        <option value="01">RT 01</option>
                        <option value="02">RT 02</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Status / Kategori</label>
                <select name="status" class="form-control" required>
                    <option value="Balita" {{ old('status') == 'Balita' ? 'selected' : '' }}>Balita</option>
                    <option value="Ibu Hamil" {{ old('status') == 'Ibu Hamil' ? 'selected' : '' }}>Ibu Hamil</option>
                    <option value="Remaja" {{ old('status') == 'Remaja' ? 'selected' : '' }}>Remaja</option>
                    <option value="Lansia" {{ old('status') == 'Lansia' ? 'selected' : '' }}>Lansia</option>
                </select>
            </div>

            <h3 class="serif mb-4 mt-4" style="font-size: 1.2rem; color: var(--primary);">
                <i class="fa-solid fa-people-roof" style="margin-right: 10px;"></i>
                Detail Keluarga
            </h3>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                <div class="form-group">
                    <label class="form-label">Nama Ibu</label>
                    <input type="text" name="nama_ibu" value="{{ old('nama_ibu') }}" class="form-control" placeholder="Nama Ibu Kandung">
                </div>
                <div class="form-group">
                    <label class="form-label">Nama Ayah</label>
                    <input type="text" name="nama_ayah" value="{{ old('nama_ayah') }}" class="form-control" placeholder="Nama Ayah Kandung">
                </div>
            </div>


            <div style="display: flex; justify-content: flex-end; gap: 15px; margin-top: 2rem;">
                <button type="reset" class="btn" style="background: transparent; color: var(--text-muted);">Bersihkan</button>
                <button type="submit" class="btn btn-primary">Daftarkan Anggota</button>
            </div>
        </form>
    </div>

    <div class="card-column" style="display: flex; flex-direction: column; gap: 24px;">
        <div class="card" style="background: #fdf8f3; border-left: 4px solid #d4a373;">
            <h4 class="serif mb-3" style="font-size: 1rem;">Panduan Pendaftaran</h4>
            <ul style="list-style: none; font-size: 0.85rem; color: #666; display: flex; flex-direction: column; gap: 12px;">
                <li><i class="fa-regular fa-circle-check" style="color: #4a7c59; margin-right: 8px;"></i> Pastikan NIK sesuai persis dengan KTP atau KK.</li>
                <li><i class="fa-regular fa-circle-check" style="color: #4a7c59; margin-right: 8px;"></i> Tanggal lahir sangat penting untuk perhitungan pertumbuhan.</li>
                <li><i class="fa-regular fa-circle-check" style="color: #4a7c59; margin-right: 8px;"></i> Nama orang tua membantu melacak kesehatan keturunan.</li>
            </ul>
        </div>

        <div class="card">
            <h4 class="serif mb-3" style="font-size: 1rem;">Aktivitas Terbaru</h4>
            <div style="font-size: 0.85rem; color: #666; display: flex; flex-direction: column; gap: 15px;">
                <div style="display: flex; gap: 10px;">
                    <div style="width: 8px; height: 8px; border-radius: 50%; background: #4a7c59; margin-top: 6px;"></div>
                    <span>Menambahkan Ahmed Dahlan ke RT 02</span>
                </div>
                <div style="display: flex; gap: 10px;">
                    <div style="width: 8px; height: 8px; border-radius: 50%; background: #4a7c59; margin-top: 6px;"></div>
                    <span>Memperbarui profil Siti Junirah</span>
                </div>
                <div style="display: flex; gap: 10px;">
                    <div style="width: 8px; height: 8px; border-radius: 50%; background: #4a7c59; margin-top: 6px;"></div>
                    <span>Telah mendaftarkan 5 bayi pada hari ini</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
