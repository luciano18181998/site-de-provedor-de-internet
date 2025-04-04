@extends('layouts.app')

@section('title', 'Fatura')

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
        margin: 0;
    }

    .interface {
        max-width: 1280px;
        margin: 0 auto;
        padding: 20px;
    }

    header {
        padding: 20px 4%;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    header ul {
        list-style: none;
        display: flex;
        gap: 30px;
    }

    header ul li a {
        color: #7d7d7d;
        text-decoration: none;
        transition: color 0.2s;
    }

    header ul li a:hover {
        color: #fff;
    }

    .formulario-contato {
        background-color: #1a1a1a;
        border-radius: 10px;
        padding: 20px;
        margin: 40px auto;
        text-align: left;
        max-width: 500px;
    }

    .formulario-contato h2 {
        color: #00ff08;
        margin-bottom: 20px;
        text-align: center;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
    display: block;
    font-size: 1rem;
    margin-bottom: 10px; /* Adiciona espaço entre o label e o input */
    }

    .form-group input {
    width: 100%;
    padding: 10px;
    border-radius: 5px;
    border: 1px solid #7d7d7d;
    background: #333;
    color: white;
    font-size: 1rem;
    }

    .form-group input::placeholder {
        color: #7d7d7d;
    }

    .btn-submit {
        background-color: #00ff08;
        border: none;
        padding: 10px 20px;
        border-radius: 5px;
        font-weight: bold;
        color: black;
        cursor: pointer;
        width: 100%;
        transition: background-color 0.2s, transform 0.2s;
    }

    .btn-submit:hover {
        background-color: #007c05;
        transform: scale(1.05);
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

    body {
        background-color: black;
        height: 100vh;
    }

    .interface {
        max-width: 1280px;
        margin: 0 auto;
    }

    .flex {
        display: flex;
    }

    /* ESTILO DO CABEÇALHO */
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
    }

    header nav ul li {
        display: inline-block;
        padding: 0 40px;
    }

    .btn-contato button:hover {
        box-shadow: 0px 0px 8px #00ff08;
        transform: scale(1.15);
    }

    /* ESTILO DO TOPO DO SITE */
    section.topo-do-site {
        padding: 40px 4%;
    }

    section.topo-do-site .flex {
        align-items: center;
        justify-content: center;
        gap: 90px;
    }

    .topo-do-site h1 {
        color: #fff;
        font-size: 42px;
        line-height: 40px;
    }

    .topo-do-site .txt-topo-site h1 span {
        color: #00ff08;
        font-size: 84px;
    }

    .topo-do-site .txt-topo-site p {
        color: #fff;
        margin: 40px 0;
    }

    .topo-do-site .img-topo-site img {
        position: relative;
        animation: flutuar 2s ease-in-out infinite alternate;
    }

    @keyframes flutuar {
        0% {
            top: 0;
        }

        100% {
            top: 30px;
        }
    }

    .planos h1 {
        font-size: 2.5rem;
        color: #fff;
        margin-bottom: 20px;
    }

    #regiao {
        margin-top: 20px;
        padding: 10px;
        font-size: 1rem;
        border-radius: 5px;
        border: 1px solid #7d7d7d;
        background-color: #1a1a1a;
        color: white;
    }

    #lista-planos {
        margin-top: 20px;
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        justify-content: center;
    }
    /* Estilo da fatura */
    .fatura-container {
            background-color: #1a1a1a;
            border-radius: 10px;
            padding: 30px;
            margin: 40px auto;
            max-width: 500px;
            text-align: center;
            box-shadow: 0px 0px 10px rgba(0, 255, 8, 0.5);
        }

        .fatura-container h1 {
            color: #00ff08;
            margin-bottom: 20px;
            font-size: 24px;
        }

        .fatura-container p {
            font-size: 16px;
            margin: 10px 0;
        }

        .fatura-container strong {
            color: #fff;
        }
        .btn-pagamento:hover {
            background-color: #007c05;
            transform: scale(1.05);
        }
        /* Estilizando o botão de pagamento */
        .btn-pagamento {
            background-color: #00ff08;
            border: none;
            padding: 15px;
            border-radius: 5px;
            font-weight: bold;
            color: black;
            cursor: pointer;
            width: 100%;
            transition: background-color 0.2s, transform 0.2s;
            margin-top: 20px;
            font-size: 18px;
        }
        .btn-contato button:hover {
            box-shadow: 0px 0px 8px #00ff08;
            transform: scale(1.05);
        }
        
    
    
    </style>

    <div class="interface">
    <header>
            <div class="logo">
                <a href="{{ route('site.index') }}">
                    <h1 class="logo-text">{{ $appName }}</h1>
                </a>
            </div>
            <nav class="menu-desktop">
                <ul>
                    <li><a href="{{ route ('site.index') }}">Início</a></li>
                    <li><a href="{{ route ('planos.show') }}">Plano</a></li>
                    <li><a href="{{ route ('sobre') }}">Sobre</a></li>
                    <li><a href="{{ route ('segunda-via.index') }}">Segunda via</a></li>
                </ul>
            </nav>
            <div class="btn-contato">
                <a href="{{ route('site.contato') }}">
                    <button>Contato</button>
                </a>
            </div>
        </header>

        <!-- Fatura -->
        <div class="fatura-container">
            <h1>Fatura do Cliente</h1>
            <p><strong>Nome:</strong> {{ $usuario->nome }}</p>
            <p><strong>CPF:</strong> {{ $usuario->cpf }}</p>
            <p><strong>Valor:</strong> R$ {{ number_format($fatura->valor, 2, ',', '.') }}</p>
            <p><strong>Vencimento:</strong> {{ \Carbon\Carbon::parse($fatura->vencimento)->format('d/m/Y') }}</p>
            <p><strong>Status:</strong> {{ ucfirst($fatura->status) }}</p>

            <!-- Botão de pagamento -->
            <form action="{{ route('pagamento.gerar') }}" method="POST">
                @csrf
                <input type="hidden" name="valor" value="{{ $fatura->valor }}">
                <button type="submit" class="btn-pagamento">Pagar Agora</button>
            </form>
        </div>
    </div>
@endsection

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