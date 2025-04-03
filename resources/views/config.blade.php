<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configuração de E-mail e Mercado Pago</title>
</head>
<body>
    <h1>Configuração de E-mail e Mercado Pago</h1>

    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <form action="/configurar" method="POST">
        @csrf
        <div>
            <label for="MAIL_HOST">Servidor SMTP:</label>
            <input type="text" id="MAIL_HOST" name="MAIL_HOST" value="{{ env('MAIL_HOST') }}" required>
        </div>

        <div>
            <label for="MAIL_USERNAME">Usuário do E-mail:</label>
            <input type="text" id="MAIL_USERNAME" name="MAIL_USERNAME" value="{{ env('MAIL_USERNAME') }}" required>
        </div>

        <div>
            <label for="MAIL_PASSWORD">Senha do E-mail:</label>
            <input type="password" id="MAIL_PASSWORD" name="MAIL_PASSWORD" value="{{ env('MAIL_PASSWORD') }}" required>
        </div>

        <div>
            <label for="MERCADO_PAGO_ACCESS_TOKEN">Token do Mercado Pago:</label>
            <input type="text" id="MERCADO_PAGO_ACCESS_TOKEN" name="MERCADO_PAGO_ACCESS_TOKEN" value="{{ env('MERCADO_PAGO_ACCESS_TOKEN') }}" required>
        </div>

        <button type="submit">Salvar Configurações</button>
    </form>
</body>
</html>
