<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fatura;

class MercadoPagoWebhookController extends Controller
{
    public function handle(Request $request)
    {
        $data = $request->all();

        if (isset($data['data']['id'])) {
            $paymentId = $data['data']['id'];

            // Consultar o status do pagamento no Mercado Pago
            $mpResponse = $this->consultarPagamento($paymentId);

            if ($mpResponse && isset($mpResponse['status']) && $mpResponse['status'] === 'approved') {
                // Encontrar a fatura e atualizar status
                $fatura = Fatura::where('id', $mpResponse['external_reference'])->first();

                if ($fatura) {
                    $fatura->status = 'pago';
                    $fatura->save();
                }
            }
        }

        return response()->json(['status' => 'success']);
    }

    private function consultarPagamento($paymentId)
    {
        $accessToken = env('MERCADO_PAGO_ACCESS_TOKEN');

        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => "https://api.mercadopago.com/v1/payments/{$paymentId}",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => [
                "Authorization: Bearer $accessToken"
            ]
        ]);

        $response = curl_exec($curl);
        curl_close($curl);

        return json_decode($response, true);
    }
}
