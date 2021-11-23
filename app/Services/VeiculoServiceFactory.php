<?php

namespace App\Services;

use App\Services\VeiculoService;
use App\Repositories\VeiculoRepositoryInterface;

/**
 * Class VeiculoServiceFactory
 * @package App\Services
 * @author Julio Gomes <juliocgomes.aog@gmail.com>
 * @copyright 2021 Project Simulador Financiamento.
 */
class VeiculoServiceFactory
{
    /**
     * @return VeiculoService
     */
    public function __invoke()
    {
        /** @var VeiculoRepositoryInterface $veiculoRepository */
        $veiculoRepository = app(VeiculoRepositoryInterface::class);

        /** @var MarcaServiceInterface $marcaService */
        $marcaService = app(MarcaServiceInterface::class);

        return new VeiculoService(
            $veiculoRepository,
            $marcaService
        );
    }
}
