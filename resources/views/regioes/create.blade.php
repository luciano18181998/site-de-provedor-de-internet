<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <title>Adicionar Região</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: black;
            color: white;
            margin: 0;
            display: flex;
            height: 100vh;
        }
        .sidebar {
            background-color: #1a1a1a;
            width: 250px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            display: flex;
            flex-direction: column;
            gap: 15px;
        }
        .sidebar h2 {
            color: #00ff08;
            text-align: center;
        }
        .sidebar a {
            color: #7d7d7d;
            text-decoration: none;
            font-size: 1.1rem;
            padding: 10px;
            border-radius: 5px;
            transition: background-color 0.3s, color 0.3s;
        }
        .sidebar a:hover {
            background-color: #00ff08;
            color: black;
        }
        .main-content {
            flex: 1;
            padding: 20px;
            background-color: #222;
            overflow-y: auto;
        }
        h2 {
            color: #00ff08;
            margin-bottom: 10px;
        }
        .form-container {
            background-color: #1a1a1a;
            padding: 20px;
            border-radius: 8px;
            width: 50%;
            margin: auto;
        }
        label, input, button {
            display: block;
            width: 100%;
            margin-bottom: 10px;
        }
        input {
            padding: 10px;
            border-radius: 5px;
            border: none;
        }
        .btn-submit {
            padding: 10px 15px;
            background-color: #00ff08;
            color: black;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            transition: background-color 0.3s, transform 0.2s;
        }
        .btn-submit:hover {
            background-color: #007c05;
            transform: scale(1.05);
        }
        .btn-back {
            display: inline-block;
            padding: 10px 15px;
            background-color: #ff4d4d;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            transition: background-color 0.3s, transform 0.2s;
        }
        .btn-back:hover {
            background-color: #cc0000;
            transform: scale(1.05);
        }
        .error-list {
            color: red;
            list-style: none;
            padding: 0;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <h2>Painel Admin</h2>
        <a href="{{ route ('admin.dashboard') }}">Dashboard</a>
        <a href="{{ route ('usuarios.create') }}">Criar Usuário</a>
        <a href="{{ route ('usuarios.index') }}">Gerenciar Usuários</a>
        <a href="{{ route ('cobrancas.index') }}">Cobranças</a>
        <a href="{{ route ('planos.index') }}">Planos</a>
        <a href="{{ route ('regioes.index') }}">Regioes</a>
        <a href="{{ route ('admin.lista') }}">Lista de Administradores</a>
        <a href="{{ route ('config.save') }}">config</a>
    </div>
    <div class="main-content">
        <h2>Adicionar Região</h2>
        
        @if($errors->any())
            <ul class="error-list">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <div class="form-container">
            <form action="{{ route('regioes.store') }}" method="post">
                @csrf
                <label for="nome">Nome da Região:</label>
                <input type="text" id="nome" name="nome" required>
                <button type="submit" class="btn-submit">Salvar</button>
            </form>
            <a href="{{ route('regioes.index') }}" class="btn-back">Voltar</a>
        </div>
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