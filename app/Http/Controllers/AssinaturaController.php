<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use MercadoPago\SDK;
use MercadoPago\Preapproval;

class AssinaturaController extends Controller
{
    public function criarAssinatura(Request $request)
    {
        // 1️⃣ Pega o Access Token do Mercado Pago do .env
        $accessToken = env('MERCADO_PAGO_ACCESS_TOKEN');

        // 2️⃣ Se o token não estiver configurado, retorna erro
        if (!$accessToken) {
            return response()->json(['erro' => 'Token do Mercado Pago não configurado'], 500);
        }

        // 3️⃣ Define o Access Token no SDK do Mercado Pago
        SDK::setAccessToken($accessToken);

        // 4️⃣ Validação dos dados recebidos
        $request->validate([
            'email' => 'required|email',
            'valor' => 'required|numeric|min:1',
        ]);

        try {
            // 5️⃣ Criar uma nova assinatura
            $preapproval = new Preapproval();
            $preapproval->payer_email = $request->email;
            $preapproval->back_url = route('assinatura.sucesso');
            $preapproval->reason = "Assinatura mensal";
            $preapproval->auto_recurring = [
                "frequency" => 1,
                "frequency_type" => "months",
                "transaction_amount" => $request->valor,
                "currency_id" => "BRL",
                "start_date" => date('c'),
                "end_date" => date('c', strtotime('+1 year'))
            ];

            // 6️⃣ Salva a assinatura no Mercado Pago
            $preapproval->save();

            // 7️⃣ Verifica se houve erro
            if (!$preapproval->id) {
                return response()->json([
                    'erro' => 'Erro ao criar assinatura no Mercado Pago',
                    'detalhes' => $preapproval->error
                ], 500);
            }

            // 8️⃣ Redireciona para o link de pagamento
            return redirect($preapproval->init_point);
        } catch (\Exception $e) {
            return response()->json([
                'erro' => 'Ocorreu um erro inesperado',
                'detalhes' => $e->getMessage()
            ], 500);
        }
    }

    public function sucesso()
    {
        return "Pagamento realizado com sucesso!";
    }
}
