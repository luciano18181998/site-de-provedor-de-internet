<!DOCTYPE html> 
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--fonts-google-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <!--fonts-google-ff-->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <title>{{ $appName }} - Bem-vindo ao Meu Site</title>
</head>
<body>

    <header>
        <div class="interface">
            <div class="logo">
                <a href="{{ route('site.index') }}">
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
            </div><!--btn-contato-->
        </div><!--interface-->
    </header>

    <main>
        <section class="topo-do-site">
            <div class="interface">
                <div class="flex">
                    <!-- Texto do topo do site -->
                    <div class="txt-topo-site">
                        <h1>VENHA CONHECER E FAZER PARTE DO TIME<span>.</span></h1>
                        <p>Rápido atendimento e suporte. O que está esperando? Venha fazer parte!</p>
                        <div class="btn-contato">
                            <a href="{{ route ('site.contato') }}">
                                <button>Entre em contato</button>
                            </a>
                        </div><!--btn-contato-->
                    </div><!--txt-topo-site-->

                    <!-- Imagem do topo do site -->
                    <div class="img-topo-site">
                        <img src="{{ asset('img/logo.png') }}" alt="Descrição da imagem" style="width: 500px; height: 500px;">
                    </div><!--img-topo-site-->
                </div><!--flex-->
            </div><!--interface-->
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