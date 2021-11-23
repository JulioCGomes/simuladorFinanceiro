<?php

namespace App\Services;

/**
 * Interface MarcaServiceInterface
 * @package App\Services
 * @author Julio Gomes <juliocgomes.aog@gmail.com>
 * @copyright 2021 Project Simulador Financiamento.
 */
interface MarcaServiceInterface
{
    /**
     * Listando todas as masrcas.
     *
     * @return Mixed
     */
    public function getAllMarcas();

    /**
     * Listando a marca atráves do id,
     *
     * @param integer $idMarca
     * @return Marca|Collection|Array
     */
    public function getMarcaByID(int $idMarca);

    /**
     * Listando a marca atráves do nome.
     *
     * @param string $nomeMarca
     * @return Marca|Collection|Array
     */
    public function getMarcaByNome(string $nomeMarca);

    /**
     * Adicionando marca.
     *
     * @param array $dados
     * @return Marca|Collection|Array
     */
    public function addMarca(array $dados);

    /**
     * Atualizando dados da marca.
     *
     * @param array $dados
     * @return Marca|Collection|Array
     */
    public function atualizarMarca(array $dados);

    /**
     * Desativando a marca.
     *
     * @param integer $idMarca
     * @return Boolean
     */
    public function desativarMarca(int $idMarca);
}
