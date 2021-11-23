<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\VeiculoRequest;
use App\Http\Resources\VeiculoResource;
use App\Services\VeiculoServiceInterface;
use Exception;
use Illuminate\Http\Request;

class VeiculoController extends Controller
{
    /** @var VeiculoServiceInterface $veiculoService */
    private $veiculoService;

    /**
     * Construtor do controller ApostaController
     *
     * @param VeiculoServiceInterface $veiculoService
     */
    public function __construct(
        VeiculoServiceInterface $veiculoService
    ) {
        $this->veiculoService = $veiculoService;
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
            $dados = $this->veiculoService->getAllVeiculos();

            return new VeiculoResource($dados);
        } catch (Exception $e) {
            return response()->json([
                'msg' => 'Não foi possível listar os veículos. Erro: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Adicionando veículo.
     *
     * @param VeiculoRequest $request
     * @return VeiculoResource|Json
     */
    public function adicionar(VeiculoRequest $request)
    {
        try {
            /** @var Array $dadosValidados*/
            $dadosValidados = $request->validated();

            /** @var String|Array $retornaDados */
            $retornaDados = $this->veiculoService->addVeiculo($dadosValidados);

            return new VeiculoResource([$retornaDados]);
        } catch (Exception $e) {
            return response()->json([
                'msg' => 'Não foi possível adicionar o veículo. Erro: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Atualizando dados da marca.
     *
     * @param VeiculoRequest $request
     * @return VeiculoResource|Json
     */
    public function atualizar(VeiculoRequest $request)
    {
        try {
            /** @var Array $dadosValidados*/
            $dadosValidados = $request->validated();

            /** @var String|Array $retornaDados */
            $retornaDados = $this->veiculoService->atualizarVeiculo($dadosValidados);

            return new VeiculoResource([$retornaDados]);
        } catch (Exception $e) {
            return response()->json([
                'msg' => 'Não foi possível adicionar a marca. Erro: ' . $e->getMessage()
            ], 500);
        }
    }
    
    /**
     * Desativando o veículo
     *
     * @param mixed $idMarca
     * @return VeiculoResource|Json
     */
    public function deletar($idVeiculo)
    {
        try {
            /** @var String|Array $retornaDados */
            $retornaDados = $this->veiculoService->desativarVeiculo(intval($idVeiculo));

            return new VeiculoResource($retornaDados);
        } catch (Exception $e) {
            return response()->json([
                'msg' => 'Não foi possível deletar o veículo. Erro: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Listando o veículo atráves da marca.
     *
     * @param integer $idMarca
     * @return VeiculoResource
     */
    public function getveiculomarca(int $idMarca)
    {
        try {
            /** @var String|Array $retornaDados */
            $retornaDados = $this->veiculoService->getVeiculoByMarca(intval($idMarca));

            return new VeiculoResource($retornaDados);
        } catch (Exception $e) {
            return response()->json([
                'msg' => 'Não foi possível listar os veículos. Erro: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Listando veículo.
     *
     * @param integer $idVeiculo
     * @return VeiculoResource
     */
    public function getveiculo(int $idVeiculo)
    {
        try {
            /** @var String|Array $retornaDados */
            $retornaDados = $this->veiculoService->getVeiculoByID(intval($idVeiculo));

            return new VeiculoResource($retornaDados);
        } catch (Exception $e) {
            return response()->json([
                'msg' => 'Não foi possível listar o veículo. Erro: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Undocumented function
     *
     * @param Request $request
     * @return void
     */
    public function simulacao(Request $request)
    {
        try {
            $retornaDados = $this->veiculoService->simulacaoVeiculo($request->all());
            
            return response()->json([
                'data' => $retornaDados
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'msg' => 'Não foi possível fazer a simulação. Erro: ' . $e->getMessage()
            ], 500);
        }
    }
}
