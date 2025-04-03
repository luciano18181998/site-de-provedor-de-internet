<p>Olá {{ $fatura->usuario->nome }},</p>
<p>Sua fatura no valor de R$ {{ number_format($fatura->valor, 2, ',', '.') }} vence em {{ date('d/m/Y', strtotime($fatura->vencimento)) }}.</p>
<p>Realize o pagamento o quanto antes para evitar multas.</p>
<p><a href="{{ route('segunda-via.consultar') }}">Clique aqui para pagar</a></p>
