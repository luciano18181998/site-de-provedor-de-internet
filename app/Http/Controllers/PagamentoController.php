<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fatura;
use MercadoPago;

class PagamentoController extends Controller
{
    public function gerar(Request $request, $fatura_id)
    {
        $fatura = Fatura::findOrFail($fatura_id);
        \MercadoPago\SDK::setAccessToken(config('services.mercadopago.access_token'));

        $item = new \MercadoPago\Item();
        $item->title = "Fatura #{$fatura->id} - Cliente {$fatura->usuario->nome}";
        $item->quantity = 1;
        $item->unit_price = (float) $fatura->valor;

        $preference = new \MercadoPago\Preference();
        $preference->items = [$item];
        $preference->external_reference = $fatura->id;

        $preference->back_urls = [
            "success" => route('pagamento.sucesso'),
            "failure" => route('pagamento.falha'),
        ];
        $preference->auto_return = "approved";
        $preference->notification_url = url('/webhook/mercadopago');

        try {
            $preference->save();
            return redirect($preference->init_point);
        } catch (\Exception $e) {
            return back()->with('error', 'Erro ao processar pagamento: ' . $e->getMessage());
        }
    }

    public function gerarBoleto(Request $request, $fatura_id)
    {
        $fatura = Fatura::findOrFail($fatura_id);
        $usuario = $fatura->usuario;

        \MercadoPago\SDK::setAccessToken(config('services.mercadopago.access_token'));

        $payment = new \MercadoPago\Payment();
        $payment->transaction_amount = (float) $fatura->valor;
        $payment->description = "Fatura #{$fatura->id} - Cliente {$usuario->nome}";
        $payment->payment_method_id = "bolbradesco";

        // Vencimento em 3 dias
        $vencimento = now()->addDays(3)->format('Y-m-d\TH:i:s.000P');
        $payment->date_of_expiration = $vencimento;

        $payment->payer = [
            "email" => $usuario->email,
            "first_name" => $usuario->nome,
            "identification" => [
                "type" => "CPF",
                "number" => preg_replace('/[^0-9]/', '', $usuario->cpf)
            ]
        ];

        try {
            $payment->save();

            if ($payment->status === 'pending') {
                $fatura->external_id = $payment->id;
                $fatura->status = 'pendente';
                $fatura->save();

                return redirect($payment->transaction_details->external_resource_url);
            } else {
                return back()->with('error', 'Erro ao gerar boleto.');
            }
        } catch (\Exception $e) {
            return back()->with('error', 'Erro ao gerar boleto: ' . $e->getMessage());
        }
    }

    public function sucesso()
    {
        return view('pagamento.sucesso');
    }

    public function falha()
    {
        return view('pagamento.falha');
    }

    public function notificacao(Request $request)
    {
        \MercadoPago\SDK::setAccessToken(config('services.mercadopago.access_token'));

        $type = $request->get('type');
        $paymentId = $request->input('data.id');

        \Log::info('?? Webhook recebido', [
            'type' => $type,
            'payment_id' => $paymentId,
        ]);

        if ($type === 'payment' && $paymentId) {
            try {
                $payment = \MercadoPago\Payment::find_by_id($paymentId);

                if ($payment && $payment->status === 'approved') {
                    $faturaId = $payment->external_reference;

                    $fatura = Fatura::find($faturaId);
                    if ($fatura && $fatura->status !== 'pago') {
                        $fatura->status = 'pago';
                        $fatura->save();

                        \Log::info("? Fatura #{$fatura->id} marcada como paga.");
                    }
                } else {
                    \Log::warning("?? Pagamento {$paymentId} não aprovado.");
                }
            } catch (\Exception $e) {
                \Log::error("? Erro no webhook: " . $e->getMessage());
            }
        }

        return response()->json(['status' => 'ok'], 200);
    }
}
