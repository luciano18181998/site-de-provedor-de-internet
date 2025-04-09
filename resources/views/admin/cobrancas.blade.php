<td>
    <form action="{{ route('pagamento.gerar', ['fatura_id' => $fatura->id]) }}" method="POST">
        @csrf
        <input type="hidden" name="valor" value="{{ $fatura->valor }}">
        <button type="submit" class="btn-green">💳 Pagar</button>
    </form>

    <form action="{{ route('cobrancas.remover', $fatura->id) }}" method="POST" style="margin-top: 5px;">
        @csrf
        <button class="btn-red" type="submit">❌ Remover</button>
    </form>
</td>

