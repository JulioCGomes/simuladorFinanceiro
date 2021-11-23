<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\MarcaRequest;
use App\Http\Resources\MarcaResource;
use App\Services\MarcaServiceInterface;
use Exception;

/**
 * Class MarcaController
 * @package App\Http\Controllers\Api
 * @author Julio Gomes <juliocgomes.aog@gmail.com>
 * @copyright 2021 Project Simulador Financiamento.
 */
class MarcaController extends Controller
{
    /** @var MarcaServiceInterface $marcaService */
    private $marcaService;

    /**
     * Construtor do controller ApostaController
     *
     * @param MarcaServiceInterface $marcaService
     */
    public function __construct(
        MarcaServiceInterface $marcaService
    ) {
        $this->marcaService = $marcaService;
    }

    /**
     * Listando todas as masrcas.
     *
     * @return Mixed
     */
    public function index()
    {
        try {
            /** @var Array|Colletion $dados */
            $dados = $this->marcaService->getAllMarcas();

            return new MarcaResource($dados);
        } catch (Exception $e) {
            return response()->json([
                'msg' => 'Não foi possível listar as marcas. Erro: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Adicionando a marca.
     *
     * @param MarcaRequest $request
     * @return MarcaResource|Json
     */
    public function adicionar(MarcaRequest $request)
    {
        try {
            /** @var Array $dadosValidados*/
            $dadosValidados = $request->validated();

            /** @var String|Array $retornaDados */
            $retornaDados = $this->marcaService->addMarca($dadosValidados);

            return new MarcaResource([$retornaDados]);
        } catch (Exception $e) {
            return response()->json([
                'msg' => 'Não foi possível adicionar a marca. Erro: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Atualizando dados da marca.
     *
     * @param MarcaRequest $request
     * @return MarcaResource|Json
     */
    public function atualizar(MarcaRequest $request)
    {
        try {
            /** @var Array $dadosValidados*/
            $dadosValidados = $request->validated();

            /** @var String|Array $retornaDados */
            $retornaDados = $this->marcaService->atualizarMarca($dadosValidados);

            return new MarcaResource([$retornaDados]);
        } catch (Exception $e) {
            return response()->json([
                'msg' => 'Não foi possível adicionar a marca. Erro: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Desativando a marca.
     *
     * @param mixed $idMarca
     * @return MarcaResource|Json
     */
    public function deletar($idMarca)
    {
        try {
            /** @var String|Array $retornaDados */
            $retornaDados = $this->marcaService->desativarMarca(intval($idMarca));

            return new MarcaResource($retornaDados);
        } catch (Exception $e) {
            return response()->json([
                'msg' => 'Não foi possível adicionar a marca. Erro: ' . $e->getMessage()
            ], 500);
        }
    }
}
