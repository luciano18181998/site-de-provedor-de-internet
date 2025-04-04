<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <title>Sobre Nós</title>
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
    <section class="sobre-nos">
        <div class="interface">
            <div class="texto-sobre">
                <h1>Sobre Nós<span>.</span></h1>
                <p>Nossa empresa tem como principal foco oferecer serviços com qualidade, garantindo um atendimento diferenciado e ágil. 
                Buscamos sempre a excelência para proporcionar a melhor experiência aos nossos clientes, com rapidez e eficiência.</p>
                <p>Com uma equipe altamente capacitada, estamos sempre prontos para atender às suas necessidades e oferecer soluções inovadoras.</p>
            </div>
        </div>
    </section>
</main>

<style>
    *{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    .poppins-thin {
        font-family: "Poppins", serif;
        font-weight: 100;
        font-style: normal;
      }
      
      .poppins-extralight {
        font-family: "Poppins", serif;
        font-weight: 200;
        font-style: normal;
      }
      
      .poppins-light {
        font-family: "Poppins", serif;
        font-weight: 300;
        font-style: normal;
      }
      
      .poppins-regular {
        font-family: "Poppins", serif;
        font-weight: 400;
        font-style: normal;
      }
      
      .poppins-medium {
        font-family: "Poppins", serif;
        font-weight: 500;
        font-style: normal;
      }
      
      .poppins-semibold {
        font-family: "Poppins", serif;
        font-weight: 600;
        font-style: normal;
      }
      
      .poppins-bold {
        font-family: "Poppins", serif;
        font-weight: 700;
        font-style: normal;
      }
      
      .poppins-extrabold {
        font-family: "Poppins", serif;
        font-weight: 800;
        font-style: normal;
      }
      
      .poppins-black {
        font-family: "Poppins", serif;
        font-weight: 900;
        font-style: normal;
      }
      
      .poppins-thin-italic {
        font-family: "Poppins", serif;
        font-weight: 100;
        font-style: italic;
      }
      
      .poppins-extralight-italic {
        font-family: "Poppins", serif;
        font-weight: 200;
        font-style: italic;
      }
      
      .poppins-light-italic {
        font-family: "Poppins", serif;
        font-weight: 300;
        font-style: italic;
      }
      
      .poppins-regular-italic {
        font-family: "Poppins", serif;
        font-weight: 400;
        font-style: italic;
      }
      
      .poppins-medium-italic {
        font-family: "Poppins", serif;
        font-weight: 500;
        font-style: italic;
      }
      
      .poppins-semibold-italic {
        font-family: "Poppins", serif;
        font-weight: 600;
        font-style: italic;
      }
      
      .poppins-bold-italic {
        font-family: "Poppins", serif;
        font-weight: 700;
        font-style: italic;
      }
      
      .poppins-extrabold-italic {
        font-family: "Poppins", serif;
        font-weight: 800;
        font-style: italic;
      }
      
      .poppins-black-italic {
        font-family: "Poppins", serif;
        font-weight: 900;
        font-style: italic;
      }
      /*E*/
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

    .planos {
        text-align: center;
        padding: 40px 4%;
    }

    .planos h1 {
        font-size: 2.5rem;
        color: #fff;
        margin-bottom: 40px;
    }

    .container {
        display: flex;
        justify-content: space-around;
        gap: 20px;
        flex-wrap: wrap;
    }

    .plano {
        background-color: #1a1a1a;
        border-radius: 10px;
        padding: 20px;
        width: 300px;
        text-align: center;
        transition: transform 0.2s, box-shadow 0.2s;
    }

    .plano h2 {
        font-size: 1.5rem;
        color: #00ff08;
        margin-bottom: 10px;
    }

    .plano p {
        margin: 20px 0;
        font-size: 1rem;
        color: #7d7d7d;
    }

    .preco {
        font-size: 1.8rem;
        font-weight: bold;
        color: #fff;
        margin-bottom: 20px;
    }

    .plano button {
        background-color: #00ff08;
        border: none;
        color: black;
        padding: 10px 20px;
        border-radius: 5px;
        font-size: 1rem;
        cursor: pointer;
        transition: background-color 0.2s, transform 0.2s;
    }

    .plano button:hover {
        background-color: #007c05;
        transform: scale(1.05);
    }

    .plano:hover {
        transform: scale(1.05);
        box-shadow: 0px 0px 20px #5F9EA0;
        box-shadow: 2px 2px 2px 1px rgba(0, 0, 0, 0.2);
    }
      
}
/*ESTILO GERAL*/
.btn-contato button{
    padding: 10px 40px;
    font-size: 10px;
    font-weight: 600;
    background-color: #0f0;
    border: 0;
    border-radius: 30px;
    cursor: pointer;
    transition: .2s;
}
body{
    background-color: black;
    height: 100vh;
}

.interface{
    max-width: 1280px;
    margin: 0 auto;
}
.flex{
    display: flex;
}

/* ESTILO DO CABEÇALHO */
header{
    padding: 10px 4%;
}
header > .interface{
    display: flex;
    align-items: center;
    justify-content: space-between;
}
header a{
    color: #7d7d7d;
    text-decoration: none;
    display: inline-block;
    transition: .2s;
}
header a:hover{
    color: #fff;
    transform: scale(1.15);
}
header nav ul{
    list-style-type: none;
}
header nav ul li{
    display: inline-block;
    padding: 0 40px;
}
.btn-contato button:hover{
    box-shadow: 0px 0px 8px #00ff08;
    transform: scale(1.15);
}

/* ESTILO DO TOPO DO SITE*/
section.topo-do-site{
    padding: 40px 4%;
}
section.topo-do-site .flex{
    align-items: center;
    justify-content: center;
    gap: 90px;
}
.topo-do-site h1{
    color: #fff;
    font-size: 42px;
    line-height: 40px;
}
.topo-do-site .txt-topo-site h1 span{
    color: #00ff08;
    font-size: 84px;
}
.topo-do-site .txt-topo-site p{
    color: #fff;
    margin: 40px 0;
}

.topo-do-site .img-topo-site img{
    position: relative;
    animation: flutuar 2s ease-in-out infinite alternate;
}

@keyframes flutuar{
    0%{
        top: 0;
    }
    100%{
        top: 30px
    }
}
.planos h1 {
    font-size: 2.5rem;
    color: #fff;
    margin-bottom: 20px; /* Ajuste para dar mais espaço abaixo do título */
}
#regiao {
    margin-top: 20px; /* Ajuste para separar o select do título */
    padding: 10px;
    font-size: 1rem;
    border-radius: 5px;
    border: 1px solid #7d7d7d;
    background-color: #1a1a1a;
    color: white;
}
#lista-planos {
    margin-top: 20px; /* Ajuste para separar os planos do select */
    display: flex;
    flex-wrap: wrap;
    gap: 20px; /* Espaçamento entre os planos */
    justify-content: center;
}
.sobre-nos {
    text-align: center;
    padding: 60px 4%;
}

.sobre-nos h1 {
    font-size: 2.5rem;
    color: #00ff08; /* Mudando a cor do título para verde */
}

.sobre-nos p {
    margin-top: 20px;
    font-size: 1.2rem;
    color: #7d7d7d; /* Mantendo o texto do parágrafo cinza */
    max-width: 800px;
    margin-left: auto;
    margin-right: auto;
}
</style>

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