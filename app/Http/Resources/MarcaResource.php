<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class MarcaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $dados = parent::toArray($request);

        $marca = [];
        if (!empty($dados)) {
            foreach ($dados as $value) {
                $marca[] = $this->tratarBlocoMarca($value);
            }
        }

        return $marca;
    }

    /**
     * Tratando o retorno da marca.
     *
     * @param array $dados
     * @return Array
     */
    private function tratarBlocoMarca(array $dados)
    {
        return [
            'id' => $dados['id'],
            'nome' => $dados['nome'],
            'ativado' => $dados['ativo'],
            'criado_em' => Carbon::parse($dados['created_at'])->format('d/m/Y H:i:s'),
            'atualizado_em' => Carbon::parse($dados['updated_at'])->format('d/m/Y H:i:s')
        ];
    }
}
