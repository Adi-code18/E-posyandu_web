{{--
    =============================================================================
    Master Layout: Admin & Petugas Posyandu
    =============================================================================
    Deskripsi   : Kerangka master antarmuka web e-Posyandu dengan navigasi responsif,
                  drawer menu mobile, dan integrasi sistem tombol elegan.
    Breakpoint  : Desktop (>= 992px), Tablet/Mobile (< 992px)
    =============================================================================
--}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    <meta name="theme-color" content="#2d6a4f">
    <title>@yield('title', 'Admin') — e-Posyandu</title>
    
    <!-- Google Fonts: Inter & Playfair Display -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome 6 Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- e-Posyandu Design System CSS -->
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    
    <!-- Chart.js Engine -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    @yield('styles')
</head>
<body>
    <div class="admin-container">
        <!-- Backdrop Overlay untuk Mobile Drawer -->
        <div class="sidebar-backdrop" id="sidebarBackdrop"></div>

        <!-- Sidebar / Drawer Navigasi -->
        <aside class="sidebar">
            <div class="logo-section">
                <div class="logo-icon-wrap">
                    <i class="fa-solid fa-leaf"></i>
                </div>
                <span>e-Posyandu</span>
                <!-- Tombol Tutup Khusus Tampilan Mobile -->
                <button type="button" class="sidebar-close-btn" id="sidebarCloseBtn" aria-label="Tutup Menu">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            
            <nav class="nav-links">
                <ul>
                    <li class="nav-item">
                        <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                            <i class="fa-solid fa-chart-pie"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.pendaftaran') }}" class="nav-link {{ request()->routeIs('admin.pendaftaran') ? 'active' : '' }}">
                            <i class="fa-solid fa-user-plus"></i>
                            <span>Pendaftaran Masyarakat</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.daftar-anggota') }}" class="nav-link {{ request()->routeIs('admin.daftar-anggota', 'admin.profil') ? 'active' : '' }}">
                            <i class="fa-solid fa-address-card"></i>
                            <span>Daftar Anggota</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.pemeriksaan') }}" class="nav-link {{ request()->routeIs('admin.pemeriksaan') ? 'active' : '' }}">
                            <i class="fa-solid fa-stethoscope"></i>
                            <span>Pencatatan Fisik</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.laporan-kesehatan') }}" class="nav-link {{ request()->routeIs('admin.laporan-kesehatan') ? 'active' : '' }}">
                            <i class="fa-solid fa-file-medical"></i>
                            <span>Laporan Kesehatan</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('admin.manajemen-artikel') }}" class="nav-link {{ request()->routeIs('admin.manajemen-artikel') ? 'active' : '' }}">
                            <i class="fa-solid fa-newspaper"></i>
                            <span>Artikel Edukasi</span>
                        </a>
                    </li>
                </ul>
            </nav>

            <div class="sidebar-footer">
                <ul>
                    <li class="nav-item">
                        <a href="{{ route('admin.pengaturan-akun') }}" class="nav-link btn-sidebar-action {{ request()->routeIs('admin.pengaturan-akun*') ? 'active' : '' }}">
                            <i class="fa-solid fa-gear"></i>
                            <span>Pengaturan</span>
                        </a>
                    </li>
                    <li class="nav-item" style="list-style: none;">
                        <button type="button" class="nav-link btn-sidebar-action" onclick="openModal('logoutModal')" style="color: var(--danger);">
                            <i class="fa-solid fa-right-from-bracket" style="color: var(--danger);"></i>
                            <span>Keluar</span>
                        </button>
                    </li>
                </ul>
            </div>
        </aside>

        <!-- Area Konten Utama -->
        <main class="main-content">
            <!-- Header Navigasi Atas -->
            <header>
                <div class="header-left-wrap">
                    <!-- Tombol Hamburger Mobile -->
                    <button type="button" class="mobile-menu-toggle" id="mobileMenuToggle" aria-label="Buka Menu Navigasi">
                        <i class="fa-solid fa-bars"></i>
                    </button>
                    
                    <div class="header-left">
                        <span class="header-kicker">e-Posyandu</span>
                        <h2 class="serif">@yield('page_title', 'Dashboard')</h2>
                    </div>
                </div>
                
                <div class="header-right">
                    <!-- Tanggal Aktif Pill Badge seperti Desain Figma -->
                    <div class="header-date-pill">
                        <i class="fa-regular fa-calendar"></i>
                        <span>{{ now()->format('F d, Y') }}</span>
                    </div>

                    <!-- Tombol Pencarian Cepat Spotlight -->
                    <button type="button" class="icon-btn" id="headerSearchBtn" onclick="openModal('quickSearchModal')" title="Cari Data Cepat (Ctrl+K)">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>

                    <!-- Tombol & Dropdown Notifikasi Posyandu -->
                    <div class="header-action-wrapper" id="notificationWrapper">
                        <button type="button" class="icon-btn" id="notificationBtn" title="Notifikasi Posyandu" aria-expanded="false" aria-haspopup="true">
                            <i class="fa-solid fa-bell"></i>
                            <span class="badge" id="notificationBadge">3</span>
                        </button>
                        
                        <!-- Panel Flyout Notifikasi -->
                        <div class="floating-dropdown-menu notification-menu" id="notificationDropdown">
                            <div class="notif-header-box">
                                <div style="display: flex; align-items: center; justify-content: space-between; width: 100%;">
                                    <div style="display: flex; align-items: center; gap: 8px;">
                                        <span style="font-weight: 700; font-size: 0.95rem; color: var(--text-main);">Notifikasi</span>
                                        <span class="tag tag-success" style="font-size: 0.7rem; padding: 2px 8px;" id="unreadNotifBadge">3 Baru</span>
                                    </div>
                                    <button type="button" class="btn-text-link" id="markAllReadBtn">
                                        Tandai Semua Dibaca
                                    </button>
                                </div>
                            </div>
                            
                            <div class="notif-list-container" id="notificationList">
                                <a href="{{ route('admin.dashboard') }}" class="notif-row unread">
                                    <div class="notif-badge-icon green">
                                        <i class="fa-solid fa-calendar-check"></i>
                                    </div>
                                    <div class="notif-text-wrap">
                                        <div class="notif-title-text">Jadwal Sesi Penimbangan Hari Ini</div>
                                        <div class="notif-desc-text">Posko Anggrek (RW 01) siap melayani pemeriksaan balita & ibu hamil.</div>
                                        <div class="notif-time-text"><i class="fa-regular fa-clock"></i> Baru saja • Hari ini</div>
                                    </div>
                                    <span class="unread-indicator-dot"></span>
                                </a>

                                <a href="{{ route('admin.laporan-kesehatan') }}" class="notif-row unread">
                                    <div class="notif-badge-icon amber">
                                        <i class="fa-solid fa-triangle-exclamation"></i>
                                    </div>
                                    <div class="notif-text-wrap">
                                        <div class="notif-title-text">Pemantauan Gizi & Antropometri</div>
                                        <div class="notif-desc-text">3 balita di RW 01 memerlukan pemantauan berat badan berkala.</div>
                                        <div class="notif-time-text"><i class="fa-regular fa-clock"></i> 2 jam yang lalu</div>
                                    </div>
                                    <span class="unread-indicator-dot"></span>
                                </a>

                                <a href="{{ route('admin.daftar-anggota') }}" class="notif-row unread">
                                    <div class="notif-badge-icon blue">
                                        <i class="fa-solid fa-user-plus"></i>
                                    </div>
                                    <div class="notif-text-wrap">
                                        <div class="notif-title-text">Pendaftaran Anggota Balita Baru</div>
                                        <div class="notif-desc-text">Ananda Aditya Pratama (1 Thn 8 Bln) telah didaftarkan.</div>
                                        <div class="notif-time-text"><i class="fa-regular fa-clock"></i> 4 jam yang lalu</div>
                                    </div>
                                    <span class="unread-indicator-dot"></span>
                                </a>
                            </div>

                            <div class="notif-footer-box">
                                <a href="{{ route('admin.laporan-kesehatan') }}" style="font-size: 0.8rem; font-weight: 600; color: var(--primary); text-decoration: none;">
                                    Lihat Semua Aktivitas Posyandu <i class="fa-solid fa-chevron-right" style="font-size: 0.65rem;"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Tombol & Dropdown Profil Petugas -->
                    @php
                        $userDisplayName = session('kader_nama', 'Ibu Kader Rahmawati');
                        $userDisplayRole = session('kader_jabatan', 'Kader Aktif (RW 01)');
                        $userDisplayEmail = session('kader_email', 'kader.anggrek@posyandu.desa.id');
                        $userAvatar = session('kader_avatar');
                        $avatarUrl = $userAvatar ? asset($userAvatar) : 'https://ui-avatars.com/api/?name=' . urlencode($userDisplayName) . '&background=2d6a4f&color=fff';
                    @endphp
                    <div class="header-action-wrapper" id="profileWrapper">
                        <button type="button" class="profile-dropdown" id="profileDropdownBtn" aria-expanded="false" aria-haspopup="true">
                            <img src="{{ $avatarUrl }}" alt="Avatar Petugas" class="profile-avatar">
                            <span class="profile-name">{{ \Illuminate\Support\Str::limit($userDisplayName, 18) }}</span>
                            <i class="fa-solid fa-chevron-down" id="profileChevron" style="font-size: 0.7rem; color: var(--text-muted); margin-left: 4px; transition: transform 0.2s ease;"></i>
                        </button>
                        
                        <!-- Panel Flyout Profil -->
                        <div class="floating-dropdown-menu profile-menu" id="profileDropdown">
                            <div class="dropdown-header-box">
                                <div class="dropdown-user-row">
                                    <img src="{{ $avatarUrl }}" alt="Avatar Petugas" class="avatar-lg">
                                    <div style="min-width: 0;">
                                        <div class="dropdown-user-name">{{ $userDisplayName }}</div>
                                        <div class="dropdown-user-role"><i class="fa-solid fa-circle-check text-success"></i> {{ $userDisplayRole }}</div>
                                        <div style="font-size: 0.7rem; color: var(--text-muted); margin-top: 2px;">{{ $userDisplayEmail }}</div>
                                    </div>
                                </div>
                            </div>
                            
                            <ul class="dropdown-item-list">
                                <li>
                                    <a href="{{ route('admin.pengaturan-akun') }}" class="dropdown-action-item {{ request()->routeIs('admin.pengaturan-akun') ? 'active-item' : '' }}">
                                        <i class="fa-solid fa-sliders"></i>
                                        <span>Pengaturan Akun & Posko</span>
                                    </a>
                                </li>
                            </ul>
                            
                            <div class="dropdown-split-line"></div>
                            
                            <div style="padding: 0.35rem 0.5rem 0.5rem;">
                                <button type="button" class="dropdown-action-item text-danger" onclick="openModal('logoutModal'); closeAllDropdowns();" style="border-radius: var(--radius-md);">
                                    <i class="fa-solid fa-right-from-bracket"></i>
                                    <span>Keluar dari Sesi</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Pembungkus Konten Utama Halaman -->
            <div class="content-wrapper fade-in">
                {{-- Flash Message: Berhasil --}}
                @if(session('success'))
                    <div class="alert alert-success">
                        <i class="fa-solid fa-circle-check" style="font-size: 1.25rem;"></i>
                        <span>{{ session('success') }}</span>
                    </div>
                @endif

                {{-- Flash Message: Gagal / Error --}}
                @if(session('error'))
                    <div class="alert alert-danger">
                        <i class="fa-solid fa-circle-exclamation" style="font-size: 1.25rem;"></i>
                        <span>{{ session('error') }}</span>
                    </div>
                @endif

                {{-- Notifikasi Error Validasi Input --}}
                @if($errors->any())
                    <div class="alert alert-danger" style="flex-direction: column; align-items: flex-start;">
                        <div style="font-weight: 600; display: flex; align-items: center; gap: 8px;">
                            <i class="fa-solid fa-triangle-exclamation"></i>
                            <span>Terdapat beberapa kesalahan validasi pengisian data:</span>
                        </div>
                        <ul style="margin: 6px 0 0 0; padding-left: 24px; font-size: 0.875rem;">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- Konten Dinamis Halaman --}}
                @yield('content')
            </div>
        </main>
    </div>

    <!-- =========================================================================
         GLOBAL MODALS & FLOATING DIALOGS
         ========================================================================= -->

    <!-- 1. Modal Pencarian Cepat Spotlight (Ctrl+K) -->
    <div id="quickSearchModal" class="modal-overlay">
        <div class="modal-box modal-md" style="max-width: 540px; padding: 1.25rem;">
            <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 1rem;">
                <h3 class="serif" style="font-size: 1.15rem; margin: 0; color: var(--text-main); display: flex; align-items: center; gap: 8px;">
                    <i class="fa-solid fa-magnifying-glass text-primary"></i>
                    Pencarian Cepat Posyandu
                </h3>
                <button type="button" class="modal-close-btn" onclick="closeModal('quickSearchModal')" aria-label="Tutup">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>

            <div style="position: relative; margin-bottom: 1.25rem;">
                <input type="text" id="quickSearchInput" class="form-control" style="padding: 10px 14px 10px 40px; font-size: 0.95rem;" placeholder="Ketik nama warga, NIK, atau layanan...">
                <i class="fa-solid fa-search" style="position: absolute; left: 14px; top: 50%; transform: translateY(-50%); color: var(--text-muted);"></i>
            </div>

            <div style="font-size: 0.75rem; font-weight: 700; color: var(--text-muted); text-transform: uppercase; margin-bottom: 8px; letter-spacing: 0.05em;">
                Pintasan Menu & Layanan Cepat
            </div>

            <div style="display: flex; flex-direction: column; gap: 6px;">
                <a href="{{ route('admin.daftar-anggota') }}" class="dropdown-action-item" style="border-radius: var(--radius-md); padding: 8px 12px; background: var(--bg-card-subtle);">
                    <i class="fa-solid fa-users text-primary"></i>
                    <div style="flex-grow: 1;">
                        <div style="font-weight: 600; font-size: 0.875rem;">Daftar Anggota & Rekam Medis</div>
                        <div style="font-size: 0.725rem; color: var(--text-muted);">Cari data balita, ibu hamil, remaja, dan lansia</div>
                    </div>
                    <i class="fa-solid fa-arrow-right" style="font-size: 0.75rem; opacity: 0.5;"></i>
                </a>

                <a href="{{ route('admin.pendaftaran') }}" class="dropdown-action-item" style="border-radius: var(--radius-md); padding: 8px 12px; background: var(--bg-card-subtle);">
                    <i class="fa-solid fa-user-plus text-primary"></i>
                    <div style="flex-grow: 1;">
                        <div style="font-weight: 600; font-size: 0.875rem;">Pendaftaran Sasaran Baru</div>
                        <div style="font-size: 0.725rem; color: var(--text-muted);">Formulir registrasi warga sasaran baru</div>
                    </div>
                    <i class="fa-solid fa-arrow-right" style="font-size: 0.75rem; opacity: 0.5;"></i>
                </a>

                <a href="{{ route('admin.pemeriksaan') }}" class="dropdown-action-item" style="border-radius: var(--radius-md); padding: 8px 12px; background: var(--bg-card-subtle);">
                    <i class="fa-solid fa-stethoscope text-primary"></i>
                    <div style="flex-grow: 1;">
                        <div style="font-weight: 600; font-size: 0.875rem;">Pencatatan Fisik & Antropometri</div>
                        <div style="font-size: 0.725rem; color: var(--text-muted);">Input hasil ukur BB, TB, LiLA, dan tensi darah</div>
                    </div>
                    <i class="fa-solid fa-arrow-right" style="font-size: 0.75rem; opacity: 0.5;"></i>
                </a>

                <a href="{{ route('admin.laporan-kesehatan') }}" class="dropdown-action-item" style="border-radius: var(--radius-md); padding: 8px 12px; background: var(--bg-card-subtle);">
                    <i class="fa-solid fa-file-medical text-primary"></i>
                    <div style="flex-grow: 1;">
                        <div style="font-weight: 600; font-size: 0.875rem;">Laporan Kesehatan & Status Gizi</div>
                        <div style="font-size: 0.725rem; color: var(--text-muted);">Evaluasi status gizi stunting dan grafik rekap posyandu</div>
                    </div>
                    <i class="fa-solid fa-arrow-right" style="font-size: 0.75rem; opacity: 0.5;"></i>
                </a>
            </div>
        </div>
    </div>

    <!-- 2. Modal Pengaturan Akun & Posko Posyandu -->
    <div id="settingsModal" class="modal-overlay">
        <div class="modal-box modal-md">
            <div class="modal-header">
                <div>
                    <h3 class="serif" style="font-size: 1.25rem; margin: 0; color: var(--text-main);">
                        <i class="fa-solid fa-sliders text-primary" style="margin-right: 8px;"></i>
                        Pengaturan Akun & Posko
                    </h3>
                    <div style="font-size: 0.825rem; color: var(--text-muted); margin-top: 2px;">
                        Konfigurasi informasi pos pelayanan terpadu dan kontak kader aktif.
                    </div>
                </div>
                <button type="button" class="modal-close-btn" onclick="closeModal('settingsModal')" aria-label="Tutup">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>

            <form id="settingsForm" onsubmit="handleSaveSettings(event)">
                <div style="display: flex; flex-direction: column; gap: 14px;">
                    <div class="form-group">
                        <label class="form-label">Nama Posko Posyandu</label>
                        <input type="text" id="settingPoskoName" class="form-control" value="Posyandu Anggrek 01" required>
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px;">
                        <div class="form-group">
                            <label class="form-label">Wilayah Rukun Warga (RW)</label>
                            <input type="text" id="settingRW" class="form-control" value="RW 01" required>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Desa / Kelurahan</label>
                            <input type="text" id="settingDesa" class="form-control" value="Desa Sejahtera" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Bidan Pembina / Koordinator Wilayah</label>
                        <input type="text" id="settingBidan" class="form-control" value="Bidan Siti Aminah, S.Tr.Keb" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Nomor WhatsApp Pengingat Jadwal</label>
                        <input type="text" id="settingWA" class="form-control" value="0812-3456-7890" required>
                    </div>

                    <div style="display: flex; align-items: center; justify-content: space-between; padding: 12px; background: var(--bg-card-subtle); border-radius: var(--radius-md); border: 1px solid var(--border-color-light);">
                        <div>
                            <div style="font-weight: 600; font-size: 0.875rem; color: var(--text-main);">Kirim Notifikasi Otomatis</div>
                            <div style="font-size: 0.775rem; color: var(--text-muted);">Kirim pesan pengingat ke warga H-1 jadwal posyandu</div>
                        </div>
                        <input type="checkbox" id="settingNotifToggle" checked style="width: 18px; height: 18px; cursor: pointer; accent-color: var(--primary);">
                    </div>
                </div>

                <div class="modal-footer" style="margin-top: 1.5rem; padding-top: 1rem; border-top: 1px solid var(--border-color); display: flex; justify-content: flex-end; gap: 10px;">
                    <button type="button" class="btn btn-secondary btn-sm" onclick="closeModal('settingsModal')">Batal</button>
                    <button type="submit" class="btn btn-primary btn-sm">
                        <i class="fa-solid fa-floppy-disk"></i>
                        <span>Simpan Perubahan</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- 3. Modal Konfirmasi Keluar dari Sistem (Logout) -->
    <div id="logoutModal" class="modal-overlay">
        <div class="modal-box modal-sm" style="max-width: 420px; text-align: center;">
            <div style="width: 56px; height: 56px; border-radius: 50%; background: #fee2e2; color: #ef4444; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; margin: 0 auto 1rem;">
                <i class="fa-solid fa-right-from-bracket"></i>
            </div>
            <h3 class="serif" style="font-size: 1.25rem; margin-bottom: 6px; color: var(--text-main);">Keluar dari Sesi Kerja?</h3>
            <p style="font-size: 0.875rem; color: var(--text-muted); margin-bottom: 1.5rem; line-height: 1.5;">
                Pastikan seluruh pencatatan data pemeriksaan posyandu telah tersimpan sebelum mengakhiri sesi.
            </p>
            <div style="display: flex; justify-content: center; gap: 10px;">
                <button type="button" class="btn btn-secondary btn-sm" onclick="closeModal('logoutModal')">
                    Tetap di Sini
                </button>
                <a href="{{ route('login') }}" class="btn btn-danger btn-sm">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    <span>Ya, Keluar</span>
                </a>
            </div>
        </div>
    </div>

    <!-- 5. Floating Toast Notification Container -->
    <div class="toast-container" id="globalToastContainer"></div>

    <!-- Script Interaksi & Navigasi -->
    <script src="{{ asset('js/admin.js') }}"></script>
    @yield('scripts')
</body>
</html>
