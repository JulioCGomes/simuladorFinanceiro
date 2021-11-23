<?php

namespace App\Repositories;

use App\Repositories\Adapters\Eloquent\VeiculoRepositoryAdapter;
use App\Repositories\VeiculoRepository;

/**
 * Class VeiculoRepositoryFactory
 * @package App\Repositories
 * @author Julio Gomes <juliocgomes.aog@gmail.com>
 * @copyright 2021 Project Simulador Financiamento.
 */
class VeiculoRepositoryFactory
{
    /**
     * @return VeiculoRepository
     */
    public function __invoke()
    {
        /** @var VeiculoRepositoryAdapter $veiculoAdapter */
        $veiculoAdapter = app(VeiculoRepositoryAdapter::class);

        return new VeiculoRepository(
            $veiculoAdapter
        );
    }
}
