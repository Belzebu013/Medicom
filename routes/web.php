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

Route::get('/', function () {
    return redirect()->route('site.login');
});

Route::get('/login/{erro?}', [\App\Http\Controllers\LoginController::class, 'Index'])
    ->name('site.login');

Route::post('/cadastrar', [\App\Http\Controllers\LoginController::Class,'Cadastrar'])
    ->name('site.cadastrar');

Route::post('/autenticar', [\App\Http\Controllers\LoginController::Class,'Autenticar'])
    ->name('site.autenticar');

Route::prefix('/app')->group(function(){

    Route::get('/home', [\App\Http\Controllers\HomeController::class, 'index'])
        ->name('app.home');

    Route::get('/sair', [\App\Http\Controllers\LoginController::class, 'sair'])
        ->name('app.sair');

    Route::resource('/paciente', App\Http\Controllers\PacienteController::class);
        
    Route::resource('/medico', App\Http\Controllers\MedicoController::class);

    Route::resource('/consulta', App\Http\Controllers\ConsultaController::class);

    Route::resource('/especialidade', App\Http\Controllers\EspecialidadeController::class);    
});
    
