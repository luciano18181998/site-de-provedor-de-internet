<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Artisan;

class ConfigController extends Controller
{
    // Exibe o formulário de configuração
    public function index()
    {
        return view('config.form', [
            'app_name' => env('APP_NAME'),
            'app_url' => env('APP_URL'),
            'mail_host' => env('MAIL_HOST'),
            'mail_username' => env('MAIL_USERNAME'),
            'mail_password' => env('MAIL_PASSWORD'),
            'mail_mailer' => env('MAIL_MAILER'),
            'mail_port' => env('MAIL_PORT'),
            'mail_encryption' => env('MAIL_ENCRYPTION'),
            'mail_from_name' => env('MAIL_FROM_NAME'),
            'mercado_pago_public_key' => env('MERCADO_PAGO_PUBLIC_KEY'),
            'mercado_pago_access_token' => env('MERCADO_PAGO_ACCESS_TOKEN'),
        ]);
    }

    // Salva as configurações enviadas pelo formulário
    public function store(Request $request)
    {
        // Valida os dados do formulário
        $request->validate([
            'APP_NAME' => 'required|string',
            'APP_URL' => 'required|url',
            'MAIL_HOST' => 'required|string',
            'MAIL_USERNAME' => 'required|string',
            'MAIL_PASSWORD' => 'required|string',
            'MAIL_MAILER' => 'required|string',
            'MAIL_PORT' => 'required|numeric',
            'MAIL_ENCRYPTION' => 'required|string',
            'MAIL_FROM_NAME' => 'required|string',
            'MERCADO_PAGO_PUBLIC_KEY' => 'required|string',
            'MERCADO_PAGO_ACCESS_TOKEN' => 'required|string',
        ]);

        // Caminho do arquivo .env
        $envFile = base_path('.env');

        // Verifica se o arquivo .env existe
        if (!File::exists($envFile)) {
            return back()->with('error', 'Arquivo .env não encontrado.');
        }

        // Lê o conteúdo atual do .env
        $envContent = File::get($envFile);

        // Define as chaves e valores a serem atualizados
        $configurations = [
            'APP_NAME' => $request->APP_NAME,
            'APP_URL' => $request->APP_URL,
            'MAIL_HOST' => $request->MAIL_HOST,
            'MAIL_USERNAME' => $request->MAIL_USERNAME,
            'MAIL_PASSWORD' => $request->MAIL_PASSWORD,
            'MAIL_MAILER' => $request->MAIL_MAILER,
            'MAIL_PORT' => $request->MAIL_PORT,
            'MAIL_ENCRYPTION' => $request->MAIL_ENCRYPTION,
            'MAIL_FROM_NAME' => $request->MAIL_FROM_NAME,
            'MERCADO_PAGO_PUBLIC_KEY' => $request->MERCADO_PAGO_PUBLIC_KEY,
            'MERCADO_PAGO_ACCESS_TOKEN' => $request->MERCADO_PAGO_ACCESS_TOKEN,
        ];

        // Substitui ou adiciona cada chave no arquivo .env
        foreach ($configurations as $key => $value) {
            $envContent = preg_replace(
                "/^{$key}=.*/m",
                "{$key}=\"{$value}\"",
                $envContent
            );
        }

        // Salva as alterações no arquivo .env
        File::put($envFile, $envContent);

        // Limpa o cache das configurações para aplicar as mudanças
        Artisan::call('config:clear');
        Artisan::call('cache:clear');

        return back()->with('success', 'Configurações salvas com sucesso!');
    }
}
