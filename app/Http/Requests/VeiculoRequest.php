<?php

namespace App\Http\Requests;

use App\Http\Requests\DefaultRequest;

class VeiculoRequest extends DefaultRequest
{
    /**
     * Obtenha as regras de validação que se aplicam à solicitação.
     *
     * @return array
     */
    protected $regras = [
        'id' => ['nullable', 'integer'],
        'id_marca' => ['required', 'integer'],
        'nome' => ['required', 'string', 'min:2', 'max:30'],
        'valor' => ['required']
    ];

    /**
     * Obtenha as mensagens de erros que ocorrem.
     *
     * @return array
     */
    protected $mensagens = [
        'id.integer' => 'Campo id deve ser um número inteiro.',
        'id_marca.required' => 'Campo id_marca é obrigatório.',
        'id_marca.integer' => 'Campo id_marca deve ser um número inteiro.',
        'nome.required' => 'Campo nome deve é obrigatório.',
        'nome.string' => 'Campo nome deve ser uma string',
        'nome.min' => 'Campo nome deve ter no mínimo 2 caracteres.',
        'nome.max' => 'Campo nome deve ter no máximo 20 caracteres.',
        'valor.required' => 'Campo valor é obrigatório.'
    ];
}
