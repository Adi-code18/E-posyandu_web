{{--
    =============================================================================
    Halaman: Autentikasi Masuk (Login) Petugas & Kader — "Login Kader Simple"
    =============================================================================
    Desain   : Minimalist, Warm Cream Canvas (#FBF9F4), Soft Sand Inputs (#F5F2EB),
               Forest Green Accent (#2D6A4F), Tipografi Playfair Display Serif.
    Sesuai   : Figma Mockup "Login Kader Simple"
    =============================================================================
--}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    <meta name="theme-color" content="#2d6a4f">
    <title>Login Petugas — e-Posyandu</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --primary: #2d6a4f;
            --primary-hover: #1b4332;
            --bg-canvas: #fbf9f4;
            --bg-card: #ffffff;
            --bg-input: #f5f2eb;
            --border-input: #e6e1d4;
            --text-main: #1f2937;
            --text-muted: #71717a;
            --radius-md: 12px;
            --radius-lg: 20px;
        }

        *, *::before, *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background-color: var(--bg-canvas);
            color: var(--text-main);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 2rem 1.5rem;
            position: relative;
        }

        .login-wrapper {
            width: 100%;
            max-width: 410px;
            text-align: center;
            animation: fadeIn 0.4s ease forwards;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(12px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .logo-badge {
            width: 46px;
            height: 46px;
            border-radius: 12px;
            background: #e8f0ea;
            color: var(--primary);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
            margin-bottom: 1.25rem;
            box-shadow: 0 2px 8px rgba(45, 106, 79, 0.12);
        }

        h1.login-title {
            font-family: 'Playfair Display', Georgia, serif;
            font-size: 1.85rem;
            font-weight: 700;
            line-height: 1.25;
            color: var(--text-main);
            margin-bottom: 0.5rem;
        }

        p.login-subtitle {
            font-size: 0.875rem;
            color: var(--text-muted);
            margin-bottom: 2rem;
            line-height: 1.5;
        }

        .login-form {
            text-align: left;
        }

        .form-group {
            margin-bottom: 1.25rem;
        }

        label.form-label {
            display: block;
            font-size: 0.85rem;
            font-weight: 600;
            color: #374151;
            margin-bottom: 6px;
        }

        .input-group-custom {
            position: relative;
        }

        .input-group-custom i.leading-icon {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #9ca3af;
            font-size: 0.95rem;
            pointer-events: none;
        }

        .input-control {
            width: 100%;
            padding: 12px 14px 12px 42px;
            border: 1px solid var(--border-input);
            border-radius: var(--radius-md);
            background: var(--bg-input);
            font-family: inherit;
            font-size: 0.925rem;
            color: var(--text-main);
            transition: all 0.2s ease;
        }

        .input-control:focus {
            outline: none;
            border-color: var(--primary);
            background: #ffffff;
            box-shadow: 0 0 0 3px rgba(45, 106, 79, 0.15);
        }

        .input-control::placeholder {
            color: #a1a1aa;
        }

        .toggle-pwd-btn {
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #9ca3af;
            cursor: pointer;
            padding: 4px;
            font-size: 0.95rem;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: color 0.15s ease;
        }

        .toggle-pwd-btn:hover {
            color: var(--primary);
        }

        .form-options-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 1.15rem 0 1.75rem;
            font-size: 0.825rem;
        }

        .checkbox-label {
            display: flex;
            align-items: center;
            gap: 7px;
            color: #4b5563;
            cursor: pointer;
            user-select: none;
        }

        .checkbox-label input[type="checkbox"] {
            accent-color: var(--primary);
            width: 15px;
            height: 15px;
            cursor: pointer;
        }

        .forgot-link {
            color: #4b5563;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.15s ease;
        }

        .forgot-link:hover {
            color: var(--primary);
            text-decoration: underline;
        }

        .btn-submit-login {
            width: 100%;
            background: var(--primary);
            color: #ffffff;
            border: none;
            border-radius: var(--radius-md);
            padding: 13px 20px;
            font-family: inherit;
            font-size: 0.95rem;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            box-shadow: 0 4px 14px rgba(45, 106, 79, 0.25);
            transition: all 0.2s ease;
        }

        .btn-submit-login:hover {
            background: var(--primary-hover);
            transform: translateY(-1px);
            box-shadow: 0 6px 18px rgba(45, 106, 79, 0.35);
        }

        .btn-submit-login:active {
            transform: scale(0.98);
        }

        /* Fixed Page Footer */
        .login-page-footer {
            margin-top: 3.5rem;
            width: 100%;
            max-width: 900px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 0.775rem;
            color: #9ca3af;
            border-top: 1px solid rgba(0, 0, 0, 0.05);
            padding-top: 1.25rem;
            flex-wrap: wrap;
            gap: 12px;
        }

        .login-page-footer a {
            color: #9ca3af;
            text-decoration: none;
            transition: color 0.15s ease;
        }

        .login-page-footer a:hover {
            color: var(--primary);
            text-decoration: underline;
        }

        @media (max-width: 640px) {
            .login-page-footer {
                flex-direction: column;
                text-align: center;
                gap: 8px;
            }
        }
    </style>
</head>
<body>
    <div class="login-wrapper">
        <!-- Logo Badge -->
        <div class="logo-badge" title="e-Posyandu Protected">
            <i class="fa-solid fa-shield-halved"></i>
        </div>

        <!-- Headline & Subtitle -->
        <h1 class="login-title">
            Selamat Datang di e-Posyandu
        </h1>
        <p class="login-subtitle">
            Masuk untuk mengelola data kesehatan warga.
        </p>

        <!-- Form Login -->
        <form action="{{ route('admin.dashboard') }}" method="GET" class="login-form">
            <div class="form-group">
                <label class="form-label" for="usernameInput">Username atau NIK</label>
                <div class="input-group-custom">
                    <i class="fa-regular fa-user leading-icon"></i>
                    <input type="text" id="usernameInput" class="input-control" placeholder="Contoh: 3201234567890001" required autofocus>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label" for="passwordInput">Kata Sandi</label>
                <div class="input-group-custom">
                    <i class="fa-solid fa-lock leading-icon"></i>
                    <input type="password" id="passwordInput" class="input-control" placeholder="••••••••" style="padding-right: 42px;" required>
                    <button type="button" id="togglePasswordBtn" class="toggle-pwd-btn" aria-label="Lihat kata sandi">
                        <i class="fa-regular fa-eye" id="toggleEyeIcon"></i>
                    </button>
                </div>
            </div>

            <div class="form-options-row">
                <label class="checkbox-label">
                    <input type="checkbox" name="remember" checked>
                    <span>Ingat Saya</span>
                </label>
                <a href="#" class="forgot-link">Lupa kata sandi?</a>
            </div>

            <button type="submit" class="btn-submit-login">
                <span>Masuk Sekarang</span>
                <i class="fa-solid fa-arrow-right"></i>
            </button>
        </form>
    </div>

    <!-- Footer Bar -->
    <div class="login-page-footer">
        <div>
            &copy; 2024 e-Posyandu. Rooted in Community Health.
        </div>
        <div style="display: flex; gap: 16px;">
            <a href="#">Bantuan</a>
            <a href="#">Kebijakan Privasi</a>
        </div>
    </div>

    <script>
        const toggleBtn = document.getElementById('togglePasswordBtn');
        const passwordInput = document.getElementById('passwordInput');
        const eyeIcon = document.getElementById('toggleEyeIcon');

        if (toggleBtn && passwordInput && eyeIcon) {
            toggleBtn.addEventListener('click', () => {
                const isPassword = passwordInput.getAttribute('type') === 'password';
                passwordInput.setAttribute('type', isPassword ? 'text' : 'password');
                eyeIcon.classList.toggle('fa-eye', !isPassword);
                eyeIcon.classList.toggle('fa-eye-slash', isPassword);
            });
        }
    </script>
</body>
</html>
