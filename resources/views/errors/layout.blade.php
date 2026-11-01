<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Status Layanan') - e-Posyandu</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Playfair+Display:ital,wght@0,600;0,700;0,800;1,600&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

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
            --accent-blue: #2980b9;
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
            justify-content: center;
            padding: 2rem 1.5rem;
            position: relative;
            overflow-x: hidden;
            background-image: 
                radial-gradient(circle at 15% 15%, rgba(74, 124, 89, 0.08) 0%, transparent 40%),
                radial-gradient(circle at 85% 85%, rgba(212, 163, 115, 0.1) 0%, transparent 45%);
        }

        /* Decorative background elements */
        .ambient-shape-1 {
            position: absolute;
            top: -100px;
            left: -100px;
            width: 350px;
            height: 350px;
            border-radius: 50%;
            background: linear-gradient(135deg, rgba(74, 124, 89, 0.1), rgba(132, 165, 157, 0.05));
            filter: blur(50px);
            z-index: 0;
            pointer-events: none;
        }

        .ambient-shape-2 {
            position: absolute;
            bottom: -80px;
            right: -80px;
            width: 400px;
            height: 400px;
            border-radius: 50%;
            background: linear-gradient(135deg, rgba(212, 163, 115, 0.12), rgba(231, 76, 60, 0.06));
            filter: blur(60px);
            z-index: 0;
            pointer-events: none;
        }

        /* Top Brand Navigation */
        .brand-nav {
            position: fixed;
            top: 1.5rem;
            left: 2rem;
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            color: var(--text-main);
            font-weight: 700;
            font-size: 1.1rem;
            z-index: 10;
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(10px);
            padding: 8px 18px;
            border-radius: 50px;
            border: 1px solid rgba(74, 124, 89, 0.15);
            transition: all 0.3s ease;
        }

        .brand-nav:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0,0,0,0.06);
            background: #ffffff;
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

        /* Top Right Code Switcher Link */
        .switcher-link {
            position: fixed;
            top: 1.5rem;
            right: 2rem;
            display: flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
            color: var(--primary);
            font-weight: 600;
            font-size: 0.85rem;
            z-index: 10;
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(10px);
            padding: 8px 18px;
            border-radius: 50px;
            border: 1px solid rgba(74, 124, 89, 0.2);
            transition: all 0.3s ease;
        }

        .switcher-link:hover {
            background: var(--primary);
            color: white;
            transform: translateY(-2px);
        }

        /* Main Error Card */
        .error-card {
            position: relative;
            z-index: 1;
            background: var(--bg-card);
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
            width: 100%;
            max-width: 680px;
            padding: 3.5rem 3rem;
            text-align: center;
            border: 1px solid rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            animation: cardEntrance 0.7s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }

        @keyframes cardEntrance {
            from {
                opacity: 0;
                transform: translateY(35px) scale(0.98);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        /* Badge Pill */
        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 6px 16px;
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

        /* Big Hero Number & Visual Illustration */
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
            background: linear-gradient(135deg, #2c3e50 30%, #7f8c8d 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            opacity: 0.95;
            position: relative;
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

        /* Floating Icon Avatar inside Big Code */
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

        /* Titles and Typography */
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

        /* Technical Context Box */
        .context-box {
            background: #fafafa;
            border: 1px dashed #e0e0e0;
            border-radius: 16px;
            padding: 1rem 1.25rem;
            margin-bottom: 2.2rem;
            text-align: left;
            font-size: 0.82rem;
            color: #666;
            display: flex;
            align-items: flex-start;
            gap: 12px;
        }

        .context-box i {
            color: var(--primary);
            font-size: 1.1rem;
            margin-top: 2px;
        }

        /* Action Buttons */
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
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
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
            box-shadow: 0 6px 15px rgba(0,0,0,0.04);
        }

        /* Footer */
        .error-footer {
            margin-top: 2.5rem;
            font-size: 0.78rem;
            color: #a0a0a0;
            display: flex;
            align-items: center;
            gap: 15px;
            justify-content: center;
            z-index: 1;
        }

        .error-footer a {
            color: inherit;
            text-decoration: none;
            transition: color 0.2s ease;
        }

        .error-footer a:hover {
            color: var(--primary);
        }

        @media (max-width: 600px) {
            .error-card {
                padding: 2.5rem 1.5rem;
            }

            .brand-nav, .switcher-link {
                position: static;
                margin-bottom: 1rem;
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
    <div class="ambient-shape-1"></div>
    <div class="ambient-shape-2"></div>

    <!-- Navigation Header -->
    <a href="{{ route('admin.dashboard') }}" class="brand-nav">
        <div class="brand-logo-icon">
            <i class="fa-solid fa-shield-heart"></i>
        </div>
        <span>e-Posyandu</span>
    </a>

    <a href="{{ url('/status') }}" class="switcher-link" title="Jelajahi seluruh status error & respon kode">
        <i class="fa-solid fa-shapes"></i>
        <span>Katalog Status Code</span>
    </a>

    <!-- Card Content -->
    <div class="error-card">
        <!-- Badge -->
        @yield('badge')

        <!-- Hero Code Visual -->
        <div class="visual-container">
            <div class="big-code @yield('code-class')">
                @yield('code', '404')
            </div>
            <div class="icon-floating-box">
                @yield('icon', '<i class="fa-solid fa-triangle-exclamation" style="color: var(--accent-amber);"></i>')
            </div>
        </div>

        <!-- Title & Message -->
        <h1 class="error-title">@yield('title')</h1>
        <p class="error-message">@yield('message')</p>

        <!-- Context / Diagnostic Info -->
        <div class="context-box">
            <i class="fa-solid fa-circle-info"></i>
            <div>
                <strong>Informasi Penanganan Posyandu:</strong><br>
                <span>@yield('detail', 'Pastikan alamat URL atau parameter data warga yang Anda cari sudah sesuai dengan ketentuan sistem e-Posyandu.')</span>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="action-group">
            @yield('actions')
        </div>
    </div>

    <!-- Footer -->
    <div class="error-footer">
        <span>© 2024 e-Posyandu • Rooted in Community Health</span>
        <span>•</span>
        <a href="{{ route('admin.dashboard') }}">Beranda</a>
        <span>•</span>
        <a href="{{ url('/status') }}">Daftar HTTP Code</a>
        <span>•</span>
        <a href="{{ route('login') }}">Masuk Kembali</a>
    </div>
</body>
</html>

