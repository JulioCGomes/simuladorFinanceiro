<?php

namespace App\Repositories;

use App\Repositories\Adapters\Eloquent\VeiculoRepositoryAdapter;
use App\Repositories\VeiculoRepositoryInterface;

/**
 * Class VeiculoRepository
 * @package App\Http\Repositories
 * @author Julio Gomes <juliocgomes.aog@gmail.com>
 * @copyright 2021 Project Simulador Financiamento.
 */
class VeiculoRepository implements VeiculoRepositoryInterface
{
    /** @var VeiculoRepositoryAdapter $veiculoAdapter */
    protected $veiculoAdapter;

    /**
     * Construtor Marca.
     *
     * @param VeiculoRepositoryAdapter $veiculoAdapter
     */
    public function __construct(
        VeiculoRepositoryAdapter $veiculoAdapter
    ) {
        $this->veiculoAdapter = $veiculoAdapter;
    }

    /**
     * Listando todos os veículos.
     *
     * @return Mixed
     */
    public function getAllVeiculos()
    {
        return $this->veiculoAdapter->getAllVeiculos();
    }

    /**
     * Listando o veículo atráves do id,
     *
     * @param integer $idVeiculo
     * @return Veiculo|Collection|Array
     */
    public function getVeiculoByID(int $idVeiculo)
    {
        return $this->veiculoAdapter->getVeiculoByID((int) $idVeiculo);
    }

    /**
     * Listando o veículo atráves do nome,
     *
     * @param string $nomeVeiculo
     * @return Veiculo|Collection|Array
     */
    public function getVeiculoByNome(string $nomeVeiculo)
    {
        return $this->veiculoAdapter->getVeiculoByNome((string) $nomeVeiculo);
    }

    /**
     * Listando o veículo atráves do id marca..
     *
     * @param integer $idMarca
     * @return Veiculo|Collection|Array
     */
    public function getVeiculoByMarca(int $idMarca)
    {
        return $this->veiculoAdapter->getVeiculoByMarca((int) $idMarca);
    }

    /**
     * Adicionando veículo.
     *
     * @param array $dados
     * @return Veiculo|Collection|Array
     */
    public function addVeiculo(array $dados)
    {
        return $this->veiculoAdapter->addVeiculo((array) $dados);
    }

    /**
     * Atualizando dados do veículo.
     *
     * @param array $dados
     * @return Veiculo|Collection|Array
     */
    public function atualizarVeiculo(array $dados)
    {
        return $this->veiculoAdapter->atualizarVeiculo((array) $dados);
    }

    /**
     * Desativando o veículo.
     *
     * @param integer $idVeiculo
     * @return Veiculo|Collection|Array
     */
    public function desativarVeiculo(int $idVeiculo)
    {
        return $this->veiculoAdapter->desativarVeiculo((int) $idVeiculo);
    }
}
