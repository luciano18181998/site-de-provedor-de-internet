<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Models\Fatura;
use Carbon\Carbon;

class CobrancaController extends Controller
{
    public function index(Request $request)
    {
        $usuarios = Usuario::all();

        // Faturas pendentes
        $pendentes = Fatura::where('status', 'pendente')->with('usuario')->get();

        // Faturas pagas (opcionalmente filtradas por usuário)
        $pagosQuery = Fatura::where('status', 'pago')->with('usuario')->latest();

        if ($request->filled('usuario_id')) {
            $pagosQuery->where('usuario_id', $request->usuario_id);
        }

        $pagos = $pagosQuery->get();

        return view('cobrancas.index', compact('usuarios', 'pendentes', 'pagos'));
    }

    public function gerar(Request $request)
    {
        $request->validate([
            'usuario_id' => 'required|exists:usuarios,id',
        ]);

        $usuario = Usuario::findOrFail($request->usuario_id);

        // Calcula a data de vencimento no próximo mês
        $dataVencimento = Carbon::now()->addMonth();
        $diaVencimento = (int) $usuario->data_vencimento;

        // Verifica se o dia de vencimento existe no próximo mês
        $ultimoDiaDoMes = $dataVencimento->copy()->endOfMonth()->day;
        if ($diaVencimento > $ultimoDiaDoMes) {
            $diaVencimento = $ultimoDiaDoMes;
        }

        $dataVencimento->day = $diaVencimento;

        // Verifica se já existe fatura para este usuário neste mês e ano
        $existeFatura = Fatura::where('usuario_id', $usuario->id)
            ->whereYear('vencimento', $dataVencimento->year)
            ->whereMonth('vencimento', $dataVencimento->month)
            ->exists();

        if ($existeFatura) {
            return redirect()->route('cobrancas.index')->with('success', 'Já existe uma cobrança gerada para este mês.');
        }

        // Cria nova fatura
        $fatura = new Fatura();
        $fatura->usuario_id = $usuario->id;
        $fatura->valor = $usuario->plano->valor;
        $fatura->vencimento = $dataVencimento->format('Y-m-d');
        $fatura->status = 'pendente';
        $fatura->save();

        return redirect()->route('cobrancas.index')->with('success', 'Cobrança gerada com sucesso!');
    }

    public function remover(Request $request, $id)
    {
        $fatura = Fatura::findOrFail($id);

        // Impede remoção de faturas pagas (opcional)
        if ($fatura->status === 'pago') {
            return redirect()->route('cobrancas.index')->with('success', 'Não é possível remover uma fatura paga.');
        }

        $fatura->delete();

        return redirect()->route('cobrancas.index')->with('success', 'Cobrança removida com sucesso.');
    }
}
