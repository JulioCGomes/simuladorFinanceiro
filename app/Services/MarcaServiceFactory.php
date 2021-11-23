<?php

namespace App\Services;

use App\Services\MarcaService;
use App\Repositories\MarcaRepositoryInterface;

/**
 * Class MarcaServiceFactory
 * @package App\Services
 * @author Julio Gomes <juliocgomes.aog@gmail.com>
 * @copyright 2021 Project Simulador Financiamento.
 */
class MarcaServiceFactory
{
    /**
     * @return MarcaService
     */
    public function __invoke()
    {
        /** @var MarcaRepositoryInterface $marcaRepositoryInterface */
        $marcaRepository = app(MarcaRepositoryInterface::class);

        return new MarcaService(
            $marcaRepository
        );
    }
}
