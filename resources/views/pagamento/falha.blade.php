@extends('layouts.app') {{-- Usa o layout principal, se houver --}}

@section('content')
    <div style="text-align: center; padding: 50px;">
        <h1>? Pagamento n�o realizado</h1>
        <p>O pagamento foi cancelado ou n�o foi conclu�do.</p>
        <a href="{{ route('site.index') }}" class="btn btn-primary">Voltar para o in�cio</a>
    </div>
@endsection
