@extends('layouts.admin')

@section('title', 'Pengaturan Akun & Posko — e-Posyandu')

@section('breadcrumbs')
    <a href="{{ route('admin.dashboard') }}">Beranda</a> / <span>Pengaturan Akun & Keamanan</span>
@endsection

@section('page_title', 'Pengaturan Akun & Posko')

@section('content')
<div class="account-settings-container">
    {{-- Header Banner Profil Ringkas --}}
    <div class="avatar-header-card">
        <div class="avatar-upload-box">
            @php
                $avatarImg = $profil['avatar'] ? asset($profil['avatar']) : 'https://ui-avatars.com/api/?name=' . urlencode($profil['nama']) . '&background=2d6a4f&color=fff&size=128';
            @endphp
            <img src="{{ $avatarImg }}" alt="Avatar {{ $profil['nama'] }}" id="profileAvatarPreview">
            <label for="avatarFileInput" class="avatar-upload-overlay" title="Ganti Foto Profil">
                <i class="fa-solid fa-camera"></i>
            </label>
        </div>
        <div style="flex-grow: 1; min-width: 0;">
            <div style="display: flex; align-items: center; gap: 10px; flex-wrap: wrap;">
                <h3 class="serif" style="margin: 0; font-size: 1.35rem; color: var(--text-main);">{{ $profil['nama'] }}</h3>
                <span class="tag tag-success" style="font-size: 0.725rem;">
                    <i class="fa-solid fa-circle-check"></i> Akun Terverifikasi
                </span>
            </div>
            <div style="font-size: 0.85rem; color: var(--text-muted); margin-top: 4px; display: flex; align-items: center; gap: 16px; flex-wrap: wrap;">
                <span><i class="fa-solid fa-id-badge text-primary" style="margin-right: 4px;"></i> {{ $profil['jabatan'] }}</span>
                <span><i class="fa-solid fa-envelope" style="margin-right: 4px;"></i> {{ $profil['email'] }}</span>
                <span><i class="fa-brands fa-whatsapp text-success" style="margin-right: 4px;"></i> {{ $profil['telepon'] }}</span>
            </div>
        </div>
    </div>

    {{-- Navigasi Tab Horizontal --}}
    <div class="account-tabs" role="tablist">
        <button type="button" class="account-tab-btn {{ ($activeTab ?? 'profil') === 'profil' ? 'active' : '' }}" data-tab="profil" role="tab">
            <i class="fa-solid fa-user-gear"></i>
            <span>Informasi Profil</span>
        </button>
        <button type="button" class="account-tab-btn {{ ($activeTab ?? 'profil') === 'keamanan' ? 'active' : '' }}" data-tab="keamanan" role="tab">
            <i class="fa-solid fa-shield-halved"></i>
            <span>Keamanan & 2FA</span>
            @if($keamanan['tfa_enabled'])
                <span class="tag tag-success" style="font-size: 0.65rem; padding: 2px 6px; margin-left: 4px;">Aktif</span>
            @endif
        </button>
        <button type="button" class="account-tab-btn {{ ($activeTab ?? 'profil') === 'posko' ? 'active' : '' }}" data-tab="posko" role="tab">
            <i class="fa-solid fa-sliders"></i>
            <span>Pengaturan Posko</span>
        </button>
    </div>

    {{-- =========================================================================
         TAB 1: INFORMASI PROFIL & KONTAK
         ========================================================================= --}}
    <div id="tab-profil" class="account-tab-pane {{ ($activeTab ?? 'profil') === 'profil' ? 'active' : '' }}">
        <div class="card">
            <div class="card-title">
                <div>
                    <h3 style="margin: 0; font-size: 1.15rem; color: var(--text-main);">Data Profil & Kontak Petugas</h3>
                    <p style="margin: 2px 0 0; font-size: 0.825rem; font-weight: 400; color: var(--text-muted);">
                        Perbarui identitas kader, alamat surat elektronik, dan nomor WhatsApp koordinasi.
                    </p>
                </div>
            </div>

            <form action="{{ route('admin.pengaturan-akun.profil') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="file" name="avatar" id="avatarFileInput" accept="image/jpeg,image/png,image/webp" style="display: none;" onchange="previewAvatar(this)">

                <div class="form-row" style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 1.25rem;">
                    <div class="form-group" style="margin-bottom: 0;">
                        <label class="form-label" for="nama">Nama Lengkap Petugas <span class="text-danger">*</span></label>
                        <input type="text" name="nama" id="nama" class="form-control" value="{{ old('nama', $profil['nama']) }}" required>
                    </div>
                    <div class="form-group" style="margin-bottom: 0;">
                        <label class="form-label" for="username">Username Sistem <span class="text-danger">*</span></label>
                        <input type="text" name="username" id="username" class="form-control" value="{{ old('username', $profil['username']) }}" required>
                    </div>
                </div>

                <div class="form-row" style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 1.25rem;">
                    <div class="form-group" style="margin-bottom: 0;">
                        <label class="form-label" for="email">Alamat Email <span class="text-danger">*</span></label>
                        <div class="password-input-group">
                            <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $profil['email']) }}" required>
                        </div>
                    </div>
                    <div class="form-group" style="margin-bottom: 0;">
                        <label class="form-label" for="telepon">Nomor WhatsApp / HP Aktif <span class="text-danger">*</span></label>
                        <input type="text" name="telepon" id="telepon" class="form-control" value="{{ old('telepon', $profil['telepon']) }}" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Peran & Penugasan Wilayah</label>
                    <input type="text" class="form-control" value="{{ $profil['jabatan'] }}" readonly style="background: #f3f4f6; color: var(--text-muted); cursor: not-allowed;">
                    <small style="color: var(--text-muted); font-size: 0.775rem; margin-top: 4px; display: block;">
                        Perubahan jabatan posko dikelola oleh Ketua Posyandu atau Koordinator Puskesmas.
                    </small>
                </div>

                <div class="form-group">
                    <label class="form-label" for="bio">Catatan Ringkas / Deskripsi Tugas</label>
                    <textarea name="bio" id="bio" rows="3" class="form-control" placeholder="Tuliskan catatan peran kader posyandu...">{{ old('bio', $profil['bio']) }}</textarea>
                </div>

                <div style="display: flex; justify-content: flex-end; gap: 10px; margin-top: 1.5rem; padding-top: 1rem; border-top: 1px solid var(--border-color-light);">
                    <button type="reset" class="btn btn-secondary">
                        <i class="fa-solid fa-rotate-left"></i>
                        <span>Atur Ulang</span>
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fa-solid fa-floppy-disk"></i>
                        <span>Simpan Perubahan Profil</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- =========================================================================
         TAB 2: KEAMANAN, KATA SANDI, 2FA & SESI LOGIN
         ========================================================================= --}}
    <div id="tab-keamanan" class="account-tab-pane {{ ($activeTab ?? 'profil') === 'keamanan' ? 'active' : '' }}">
        <div class="content-grid" style="grid-template-columns: 1fr 1fr; gap: 20px;">
            {{-- Form Ganti Kata Sandi --}}
            <div class="card" style="height: fit-content;">
                <div class="card-title">
                    <div>
                        <h3 style="margin: 0; font-size: 1.15rem; color: var(--text-main);">Ganti Kata Sandi</h3>
                        <p style="margin: 2px 0 0; font-size: 0.825rem; font-weight: 400; color: var(--text-muted);">
                            Gunakan kombinasi minimal 8 karakter dengan huruf, angka, dan simbol.
                        </p>
                    </div>
                </div>

                <form action="{{ route('admin.pengaturan-akun.password') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label class="form-label" for="current_password">Kata Sandi Saat Ini <span class="text-danger">*</span></label>
                        <div class="password-input-group">
                            <input type="password" name="current_password" id="current_password" class="form-control" placeholder="Masukkan kata sandi lama" required>
                            <button type="button" class="password-toggle-btn" onclick="togglePasswordVisibility('current_password', this)" aria-label="Lihat kata sandi">
                                <i class="fa-regular fa-eye"></i>
                            </button>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="new_password">Kata Sandi Baru <span class="text-danger">*</span></label>
                        <div class="password-input-group">
                            <input type="password" name="new_password" id="new_password" class="form-control" placeholder="Minimal 8 karakter" required oninput="evaluatePasswordStrength(this.value)">
                            <button type="button" class="password-toggle-btn" onclick="togglePasswordVisibility('new_password', this)" aria-label="Lihat kata sandi">
                                <i class="fa-regular fa-eye"></i>
                            </button>
                        </div>
                        {{-- Password Strength Meter --}}
                        <div class="password-meter-container">
                            <div class="password-meter-bars">
                                <div class="meter-bar" id="meterBar1"></div>
                                <div class="meter-bar" id="meterBar2"></div>
                                <div class="meter-bar" id="meterBar3"></div>
                                <div class="meter-bar" id="meterBar4"></div>
                            </div>
                            <div class="password-meter-text" id="passwordMeterText">Kekuatan kata sandi: Belum diisi</div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="new_password_confirmation">Konfirmasi Kata Sandi Baru <span class="text-danger">*</span></label>
                        <div class="password-input-group">
                            <input type="password" name="new_password_confirmation" id="new_password_confirmation" class="form-control" placeholder="Ulangi kata sandi baru" required>
                            <button type="button" class="password-toggle-btn" onclick="togglePasswordVisibility('new_password_confirmation', this)" aria-label="Lihat kata sandi">
                                <i class="fa-regular fa-eye"></i>
                            </button>
                        </div>
                    </div>

                    <div style="font-size: 0.775rem; color: var(--text-muted); margin-bottom: 1.25rem;">
                        <i class="fa-regular fa-clock" style="margin-right: 4px;"></i> Terakhir diperbarui: {{ $keamanan['password_changed_at'] ?? 'Belum pernah' }}
                    </div>

                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fa-solid fa-key"></i>
                        <span>Perbarui Kata Sandi</span>
                    </button>
                </form>
            </div>

            {{-- Kolom Autentikasi Dua Faktor (2FA / TFA) & Sesi --}}
            <div style="display: flex; flex-direction: column; gap: 20px;">
                {{-- Card 2FA / TFA --}}
                <div class="card">
                    <div class="security-card-header">
                        <div style="display: flex; align-items: center; gap: 12px;">
                            <div class="security-icon-box {{ $keamanan['tfa_enabled'] ? 'green' : 'amber' }}">
                                <i class="fa-solid {{ $keamanan['tfa_enabled'] ? 'fa-shield-halved' : 'fa-triangle-exclamation' }}"></i>
                            </div>
                            <div>
                                <h3 style="margin: 0; font-size: 1.15rem; color: var(--text-main);">Autentikasi Dua Faktor (2FA)</h3>
                                <div style="font-size: 0.8rem; color: var(--text-muted); margin-top: 2px;">
                                    Google Authenticator / TOTP
                                </div>
                            </div>
                        </div>
                        @if($keamanan['tfa_enabled'])
                            <span class="tag tag-success">
                                <i class="fa-solid fa-circle-check"></i> 2FA Aktif
                            </span>
                        @else
                            <span class="tag tag-warning">
                                <i class="fa-solid fa-triangle-exclamation"></i> Nonaktif
                            </span>
                        @endif
                    </div>

                    @if($keamanan['tfa_enabled'])
                        <p style="font-size: 0.875rem; color: var(--text-main); line-height: 1.5; margin-bottom: 1rem;">
                            Akun Anda terlindungi dengan verifikasi ganda. Setiap sesi login baru memerlukan kode 6-digit dari aplikasi Google Authenticator.
                        </p>
                        <div style="font-size: 0.775rem; color: var(--text-muted); margin-bottom: 1.25rem;">
                            <i class="fa-regular fa-calendar-check" style="margin-right: 4px;"></i> Aktif sejak: {{ $keamanan['tfa_enabled_at'] ?? 'Hari ini' }}
                        </div>

                        <div style="display: flex; gap: 10px; flex-wrap: wrap;">
                            <button type="button" class="btn btn-secondary btn-sm" onclick="openModal('tfaRecoveryModal')" style="border-radius: 9999px; padding: 6px 16px;">
                                <i class="fa-solid fa-ticket"></i>
                                <span>Lihat Kode Cadangan</span>
                            </button>
                            <button type="button" class="btn btn-outline-danger btn-sm" onclick="openModal('disableTfaModal')" style="color: var(--danger); border: 1px solid #fecaca; background: #fff5f5; border-radius: 9999px; padding: 6px 16px;">
                                <i class="fa-solid fa-shield-slash"></i>
                                <span>Nonaktifkan 2FA</span>
                            </button>
                        </div>
                    @else
                        <p style="font-size: 0.875rem; color: var(--text-muted); line-height: 1.5; margin-bottom: 1.25rem;">
                            Tingkatkan proteksi akun terhadap akses yang tidak berizin. Setelah diaktifkan, Anda akan diminta memasukkan kode 6-digit dari Google Authenticator saat login.
                        </p>
                        <button type="button" class="btn btn-primary" onclick="openModal('tfaSetupModal')">
                            <i class="fa-solid fa-shield-virus"></i>
                            <span>Aktifkan 2FA Sekarang</span>
                        </button>
                    @endif
                </div>

                {{-- Card Sesi Login Aktif --}}
                <div class="card">
                    <div class="card-title" style="margin-bottom: 1rem;">
                        <div>
                            <h3 style="margin: 0; font-size: 1.15rem; color: var(--text-main);">Sesi Perangkat Aktif</h3>
                            <p style="margin: 2px 0 0; font-size: 0.825rem; font-weight: 400; color: var(--text-muted);">
                                Daftar perangkat yang sedang mengakses akun e-Posyandu Anda.
                            </p>
                        </div>
                    </div>

                    {{-- Sesi 1: Perangkat Ini --}}
                    <div class="session-item current-session">
                        <div style="display: flex; align-items: center; gap: 12px;">
                            <div class="device-badge-icon active-device">
                                <i class="fa-solid fa-laptop"></i>
                            </div>
                            <div>
                                <div style="font-weight: 600; font-size: 0.875rem; color: var(--text-main);">
                                    Windows 11 • Google Chrome
                                    <span class="tag tag-success" style="font-size: 0.65rem; padding: 2px 6px; margin-left: 6px;">Sesi Ini</span>
                                </div>
                                <div style="font-size: 0.75rem; color: var(--text-muted); margin-top: 2px;">
                                    IP 192.168.1.10 • Jakarta, Indonesia • Aktif Sekarang
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Sesi 2: Mobile (bisa dikeluarkan) --}}
                    @if(empty($keamanan['other_sessions_terminated']))
                        <div class="session-item" id="mobileSessionRow">
                            <div style="display: flex; align-items: center; gap: 12px;">
                                <div class="device-badge-icon">
                                    <i class="fa-solid fa-mobile-screen"></i>
                                </div>
                                <div>
                                    <div style="font-weight: 600; font-size: 0.875rem; color: var(--text-main);">
                                        Samsung Galaxy A54 • Chrome Mobile
                                    </div>
                                    <div style="font-size: 0.75rem; color: var(--text-muted); margin-top: 2px;">
                                        IP 192.168.1.45 • Aktif 2 jam yang lalu
                                    </div>
                                </div>
                            </div>
                        </div>

                        <form action="{{ route('admin.pengaturan-akun.logout-sesi') }}" method="POST" style="margin-top: 1rem;">
                            @csrf
                            <button type="submit" class="btn btn-secondary btn-sm w-100" style="color: var(--danger); border-color: #fca5a5;">
                                <i class="fa-solid fa-right-from-bracket"></i>
                                <span>Keluar dari Sesi Perangkat Lain</span>
                            </button>
                        </form>
                    @else
                        <div style="padding: 10px; background: #f0fdf4; border-radius: var(--radius-md); font-size: 0.8rem; color: #166534; display: flex; align-items: center; gap: 8px;">
                            <i class="fa-solid fa-circle-check"></i>
                            <span>Seluruh sesi perangkat lain telah berhasil dihentikan.</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- =========================================================================
         TAB 3: KONFIGURASI POSKO & NOTIFIKASI
         ========================================================================= --}}
    <div id="tab-posko" class="account-tab-pane {{ ($activeTab ?? 'profil') === 'posko' ? 'active' : '' }}">
        <div class="card">
            <div class="card-title">
                <div>
                    <h3 style="margin: 0; font-size: 1.15rem; color: var(--text-main);">Konfigurasi Operasional Posko Posyandu</h3>
                    <p style="margin: 2px 0 0; font-size: 0.825rem; font-weight: 400; color: var(--text-muted);">
                        Pengaturan nama pos layanan terpadu, koordinator bidan desa pembina, dan automasi notifikasi jadwal.
                    </p>
                </div>
            </div>

            <form action="{{ route('admin.pengaturan-akun.posko') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label class="form-label" for="posko_nama">Nama Posko Posyandu <span class="text-danger">*</span></label>
                    <input type="text" name="posko_nama" id="posko_nama" class="form-control" value="{{ old('posko_nama', $posko['nama']) }}" required>
                </div>

                <div class="form-row" style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 1.25rem;">
                    <div class="form-group" style="margin-bottom: 0;">
                        <label class="form-label" for="posko_rw">Wilayah Rukun Warga (RW) <span class="text-danger">*</span></label>
                        <input type="text" name="posko_rw" id="posko_rw" class="form-control" value="{{ old('posko_rw', $posko['rw']) }}" required>
                    </div>
                    <div class="form-group" style="margin-bottom: 0;">
                        <label class="form-label" for="posko_desa">Desa / Kelurahan <span class="text-danger">*</span></label>
                        <input type="text" name="posko_desa" id="posko_desa" class="form-control" value="{{ old('posko_desa', $posko['desa']) }}" required>
                    </div>
                </div>

                <div class="form-row" style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 1.25rem;">
                    <div class="form-group" style="margin-bottom: 0;">
                        <label class="form-label" for="posko_bidan">Bidan Pembina Wilayah <span class="text-danger">*</span></label>
                        <input type="text" name="posko_bidan" id="posko_bidan" class="form-control" value="{{ old('posko_bidan', $posko['bidan']) }}" required>
                    </div>
                    <div class="form-group" style="margin-bottom: 0;">
                        <label class="form-label" for="posko_wa">Nomor WhatsApp Pengingat Otomatis <span class="text-danger">*</span></label>
                        <input type="text" name="posko_wa" id="posko_wa" class="form-control" value="{{ old('posko_wa', $posko['wa']) }}" required>
                    </div>
                </div>

                <div style="font-weight: 700; font-size: 0.95rem; color: var(--text-main); margin: 1.5rem 0 0.75rem;">
                    Automasi Notifikasi & Pengingat Posyandu
                </div>

                <div style="display: flex; flex-direction: column; gap: 12px; margin-bottom: 1.5rem;">
                    {{-- Switch 1 --}}
                    <div style="display: flex; align-items: center; justify-content: space-between; padding: 12px 14px; background: var(--bg-card-subtle); border-radius: var(--radius-md); border: 1px solid var(--border-color-light);">
                        <div>
                            <div style="font-weight: 600; font-size: 0.875rem; color: var(--text-main);">Pengingat Jadwal Posyandu H-1 (WhatsApp Gateway)</div>
                            <div style="font-size: 0.775rem; color: var(--text-muted);">Kirim pesan otomatis pengingat jadwal penimbangan ke orang tua balita & bumil.</div>
                        </div>
                        <label class="switch-control">
                            <input type="checkbox" name="notif_h1" value="1" {{ !empty($posko['notif_h1']) ? 'checked' : '' }}>
                            <span class="switch-slider"></span>
                        </label>
                    </div>

                    {{-- Switch 2 --}}
                    <div style="display: flex; align-items: center; justify-content: space-between; padding: 12px 14px; background: var(--bg-card-subtle); border-radius: var(--radius-md); border: 1px solid var(--border-color-light);">
                        <div>
                            <div style="font-weight: 600; font-size: 0.875rem; color: var(--text-main);">Peringatan Pemantauan Gizi Balita & Risiko Stunting</div>
                            <div style="font-size: 0.775rem; color: var(--text-muted);">Tampilkan notifikasi di header saat terdapat balita dengan status kurva gizi perlu pemantauan khusus.</div>
                        </div>
                        <label class="switch-control">
                            <input type="checkbox" name="notif_stok" value="1" {{ !empty($posko['notif_stok']) ? 'checked' : '' }}>
                            <span class="switch-slider"></span>
                        </label>
                    </div>

                    {{-- Switch 3 --}}
                    <div style="display: flex; align-items: center; justify-content: space-between; padding: 12px 14px; background: var(--bg-card-subtle); border-radius: var(--radius-md); border: 1px solid var(--border-color-light);">
                        <div>
                            <div style="font-weight: 600; font-size: 0.875rem; color: var(--text-main);">Notifikasi Sasaran Warga Baru</div>
                            <div style="font-size: 0.775rem; color: var(--text-muted);">Terima pembaruan data setiap kali ada anggota baru terdaftar di wilayah RW 01.</div>
                        </div>
                        <label class="switch-control">
                            <input type="checkbox" name="notif_warga" value="1" {{ !empty($posko['notif_warga']) ? 'checked' : '' }}>
                            <span class="switch-slider"></span>
                        </label>
                    </div>
                </div>

                <div style="display: flex; justify-content: flex-end; gap: 10px; padding-top: 1rem; border-top: 1px solid var(--border-color-light);">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa-solid fa-floppy-disk"></i>
                        <span>Simpan Pengaturan Posko</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- =========================================================================
     MODAL 1: AKTIVASI 2FA / TFA GOOGLE AUTHENTICATOR
     ========================================================================= --}}
