<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - e-Posyandu</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --primary: #4a7c59;
            --bg-main: #f8f7f2;
            --bg-card: #ffffff;
            --text-main: #2c3e50;
            --text-muted: #7f8c8d;
            --shadow: 0 4px 30px rgba(0, 0, 0, 0.08);
            --border-radius: 20px;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-main);
            color: var(--text-main);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            background-image: radial-gradient(circle at 10% 20%, rgba(74, 124, 89, 0.05) 0%, transparent 40%);
        }

        .login-card {
            background: var(--bg-card);
            padding: 3rem;
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
            width: 100%;
            max-width: 450px;
            text-align: center;
            position: relative;
            overflow: hidden;
            animation: slideUp 0.6s ease;
        }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .logo-box {
            width: 60px;
            height: 60px;
            background: var(--bg-main);
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            color: var(--primary);
            font-size: 1.5rem;
            border: 1px solid rgba(74, 124, 89, 0.2);
        }

        h1 {
            font-family: 'Playfair Display', serif;
            font-size: 1.8rem;
            margin-bottom: 0.5rem;
        }

        p {
            color: var(--text-muted);
            font-size: 0.9rem;
            margin-bottom: 2.5rem;
        }

        .form-group {
            text-align: left;
            margin-bottom: 1.5rem;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            font-size: 0.85rem;
        }

        .input-wrapper {
            position: relative;
        }

        .input-wrapper i {
            position: absolute;
            left: 15px;
            top: 15px;
            color: var(--text-muted);
        }

        .form-control {
            width: 100%;
            padding: 12px 15px 12px 45px;
            border: 1px solid #eee;
            border-radius: 12px;
            font-family: inherit;
            background: #fafafa;
            transition: all 0.3s ease;
            box-sizing: border-box;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary);
            background: #fff;
            box-shadow: 0 0 0 4px rgba(74, 124, 89, 0.1);
        }

        .options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            font-size: 0.85rem;
        }

        .btn-login {
            background: var(--primary);
            color: white;
            border: none;
            width: 100%;
            padding: 14px;
            border-radius: 12px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            text-decoration: none;
        }

        .btn-login:hover {
            background: #3e684a;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(74, 124, 89, 0.3);
        }

        .footer {
            position: fixed;
            bottom: 2rem;
            width: 100%;
            display: flex;
            justify-content: space-between;
            padding: 0 3rem;
            font-size: 0.8rem;
            color: var(--text-muted);
            box-sizing: border-box;
        }

        a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 600;
        }
    </style>
</head>
<body>
    <div class="login-card">
        <div class="logo-box">
            <i class="fa-solid fa-shield-heart"></i>
        </div>
        <h1>Selamat Datang di e-Posyandu</h1>
        <p>Masuk untuk mengelola data kesehatan warga.</p>

        <form action="{{ route('admin.dashboard') }}" method="GET">
            <div class="form-group">
                <label>Username atau NIK</label>
                <div class="input-wrapper">
                    <i class="fa-regular fa-user"></i>
                    <input type="text" class="form-control" placeholder="Contoh: 3201234567890001">
                </div>
            </div>

            <div class="form-group">
                <label>Kata Sandi</label>
                <div class="input-wrapper">
                    <i class="fa-solid fa-lock"></i>
                    <input type="password" id="passwordInput" class="form-control" placeholder="••••••••">
                    <i class="fa-regular fa-eye" id="togglePassword" style="left: auto; right: 15px; cursor: pointer;"></i>
                </div>
            </div>

            <div class="options">
                <label style="display: flex; align-items: center; gap: 8px; font-weight: 400;">
                    <input type="checkbox"> Ingat Saya
                </label>
                <a href="#">Lupa kata sandi?</a>
            </div>

            <button type="submit" class="btn-login">
                Masuk Sekarang
                <i class="fa-solid fa-arrow-right"></i>
            </button>
        </form>
    </div>

    <div class="footer">
        <div>© 2024 e-Posyandu. Rooted in Community Health.</div>
        <div style="display: flex; gap: 20px;">
            <a href="#" style="color: inherit; font-weight: 400;">Bantuan</a>
            <a href="#" style="color: inherit; font-weight: 400;">Kebijakan Privasi</a>
        </div>
    </div>

    <script>
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('passwordInput');
        if (togglePassword && passwordInput) {
            togglePassword.addEventListener('click', function() {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
                this.classList.toggle('fa-eye');
                this.classList.toggle('fa-eye-slash');
            });
        }
    </script>
</body>
</html>
