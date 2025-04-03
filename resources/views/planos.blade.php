<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    
    <title>Planos de Internet</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
                <li><a href="#">Segunda via</a></li>
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
    <section class="planos">
        <div class="interface">
            <h1>Planos</h1>


            <select id="regiao">
                <option value="">Escolha uma região</option>
                @foreach($regioes as $regiao)
                    <option value="{{ $regiao->id }}">{{ $regiao->nome }}</option>
                @endforeach
            </select>

            <div class="container" id="lista-planos">
                <p>Selecione uma região para ver os planos disponíveis.</p>
            </div>
        </div>
    </section>
</main>

<script>
    $(document).ready(function() {
        $('#regiao').change(function() {
            let regiaoId = $(this).val();

            if (regiaoId === '') {
                $('#lista-planos').html('<p>Selecione uma região para ver os planos disponíveis.</p>');
                return;
            }

            $('#lista-planos').html('<p>Carregando planos...</p>');

            $.get(`/planos/regiao/${encodeURIComponent(regiaoId)}`, function(data) {
                if (!data || data.length === 0) {
                    $('#lista-planos').html('<p>Nenhum plano encontrado para esta região.</p>');
                    return;
                }

                let html = '';
                data.forEach(plano => {
                    html += `
                        <div class="plano">
                            <h2>${plano.nome}</h2>
                            <p>${plano.descricao}</p>
                            <div class="preco">R$ ${parseFloat(plano.valor).toLocaleString('pt-BR', { minimumFractionDigits: 2 })}</div>
                            <a href="{{ route ('site.contato') }}">
                            <button>Contratar</button>
                            </a>
                        </div>`;
                });

                $('#lista-planos').html(html);
            }).fail(function() {
                $('#lista-planos').html('<p>Erro ao carregar os planos. Tente novamente.</p>');
            });
        });
    });
</script>

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
</style>

</body>
</html>