<div id="tfaSetupModal" class="modal-overlay">
    <div class="modal-box modal-md" style="max-width: 540px;">
        <div class="modal-header">
            <div>
                <h3 class="serif" style="margin: 0; font-size: 1.25rem; color: var(--text-main); display: flex; align-items: center; gap: 8px;">
                    <i class="fa-solid fa-shield-virus text-primary"></i>
                    Aktivasi Autentikasi Dua Faktor (2FA)
                </h3>
                <div style="font-size: 0.8rem; color: var(--text-muted); margin-top: 2px;">
                    Konfigurasikan aplikasi Google Authenticator atau Microsoft Authenticator Anda.
                </div>
            </div>
            <button type="button" class="modal-close-btn" onclick="closeModal('tfaSetupModal')" aria-label="Tutup">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>

        <form action="{{ route('admin.pengaturan-akun.tfa') }}" method="POST" id="tfaSetupForm">
            @csrf
            <input type="hidden" name="action" value="enable">

            {{-- Langkah 1: Scan QR --}}
            <div style="margin-bottom: 1.25rem;">
                <div style="font-weight: 700; font-size: 0.875rem; color: var(--text-main); margin-bottom: 6px;">
                    Langkah 1: Pindai Kode QR atau Masukkan Kunci Rahasia
                </div>
                <div style="font-size: 0.8rem; color: var(--text-muted); margin-bottom: 12px;">
                    Buka Google Authenticator di ponsel Anda, lalu pilih <strong>Pindai kode QR</strong>.
                </div>

                <div style="display: flex; align-items: center; gap: 16px; padding: 14px; background: #fafaf8; border-radius: var(--radius-md); border: 1px solid var(--border-color);">
                    {{-- Clean SVG QR Code Representation --}}
                    <div style="background: white; padding: 8px; border-radius: 8px; border: 1px solid #e5e7eb; display: inline-flex; align-items: center; justify-content: center; flex-shrink: 0;">
                        <svg width="108" height="108" viewBox="0 0 108 108" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect width="108" height="108" fill="white"/>
                            {{-- Top-Left Finder --}}
                            <rect x="8" y="8" width="28" height="28" rx="4" fill="#2d6a4f"/>
                            <rect x="14" y="14" width="16" height="16" fill="white"/>
                            <rect x="18" y="18" width="8" height="8" fill="#2d6a4f"/>
                            {{-- Top-Right Finder --}}
                            <rect x="72" y="8" width="28" height="28" rx="4" fill="#2d6a4f"/>
                            <rect x="78" y="14" width="16" height="16" fill="white"/>
                            <rect x="82" y="18" width="8" height="8" fill="#2d6a4f"/>
                            {{-- Bottom-Left Finder --}}
                            <rect x="8" y="72" width="28" height="28" rx="4" fill="#2d6a4f"/>
                            <rect x="14" y="78" width="16" height="16" fill="white"/>
                            <rect x="18" y="82" width="8" height="8" fill="#2d6a4f"/>
                            {{-- Data Blocks --}}
                            <rect x="42" y="12" width="6" height="6" fill="#1b4332"/>
                            <rect x="54" y="12" width="6" height="6" fill="#1b4332"/>
                            <rect x="42" y="24" width="6" height="6" fill="#1b4332"/>
                            <rect x="60" y="24" width="6" height="6" fill="#1b4332"/>
                            <rect x="48" y="36" width="6" height="6" fill="#1b4332"/>
                            <rect x="12" y="44" width="6" height="6" fill="#1b4332"/>
                            <rect x="24" y="44" width="6" height="6" fill="#1b4332"/>
                            <rect x="36" y="48" width="6" height="6" fill="#1b4332"/>
                            <rect x="48" y="48" width="12" height="12" rx="2" fill="#2d6a4f"/>
                            <rect x="66" y="48" width="6" height="6" fill="#1b4332"/>
                            <rect x="78" y="44" width="6" height="6" fill="#1b4332"/>
                            <rect x="90" y="44" width="6" height="6" fill="#1b4332"/>
                            <rect x="42" y="66" width="6" height="6" fill="#1b4332"/>
                            <rect x="60" y="66" width="6" height="6" fill="#1b4332"/>
                            <rect x="72" y="66" width="6" height="6" fill="#1b4332"/>
                            <rect x="84" y="72" width="6" height="6" fill="#1b4332"/>
                            <rect x="72" y="84" width="6" height="6" fill="#1b4332"/>
                            <rect x="90" y="84" width="6" height="6" fill="#1b4332"/>
                            <rect x="42" y="84" width="6" height="6" fill="#1b4332"/>
                            <rect x="54" y="84" width="6" height="6" fill="#1b4332"/>
                        </svg>
                    </div>
                    <div style="flex-grow: 1; min-width: 0;">
                        <div style="font-size: 0.75rem; color: var(--text-muted); margin-bottom: 4px;">Kunci Rahasia Manual:</div>
                        <div style="display: flex; align-items: center; gap: 8px;">
                            <code style="background: white; padding: 6px 10px; border-radius: 6px; border: 1px solid #e5e7eb; font-weight: 700; color: var(--primary); font-size: 0.85rem;" id="tfaSecretKeyText">{{ $keamanan['tfa_secret'] }}</code>
                            <button type="button" class="btn btn-secondary btn-sm" onclick="copySecretKey()" title="Salin Kunci">
                                <i class="fa-regular fa-copy"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Langkah 2: Kode Verifikasi OTP --}}
            <div style="margin-bottom: 1.5rem;">
                <div style="font-weight: 700; font-size: 0.875rem; color: var(--text-main); margin-bottom: 6px;">
                    Langkah 2: Masukkan 6 Digit Kode OTP dari Authenticator
                </div>
                <div style="font-size: 0.8rem; color: var(--text-muted); margin-bottom: 8px;">
                    Ketik kode 6 digit yang muncul pada aplikasi authenticator Anda saat ini:
                </div>

                {{-- Interactive 6-box input --}}
                <div class="otp-input-row">
                    <input type="text" maxlength="1" class="otp-box" inputmode="numeric" pattern="[0-9]*" autocomplete="off" required>
                    <input type="text" maxlength="1" class="otp-box" inputmode="numeric" pattern="[0-9]*" autocomplete="off" required>
                    <input type="text" maxlength="1" class="otp-box" inputmode="numeric" pattern="[0-9]*" autocomplete="off" required>
                    <input type="text" maxlength="1" class="otp-box" inputmode="numeric" pattern="[0-9]*" autocomplete="off" required>
                    <input type="text" maxlength="1" class="otp-box" inputmode="numeric" pattern="[0-9]*" autocomplete="off" required>
                    <input type="text" maxlength="1" class="otp-box" inputmode="numeric" pattern="[0-9]*" autocomplete="off" required>
                </div>
                <input type="hidden" name="otp_code" id="finalOtpInput">
            </div>

            <div class="modal-footer" style="padding-top: 1rem; border-top: 1px solid var(--border-color); display: flex; justify-content: flex-end; gap: 10px;">
                <button type="button" class="btn btn-secondary" onclick="closeModal('tfaSetupModal')" style="border-radius: 9999px; padding: 8px 18px;">Batal</button>
                <button type="submit" class="btn btn-primary" id="btnVerifyTfa" style="background: #2d6a4f; border-radius: 9999px; padding: 8px 20px;">
                    <i class="fa-solid fa-check"></i>
                    <span>Verifikasi & Aktifkan</span>
                </button>
            </div>
        </form>
    </div>
