@extends('layouts.app')

@section('content')
<div style="text-align: center; padding: 40px;">
    <h1>? Pagamento aprovado</h1>
    <p>Obrigado! Seu pagamento foi concluído com sucesso.</p>
    <a href="{{ url('/') }}">Voltar ao site</a>
</div>
@endsection
