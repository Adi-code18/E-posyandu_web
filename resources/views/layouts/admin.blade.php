<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - e-Posyandu Admin</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    @yield('styles')
</head>
<body>
    <div class="admin-container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="logo-section">
                <img src="https://cdn-icons-png.flaticon.com/512/3063/3063067.png" alt="Logo">
                <span>e-Posyandu</span>
            </div>
            
            <nav class="nav-links">
                <ul>

                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <i class="fa-solid fa-gauge-high"></i>
                        Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.pendaftaran') }}" class="nav-link {{ request()->routeIs('admin.pendaftaran') ? 'active' : '' }}">
                        <i class="fa-solid fa-user-plus"></i>
                        Pendaftaran Anggota
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.daftar-anggota') }}" class="nav-link {{ request()->routeIs('admin.daftar-anggota') ? 'active' : '' }}">
                        <i class="fa-solid fa-users"></i>
                        Daftar Anggota
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.manajemen-produk') }}" class="nav-link {{ request()->routeIs('admin.manajemen-produk') ? 'active' : '' }}">
                        <i class="fa-solid fa-boxes-stacked"></i>
                        Manajemen Produk
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.manajemen-artikel') }}" class="nav-link {{ request()->routeIs('admin.manajemen-artikel') ? 'active' : '' }}">
                        <i class="fa-solid fa-newspaper"></i>
                        Manajemen Artikel
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.laporan-keuangan') }}" class="nav-link {{ request()->routeIs('admin.laporan-keuangan') ? 'active' : '' }}">
                        <i class="fa-solid fa-file-invoice-dollar"></i>
                        Laporan Keuangan
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.laporan-kesehatan') }}" class="nav-link {{ request()->routeIs('admin.laporan-kesehatan') ? 'active' : '' }}">
                        <i class="fa-solid fa-notes-medical"></i>
                        Laporan Kesehatan
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('status.index') }}" class="nav-link" target="_blank" style="color: var(--primary); font-weight: 600;">
                        <i class="fa-solid fa-shapes"></i>
                        Status & Error Code
                    </a>
                </li>


                </ul>
            </nav>

            
                <ul>
                    <li class="nav-item">
                        <a href="{{ route('admin.dashboard') }}" class="nav-link">
                            <i class="fa-solid fa-gear"></i>
                            Pengaturan
                        </a>
                    </li>
                    <li class="nav-item" style="list-style: none;">
                        <a href="{{ route('login') }}" class="nav-link" style="color: #e74c3c;">
                            <i class="fa-solid fa-right-from-bracket"></i>
                            Keluar
                        </a>
                    </li>
                </ul>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <header>
                <div class="header-left">
                    <div class="breadcrumbs">
                        @yield('breadcrumbs', 'Beranda')
                    </div>
                    <h2 class="serif">@yield('page_title', 'Dashboard')</h2>
                </div>
                
                <div class="header-right">
                    <!-- Global Search -->
                    <a href="{{ route('admin.daftar-anggota') }}" class="icon-btn" title="Cari data..." style="text-decoration: none; color: inherit;">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </a>

                    <!-- Notification System -->
                    <div class="icon-btn" title="Notifikasi">
                        <i class="fa-solid fa-bell"></i>
                        <span class="badge">3</span>
                    </div>

                    <!-- Profile Dropdown -->
                    <div class="profile-dropdown">
                        <img src="https://ui-avatars.com/api/?name=Ibu+Kader&background=4a7c59&color=fff" alt="Profile" class="profile-avatar">
                        <span class="profile-name">Ibu Kader</span>
                        <i class="fa-solid fa-chevron-down" style="font-size: 0.7rem; margin-left: 5px;"></i>
                    </div>
                </div>
            </header>

            <div class="content-wrapper fade-in">
                {{-- Flash Message Alerts --}}
                @if(session('success'))
                    <div style="background: #e8f5e9; color: #2e7d32; border: 1px solid #c8e6c9; padding: 14px 18px; border-radius: 12px; margin-bottom: 20px; display: flex; align-items: center; gap: 12px; font-weight: 500; box-shadow: 0 2px 8px rgba(46,125,50,0.08);">
                        <i class="fa-solid fa-circle-check" style="font-size: 1.2rem;"></i>
                        <span>{{ session('success') }}</span>
                    </div>
                @endif

                @if(session('error'))
                    <div style="background: #ffebee; color: #c62828; border: 1px solid #ffcdd2; padding: 14px 18px; border-radius: 12px; margin-bottom: 20px; display: flex; align-items: center; gap: 12px; font-weight: 500; box-shadow: 0 2px 8px rgba(198,40,40,0.08);">
                        <i class="fa-solid fa-circle-exclamation" style="font-size: 1.2rem;"></i>
                        <span>{{ session('error') }}</span>
                    </div>
                @endif

                @if($errors->any())
                    <div style="background: #ffebee; color: #c62828; border: 1px solid #ffcdd2; padding: 14px 18px; border-radius: 12px; margin-bottom: 20px; box-shadow: 0 2px 8px rgba(198,40,40,0.08);">
                        <div style="font-weight: 600; margin-bottom: 6px; display: flex; align-items: center; gap: 8px;">
                            <i class="fa-solid fa-triangle-exclamation"></i>
                            <span>Terdapat beberapa kesalahan pengisian formulir:</span>
                        </div>
                        <ul style="margin: 0; padding-left: 24px; font-size: 0.9rem;">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @yield('content')
            </div>
        </main>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/admin.js') }}"></script>
    @yield('scripts')
</body>
</html>
