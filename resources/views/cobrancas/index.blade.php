@extends('layouts.app')

@section('title', 'Painel de Cobranças')

@section('content')
    <div class="container">
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
                <tr>
                    <th>Nome</th>
                    <th>CPF</th>
                    <th>Valor</th>
                    <th>Vencimento</th>
                    <th>Ação</th>
                </tr>
                @foreach ($pendentes as $fatura)
                    <tr>
                        <td>{{ $fatura->usuario->nome }}</td>
                        <td>{{ $fatura->usuario->cpf }}</td>
                        <td>R$ {{ number_format($fatura->valor, 2, ',', '.') }}</td>
                        <td>{{ $fatura->vencimento }}</td>
                        <td>
                            <form action="{{ route('cobrancas.remover', $fatura->id) }}" method="POST">
                                @csrf
                                <button class="btn-red" type="submit">❌ Remover Cobrança</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </table>

            <h2>🟢 Faturas Pagas</h2>
            <table border="1">
                <tr>
                    <th>Nome</th>
                    <th>CPF</th>
                    <th>Valor</th>
                    <th>Pago em</th>
                </tr>
                @foreach ($pagos as $fatura)
                    <tr>
                        <td>{{ $fatura->usuario->nome }}</td>
                        <td>{{ $fatura->usuario->cpf }}</td>
                        <td>R$ {{ number_format($fatura->valor, 2, ',', '.') }}</td>
                        <td>{{ $fatura->updated_at }}</td>
                    </tr>
                @endforeach
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