<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Models\Fatura;
use Illuminate\Support\Facades\Config;

class SegundaViaController extends Controller
{
    public function index()
    {
        return view('segunda-via.index', ['appName' => Config::get('app.name')]);
    }

    public function consultar(Request $request)
    {
        // Validar CPF
        $request->validate([
            'cpf' => 'required|digits:11',
        ]);

        // Remover formatação do CPF
        $cpf = preg_replace('/\D/', '', $request->cpf);

        // Buscar usuário pelo CPF
        $usuario = Usuario::where('cpf', $cpf)->first();
        if (!$usuario) {
            return redirect()->route('segunda-via.index')->with('error', 'Usuário não encontrado.');
        }

        // Buscar fatura pendente
        $fatura = Fatura::where('usuario_id', $usuario->id)
                        ->whereIn('status', ['pendente', 'PENDENTE', 'em aberto'])
                        ->orderBy('vencimento', 'asc')
                        ->first();

        if (!$fatura) {
            return redirect()->route('segunda-via.index')->with('error', 'Nenhuma fatura pendente encontrada.');
        }

        // Garantir que o valor da fatura é válido
        if ($fatura->valor <= 0) {
            return redirect()->route('segunda-via.index')->with('error', 'Erro: O valor da fatura é inválido.');
        }

        return view('segunda-via.fatura', [
            'usuario' => $usuario,
            'fatura' => $fatura,
            'appName' => Config::get('app.name') // Passando appName para evitar erro na view
        ]);
    }
}
