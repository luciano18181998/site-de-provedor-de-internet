<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Planos</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
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
        .btn-add {
            display: inline-block;
            padding: 10px 15px;
            background-color: #00ff08;
            color: black;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            transition: background-color 0.3s, transform 0.2s;
        }
        .btn-add:hover {
            background-color: #007c05;
            transform: scale(1.05);
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            text-align: left;
            padding: 10px;
            border-bottom: 1px solid #444;
        }
        th {
            background-color: #1a1a1a;
            color: #00ff08;
        }
        td {
            background-color: #222;
        }
        .btn-delete {
            padding: 8px 12px;
            background-color: #ff4d4d;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .btn-delete:hover {
            background-color: #cc0000;
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
    </div>
    <div class="main-content">
        <h2>Lista de Planos</h2>
        <a href="{{ route('planos.create') }}" class="btn-add">Adicionar Plano</a>

        @if(session('success'))
            <p style="color: green;">{{ session('success') }}</p>
        @endif

        <table>
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Valor</th>
                    <th>Descrição</th>
                    <th>Região</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($planos as $plano)
                    <tr>
                        <td>{{ $plano->nome }}</td>
                        <td>R$ {{ number_format($plano->valor, 2, ',', '.') }}</td>
                        <td>{{ $plano->descricao }}</td>
                        <td>{{ $plano->regiao->nome }}</td>
                        <td>
                            <form action="{{ route('planos.destroy', $plano->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir este plano?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-delete">Excluir</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
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