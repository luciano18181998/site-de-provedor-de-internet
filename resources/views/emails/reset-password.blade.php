<!DOCTYPE html>
<html>
<head>
    <title>Redefinição de Senha</title>
</head>
<body>
    <p>Você solicitou a redefinição de senha.</p>
    <p>Clique no link abaixo para redefinir sua senha:</p>
    <a href="{{ url('/admin/reset-password/' . $token) }}">Redefinir Senha</a>
</body>
</html>
