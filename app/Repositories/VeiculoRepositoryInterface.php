<?php

namespace App\Repositories;

/**
 * Class VeiculoRepositoryInterface
 * @package App\Repositories
 * @author Julio Gomes <juliocgomes.aog@gmail.com>
 * @copyright 2021 Project Simulador Financiamento.
 */
interface VeiculoRepositoryInterface
{
    /**
     * Listando todas os veículos.
     *
     * @return Mixed
     */
    public function getAllVeiculos();

    /**
     * Listando o veículo atráves do id,
     *
     * @param integer $idVeiculo
     * @return Veiculo|Collection|Array
     */
    public function getVeiculoByID(int $idVeiculo);

    /**
     * Listando o veículo atráves do nome,
     *
     * @param string $nomeVeiculo
     * @return Veiculo|Collection|Array
     */
    public function getVeiculoByNome(string $nomeVeiculo);

    /**
     * Listando o veículo atráves do id marca..
     *
     * @param integer $idMarca
     * @return Veiculo|Collection|Array
     */
    public function getVeiculoByMarca(int $idMarca);

    /**
     * Adicionando veículo.
     *
     * @param array $dados
     * @return Veiculo|Collection|Array
     */
    public function addVeiculo(array $dados);

    /**
     * Atualizando dados do veículo.
     *
     * @param array $dados
     * @return Veiculo|Collection|Array
     */
    public function atualizarVeiculo(array $dados);

    /**
     * Desativando o veículo.
     *
     * @param integer $idVeiculo
     * @return Boolean
     */
    public function desativarVeiculo(int $idVeiculo);
}
