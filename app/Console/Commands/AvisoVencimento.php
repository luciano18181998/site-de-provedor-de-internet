<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Fatura;
use App\Mail\AvisoFatura;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class AvisoVencimento extends Command
{
    protected $signature = 'fatura:avisar';
    protected $description = 'Envia um e-mail para usuários com fatura perto do vencimento';

    public function handle()
    {
        $hoje = Carbon::now();
        $faturas = Fatura::where('status', 'pendente')
                         ->whereDate('vencimento', '<=', $hoje->addDays(5)) // 5 dias antes do vencimento
                         ->get();

        foreach ($faturas as $fatura) {
            Mail::to($fatura->usuario->email)->send(new AvisoFatura($fatura));
        }

        $this->info('E-mails de aviso enviados!');
    }
}
