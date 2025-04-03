<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * O mapa de políticas da aplicação.
     *
     * @var array
     */
    protected $policies = [
        // Defina suas políticas aqui, se necessário
    ];

    /**
     * Registra quaisquer serviços de autenticação/autorização.
     */
    public function boot()
    {
        $this->registerPolicies();
    }
}
