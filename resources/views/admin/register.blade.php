<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <title>Cadastro Administrador</title>
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
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 20px;
            background-color: #222;
        }
        h2 {
            color: #00ff08;
            margin-bottom: 20px;
        }
        form {
            background-color: #1a1a1a;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            display: flex;
            flex-direction: column;
            gap: 10px;
            width: 300px;
        }
        input {
            padding: 10px;
            border: none;
            border-radius: 5px;
            font-size: 1rem;
        }
        button {
            padding: 10px;
            background-color: #00ff08;
            color: black;
            border: none;
            border-radius: 5px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.2s;
        }
        button:hover {
            background-color: #007c05;
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
        <a href="{{ route ('regioes.index') }}">Regioes</a>
        <a href="{{ route ('admin.lista') }}">Lista de Administradores</a>
        <a href="{{ route ('config.save') }}">config</a>
    </div>
    <div class="main-content">
        <h2>Cadastro Administrador</h2>
        <form method="POST" action="{{ route('admin.register') }}">
            @csrf
            <input type="text" name="nome" placeholder="Nome" required>
            <input type="email" name="email" placeholder="E-mail" required>
            <input type="password" name="password" placeholder="Senha" required>
            <input type="password" name="password_confirmation" placeholder="Confirmar Senha" required>
            <button type="submit">Cadastrar</button>
        </form>
    </div>
</body>
</html>
