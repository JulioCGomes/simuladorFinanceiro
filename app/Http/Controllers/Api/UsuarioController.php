<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

/**
 * Class UsuarioController
 * @package App\Http\Controllers\Api
 * @author Julio Gomes <juliocgomes.aog@gmail.com>
 * @copyright 2021 Project Simulador Financiamento.
 */
class UsuarioController extends Controller
{
    /**
     * Retornando o usuário logado dentro do sistema.
     *
     * @return void
     */
    public function me()
    {
        try {
            return response()->json([
                'data' =>auth()->user(),
                'msg' => 'Usuário logado retornado com sucesso.',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'msg' => $e->getMessage(),
            ], 500);
        }
    }
}
