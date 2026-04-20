<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Keamanan Tinggi - Toko Online</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }

        body {
            background: #f4f7fe;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .login-card {
            background: #ffffff;
            width: 100%;
            max-width: 420px;
            padding: 40px;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        }

        .header {
            text-align: center;
            margin-bottom: 32px;
        }

        .header h2 {
            color: #1a202c;
            font-size: 26px;
            font-weight: 700;
        }

        .header p {
            color: #718096;
            font-size: 14px;
            margin-top: 8px;
        }

        /* Styling untuk Error Message dari SRS (SEC-04) */
        .alert-error {
            background-color: #fff5f5;
            color: #c53030;
            padding: 12px 16px;
            border-radius: 8px;
            border-left: 4px solid #c53030;
            margin-bottom: 24px;
            font-size: 13px;
            display: flex;
            align-items: center;
        }

        .alert-error i { margin-right: 10px; }

        .form-group {
            margin-bottom: 20px;
            position: relative;
        }

        label {
            display: block;
            color: #4a5568;
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .input-wrapper {
            position: relative;
        }

        input {
            width: 100%;
            padding: 12px 16px;
            padding-left: 40px; /* Space for icon */
            border: 1.5px solid #e2e8f0;
            border-radius: 8px;
            font-size: 15px;
            transition: all 0.2s;
            background: #f8fafc;
        }

        input:focus {
            outline: none;
            border-color: #4c51bf;
            background: #fff;
            box-shadow: 0 0 0 4px rgba(76, 81, 191, 0.1);
        }

        .input-icon {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #a0aec0;
        }

        .toggle-password {
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #a0aec0;
            cursor: pointer;
            font-size: 14px;
        }

        button[type="submit"] {
            width: 100%;
            padding: 14px;
            background: #4c51bf;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.3s;
            margin-top: 10px;
        }

        button[type="submit"]:hover {
            background: #434190;
        }

        .footer-links {
            margin-top: 25px;
            text-align: center;
            font-size: 13px;
            color: #718096;
        }

        .footer-links a {
            color: #4c51bf;
            text-decoration: none;
            font-weight: 600;
        }
    </style>
</head>
<body>

<div class="login-card">
    <div class="header">
        <h2>Selamat Datang</h2>
    </div>

    @if ($errors->any())
    <div class="alert-error">
        <i class="fas fa-exclamation-circle"></i>
        {{ $errors->first() }}
    </div>
    @endif

    <form method="POST" action="/login">
        @csrf
        <div class="form-group">
            <label>Alamat Email</label>
            <div class="input-wrapper">
                <i class="fas fa-envelope input-icon"></i>
                <input type="email" name="email" placeholder="nama@email.com" required>
            </div>
        </div>

        <div class="form-group">
            <label>Kata Sandi</label>
            <div class="input-wrapper">
                <i class="fas fa-lock input-icon"></i>
                <input type="password" id="password" name="password" placeholder="••••••••" required>
                <i class="fas fa-eye toggle-password" id="eyeIcon"></i>
            </div>
        </div>

        <button type="submit">Masuk Sekarang</button>
    </form>
</div>

<script>
    // Fitur Tambahan Keamanan UX: Intip Password
    const eyeIcon = document.getElementById('eyeIcon');
    const passwordInput = document.getElementById('password');

    eyeIcon.addEventListener('click', () => {
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        eyeIcon.classList.toggle('fa-eye-slash');
    });
</script>

</body>
</html>