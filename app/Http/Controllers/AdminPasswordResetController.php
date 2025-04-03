<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Models\Administrador;

class AdminPasswordResetController extends Controller
{
    // Exibir formulário de recuperação de senha
    public function showForgotPasswordForm()
    {
        return view('admin.forgot-password');
    }

    // Enviar link de redefinição de senha
    public function sendResetLink(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::broker('administradores')->sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with('success', 'E-mail de redefinição enviado!')
            : back()->withErrors(['email' => 'Erro ao enviar link de redefinição.']);
    }

    // Exibir formulário de redefinição de senha
    public function showResetPasswordForm($token)
    {
        return view('admin.reset-password', ['token' => $token]);
    }

    // Processar redefinição de senha
    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6|confirmed',
            'token' => 'required'
        ]);

        $status = Password::broker('administradores')->reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($admin, $password) {
                $admin->forceFill([
                    'password' => Hash::make($password),
                    'remember_token' => Str::random(60),
                ])->save();

                event(new PasswordReset($admin));
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('admin.login')->with('success', 'Senha redefinida com sucesso!')
            : back()->withErrors(['email' => 'Erro ao redefinir a senha.']);
    }
}
