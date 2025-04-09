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
        $hoje = Carbon::now(); // respeita o timezone do app
        $usuarios = Usuario::with('plano')->get();

        foreach ($usuarios as $usuario) {
            // Garante que o dia seja válido entre 1 e 28
            $dia = min(max((int) $usuario->data_vencimento, 1), 28);

            // Cria a data de vencimento com o dia desejado
            $vencimento = Carbon::create($hoje->year, $hoje->month, $dia)->startOfDay();

            // Se a data de vencimento já passou neste mês, gera para o próximo
            if ($vencimento->isPast()) {
                $vencimento->addMonth();
            }

            // Verifica se já existe fatura para este usuário no mês/ano
            $existe = Fatura::where('usuario_id', $usuario->id)
                ->whereMonth('vencimento', $vencimento->month)
                ->whereYear('vencimento', $vencimento->year)
                ->exists();

            if (!$existe) {
                Fatura::create([
                    'usuario_id' => $usuario->id,
                    'valor' => $usuario->plano->valor,
                    'status' => 'pendente',
                    'vencimento' => $vencimento->toDateString(),
                ]);

                $this->info("✅ Fatura criada para {$usuario->nome} com vencimento em {$vencimento->format('d/m/Y')}");
            } else {
                $this->line("ℹ️  Já existe fatura para {$usuario->nome} em {$vencimento->format('m/Y')}");
            }
        }

        $this->info('✅ Geração de faturas finalizada com sucesso.');
    }
}
