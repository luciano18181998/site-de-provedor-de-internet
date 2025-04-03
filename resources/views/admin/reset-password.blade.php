<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redefinir Senha</title>
</head>
<body>
    <h2>Redefinir Senha</h2>

    @if ($errors->any())
        <p style="color: red;">{{ $errors->first() }}</p>
    @endif

    <form method="POST" action="{{ route('admin.password.update') }}">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">

        <label for="email">E-mail:</label>
        <input type="email" name="email" id="email" required>

        <label for="password">Nova Senha:</label>
        <input type="password" name="password" id="password" required>

        <label for="password_confirmation">Confirme a Senha:</label>
        <input type="password" name="password_confirmation" id="password_confirmation" required>

        <button type="submit">Redefinir Senha</button>
    </form>

    <a href="{{ route('admin.login') }}">Voltar para o Login</a>
</body>
</html>
