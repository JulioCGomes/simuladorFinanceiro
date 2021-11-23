<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class VeiculoResource extends JsonResource
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

        $veiculo = [];
        if (!empty($dados)) {
            foreach ($dados as $value) {
                $veiculo[] = $this->tratarBlocoVeiculo($value);
            }
        }

        return $veiculo;
    }

    /**
     * Tratando o retorno da marca.
     *
     * @param array $dados
     * @return Array
     */
    private function tratarBlocoVeiculo(array $dados)
    {
        return [
            'id' => $dados['id'],
            'nome' => $dados['nome'],
            'ativado' => $dados['ativo'],
            'valor' => number_format($dados['valor'], 2, ',', '.'),
            'id_marca' => isset($dados['id_marca']) ? $dados['id_marca'] : null,
            'nome_marca' => isset($dados['nome_marca']) ? $dados['nome_marca'] : null,
            'criado_em' => Carbon::parse($dados['created_at'])->format('d/m/Y H:i:s'),
            'atualizado_em' => Carbon::parse($dados['updated_at'])->format('d/m/Y H:i:s')
        ];
    }
}
