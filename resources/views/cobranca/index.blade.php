@extends('layouts.app')

@section('title', 'Cobrança')

@section('content')
    <h1>Gerar Cobrança</h1>

    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <form action="{{ route('cobranca.gerar') }}" method="POST">
        @csrf
        <label for="usuario_id">Selecione o Usuário:</label>
        <select name="usuario_id" required>
            @foreach($usuarios as $usuario)
                <option value="{{ $usuario->id }}">{{ $usuario->nome }} - CPF: {{ $usuario->cpf }}</option>
            @endforeach
        </select>
        <button type="submit">Gerar Cobrança</button>
    </form>
@endsection
