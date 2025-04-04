<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <title>Contato</title>
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
        margin-bottom: 5px;
    }

    .form-group input {
        width: 100%;
        padding: 10px;
        border-radius: 5px;
        border: 1px solid #7d7d7d;
        background: #333;
        color: white;
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
    </style>
</head>
<body>
    <header>
        <div class="interface">
            <div class="logo">
                <a href="{{ route ('site.index') }}">
                    <h1 class="logo-text">{{ $appName }}</h1>
                </a>
            </div><!--logo-->
            <nav class="menu-desktop">
                <ul>
                    <li><a href="{{ route ('site.index') }}">Início</a></li>
                    <li><a href="{{ route ('planos.show') }}">Plano</a></li>
                    <li><a href="{{ route ('sobre') }}">Sobre</a></li>
                    <li><a href="{{ route ('segunda-via.index') }}">Segunda via</a></li>
                </ul>
            </nav>
            <div class="btn-contato">
            <a href="{{ route ('site.contato') }}">
                <button>Contato</button>
            </a>
        </div>
        </div>
    </header>
    <main>
        <section class="formulario-contato">
            <div class="interface">
                <h2>Entre em Contato</h2>
                @if(session('success'))
                    <p style="color: green;">{{ session('success') }}</p>
                @endif
                <form action="{{ route('enviar.contato') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="nome">Nome:</label>
                        <input type="text" id="nome" name="nome" required>
                    </div>
                    <div class="form-group">
                        <label for="telefone">Telefone:</label>
                        <input type="text" id="telefone" name="telefone" required>
                    </div>
                    <div class="form-group">
                        <label for="cpf">CPF:</label>
                        <input type="text" id="cpf" name="cpf" required>
                    </div>
                    <button type="submit" class="btn-submit">Enviar</button>
                </form>
            </div>
        </section>
    </main>
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