<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Plano;
use App\Models\Regiao;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class PlanoController extends Controller
{
    public function index()
    {
        $planos = Plano::with('regiao')->get();
        return view('planos.index', compact('planos'));
    }

    public function create()
    {
        $regioes = Regiao::all(); // Buscar todas as regiões para selecionar no formulário
        return view('planos.create', compact('regioes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|max:255',
            'valor' => 'required|numeric',
            'descricao' => 'required',
            'regiao_id' => 'required|exists:regioes,id'
        ]);

        Plano::create([
            'nome' => $request->nome,
            'valor' => $request->valor,
            'descricao' => $request->descricao,
            'regiao_id' => $request->regiao_id,
            'user_id' => Auth::id() // Pega o ID do usuário autenticado
        ]);

        return redirect()->route('planos.index')->with('success', 'Plano cadastrado com sucesso!');
    }

    public function destroy($id)
    {
        $plano = Plano::findOrFail($id);
        $plano->delete();

        return redirect()->route('planos.index')->with('success', 'Plano excluído com sucesso!');
    }

    public function showPlanos()
    {
        $appName = Config::get('app.name'); // Obtém o nome do aplicativo do config/app.php
        $regioes = Regiao::all(); 

        return view('planos', compact('appName', 'regioes'));
    }

    public function getPlanosPorRegiao($id)
    {
        $planos = Plano::where('regiao_id', $id)->get();
        return response()->json($planos);
    }
}
