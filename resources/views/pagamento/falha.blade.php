@extends('layouts.app') {{-- Usa o layout principal, se houver --}}

@section('content')
    <div style="text-align: center; padding: 50px;">
        <h1>? Pagamento não realizado</h1>
        <p>O pagamento foi cancelado ou não foi concluído.</p>
        <a href="{{ route('site.index') }}" class="btn btn-primary">Voltar para o início</a>
    </div>
@endsection
