<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Usuario;
use App\Models\Fatura;
use Carbon\Carbon;

class GerarFaturasMensais extends Command
{
    protected $signature = 'fatura:gerar';
    protected $description = 'Gera faturas automaticamente todo mês';

    public function handle()
    {
        $usuarios = Usuario::all();

        foreach ($usuarios as $usuario) {
            Fatura::create([
                'usuario_id' => $usuario->id,
                'valor' => $usuario->plano->valor,
                'status' => 'pendente',
                'vencimento' => Carbon::now()->addDays($usuario->data_vencimento),
            ]);
        }

        $this->info('Faturas geradas com sucesso!');
    }
}
