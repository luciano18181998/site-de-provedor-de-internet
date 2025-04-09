<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define os agendamentos de comandos da aplicação.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // Gera faturas automaticamente no 1º dia de cada mês às 08:00
        $schedule->command('fatura:gerar')->monthlyOn(1, '08:00');
    }

    /**
     * Registra os comandos da aplicação.
     *
     * @return void
     */
    protected function commands()
    {
        // Carrega os comandos da pasta App\Console\Commands
        $this->load(__DIR__.'/Commands');

        // Inclui qualquer comando personalizado do arquivo de rotas de console
        require base_path('routes/console.php');
    }
}
