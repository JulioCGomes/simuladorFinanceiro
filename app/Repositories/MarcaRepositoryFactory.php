<?php

namespace App\Repositories;

use App\Repositories\Adapters\Eloquent\MarcaRepositoryAdapter;
use App\Repositories\MarcaRepository;

/**
 * Class MarcaRepositoryFactory
 * @package App\Repositories
 * @author Julio Gomes <juliocgomes.aog@gmail.com>
 * @copyright 2021 Project Simulador Financiamento.
 */
class MarcaRepositoryFactory
{
    /**
     * @return MarcaRepository
     */
    public function __invoke()
    {
        /** @var MarcaRepositoryAdapter $marcaAdapter */
        $marcaAdapter = app(MarcaRepositoryAdapter::class);

        return new MarcaRepository(
            $marcaAdapter
        );
    }
}
