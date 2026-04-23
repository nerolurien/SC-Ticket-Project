<!DOCTYPE html>
<html>
<head>
<title>Login</title>
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 20px;
    }

    .login-container {
        background: white;
        padding: 40px;
        border-radius: 10px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        width: 100%;
        max-width: 400px;
    }

    h2 {
        color: #333;
        text-align: center;
        margin-bottom: 30px;
        font-size: 28px;
    }

    .error-message {
        background-color: #fee;
        color: #c33;
        padding: 12px;
        border-radius: 5px;
        margin-bottom: 20px;
        border-left: 4px solid #c33;
        font-size: 14px;
    }

    form div {
        margin-bottom: 20px;
    }

    label {
        display: block;
        color: #555;
        font-weight: 500;
        margin-bottom: 8px;
        font-size: 14px;
    }

    input[type="email"],
    input[type="password"] {
        width: 100%;
        padding: 12px 15px;
        border: 2px solid #e0e0e0;
        border-radius: 5px;
        font-size: 14px;
        transition: all 0.3s ease;
        outline: none;
    }

    input[type="email"]:focus,
    input[type="password"]:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    }

    button[type="submit"] {
        width: 100%;
        padding: 12px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border: none;
        border-radius: 5px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    button[type="submit"]:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
    }

    button[type="submit"]:active {
        transform: translateY(0);
    }
</style>
</head>
<body>
<div class="login-container">
    <h2>Login</h2>
    @if ($errors->any())
    <div class="error-message">
        {{ $errors->first() }}
    </div>
    @endif
    <form method="POST" action="/login">
        @csrf
        <div>
            <label>Email</label>
            <input type="email" name="email" required>
        </div>
        <div>
            <label>Password</label>
            <input type="password" name="password" required>
        </div>
        <button type="submit">Login</button>
    </form>
</div>
</body>
</html>
