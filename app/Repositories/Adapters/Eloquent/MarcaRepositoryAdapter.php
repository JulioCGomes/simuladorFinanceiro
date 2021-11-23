<?php

namespace App\Repositories\Adapters\Eloquent;

use App\Models\Marca;
use App\Services\MarcaService;

/**
 * Class MarcaRepositoryAdapter
 * @package App\Http\Repositories\Adapters\Eloquent
 * @author Julio Gomes <juliocgomes.aog@gmail.com>
 * @copyright 2021 Project Simulador Financiamento.
 */
class MarcaRepositoryAdapter
{
    /** @var Marca $marcaModel */
    private $marcaModel;

    public function __construct(
        Marca $marcaModel
    ) {
        $this->marcaModel = $marcaModel;
    }

    /**
     * Undocumented function
     *
     * @return Marca|Collection
     */
    public function getAllMarcas()
    {
        return $this->marcaModel->where('ativo', MarcaService::MARCA_ATIVADA)->get();
    }

    /**
     * Listando a marca atráves do id.
     *
     * @param int $idMarca
     * @return Marca|Collection|Array
     */
    public function getMarcaByID(int $idMarca)
    {
        return $this->marcaModel->where('id', $idMarca)->first();
    }

    /**
     * Listando a marca atráves do nome.
     *
     * @param string $nomeMarca
     * @return Marca|Collection|Array
     */
    public function getMarcaByNome(string $nome)
    {
        return $this->marcaModel->where('nome', $nome)->first();
    }

    /**
     * Adicionando marca.
     *
     * @param array $dados
     * @return Marca|Collection|Array
     */
    public function addMarca(array $dados)
    {
        return $this->marcaModel->create($dados)->toArray();
    }

    /**
     * Atualizar dados da marca.
     *
     * @param array $dados
     * @return Marca|Collection|Array
     */
    public function atualizarMarca(array $dados)
    {
        $this->marcaModel->where('id', intval($dados['id']))->update($dados);

        return $this->getMarcaByID((int) $dados['id'])->toArray();
    }

    /**
     * Desativar marca.
     *
     * @param integer $idMarca
     * @return 
     */
    public function desativarMarca(int $idMarca)
    {
        $this->marcaModel->where('id', intval($idMarca))->update(['ativo' => MarcaService::MARCA_DESATIVADA]);

        return $this->getAllMarcas();
    }
}
