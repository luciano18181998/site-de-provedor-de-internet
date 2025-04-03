<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Administrador;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    // Exibir tela de login
    public function showLogin()
    {
        return view('admin.login');
    }

    // Processar login do administrador
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::guard('admin')->attempt($credentials)) {
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors(['email' => 'Credenciais inválidas']);
    }

    // Exibir tela de registro
    public function showRegister()
    {
        return view('admin.register');
    }

    // Processar o cadastro de administrador
    public function register(Request $request)
    {
        $data = $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|unique:administradores',
            'password' => 'required|min:6|confirmed',
        ]);

        Administrador::create([
            'nome' => $data['nome'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        return redirect()->route('admin.login')->with('success', 'Cadastro realizado com sucesso!');
    }

    // Dashboard do Administrador
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    // Logout do Administrador
    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}
