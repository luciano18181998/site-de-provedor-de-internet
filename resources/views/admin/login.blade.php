<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <title>Login Administrador</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: black;
            color: white;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-container {
            background-color: #1a1a1a;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.5);
            text-align: center;
            width: 100%;
            max-width: 400px;
        }

        .login-container h2 {
            margin-bottom: 20px;
            color: #00ff08;
        }

        .login-container form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .login-container input {
            padding: 10px;
            border: none;
            border-radius: 5px;
            font-size: 1rem;
            background-color: #333;
            color: white;
        }

        .login-container input::placeholder {
            color: #7d7d7d;
        }

        .login-container button {
            padding: 10px;
            border: none;
            border-radius: 5px;
            background-color: #00ff08;
            font-weight: bold;
            font-size: 1rem;
            color: black;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.2s;
        }

        .login-container button:hover {
            background-color: #007c05;
            transform: scale(1.05);
        }

        .login-container a {
            margin-top: 10px;
            display: block;
            color: #7d7d7d;
            text-decoration: none;
            transition: color 0.3s;
        }

        .login-container a:hover {
            color: #fff;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Login Administrador</h2>
        <form action="{{ route('admin.login.submit') }}" method="POST">
            @csrf
            <input type="email" name="email" placeholder="Digite seu email" required>
            <input type="password" name="password" placeholder="Digite sua senha" required>
            <button type="submit">Entrar</button>
        </form>
        <a href="{{ route('admin.forgot-password') }}">Esqueceu a senha?</a>
    </div>
</body>
</html>
