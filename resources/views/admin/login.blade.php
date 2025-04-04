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

<script>
    document.addEventListener("keydown", function (event) {
        // Bloqueia Ctrl + U, Ctrl + Shift + I, Ctrl + C, Ctrl + X, Ctrl + S, F12 e outras teclas
        if (
            (event.ctrlKey && (event.key === "u" || event.key === "U")) || // Ctrl + U
            (event.ctrlKey && (event.key === "i" || event.key === "I")) || // Ctrl + I
            (event.ctrlKey && (event.shiftKey && (event.key === "i" || event.key === "I"))) || // Ctrl + Shift + I
            (event.ctrlKey && (event.key === "c" || event.key === "C")) || // Ctrl + C
            (event.ctrlKey && (event.key === "x" || event.key === "X")) || // Ctrl + X
            (event.ctrlKey && (event.key === "s" || event.key === "S")) || // Ctrl + S
            (event.key === "F12") // Tecla F12
        ) {
            event.preventDefault();
            alert("Ação bloqueada!");
        }
    });

    // Bloqueia o clique com o botão direito do mouse
    document.addEventListener("contextmenu", function (event) {
        event.preventDefault();
        alert("O botão direito está desativado.");
    });

    // Bloqueia o arrastar de imagens (evita que sejam copiadas)
    document.addEventListener("dragstart", function (event) {
        if (event.target.tagName === "IMG") {
            event.preventDefault();
            alert("Arrastar imagens está desativado.");
        }
    });

    // Bloqueia a seleção de texto (opcional)
    document.addEventListener("selectstart", function (event) {
        event.preventDefault();
    });
</script>