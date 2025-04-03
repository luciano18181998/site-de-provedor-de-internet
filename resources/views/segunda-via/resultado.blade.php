<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Segunda Via</title>
</head>
<body>
    <h1>Segunda Via da Fatura</h1>

    <p><strong>Nome:</strong> {{ $fatura->usuario->nome }}</p>
    <p><strong>Valor:</strong> R$ {{ number_format($fatura->valor, 2, ',', '.') }}</p>
    <p><strong>Vencimento:</strong> {{ date('d/m/Y', strtotime($fatura->vencimento)) }}</p>

    <a href="https://www.mercadopago.com.br/checkout/v1/redirect?preference-id={{ $fatura->mercado_pago_id }}" target="_blank">
        <button>Pagar Agora</button>
    </a>
</body>
</html>
