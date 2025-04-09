@extends('layouts.app')

@section('title', 'Painel de Cobranças')

@section('content')
<div class="container">
    <div class="sidebar">
        <h2>Painel Admin</h2>
        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
        <a href="{{ route('usuarios.create') }}">Criar Usuário</a>
        <a href="{{ route('usuarios.index') }}">Gerenciar Usuários</a>
        <a href="{{ route('cobrancas.index') }}">Cobranças</a>
        <a href="{{ route('planos.index') }}">Planos</a>
        <a href="{{ route('regioes.index') }}">Regiões</a>
        <a href="{{ route('admin.lista') }}">Lista de Administradores</a>
    </div>

    <div class="main-content">
        <h1>Painel de Cobranças</h1>

        @if (session('success'))
            <p style="color: green;">{{ session('success') }}</p>
        @endif

        <h2>📌 Gerar Cobrança</h2>
        <form action="{{ route('cobrancas.gerar') }}" method="POST">
            @csrf
            <label for="usuario_id">Selecione um usuário:</label>
            <select name="usuario_id" required>
                @foreach ($usuarios as $usuario)
                    <option value="{{ $usuario->id }}">{{ $usuario->nome }} - CPF: {{ $usuario->cpf }}</option>
                @endforeach
            </select>
            <button class="btn-green" type="submit">💰 Gerar Cobrança</button>
        </form>

        <h2>🔴 Faturas Pendentes</h2>
        <table border="1">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>CPF</th>
                    <th>Valor</th>
                    <th>Vencimento</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pendentes as $fatura)
                    <tr>
                        <td>{{ $fatura->usuario->nome }}</td>
                        <td>{{ $fatura->usuario->cpf }}</td>
                        <td>R$ {{ number_format($fatura->valor, 2, ',', '.') }}</td>
                        <td>{{ \Carbon\Carbon::parse($fatura->vencimento)->format('d/m/Y') }}</td>
                        <td>
                            <form action="{{ route('pagamento.gerar', $fatura->id) }}" method="POST" style="display:inline;">
                                @csrf
                                <input type="hidden" name="valor" value="{{ $fatura->valor }}">
                                <button type="submit" class="btn-green">💳 Pagar</button>
                            </form>

                            <form action="{{ route('cobrancas.remover', $fatura->id) }}" method="POST" style="display:inline;">
                                @csrf
                                <button class="btn-red" type="submit">❌ Remover</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <h2>🟢 Faturas Pagas</h2>

        <form method="GET" action="{{ route('cobrancas.index') }}" style="margin-bottom: 10px;">
            <label for="usuario_id">Filtrar por usuário:</label>
            <select name="usuario_id" onchange="this.form.submit()" style="padding: 8px;">
                <option value="">Todos os usuários</option>
                @foreach ($usuarios as $usuario)
                    <option value="{{ $usuario->id }}" {{ request('usuario_id') == $usuario->id ? 'selected' : '' }}>
                        {{ $usuario->nome }} - CPF: {{ $usuario->cpf }}
                    </option>
                @endforeach
            </select>
        </form>

        @if(request('usuario_id'))
            <p>Este usuário tem <strong>{{ $pagos->count() }}</strong> fatura(s) paga(s).</p>
        @endif

        <table border="1">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>CPF</th>
                    <th>Valor</th>
                    <th>Pago em</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($pagos as $fatura)
                    <tr>
                        <td>{{ $fatura->usuario->nome }}</td>
                        <td>{{ $fatura->usuario->cpf }}</td>
                        <td>R$ {{ number_format($fatura->valor, 2, ',', '.') }}</td>
                        <td>{{ \Carbon\Carbon::parse($fatura->updated_at)->format('d/m/Y H:i') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">Nenhuma fatura paga encontrada.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

<style>
    body {
        font-family: 'Poppins', sans-serif;
        background-color: black;
        color: white;
        margin: 0;
        display: flex;
        height: 100vh;
    }
    .container {
        display: flex;
        width: 100%;
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
    .btn-green {
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
    .btn-green:hover {
        background-color: #007c05;
        transform: scale(1.05);
    }
    .btn-red {
        padding: 10px;
        border: none;
        border-radius: 5px;
        background-color: #ff0000;
        font-weight: bold;
        font-size: 1rem;
        color: white;
        cursor: pointer;
        transition: background-color 0.3s, transform 0.2s;
    }
    .btn-red:hover {
        background-color: #cc0000;
        transform: scale(1.05);
    }
</style>



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
