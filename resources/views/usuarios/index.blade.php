<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <title>Usuários</title>
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
        <a href="{{ route ('config.save') }}">config</a>
    </div>
    <div class="main-content">
        <h2>Lista de Usuários</h2>
        <a href="{{ route('usuarios.create') }}" class="btn-add">Adicionar Usuário</a>

        @if(session('success'))
            <p style="color: green;">{{ session('success') }}</p>
        @endif

        <table>
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Telefone</th>
                    <th>CPF</th>
                    <th>Email</th>
                    <th>Data de Vencimento</th>
                    <th>Região</th>
                    <th>Plano</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($usuarios as $usuario)
                    <tr>
                        <td>{{ $usuario->nome }}</td>
                        <td>{{ $usuario->telefone }}</td>
                        <td>{{ $usuario->cpf }}</td>
                        <td>{{ $usuario->email }}</td>
                        <td>{{ $usuario->data_vencimento }}</td>
                        <td>{{ $usuario->regiao->nome }}</td>
                        <td>{{ $usuario->plano->nome }}</td>
                        <td>
                            <form action="{{ route('usuarios.destroy', $usuario->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-delete" onclick="return confirm('Tem certeza que deseja excluir este usuário?');">
                                    Excluir
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
