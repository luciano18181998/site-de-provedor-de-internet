<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use MercadoPago;

class PagamentoController extends Controller
{
    public function gerar(Request $request)
    {
        // Verifica se o valor foi enviado na requisição
        $request->validate([
            'valor' => 'required|numeric|min:0.01',
        ]);

        // Configurar Mercado Pago com o Access Token
        \MercadoPago\SDK::setAccessToken(config('services.mercadopago.access_token'));

        // Criar uma nova preferência de pagamento
        $preference = new \MercadoPago\Preference();

        // Criar um item de pagamento
        $item = new \MercadoPago\Item();
        $item->title = "Pagamento de Fatura";
        $item->quantity = 1;
        $item->unit_price = (float) $request->input('valor'); // Pegando o valor corretamente

        $preference->items = [$item];

        // URLs de retorno
        $preference->back_urls = [
            "success" => route('pagamento.sucesso'),
            "failure" => route('pagamento.falha'),
        ];
        $preference->auto_return = "approved";

        // Salvar a preferência
        try {
            $preference->save();
            return redirect($preference->init_point);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erro ao processar pagamento: ' . $e->getMessage());
        }
    }

    public function sucesso()
    {
        return response()->json([
            'status' => 'success',
            'message' => 'Pagamento realizado com sucesso!',
        ]);
    }

    public function falha()
    {
        return response()->json([
            'status' => 'error',
            'message' => 'Pagamento não concluído. Tente novamente.',
        ]);
    }
}
