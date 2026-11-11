<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Desain Status & Error Code - e-Posyandu</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Playfair+Display:ital,wght@0,600;0,700;0,800;1,600&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Favicon Logo Resmi -->
    <link rel="icon" type="image/png" href="{{ asset('assets/e-posyandu.png') }}">

    <style>
        :root {
            --primary: #4a7c59;
            --primary-dark: #375e43;
            --primary-light: #e8f5ec;
            --bg-page: #f8f7f2;
            --bg-card: #ffffff;
            --text-main: #2c3e50;
            --text-muted: #7f8c8d;
            --shadow: 0 20px 60px rgba(44, 62, 80, 0.08);
            --border-radius: 28px;
            --accent-green: #27ae60;
            --accent-amber: #e67e22;
            --accent-red: #e74c3c;
            --accent-purple: #8e44ad;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-page);
            color: var(--text-main);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 2rem 1.5rem 4rem;
            position: relative;
            background-image: 
                radial-gradient(circle at 10% 10%, rgba(74, 124, 89, 0.08) 0%, transparent 40%),
                radial-gradient(circle at 90% 90%, rgba(212, 163, 115, 0.1) 0%, transparent 45%);
        }

        /* Top Header Bar */
        .top-navbar {
            width: 100%;
            max-width: 1000px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            flex-wrap: wrap;
            gap: 15px;
        }

        .brand-pill {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            color: var(--text-main);
            font-weight: 700;
            font-size: 1.1rem;
            background: white;
            padding: 8px 20px;
            border-radius: 50px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.04);
            border: 1px solid rgba(74, 124, 89, 0.15);
        }

        .brand-logo-icon {
            width: 32px;
            height: 32px;
            background: var(--primary);
            color: white;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.95rem;
        }

        .nav-actions {
            display: flex;
            gap: 10px;
            align-items: center;
        }

        .nav-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 18px;
            border-radius: 50px;
            font-size: 0.85rem;
            font-weight: 600;
            text-decoration: none;
            color: var(--primary);
            background: white;
            border: 1px solid rgba(74, 124, 89, 0.2);
            transition: all 0.25s ease;
        }

        .nav-btn:hover {
            background: var(--primary);
            color: white;
            transform: translateY(-2px);
        }

        /* Hero Intro */
        .intro-section {
            text-align: center;
            max-width: 700px;
            margin-bottom: 2rem;
        }

        .intro-section h2 {
            font-family: 'Playfair Display', serif;
            font-size: 2.2rem;
            margin-bottom: 0.5rem;
            color: var(--text-main);
        }

        .intro-section p {
            color: var(--text-muted);
            font-size: 0.95rem;
            line-height: 1.6;
        }

        /* Selector Bar & Filter Buttons */
        .code-explorer {
            width: 100%;
            max-width: 1000px;
            background: white;
            border-radius: 20px;
            padding: 1.2rem;
            box-shadow: 0 4px 25px rgba(0,0,0,0.04);
            margin-bottom: 2.5rem;
            border: 1px solid #eaeaea;
        }

        .filter-tabs {
            display: flex;
            justify-content: center;
            gap: 8px;
            margin-bottom: 1rem;
            flex-wrap: wrap;
        }

        .tab-btn {
            background: #f4f4f4;
            border: none;
            padding: 6px 16px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            color: #666;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .tab-btn.active, .tab-btn:hover {
            background: var(--primary);
            color: white;
        }

        .pills-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            justify-content: center;
        }

        .code-pill {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 16px;
            border-radius: 12px;
            border: 1px solid #e0e0e0;
            background: #fafafa;
            color: #444;
            text-decoration: none;
            font-size: 0.85rem;
            font-weight: 600;
            transition: all 0.25s ease;
            cursor: pointer;
        }

        .code-pill:hover {
            transform: translateY(-2px);
            border-color: var(--primary);
            box-shadow: 0 4px 12px rgba(0,0,0,0.06);
        }

        .code-pill.active {
            background: var(--text-main);
            color: white;
            border-color: var(--text-main);
            box-shadow: 0 6px 18px rgba(44, 62, 80, 0.2);
        }

        .pill-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
        }

        .dot-2xx { background: #27ae60; }
        .dot-4xx { background: #e67e22; }
        .dot-5xx { background: #e74c3c; }

        /* Main Preview Stage */
        .preview-stage {
            width: 100%;
            max-width: 720px;
            background: var(--bg-card);
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
            padding: 3.5rem 3rem;
            text-align: center;
            border: 1px solid rgba(255, 255, 255, 0.8);
            position: relative;
            animation: fadeIn 0.4s ease forwards;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(15px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 6px 18px;
            border-radius: 50px;
            font-size: 0.75rem;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
            margin-bottom: 1.5rem;
            border: 1px solid transparent;
        }

        .badge-2xx {
            background: #eafaf1;
            color: #27ae60;
            border-color: rgba(39, 174, 96, 0.25);
        }

        .badge-4xx {
            background: #fdf3e7;
            color: #d35400;
            border-color: rgba(211, 84, 0, 0.25);
        }

        .badge-5xx {
            background: #fdf2f2;
            color: #e74c3c;
            border-color: rgba(231, 76, 60, 0.25);
        }

        .visual-container {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.5rem;
            user-select: none;
        }

        .big-code {
            font-family: 'Playfair Display', serif;
            font-size: clamp(6.5rem, 15vw, 9.5rem);
            font-weight: 800;
            line-height: 0.9;
            letter-spacing: -3px;
        }

        .big-code.code-2xx {
            background: linear-gradient(135deg, #27ae60 20%, #4a7c59 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .big-code.code-4xx {
            background: linear-gradient(135deg, #e67e22 20%, #c0392b 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .big-code.code-5xx {
            background: linear-gradient(135deg, #c0392b 20%, #8e44ad 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .icon-floating-box {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 86px;
            height: 86px;
            border-radius: 50%;
            background: white;
            box-shadow: 0 10px 30px rgba(0,0,0,0.12);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.2rem;
            animation: floatUpDown 3s ease-in-out infinite;
        }

        @keyframes floatUpDown {
            0%, 100% { transform: translate(-50%, -50%) translateY(0); }
            50% { transform: translate(-50%, -50%) translateY(-8px); }
        }

        h1.error-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.85rem;
            font-weight: 700;
            color: var(--text-main);
            margin-bottom: 0.85rem;
            line-height: 1.3;
        }

        p.error-message {
            font-size: 0.98rem;
            color: var(--text-muted);
            line-height: 1.65;
            margin-bottom: 2rem;
            max-width: 520px;
            margin-left: auto;
            margin-right: auto;
        }

        .context-box {
            background: #fafafa;
            border: 1px dashed #e0e0e0;
            border-radius: 16px;
            padding: 1.1rem 1.4rem;
            margin-bottom: 2.2rem;
            text-align: left;
            font-size: 0.85rem;
            color: #666;
            display: flex;
            align-items: flex-start;
            gap: 12px;
        }

        .context-box i {
            color: var(--primary);
            font-size: 1.2rem;
            margin-top: 2px;
        }

        .action-group {
            display: flex;
            gap: 14px;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            padding: 13px 26px;
            border-radius: 14px;
            font-weight: 600;
            font-size: 0.92rem;
            text-decoration: none;
            transition: all 0.3s ease;
            cursor: pointer;
            border: none;
        }

        .btn-primary {
            background: var(--primary);
            color: white;
            box-shadow: 0 6px 20px rgba(74, 124, 89, 0.25);
        }

        .btn-primary:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(74, 124, 89, 0.35);
        }

        .btn-secondary {
            background: #ffffff;
            color: var(--text-main);
            border: 1px solid #ddd;
        }

        .btn-secondary:hover {
            background: #fdfdfd;
            border-color: #bbb;
            transform: translateY(-2px);
        }

        .btn-simulate {
            background: #f8f9fa;
            color: #666;
            border: 1px solid #e0e0e0;
            font-size: 0.8rem;
            padding: 8px 16px;
            border-radius: 10px;
        }

        .btn-simulate:hover {
            background: #eef2f5;
            color: #333;
        }

        /* Footer */
        .page-footer {
            margin-top: 3rem;
            text-align: center;
            font-size: 0.85rem;
            color: #888;
        }

        @media (max-width: 600px) {
            .preview-stage {
                padding: 2.5rem 1.5rem;
            }
            .action-group {
                flex-direction: column;
                width: 100%;
            }
            .btn {
                width: 100%;
            }
        }
    </style>
</head>
<body>

    <!-- Top Navigation Bar -->
    <header class="top-navbar">
        <a href="{{ route('admin.dashboard') }}" class="brand-pill">
            <div class="brand-logo-icon" style="background: transparent;">
                <img src="{{ asset('assets/e-posyandu.png') }}" alt="Logo e-Posyandu" style="width: 32px; height: 32px; object-fit: contain;">
            </div>
            <span>e-Posyandu</span>
        </a>

        <div class="nav-actions">
            <a href="{{ route('admin.dashboard') }}" class="nav-btn">
                <i class="fa-solid fa-gauge-high"></i> Dashboard
            </a>
            <a href="{{ route('login') }}" class="nav-btn">
                <i class="fa-solid fa-arrow-right-to-bracket"></i> Login
            </a>
        </div>
    </header>

    <!-- Intro Header -->
    <section class="intro-section">
        <h2>Desain Status & Error Code</h2>
        <p>Jelajahi dan uji desain antarmuka seluruh respon kode HTTP sistem informasi e-Posyandu, mulai dari status <strong>2xx (Sukses)</strong>, <strong>4xx (Kesalahan Klien)</strong>, hingga <strong>5xx (Kesalahan Server)</strong>.</p>
    </section>

    <!-- Code Switcher Explorer -->
    <section class="code-explorer">
        <!-- Category Filter Tabs -->
        <div class="filter-tabs">
            <button class="tab-btn active" onclick="filterCategory('all', this)">Semua ({{ count($statusCodes) }})</button>
            <button class="tab-btn" onclick="filterCategory('2xx', this)"><i class="fa-solid fa-circle" style="font-size: 0.5rem; color: #27ae60; margin-right: 4px;"></i> 2xx Sukses</button>
            <button class="tab-btn" onclick="filterCategory('4xx', this)"><i class="fa-solid fa-circle" style="font-size: 0.5rem; color: #e67e22; margin-right: 4px;"></i> 4xx Klien</button>
            <button class="tab-btn" onclick="filterCategory('5xx', this)"><i class="fa-solid fa-circle" style="font-size: 0.5rem; color: #e74c3c; margin-right: 4px;"></i> 5xx Server</button>
        </div>

        <!-- Code Pills Grid -->
        <div class="pills-grid">
            @foreach($statusCodes as $item)
            <button 
                class="code-pill {{ $item['code'] === $activeCode ? 'active' : '' }}" 
                data-category="{{ $item['category'] }}"
                data-code="{{ $item['code'] }}"
                onclick="loadCode('{{ $item['code'] }}')"
                title="{{ $item['title'] }}">
                <span class="pill-dot dot-{{ $item['category'] }}"></span>
                <span>{{ $item['code'] }}</span>
            </button>
            @endforeach
        </div>
    </section>

    <!-- Main Dynamic Preview Stage -->
    <main class="preview-stage" id="previewStage">
        <!-- Badge -->
        <span class="status-badge {{ $current['badge_class'] }}" id="previewBadge">
            <i class="fa-solid {{ $current['icon'] }}"></i>
            <span id="badgeText">{{ $current['badge'] }}</span>
        </span>

        <!-- Hero Code Visual -->
        <div class="visual-container">
            <div class="big-code {{ $current['code_class'] }}" id="bigCode">
                {{ $current['code'] }}
            </div>
            <div class="icon-floating-box" id="iconBox">
                <i class="fa-solid {{ $current['icon'] }}" id="previewIcon" style="color: {{ $current['color'] }};"></i>
            </div>
        </div>

        <!-- Title & Message -->
        <h1 class="error-title" id="previewTitle">{{ $current['title'] }}</h1>
        <p class="error-message" id="previewMessage">{{ $current['message'] }}</p>

        <!-- Diagnostic Context Box -->
        <div class="context-box">
            <i class="fa-solid fa-circle-info"></i>
            <div>
                <strong>Penjelasan Sistem Posyandu:</strong><br>
                <span id="previewDetail">{{ $current['detail'] }}</span>
            </div>
        </div>

        <!-- Actions -->
        <div class="action-group" id="actionGroup">
            <a href="{{ $current['primary_btn_url'] }}" class="btn btn-primary" id="primaryBtn">
                <i class="fa-solid fa-arrow-right"></i>
                <span id="primaryBtnText">{{ $current['primary_btn_text'] }}</span>
            </a>
            <a href="{{ $current['secondary_btn_url'] }}" class="btn btn-secondary" id="secondaryBtn">
                <i class="fa-solid fa-list-check"></i>
                <span id="secondaryBtnText">{{ $current['secondary_btn_text'] }}</span>
            </a>
        </div>
    </main>

    <!-- Page Footer -->
    <footer class="page-footer">
        <p>© 2024 e-Posyandu • Sistem Informasi Pelayanan Pos Pelayanan Terpadu</p>
    </footer>

    <!-- Interactive Switcher Script (Zero Reload for smooth experience) -->
    <script>
        const statusDatabase = @json($statusCodes);

        function filterCategory(category, buttonEl) {
            document.querySelectorAll('.tab-btn').forEach(btn => btn.classList.remove('active'));
            buttonEl.classList.add('active');

            document.querySelectorAll('.code-pill').forEach(pill => {
                if (category === 'all' || pill.dataset.category === category) {
                    pill.style.display = 'inline-flex';
                } else {
                    pill.style.display = 'none';
                }
            });
        }

        function loadCode(code) {
            const data = statusDatabase[code];
            if (!data) return;

            // Update active pill button
            document.querySelectorAll('.code-pill').forEach(pill => {
                pill.classList.toggle('active', pill.dataset.code === code);
            });

            // Update URL query string without reloading page
            const newUrl = new URL(window.location);
            newUrl.searchParams.set('code', code);
            window.history.pushState({}, '', newUrl);

            // Animate transition
            const stage = document.getElementById('previewStage');
            stage.style.opacity = '0';
            stage.style.transform = 'translateY(10px)';

            setTimeout(() => {
                // Update badge
                const badge = document.getElementById('previewBadge');
                badge.className = `status-badge ${data.badge_class}`;
                document.getElementById('badgeText').innerText = data.badge;

                // Update Big Code & Icon
                const bigCode = document.getElementById('bigCode');
                bigCode.className = `big-code ${data.code_class}`;
                bigCode.innerText = data.code;

                const icon = document.getElementById('previewIcon');
                icon.className = `fa-solid ${data.icon}`;
                icon.style.color = data.color;

                // Update Texts
                document.getElementById('previewTitle').innerText = data.title;
                document.getElementById('previewMessage').innerText = data.message;
                document.getElementById('previewDetail').innerText = data.detail;

                // Update Action Buttons
                const primaryBtn = document.getElementById('primaryBtn');
                primaryBtn.setAttribute('href', data.primary_btn_url);
                document.getElementById('primaryBtnText').innerText = data.primary_btn_text;

                const secondaryBtn = document.getElementById('secondaryBtn');
                secondaryBtn.setAttribute('href', data.secondary_btn_url);
                document.getElementById('secondaryBtnText').innerText = data.secondary_btn_text;

                // Animate in
                stage.style.opacity = '1';
                stage.style.transform = 'translateY(0)';
            }, 180);
        }
    </script>
</body>
</html>

