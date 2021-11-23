<?php

namespace App\Http\Requests;

use App\Http\Requests\DefaultRequest;

class MarcaRequest extends DefaultRequest
{
    /**
     * Obtenha as regras de validação que se aplicam à solicitação.
     *
     * @return array
     */
    protected $regras = [
        'id' => ['nullable', 'integer'],
        'nome' => ['required', 'string', 'min:2', 'max:20'],
    ];

    /**
     * Obtenha as mensagens de erros que ocorrem.
     *
     * @return array
     */
    protected $mensagens = [
        'id.integer' => 'Campo id deve ser um número inteiro',
        'nome.required' => 'Campo nome deve é obrigatório.',
        'nome.string' => 'Campo nome deve ser uma string',
        'nome.min' => 'Campo nome deve ter no mínimo 2 caracteres.',
        'nome.max' => 'Campo nome deve ter no máximo 20 caracteres.'
    ];
}
