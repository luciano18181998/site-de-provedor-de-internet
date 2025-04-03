<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Models\Regiao;
use App\Models\Plano;

class UsuarioController extends Controller
{
    public function index()
    {
        $usuarios = Usuario::with(['regiao', 'plano'])->get();
        return view('usuarios.index', compact('usuarios'));
    }

    public function create()
    {
        $regioes = Regiao::all(); // Buscar todas as regiões
        return view('usuarios.create', compact('regioes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|max:255',
            'telefone' => 'required',
            'cpf' => 'required|unique:usuarios,cpf',
            'email' => 'required|email|unique:usuarios,email',
            'data_vencimento' => 'required|integer|min:1|max:30',
            'regiao_id' => 'required|exists:regioes,id',
            'plano_id' => 'required|exists:planos,id'
        ]);

        Usuario::create($request->all());

        return redirect()->route('usuarios.index')->with('success', 'Usuário cadastrado com sucesso!');
    }

    public function getPlanos($regiao_id)
    {
        $planos = Plano::where('regiao_id', $regiao_id)->get();
        return response()->json($planos);
    }

    // Método para excluir usuário
    public function destroy($id)
    {
        $usuario = Usuario::find($id);

        if (!$usuario) {
            return redirect()->route('usuarios.index')->with('error', 'Usuário não encontrado.');
        }

        $usuario->delete();

        return redirect()->route('usuarios.index')->with('success', 'Usuário excluído com sucesso.');
    }
}
