<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fatura;
use App\Models\Usuario;

class SegundaViaController extends Controller
{
    public function index()
    {
        return view('segunda-via', [
            'appName' => config('app.name') // Passa o nome do app para a view
        ]);
    }

    public function consultar(Request $request)
    {
        $request->validate([
            'cpf' => 'required'
        ]);

        $usuario = Usuario::where('cpf', $request->cpf)->first();

        if (!$usuario) {
            return redirect()->back()->with('error', 'CPF não encontrado.');
        }

        $fatura = Fatura::where('usuario_id', $usuario->id)
                        ->where('status', 'pendente')
                        ->orderBy('vencimento', 'asc')
                        ->first();

        if (!$fatura) {
            return redirect()->back()->with('error', 'Nenhuma fatura pendente encontrada para este CPF.');
        }

        return view('segunda-via', [
            'appName' => config('app.name'), // Passa também no retorno com fatura
            'fatura' => $fatura
        ]);
    }
}
