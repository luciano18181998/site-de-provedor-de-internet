<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContatoController;
use App\Http\Controllers\RegiaoController;
use App\Http\Controllers\PlanoController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AssinaturaController;
use App\Http\Controllers\SegundaViaController;
use App\Http\Controllers\PagamentoController;
use Illuminate\Support\Facades\Config;
use App\Http\Controllers\CobrancaController;
use App\Http\Controllers\MercadoPagoWebhookController;
use App\Http\Controllers\AdminPasswordResetController;

use App\Http\Controllers\ConfigController;
// Página inicial
Route::get('/', function () {
    return view('app-name', ['appName' => config('app.name')]);
})->name('site.index');

Route::get('/contato', function () {
    return view('formulario', ['appName' => Config::get('app.name')]);
})->name('site.contato');
Route::post('/enviar-contato', [ContatoController::class, 'enviarFormulario'])->name('enviar.contato');

// Grupo de rotas protegidas para administradores
Route::middleware(['admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    // Regiões
    Route::get('/admin/regioes', [RegiaoController::class, 'index'])->name('regioes.index');
    Route::get('/admin/regioes/create', [RegiaoController::class, 'create'])->name('regioes.create');
    Route::post('/admin/regioes/store', [RegiaoController::class, 'store'])->name('regioes.store');
    Route::delete('/admin/regioes/{id}', [RegiaoController::class, 'destroy'])->name('regioes.destroy');

    // Planos
    Route::get('/admin/planos', [PlanoController::class, 'index'])->name('planos.index');
    Route::get('/admin/planos/create', [PlanoController::class, 'create'])->name('planos.create');
    Route::post('/admin/planos/store', [PlanoController::class, 'store'])->name('planos.store');
    Route::delete('/admin/planos/{id}', [PlanoController::class, 'destroy'])->name('planos.destroy');

    // Usuários
    Route::get('/admin/usuarios', [UsuarioController::class, 'index'])->name('usuarios.index');
    Route::get('/admin/usuarios/create', [UsuarioController::class, 'create'])->name('usuarios.create');
    Route::post('/admin/usuarios', [UsuarioController::class, 'store'])->name('usuarios.store');
    Route::delete('/admin/usuarios/{id}', [UsuarioController::class, 'destroy'])->name('usuarios.destroy');
    Route::get('/usuarios/getPlanos/{regiao_id}', [UsuarioController::class, 'getPlanos']);

    // Administradores
    Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
    Route::get('/admin/register', [AdminController::class, 'showRegister'])->name('admin.register');
    Route::post('/admin/register', [AdminController::class, 'register']);
    Route::get('/admin/lista', [AdminAuthController::class, 'lista'])->name('admin.lista');
    Route::delete('/admin/delete/{id}', [AdminAuthController::class, 'delete'])->name('admin.delete');
    
    // Configurações Gerais
    Route::get('/admin/config', [ConfigController::class, 'index']);
    Route::post('/admin/config', [ConfigController::class, 'store'])->name('config.save');

    Route::get('admin/cobrancas', [CobrancaController::class, 'index'])->name('cobrancas.index');
    Route::post('admin/cobrancas/gerar', [CobrancaController::class, 'gerar'])->name('cobrancas.gerar');
    Route::post('admin/cobrancas/remover/{id}', [CobrancaController::class, 'remover'])->name('cobrancas.remover');
});

// Rotas públicas para login e registro do administrador
Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');

// Planos públicos
Route::get('/planos', [PlanoController::class, 'showPlanos'])->name('planos.show');
Route::get('/planos/regiao/{id}', [PlanoController::class, 'getPlanosPorRegiao']);

// Assinatura com Mercado Pago
Route::post('/assinatura/criar', [AssinaturaController::class, 'criar'])->name('assinatura.criar');
Route::get('/assinatura/sucesso', [AssinaturaController::class, 'sucesso'])->name('assinatura.sucesso');

// Segunda Via
Route::get('/segunda-via', [SegundaViaController::class, 'index'])->name('segunda-via.index');
Route::post('/segunda-via/consultar', [SegundaViaController::class, 'consultar'])->name('segunda-via.consultar');


// Pagamento com Mercado Pago

Route::get('/pagamento/sucesso', [PagamentoController::class, 'sucesso'])->name('pagamento.sucesso');
Route::get('/pagamento/falha', [PagamentoController::class, 'falha'])->name('pagamento.falha');

Route::get('/sobre', function () {
    return view('sobre', ['appName' => Config::get('app.name')]);
})->name('sobre');

Route::post('/pagamento/gerar/{valor}', [PagamentoController::class, 'gerar'])->name('pagamento.gerar');
Route::match(['get', 'post'], '/pagamento/gerar', [PagamentoController::class, 'gerar'])->name('pagamento.gerar');
Route::post('/pagamento/gerar', [PagamentoController::class, 'gerar'])->name('pagamento.gerar');

Route::get('/cobranca', [CobrancaController::class, 'index'])->name('cobranca.index');
Route::post('/cobranca/gerar', [CobrancaController::class, 'gerar'])->name('cobranca.gerar');


Route::post('/webhook/mercadopago', [MercadoPagoWebhookController::class, 'handle']);


Route::prefix('admin')->group(function () {
    // Esqueci a Senha
    Route::get('/forgot-password', [AdminPasswordResetController::class, 'showForgotPasswordForm'])->name('admin.forgot-password');
    Route::post('/forgot-password', [AdminPasswordResetController::class, 'sendResetLink'])->name('admin.forgot-password.send');

    // Redefinição de Senha
    Route::get('/reset-password/{token}', [AdminPasswordResetController::class, 'showResetPasswordForm'])->name('password.reset'); // 🔹 Laravel precisa desse nome
    Route::post('/reset-password', [AdminPasswordResetController::class, 'resetPassword'])->name('admin.password.update');
});
