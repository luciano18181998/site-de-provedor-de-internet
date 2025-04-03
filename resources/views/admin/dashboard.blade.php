<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Admin</title>
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
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            background-color: #222;
        }
        h2 {
            color: #00ff08;
        }
        button {
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            background-color: #ff4d4d;
            font-weight: bold;
            font-size: 1rem;
            color: white;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.2s;
        }
        button:hover {
            background-color: #cc0000;
            transform: scale(1.05);
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
        <a href="{{ route ('regioes.index') }}">Regiões</a>
        <a href="{{ route ('admin.lista') }}">Lista de Administradores</a>
        <a href="{{ route ('config.save') }}">config</a>
    </div>
    <div class="main-content">
        <h2>Bem-vindo ao Painel Administrativo!</h2>
        <form action="{{ route('admin.logout') }}" method="POST">
            @csrf
            <button type="submit">Sair</button>
        </form>
    </div>
</body>
</html>
