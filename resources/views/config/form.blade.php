<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configurações da Aplicação</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: black;
            color: white;
            margin: 0;
            display: flex;
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
            flex-direction: column;
            align-items: center;
        }

        h1 {
            color: #00ff08;
            text-align: center;
            margin-bottom: 20px;
        }

        .form-section {
            background-color: #222;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            width: 100%;
            max-width: 800px;
        }

        .form-section h2 {
            color: #00ff08;
            margin-bottom: 15px;
        }

        .form-group {
            margin-bottom: 20px; /* Aumentado o espaçamento entre os campos */
        }

        .form-group label {
            display: block;
            font-size: 1.1rem; /* Aumentado o tamanho da fonte */
            margin-bottom: 8px;
        }

        .form-group input {
            width: 100%;
            padding: 1px; /* Aumentado o padding para tornar os campos maiores */
            background-color: #1a1a1a;
            color: white;
            border: 1px solid #333;
            border-radius: 5px;
            font-size: 1.2rem; /* Aumentado o tamanho da fonte */
        }

        .form-group input:focus {
            border-color: #00ff08;
            outline: none;
        }

        button {
            padding: 15px 20px; /* Aumentado o padding do botão */
            background-color: #00ff08;
            color: black;
            font-size: 1.2rem; /* Aumentado o tamanho da fonte */
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.2s;
            margin-top: 20px;
            width: 100%;
        }

        button:hover {
            background-color: #007c05;
            transform: scale(1.05);
        }

        .success-message {
            background-color: #00ff08;
            color: black;
            padding: 15px;
            border-radius: 5px;
            text-align: center;
            margin-top: 20px;
            font-size: 1.1rem; /* Aumentado o tamanho da fonte */
        }
    </style>
</head>
<body>

    <div class="sidebar">
        <h2>Painel Admin</h2>
        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
        <a href="{{ route('usuarios.create') }}">Criar Usuário</a>
        <a href="{{ route('usuarios.index') }}">Gerenciar Usuários</a>
        <a href="{{ route('planos.index') }}">Planos</a>
        <a href="{{ route('regioes.index') }}">Regioes</a>
        <a href="{{ route('admin.lista') }}">Lista de Administradores</a>
        <a href="{{ route ('config.save') }}">config</a>
    </div>

    <div class="main-content">
        <h1>Configurações da Aplicação</h1>

        <form action="{{ url('/configurar') }}" method="POST">
            @csrf

            <!-- Configurações do Mercado Pago -->
            <div class="form-section">
                <h2>Configurações do Mercado Pago</h2>
                <div class="form-group">
                    <label for="mercado_pago_access_token">Mercado Pago Access Token</label>
                    <input type="text" id="mercado_pago_access_token" name="MERCADOPAGO_ACCESS_TOKEN" value="{{ env('MERCADOPAGO_ACCESS_TOKEN') }}" required>
                </div>
                <div class="form-group">
                    <label for="mercado_pago_public_key">Mercado Pago Public Key</label>
                    <input type="text" id="mercado_pago_public_key" name="MERCADOPAGO_PUBLIC_KEY" value="{{ env('MERCADOPAGO_PUBLIC_KEY') }}" required>
                </div>
            </div>

            <!-- Configurações do SMTP -->
            <div class="form-section">
                <h2>Configurações de E-mail (SMTP)</h2>
                <div class="form-group">
                    <label for="mail_host">SMTP Host</label>
                    <input type="text" id="mail_host" name="MAIL_HOST" value="{{ env('MAIL_HOST') }}" required>
                </div>

                <div class="form-group">
                    <label for="mail_username">Email do Remetente</label>
                    <input type="email" id="mail_username" name="MAIL_USERNAME" value="{{ env('MAIL_USERNAME') }}" required>
                </div>

                <div class="form-group">
                    <label for="mail_password">SMTP Password</label>
                    <input type="password" id="mail_password" name="MAIL_PASSWORD" value="{{ env('MAIL_PASSWORD') }}" required>
                </div>

                <div class="form-group">
                    <label for="mail_mailer">Mailer</label>
                    <input type="text" id="mail_mailer" name="MAIL_MAILER" value="{{ env('MAIL_MAILER') }}" required>
                </div>

                <div class="form-group">
                    <label for="mail_port">Mail Port</label>
                    <input type="text" id="mail_port" name="MAIL_PORT" value="{{ env('MAIL_PORT') }}" required>
                </div>

                <div class="form-group">
                    <label for="mail_encryption">Mail Encryption</label>
                    <input type="text" id="mail_encryption" name="MAIL_ENCRYPTION" value="{{ env('MAIL_ENCRYPTION') }}" required>
                </div>

                <div class="form-group">
                    <label for="mail_from_name">Mail From Name</label>
                    <input type="text" id="mail_from_name" name="MAIL_FROM_NAME" value="{{ env('MAIL_FROM_NAME') }}" required>
                </div>
            </div>

            <!-- Configurações Gerais -->
            <div class="form-section">
                <h2>Configurações Gerais</h2>
                <div class="form-group">
                    <label for="app_name">Nome do Aplicativo</label>
                    <input type="text" id="app_name" name="APP_NAME" value="{{ env('APP_NAME') }}" required>
                </div>

                <div class="form-group">
                    <label for="app_url">URL do Aplicativo</label>
                    <input type="text" id="app_url" name="APP_URL" value="{{ env('APP_URL') }}" required>
                </div>
            </div>

            
        </form>

        @if(session('success'))
            <p class="success-message">{{ session('success') }}</p>
        @endif
    </div>

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
