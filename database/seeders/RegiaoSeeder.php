<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Regiao;

class RegiaoSeeder extends Seeder
{
    public function run()
    {
        $regioes = ['Sul', 'Sudeste', 'Centro-Oeste', 'Nordeste', 'Norte'];

        foreach ($regioes as $nome) {
            Regiao::create(['nome' => $nome]);
        }
    }
}
