@extends('layouts.app')

@section('title', 'Segunda Via')

@section('content')
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Poppins', sans-serif;
        background-color: black;
        color: white;
        height: 100vh;
    }

    .interface {
        max-width: 1280px;
        margin: 0 auto;
        padding: 20px;
    }

    header {
        padding: 10px 4%;
    }

    header > .interface {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    header a {
        color: #7d7d7d;
        text-decoration: none;
        display: inline-block;
        transition: .2s;
    }

    header a:hover {
        color: #fff;
        transform: scale(1.15);
    }

    header nav ul {
        list-style-type: none;
        display: flex;
        gap: 30px;
    }

    header nav ul li {
        display: inline-block;
        padding: 0 10px;
    }

    .btn-contato button {
        padding: 10px 40px;
        font-size: 10px;
        font-weight: 600;
        background-color: #0f0;
        border: 0;
        border-radius: 30px;
        cursor: pointer;
        transition: .2s;
    }

    .btn-contato button:hover {
        box-shadow: 0px 0px 8px #00ff08;
        transform: scale(1.15);
    }

    .formulario {
        max-width: 500px;
        margin: 40px auto;
        background-color: #1a1a1a;
        padding: 20px;
        border-radius: 10px;
    }

    .formulario h1, .formulario h2 {
        text-align: center;
        color: #00ff08;
        margin-bottom: 20px;
    }

    .formulario form {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    .formulario input[type="text"],
    .formulario input[type="hidden"] {
        padding: 10px;
        border: 1px solid #555;
        border-radius: 5px;
        background-color: #333;
        color: white;
    }

    .formulario button {
        background-color: #00ff08;
        border: none;
        padding: 10px;
        border-radius: 5px;
        font-weight: bold;
        cursor: pointer;
        transition: background-color 0.2s;
    }

    .formulario button:hover {
        background-color: #007c05;
    }

    .alert-error {
        color: red;
        text-align: center;
        margin-bottom: 15px;
    }

    .alert-success {
        color: limegreen;
        text-align: center;
        margin-bottom: 15px;
    }

    .formulario p {
        color: #ccc;
    }

</style>

<header>
    <div class="interface">
        <div class="logo">
            <a href="{{ route('site.index') }}">
                <h1 class="logo-text">{{ $appName }}</h1>
            </a>
        </div><!--logo-->
        <nav class="menu-desktop">
            <ul>
                <li><a href="{{ route('site.index') }}">Início</a></li>
                <li><a href="{{ route('planos.show') }}">Plano</a></li>
                <li><a href="{{ route('sobre') }}">Sobre</a></li>
                <li><a href="{{ route('segunda-via.index') }}">Segunda via</a></li>
            </ul>
        </nav>
        <div class="btn-contato">
            <a href="{{ route('site.contato') }}">
                <button>Contato</button>
            </a>
        </div>
    </div>
</header>

<div class="formulario">
    <h1>Segunda Via</h1>

    @if (session('error'))
        <p class="alert-error">{{ session('error') }}</p>
    @endif

    @if (session('success'))
        <p class="alert-success">{{ session('success') }}</p>
    @endif

    <form action="{{ route('segunda-via.consultar') }}" method="POST">
        @csrf
        <input type="text" name="cpf" placeholder="Digite seu CPF" required>
        <button type="submit">Consultar</button>
    </form>

    @isset($fatura)
        <hr>
        <h2>Fatura Encontrada</h2>
        <p><strong>Nome:</strong> {{ $fatura->usuario->nome }}</p>
        <p><strong>CPF:</strong> {{ $fatura->usuario->cpf }}</p>
        <p><strong>Valor:</strong> R$ {{ number_format($fatura->valor, 2, ',', '.') }}</p>
        <p><strong>Vencimento:</strong> {{ \Carbon\Carbon::parse($fatura->vencimento)->format('d/m/Y') }}</p>

        <form action="{{ route('pagamento.gerar', ['fatura_id' => $fatura->id]) }}" method="POST">
            @csrf
            <input type="hidden" name="valor" value="{{ $fatura->valor }}">
            <button type="submit"> Pagar com Mercado Pago</button>
        </form>
    @endisset
</div>
@endsection

