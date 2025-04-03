@extends('layouts.app')

@section('title', 'Fatura')

@section('content')
    <h1>Fatura do Cliente</h1>

    <p><strong>Nome:</strong> {{ $usuario->nome }}</p>
    <p><strong>CPF:</strong> {{ $usuario->cpf }}</p>
    <p><strong>Valor:</strong> R$ {{ number_format($fatura->valor, 2, ',', '.') }}</p>
    <p><strong>Vencimento:</strong> {{ \Carbon\Carbon::parse($fatura->vencimento)->format('d/m/Y') }}</p>
    <p><strong>Status:</strong> {{ ucfirst($fatura->status) }}</p>

    <form action="{{ route('pagamento.gerar') }}" method="POST">
        @csrf
        <input type="hidden" name="valor" value="{{ $fatura->valor }}">
        <button type="submit">Pagar</button>
    </form>
@endsection
