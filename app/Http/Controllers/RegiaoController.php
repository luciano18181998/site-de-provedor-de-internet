<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Regiao;

class RegiaoController extends Controller
{
    public function index()
    {
        $regioes = Regiao::all();
        return view('regioes.index', compact('regioes'));
    }

    public function create()
    {
        return view('regioes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|unique:regioes|max:255'
        ]);

        Regiao::create([
            'nome' => $request->nome
        ]);

        return redirect()->route('regioes.index')->with('success', 'Região cadastrada com sucesso!');
    }

    public function destroy($id)
    {
        $regiao = Regiao::findOrFail($id);
        $regiao->delete();

        return redirect()->route('regioes.index')->with('success', 'Região excluída com sucesso!');
    }
}
