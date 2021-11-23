<?php

use Laravel\Passport\Http\Controllers\AccessTokenController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\{
    LoginController,
    MarcaController,
    UsuarioController,
    VeiculoController
};

/**
 * Rota de Unauthorized
 */
Route::get('/unauthorized', function () {
    return response()->json(['message' => 'Unauthorized']);
})->name('login');

Route::post('login',                [LoginController::class, 'login']);
Route::post('oauth/token',          [AccessTokenController::class, 'issueToken'])->name('token');

/**
 * Rotas Públicas.
 */
Route::get('marcas',               [MarcaController::class, 'index']);
Route::get('veiculos/marca/{id}',  [VeiculoController::class, 'getveiculomarca']);
Route::get('veiculos/{id}',        [VeiculoController::class, 'getveiculo']);
Route::post('simulacao',           [VeiculoController::class, 'simulacao']);

Route::middleware(['auth:api'])->group(function() {
    Route::group(['prefix' => 'marcas'], function () {
        Route::post('/adicionar',                       [MarcaController::class, 'adicionar']);
        Route::put('/atualizar',                        [MarcaController::class, 'atualizar']);
        Route::delete('/deletar/{id}',                  [MarcaController::class, 'deletar']);
    });

    Route::group(['prefix' => 'veiculos'], function () {
        Route::get('/',                                 [VeiculoController::class, 'index']);
        Route::post('/adicionar',                       [VeiculoController::class, 'adicionar']);
        Route::put('/atualizar',                        [VeiculoController::class, 'atualizar']);
        Route::delete('/deletar/{id}',                  [VeiculoController::class, 'deletar']);
    });

    Route::get('me', [UsuarioController::class, 'me']);
});