</div>

{{-- =========================================================================
     MODAL 2: KODE CADANGAN PEMULIHAN (RECOVERY BACKUP CODES)
     ========================================================================= --}}
<div id="tfaRecoveryModal" class="modal-overlay">
    <div class="modal-box modal-md" style="max-width: 500px;">
        <div class="modal-header">
            <div>
                <h3 class="serif" style="margin: 0; font-size: 1.25rem; color: var(--text-main); display: flex; align-items: center; gap: 8px;">
                    <i class="fa-solid fa-ticket text-primary"></i>
                    Kode Pemulihan Cadangan (Backup Codes)
                </h3>
                <div style="font-size: 0.8rem; color: var(--text-muted); margin-top: 2px;">
                    Simpan kode ini di tempat yang aman jika Anda kehilangan akses ke ponsel.
                </div>
            </div>
            <button type="button" class="modal-close-btn" onclick="closeModal('tfaRecoveryModal')" aria-label="Tutup">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>

        <p style="font-size: 0.85rem; color: var(--text-muted); line-height: 1.5; margin-bottom: 1rem;">
            Setiap kode di bawah ini hanya dapat digunakan satu kali sebagai alternatif login jika Anda tidak membawa aplikasi authenticator:
        </p>

        <div class="recovery-codes-box" id="recoveryCodesContainer">
            <div class="recovery-code-item">8B49-3912</div>
            <div class="recovery-code-item">7A14-9821</div>
            <div class="recovery-code-item">5C29-6743</div>
            <div class="recovery-code-item">9F81-2305</div>
            <div class="recovery-code-item">3E62-8174</div>
            <div class="recovery-code-item">6D95-4018</div>
            <div class="recovery-code-item">2B38-1952</div>
            <div class="recovery-code-item">4A77-6280</div>
        </div>

        <div style="display: flex; gap: 10px; margin-bottom: 1.25rem;">
            <button type="button" class="btn btn-secondary btn-sm" style="flex: 1; border-radius: 9999px; padding: 7px 14px;" onclick="copyAllBackupCodes()">
                <i class="fa-regular fa-copy"></i>
                <span>Salin Semua Kode</span>
            </button>
            <button type="button" class="btn btn-secondary btn-sm" style="flex: 1; border-radius: 9999px; padding: 7px 14px;" onclick="downloadBackupCodes()">
                <i class="fa-solid fa-download"></i>
                <span>Unduh Berkas (.txt)</span>
            </button>
        </div>

        <div class="modal-footer" style="padding-top: 1rem; border-top: 1px solid var(--border-color); display: flex; justify-content: flex-end;">
            <button type="button" class="btn btn-primary btn-sm" onclick="closeModal('tfaRecoveryModal')" style="background: #2d6a4f; border-radius: 9999px; padding: 8px 22px;">
                <span>Saya Sudah Menyimpan</span>
            </button>
        </div>
    </div>
