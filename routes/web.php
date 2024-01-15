<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/**
 * Rota para redirecionar a página inicial para a rota de login.
 */
Route::get('/', function () {
    return redirect()->route('site.login');
});

/**
 * Rota para exibir a página de login.
 *
 * @param int $erro Código de erro opcional.
 */
Route::get('/login/{erro?}', [\App\Http\Controllers\LoginController::class, 'Index'])
    ->name('site.login');

/**
 * Rota para processar o cadastro de usuário.
 */
Route::post('/cadastrar', [\App\Http\Controllers\LoginController::Class,'Cadastrar'])
    ->name('site.cadastrar');

/**
 * Rota para autenticar o usuário.
 */
Route::post('/autenticar', [\App\Http\Controllers\LoginController::Class,'Autenticar'])
    ->name('site.autenticar');

/**
 * Grupo de rotas prefixadas para a área do sistema interno ('/app').
 */
Route::prefix('/app')->group(function(){

    /**
     * Rota para exibir a página inicial do aplicativo.
     */
    Route::get('/home', [\App\Http\Controllers\HomeController::class, 'index'])
        ->name('app.home');

    /**
     * Rota para efetuar o logout do usuário.
     */
    Route::get('/sair', [\App\Http\Controllers\LoginController::class, 'sair'])
        ->name('app.sair');

    /**
     * Recurso para gerenciar pacientes.
     */
    Route::resource('/paciente', App\Http\Controllers\PacienteController::class);
        
    /**
     * Recurso para gerenciar médicos.
     */
    Route::resource('/medico', App\Http\Controllers\MedicoController::class);

    /**
     * Recurso para gerenciar consultas.
     */
    Route::resource('/consulta', App\Http\Controllers\ConsultaController::class);

    /**
     * Recurso para gerenciar especialidades.
     */
    Route::resource('/especialidade', App\Http\Controllers\EspecialidadeController::class);    
});
    
