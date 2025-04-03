<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <title>Adicionar Usuário</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .form-container {
            background-color: #1a1a1a;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }
        .form-container h2 {
            color: #00ff08;
            margin-bottom: 20px;
        }
        .form-container form {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        .form-container input, .form-container select {
            padding: 8px;
            border: none;
            border-radius: 5px;
            font-size: 1rem;
            background-color: #333;
            color: white;
            width: 100%;
        }
        .form-container input::placeholder {
            color: #7d7d7d;
        }
        .form-container button {
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
        .form-container button:hover {
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
        <a href="{{ route ('regioes.index') }}">Regiões</a>
        <a href="{{ route ('admin.lista') }}">Lista de Administradores</a>
        <a href="{{ route ('config.save') }}">Config</a>
    </div>
    <div class="main-content">
        <div class="form-container">
            <h2>Adicionar Usuário</h2>
            <form action="{{ route('usuarios.store') }}" method="post">
                @csrf
                <input type="text" name="nome" placeholder="Nome" required>
                <input type="text" name="telefone" placeholder="Telefone" required>
                <input type="text" name="cpf" placeholder="CPF" required>
                <input type="email" name="email" placeholder="Email" required>
                <input type="number" name="data_vencimento" min="1" max="30" placeholder="Data de Vencimento (1 a 30)" required>
                
                <select name="regiao_id" id="regiao" required>
                    <option value="" disabled selected>Escolha uma região</option>
                    @foreach($regioes as $regiao)
                        <option value="{{ $regiao->id }}">{{ $regiao->nome }}</option>
                    @endforeach
                </select>

                <select name="plano_id" id="plano" required>
                    <option value="" disabled selected>Selecione um plano</option>
                </select>

                <button type="submit" id="btnSalvar" disabled>Salvar</button>
            </form>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#regiao').change(function() {
                let regiaoId = $(this).val();
                $('#plano').html('<option value="" disabled selected>Carregando...</option>');
                $('#btnSalvar').prop('disabled', true);

                $.get('/usuarios/getPlanos/' + regiaoId, function(data) {
                    $('#plano').html('<option value="" disabled selected>Selecione um plano</option>');
                    data.forEach(plan => {
                        $('#plano').append(`<option value="${plan.id}">${plan.nome}</option>`);
                    });

                    $('#btnSalvar').prop('disabled', false);
                }).fail(function() {
                    $('#plano').html('<option value="" disabled selected>Erro ao carregar planos</option>');
                    $('#btnSalvar').prop('disabled', true);
                });
            });
        });
    </script>
</body>
</html>
