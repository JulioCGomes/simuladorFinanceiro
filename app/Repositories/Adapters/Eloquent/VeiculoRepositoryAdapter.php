<?php

namespace App\Repositories\Adapters\Eloquent;

use App\Models\Veiculo;
use App\Services\VeiculoService;

/**
 * Class VeiculoRepositoryAdapter
 * @package App\Http\Repositories\Adapters\Eloquent
 * @author Julio Gomes <juliocgomes.aog@gmail.com>
 * @copyright 2021 Project Simulador Financiamento.
 */
class VeiculoRepositoryAdapter
{
    /** @var Veiculo $veiculoModel */
    private $veiculoModel;

    public function __construct(
        Veiculo $veiculoModel
    ) {
        $this->veiculoModel = $veiculoModel;
    }

    /**
     * Listando o veículo
     *
     * @return Veiculo|Collection
     */
    public function getAllVeiculos()
    {
        return ($this->veiculoModel->newQuery())
            ->select(
                'veiculos.*',
                'marcas.id as id_marca',
                'marcas.nome as nome_marca'
            )
            ->join(
                'marcas', 
                'veiculos.id_marca', '=', 'marcas.id'
            )
            ->where('veiculos.ativo', VeiculoService::VEICULO_ATIVADO)
            ->orderBy('veiculos.id', 'DESC')
            ->get();
    }

    /**
     * Listando o veículo atráves do id,
     *
     * @param integer $idVeiculo
     * @return Veiculo|Collection|Array
     */
    public function getVeiculoByID(int $idVeiculo)
    {
        return $this->veiculoModel->where('id', $idVeiculo)->get()->toArray();
    }

    /**
     * Listando o veículo atráves do nome,
     *
     * @param string $nomeVeiculo
     * @return Veiculo|Collection|Array
     */
    public function getVeiculoByNome(string $nomeVeiculo)
    {
        return $this->veiculoModel->where('nome', $nomeVeiculo)->first();
    }

    /**
     * Listando o veículo atráves do id marca..
     *
     * @param integer $idMarca
     * @return Veiculo|Collection|Array
     */
    public function getVeiculoByMarca(int $idMarca)
    {
        return $this->veiculoModel->where('id_marca', $idMarca)->get()->toArray();
    }

    /**
     * Adicionando veículo.
     *
     * @param array $dados
     * @return Veiculo|Collection|Array
     */
    public function addVeiculo(array $dados)
    {
        return $this->veiculoModel->create($dados)->toArray();
    }

    /**
     * Atualizando dados do veículo.
     *
     * @param array $dados
     * @return Veiculo|Collection|Array
     */
    public function atualizarVeiculo(array $dados)
    {
        $this->veiculoModel->where('id', intval($dados['id']))->update($dados);

        return $this->getVeiculoByID((int) $dados['id']);
    }

    /**
     * Desativando o veículo.
     *
     * @param integer $idVeiculo
     * @return Veiculo|Collection|Array
     */
    public function desativarVeiculo(int $idVeiculo)
    {
        $this->veiculoModel->where('id', intval($idVeiculo))->update(['ativo' => VeiculoService::VEICULO_DESATIVADO]);

        return $this->getAllVeiculos();
    }
}