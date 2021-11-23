<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

abstract class DefaultRequest extends FormRequest
{
    /**
     * Variável para armazenar as regras
     * Example:
     * ```
     * protected array $regras = ['campo' => 'required|integer']
     * ```
     * @var array
     */
    protected $regras = [];

    /**
     * Variável para armazenar mensagens customizadas para cada regra
     *
     * Example:
     * ```
     * protected array $mensagens = ['campo.required' => 'Campo XXX é obrigatório.']
     * ```
     * @var array
     */
    protected $mensagens = [];

    /**
     * Método para definição de regras
     * 
     * @return array
     */
    public function rules()
    {
        return $this->regras;
    }

    /**
     * Método para retorno das mensagens customizadas
     * 
     * @return array
     */
    public function messages()
    {
        return $this->mensagens;
    }

    /**
     * Retorno caso a validação seja inválida
     * @param \Illuminate\Contracts\Validation\Validator $validator
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function failedValidation(Validator $validator)
    {
        throw (new ValidationException($validator, response()->json([
            'errors' => $validator->getMessageBag()->getMessages()
        ], Response::HTTP_BAD_REQUEST)));
    }
}