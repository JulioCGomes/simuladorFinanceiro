<?php

namespace App\Repositories;

use App\Repositories\Adapters\Eloquent\MarcaRepositoryAdapter;
use App\Repositories\MarcaRepositoryInterface;

/**
 * Class MarcaRepository
 * @package App\Http\Repositories
 * @author Julio Gomes <juliocgomes.aog@gmail.com>
 * @copyright 2021 Project Simulador Financiamento.
 */
class MarcaRepository implements MarcaRepositoryInterface
{
    /** @var MarcaRepositoryAdapter $marcaAdapter */
    protected $marcaAdapter;

    /**
     * Construtor Marca.
     *
     * @param MarcaRepositoryAdapter $marcaAdapter
     */
    public function __construct(
        MarcaRepositoryAdapter $marcaAdapter
    ) {
        $this->marcaAdapter = $marcaAdapter;
    }

    /**
     * Listando todas as masrcas.
     *
     * @return Mixed
     */
    public function getAllMarcas()
    {
        return $this->marcaAdapter->getAllMarcas();
    }

    /**
     * Listando a marca atráves do id.
     *
     * @param int $idMarca
     * @return Marca|Collection|Array
     */
    public function getMarcaByID(int $idMarca)
    {
        return $this->marcaAdapter->getMarcaByID((int) $idMarca);
    }

    /**
     * Listando a marca atráves do nome.
     *
     * @param string $nomeMarca
     * @return Marca|Collection|Array
     */
    public function getMarcaByNome(string $nomeMarca)
    {
        return $this->marcaAdapter->getMarcaByNome((string) $nomeMarca);
    }

    /**
     * Adicionando marca.
     *
     * @param array $dados
     * @return Marca|Collection|Array
     */
    public function addMarca(array $dados)
    {
        return $this->marcaAdapter->addMarca((array) $dados);
    }

    /**
     * Atualizando os dados da marca.
     *
     * @param array $dados
     * @return Marca|Collection|Array
     */
    public function atualizarMarca(array $dados)
    {
        return $this->marcaAdapter->atualizarMarca((array) $dados);
    }

    /**
     * Desativando a marca.
     *
     * @param integer $idMarca
     * @return Boolean
     */
    public function desativarMarca(int $idMarca)
    {
        return $this->marcaAdapter->desativarMarca((int) $idMarca);
    }
}
