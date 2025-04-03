<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Models\Fatura;
use Carbon\Carbon;

class CobrancaController extends Controller
{
    public function index()
    {
        $usuarios = Usuario::all(); // Pega todos os usuários
        $pendentes = Fatura::where('status', 'pendente')->with('usuario')->get();
        $pagos = Fatura::where('status', 'pago')->with('usuario')->get();

        return view('cobrancas.index', compact('usuarios', 'pendentes', 'pagos'));
    }

    public function gerar(Request $request)
    {
        $usuario = Usuario::findOrFail($request->usuario_id);

        // Criar uma nova fatura para o usuário
        $fatura = new Fatura();
        $fatura->usuario_id = $usuario->id;
        $fatura->valor = $usuario->plano->valor;
        $fatura->vencimento = Carbon::now()->addMonth()->format('Y-m-d'); // Próximo mês
        $fatura->status = 'pendente';
        $fatura->save();

        return redirect()->route('cobrancas.index')->with('success', 'Cobrança gerada com sucesso!');
    }

    public function remover($id)
    {
        Fatura::destroy($id);
        return redirect()->route('cobrancas.index')->with('success', 'Cobrança removida com sucesso.');
    }
}