</div>

{{-- =========================================================================
     MODAL 3: KONFIRMASI NONAKTIFKAN 2FA
     ========================================================================= --}}
<div id="disableTfaModal" class="modal-overlay">
    <div class="modal-box modal-sm" style="max-width: 440px; text-align: center;">
        <div style="width: 56px; height: 56px; border-radius: 50%; background: #fee2e2; color: #ef4444; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; margin: 0 auto 1rem;">
            <i class="fa-solid fa-shield-halved"></i>
        </div>
        <h3 class="serif" style="font-size: 1.25rem; margin-bottom: 8px; color: var(--text-main);">Nonaktifkan 2FA?</h3>
        <p style="font-size: 0.85rem; color: var(--text-muted); margin-bottom: 1.5rem; line-height: 1.5;">
            Tingkat proteksi akun kader Anda akan menurun. Anda hanya akan memerlukan kata sandi biasa untuk login berikutnya.
        </p>
        <form action="{{ route('admin.pengaturan-akun.tfa') }}" method="POST" style="margin: 0;">
            @csrf
            <input type="hidden" name="action" value="disable">
            <div style="display: flex; justify-content: center; gap: 10px;">
                <button type="button" class="btn btn-secondary btn-sm" onclick="closeModal('disableTfaModal')" style="border-radius: 9999px; padding: 8px 18px;">
                    Batalkan
                </button>
                <button type="submit" class="btn btn-danger btn-sm" style="border-radius: 9999px; padding: 8px 18px;">
                    <i class="fa-solid fa-shield-slash"></i>
                    <span>Ya, Nonaktifkan</span>
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // 1. Tab Switching System
    const tabButtons = document.querySelectorAll('.account-tab-btn');
    const tabPanes = document.querySelectorAll('.account-tab-pane');

    tabButtons.forEach(btn => {
        btn.addEventListener('click', function() {
            const targetTab = this.getAttribute('data-tab');
            
            tabButtons.forEach(b => b.classList.remove('active'));
            tabPanes.forEach(p => p.classList.remove('active'));

            this.classList.add('active');
            const targetPane = document.getElementById('tab-' + targetTab);
            if (targetPane) {
                targetPane.classList.add('active');
            }

            // Sync URL query string without reloading page
            const newUrl = new URL(window.location.href);
            newUrl.searchParams.set('tab', targetTab);
            window.history.replaceState({}, '', newUrl);
        });
    });

    // 2. Avatar Preview on File Select
    function previewAvatar(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const previewImg = document.getElementById('profileAvatarPreview');
                if (previewImg) {
                    previewImg.src = e.target.result;
                }
                window.showToast('Foto profil dipilih. Klik "Simpan Perubahan" untuk menerapkan.', 'info');
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    // 3. Password Visibility Toggle
    function togglePasswordVisibility(inputId, btn) {
        const input = document.getElementById(inputId);
        const icon = btn.querySelector('i');
        if (input && icon) {
            const isPassword = input.getAttribute('type') === 'password';
            input.setAttribute('type', isPassword ? 'text' : 'password');
            icon.classList.toggle('fa-eye', !isPassword);
            icon.classList.toggle('fa-eye-slash', isPassword);
        }
    }

    // 4. Password Strength Meter
    function evaluatePasswordStrength(password) {
        const bar1 = document.getElementById('meterBar1');
        const bar2 = document.getElementById('meterBar2');
        const bar3 = document.getElementById('meterBar3');
        const bar4 = document.getElementById('meterBar4');
        const text = document.getElementById('passwordMeterText');

        const bars = [bar1, bar2, bar3, bar4];
        bars.forEach(b => {
            b.className = 'meter-bar';
        });

        if (!password) {
            text.textContent = 'Kekuatan kata sandi: Belum diisi';
            text.style.color = 'var(--text-muted)';
            return;
        }

        let score = 0;
        if (password.length >= 8) score++;
        if (/[A-Z]/.test(password) && /[a-z]/.test(password)) score++;
        if (/[0-9]/.test(password)) score++;
        if (/[^A-Za-z0-9]/.test(password)) score++;

        if (score === 1) {
            bar1.classList.add('active-weak');
            text.textContent = 'Kekuatan: Lemah (Tambahkan huruf besar/angka)';
            text.style.color = '#ef4444';
        } else if (score === 2) {
            bar1.classList.add('active-medium');
            bar2.classList.add('active-medium');
            text.textContent = 'Kekuatan: Cukup (Gunakan kombinasi simbol)';
            text.style.color = '#f59e0b';
        } else if (score === 3) {
            bar1.classList.add('active-good');
            bar2.classList.add('active-good');
            bar3.classList.add('active-good');
            text.textContent = 'Kekuatan: Baik (Aman)';
            text.style.color = '#0284c7';
        } else if (score >= 4) {
            bars.forEach(b => b.classList.add('active-strong'));
            text.textContent = 'Kekuatan: Sangat Kuat & Aman';
            text.style.color = '#10b981';
        }
    }

    // 5. 2FA Interactive 6-box OTP handler
    const otpBoxes = document.querySelectorAll('.otp-box');
    const finalOtpInput = document.getElementById('finalOtpInput');

    otpBoxes.forEach((box, index) => {
        box.addEventListener('input', (e) => {
            const val = e.target.value;
            // Only allow digit
            if (!/^[0-9]$/.test(val)) {
                e.target.value = '';
                return;
            }

            // Move to next input box
            if (index < otpBoxes.length - 1) {
                otpBoxes[index + 1].focus();
            }
            updateFinalOtp();
        });

        box.addEventListener('keydown', (e) => {
            if (e.key === 'Backspace' && !e.target.value && index > 0) {
                otpBoxes[index - 1].focus();
            }
        });

        box.addEventListener('paste', (e) => {
            e.preventDefault();
            const pasteData = (e.clipboardData || window.clipboardData).getData('text').trim();
            if (/^\d{6}$/.test(pasteData)) {
                pasteData.split('').forEach((ch, idx) => {
                    if (otpBoxes[idx]) otpBoxes[idx].value = ch;
                });
                updateFinalOtp();
                otpBoxes[otpBoxes.length - 1].focus();
            }
        });
    });

    function updateFinalOtp() {
        let code = '';
        otpBoxes.forEach(b => {
            code += b.value;
        });
        if (finalOtpInput) finalOtpInput.value = code;
    }

    const tfaSetupForm = document.getElementById('tfaSetupForm');
    if (tfaSetupForm) {
        tfaSetupForm.addEventListener('submit', (e) => {
            updateFinalOtp();
            if (!finalOtpInput.value || finalOtpInput.value.length !== 6) {
                e.preventDefault();
                window.showToast('Harap masukkan 6 digit kode OTP secara lengkap.', 'danger');
                if (otpBoxes[0]) otpBoxes[0].focus();
            }
        });
    }

    // 6. Copy 2FA Secret Key
    function copySecretKey() {
        const text = document.getElementById('tfaSecretKeyText')?.textContent || '';
        navigator.clipboard.writeText(text).then(() => {
            window.showToast('Kunci rahasia 2FA berhasil disalin ke papan klip.', 'success');
        });
    }

    // 7. Copy & Download Recovery Backup Codes
    function copyAllBackupCodes() {
        const codes = Array.from(document.querySelectorAll('.recovery-code-item')).map(el => el.textContent.trim()).join('\n');
        navigator.clipboard.writeText(codes).then(() => {
            window.showToast('Semua kode pemulihan berhasil disalin.', 'success');
        });
    }

    function downloadBackupCodes() {
        const codes = Array.from(document.querySelectorAll('.recovery-code-item')).map(el => el.textContent.trim()).join('\r\n');
        const content = "KODE PEMULIHAN CADANGAN 2FA (e-Posyandu)\r\n" +
                        "Dibuat untuk: {{ $profil['nama'] }} ({{ $profil['email'] }})\r\n" +
                        "Tanggal: " + new Date().toLocaleDateString('id-ID') + "\r\n" +
                        "----------------------------------------\r\n" +
                        codes + "\r\n" +
                        "----------------------------------------\r\n" +
                        "PENTING: Setiap kode hanya dapat dipakai 1 kali untuk login darurat.";
        
        const blob = new Blob([content], { type: 'text/plain;charset=utf-8' });
        const url = URL.createObjectURL(blob);
        const a = document.createElement('a');
        a.href = url;
        a.download = 'kode-cadangan-posyandu-2fa.txt';
        document.body.appendChild(a);
        a.click();
        document.body.removeChild(a);
        URL.revokeObjectURL(url);
        window.showToast('Berkas kode cadangan berhasil diunduh.', 'success');
    }
</script>
@endsection

