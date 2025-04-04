<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redefinir Senha</title>
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

        .container {
            background-color: #1a1a1a;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.5);
            text-align: center;
            width: 100%;
            max-width: 400px;
        }

        h2 {
            color: #00ff08;
            margin-bottom: 20px;
        }

        .error-message {
            color: red;
            font-size: 14px;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        label {
            font-size: 1rem;
            text-align: left;
        }

        input {
            padding: 10px;
            border: none;
            border-radius: 5px;
            font-size: 1rem;
            background-color: #333;
            color: white;
        }

        input::placeholder {
            color: #7d7d7d;
        }

        button {
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

        button:hover {
            background-color: #007c05;
            transform: scale(1.05);
        }

        a {
            display: block;
            color: #7d7d7d;
            text-decoration: none;
            margin-top: 15px;
            transition: color 0.3s;
        }

        a:hover {
            color: #fff;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Redefinir Senha</h2>

        @if ($errors->any())
            <p class="error-message">{{ $errors->first() }}</p>
        @endif

        <form method="POST" action="{{ route('admin.password.update') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">

            <label for="email">E-mail:</label>
            <input type="email" name="email" id="email" placeholder="Seu e-mail" required>

            <label for="password">Nova Senha:</label>
            <input type="password" name="password" id="password" placeholder="Digite a nova senha" required>

            <label for="password_confirmation">Confirme a Senha:</label>
            <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirme sua senha" required>

            <button type="submit">Redefinir Senha</button>
        </form>

        <a href="{{ route('admin.login') }}">Voltar para o Login</a>
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