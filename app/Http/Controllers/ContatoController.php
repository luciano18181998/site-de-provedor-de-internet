<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContatoController extends Controller
{
    public function enviarFormulario(Request $request)
    {
        // Validação dos campos
        $request->validate([
            'nome' => 'required|string|max:255',
            'telefone' => 'required|string|max:20',
            'cpf' => 'required|string|max:14',
        ]);

        // Dados do formulário
        $dados = [
            'nome' => $request->input('nome'),
            'telefone' => $request->input('telefone'),
            'cpf' => $request->input('cpf'),
        ];

        // E-mail de destino
        $para = 'lciano18181998@gmail.com';

        // Envio do e-mail
        Mail::send('emails.contato', $dados, function ($message) use ($para) {
            $message->to($para)
                    ->subject('Novo Contato do Site');
        });
        

        return back()->with('success', 'Mensagem enviada com sucesso!');
    }
}
