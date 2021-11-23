<?php

namespace App\Services;

use App\Repositories\VeiculoRepositoryInterface;
use App\Services\VeiculoServiceInterface;
use App\Services\MarcaServiceInterface;
use Exception;

/**
 * Class VeiculoService
 * @package App\Services
 * @author Julio Gomes <juliocgomes.aog@gmail.com>
 * @copyright 2021 Project Simulador Financiamento.
 */
class VeiculoService implements VeiculoServiceInterface
{
    /** @var Boolean VEICULO_DESATIVADA */
    const VEICULO_DESATIVADO = 0;

    /** @var Boolean VEICULO_ATIVADA */
    const VEICULO_ATIVADO = 1;
    
    /** @var VeiculoRepositoryInterface $veiculoRepository */
    protected $veiculoRepository;

    /** @var MarcaServiceInterface $marcaService */
    protected $marcaService;

    /**
     * Construtor veiculo service
     *
     * @param VeiculoRepositoryInterface $veiculoRepository
     * @param MarcaServiceInterface $marcaService
     */
    public function __construct(
        VeiculoRepositoryInterface $veiculoRepository,
        MarcaServiceInterface $marcaService
    ) {
        $this->veiculoRepository = $veiculoRepository;
        $this->marcaService = $marcaService;
    }

    /**
     * Listando todos os veículos.
     *
     * @return Mixed
     */
    public function getAllVeiculos()
    {
        return $this->veiculoRepository->getAllVeiculos();
    }

    /**
     * Listando o veículo atráves do id,
     *
     * @param integer $idVeiculo
     * @return Veiculo|Collection|Array
     */
    public function getVeiculoByID(int $idVeiculo)
    {
        return $this->veiculoRepository->getVeiculoByID((int) $idVeiculo);
    }

    /**
     * Listando o veículo atráves do nome,
     *
     * @param string $nomeVeiculo
     * @return Veiculo|Collection|Array
     */
    public function getVeiculoByNome(string $nomeVeiculo)
    {
        return $this->veiculoRepository->getVeiculoByNome((string) $nomeVeiculo);
    }

    /**
     * Listando o veículo atráves do id marca..
     *
     * @param integer $idMarca
     * @return Veiculo|Collection|Array
     */
    public function getVeiculoByMarca(int $idMarca)
    {
        return $this->veiculoRepository->getVeiculoByMarca((int) $idMarca);
    }

    /**
     * Adicionando veículo.
     *
     * @param array $dados
     * @return Veiculo|Collection|Array
     */
    public function addVeiculo(array $dados)
    {
        /** @var Veiculo $validateNome */
        $validateNome = $this->getVeiculoByNome((string) $dados['nome']);

        if (!empty($validateNome)) {
            throw new Exception('Veículo já existente.');
        }

        /** @var Marca $validateIdMarca */
        $validateIdMarca = $this->marcaService->getMarcaByID((int) $dados['id_marca']);

        if (empty($validateIdMarca)) {
            throw new Exception('Marca não encontrada.');
        }

        if (!$validateIdMarca->ativo) {
            throw new Exception('Marca desativada.');
        }

        $dados['ativo'] = self::VEICULO_ATIVADO;

        return $this->veiculoRepository->addVeiculo((array) $dados);
    }

    /**
     * Atualizando dados do veículo.
     *
     * @param array $dados
     * @return Veiculo|Collection|Array
     */
    public function atualizarVeiculo(array $dados)
    {
        if (empty($dados['id'])) {
            throw new Exception('ID do veículo não mencionado.');
        }

        $validateID = current($this->getVeiculoByID((int) $dados['id']));

        if (empty($validateID)) {
            throw new Exception('Veículo não encontrado.');
        }

        if (!$validateID['ativo']) {
            throw new Exception('Veículo desativado.');
        }

        $validateMarca = $this->marcaService->getMarcaByID((int) $dados['id_marca']);

        if (empty($validateMarca)) {
            throw new Exception('Marca não encontrada.');
        }

        if (empty($validateMarca->ativo)) {
            throw new Exception('Marca desativado.');
        }

        return $this->veiculoRepository->atualizarVeiculo((array) $dados);
    }

    /**
     * Desativando o veículo.
     *
     * @param integer $idVeiculo
     * @return Boolean
     */
    public function desativarVeiculo(int $idVeiculo)
    {
        if (empty($idVeiculo)) {
            throw new Exception('ID do veículo não mencionado.');
        }

        $validateID = current($this->getVeiculoByID((int) $idVeiculo));

        if (empty($validateID)) {
            throw new Exception('ID do veículo não existe.');
        }

        if (!$validateID['ativo']) {
            throw new Exception('Veículo já desativado.');
        }

        return $this->veiculoRepository->desativarVeiculo((int) $idVeiculo);
    }

    /**
     * Simulador Financeiro.
     *
     * @param array $dados
     * @return Array
     */
    public function simulacaoVeiculo(array $dados) 
    {
        if (empty($dados['idVeiculo'])) {
            throw new Exception('Não foi enviado o id do veículo.');
        }

        if (empty($dados['valorSimulacao'])) {
            throw new Exception('Não foi enviado o valor para simulação.');
        }

        $veiculo = current($this->getVeiculoByID((int) $dados['idVeiculo']));

        if (empty($veiculo)) {
            throw new Exception('ID do veículo não existe.');
        }

        if (!$veiculo['ativo']) {
            throw new Exception('Veículo já desativado.');
        }

        $valorRestante = $veiculo['valor'] - $dados['valorSimulacao'];

        return [
            'parcela_48' => number_format($valorRestante / 48, 2, ',', '.'),
            'parcela_12' => number_format($valorRestante / 12, 2, ',', '.'),
            'parcela_06' => number_format($valorRestante / 6, 2, ',', '.'),
        ];
    }
}