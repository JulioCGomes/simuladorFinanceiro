<?php

namespace App\Services;

use App\Repositories\MarcaRepositoryInterface;
use App\Services\MarcaServiceInterface;
use Exception;

/**
 * Class MarcaService
 * @package App\Services
 * @author Julio Gomes <juliocgomes.aog@gmail.com>
 * @copyright 2021 Project Simulador Financiamento.
 */
class MarcaService implements MarcaServiceInterface
{
    /** @var Boolean MARCA_DESATIVADA */
    const MARCA_DESATIVADA = 0;

    /** @var Boolean MARCA_ATIVADA */
    const MARCA_ATIVADA = 1;
    
    /** @var MarcaRepositoryInterface $marcaRepository */
    protected $marcaRepository;

    /**
     * Construtor marca service
     *
     * @param MarcaRepositoryInterface $marcaRepository
     */
    public function __construct(
        MarcaRepositoryInterface $marcaRepository
    ) {
        $this->marcaRepository = $marcaRepository;
    }

    /**
     * Listando todas as masrcas.
     *
     * @return Mixed
     */
    public function getAllMarcas()
    {
        return $this->marcaRepository->getAllMarcas();
    }

    /**
     * Listando a marca atráves do id,
     *
     * @param integer $idMarca
     * @return Marca|Collection|Array
     */
    public function getMarcaByID(int $idMarca)
    {
        return $this->marcaRepository->getMarcaByID((int) $idMarca);
    }

    /**
     * Listando a marca atráves do nome.
     *
     * @param string $nomeMarca
     * @return Marca|Collection|Array
     */
    public function getMarcaByNome(string $nomeMarca)
    {
        return $this->marcaRepository->getMarcaByNome((string) $nomeMarca);
    }

    /**
     * Adicionando marca.
     *
     * @param array $dados
     * @return Marca|Collection|Array
     */
    public function addMarca(array $dados)
    {
        /** @var Marca|Nullable $validateNome */
        $validateNome = $this->getMarcaByNome((string) $dados['nome']);

        if (!empty($validateNome)) {
            throw new Exception('Marca já existente.');
        }

        $dados['ativo'] = self::MARCA_ATIVADA;

        return $this->marcaRepository->addMarca((array) $dados);
    }

    /**
     * Atualizando os dados.
     *
     * @param array $dados
     * @return Marca|Collection|Array
     */
    public function atualizarMarca(array $dados)
    {
        if (empty($dados['id'])) {
            throw new Exception('ID da marca não mencionado.');
        }

        /** @var Marca|Nullable $validateID */
        $validateID = $this->getMarcaByID((int) $dados['id']);

        if (empty($validateID)) {
            throw new Exception('ID da marca não existe.');
        }

        return $this->marcaRepository->atualizarMarca((array) $dados);
    }

    /**
     * Desativando a marca.
     *
     * @param integer $idMarca
     * @return Boolean
     */
    public function desativarMarca(int $idMarca)
    {
        if (empty($idMarca)) {
            throw new Exception('ID da marca não mencionado.');
        }

        /** @var Marca|Nullable $validateID */
        $validateID = $this->getMarcaByID((int) $idMarca);

        if (empty($validateID)) {
            throw new Exception('ID da marca não existe.');
        }

        if (!$validateID->ativo) {
            throw new Exception('Marca já desativada.');
        }

        /**
         * Quando desativar, configurar para desativar todos os veículos também.
         */

        return $this->marcaRepository->desativarMarca((int) $idMarca);
    }
}
