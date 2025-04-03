@extends('layouts.app')

@section('title', 'Segunda Via')

@section('content')
    <h1>Segunda Via</h1>
    <p>Digite seu CPF para consultar a segunda via do pagamento.</p>

    @if(session('error'))
        <p style="color: red;">{{ session('error') }}</p>
    @endif

    <form action="{{ route('segunda-via.consultar') }}" method="POST">
        @csrf
        <input type="text" name="cpf" placeholder="Digite seu CPF">
        <button type="submit">Consultar</button>
    </form>
@endsection
