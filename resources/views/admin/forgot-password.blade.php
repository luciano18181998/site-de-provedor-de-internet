<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Senha</title>
</head>
<body>
    <h2>Recuperar Senha</h2>

    @if (session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    @if ($errors->any())
        <p style="color: red;">{{ $errors->first() }}</p>
    @endif

    <form method="POST" action="{{ route('admin.forgot-password.send') }}">
        @csrf
        <label for="email">Digite seu e-mail:</label>
        <input type="email" name="email" id="email" required>
        <button type="submit">Enviar Link</button>
    </form>

    <a href="{{ route('admin.login') }}">Voltar para o Login</a>
</body>
</html>
