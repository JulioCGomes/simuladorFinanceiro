<?php

namespace App\Providers;

use App\Repositories\{
    MarcaRepositoryFactory,
    MarcaRepositoryInterface,
    VeiculoRepositoryFactory,
    VeiculoRepositoryInterface
};
use App\Services\{
    MarcaServiceFactory,
    MarcaServiceInterface,
    VeiculoServiceFactory,
    VeiculoServiceInterface
};
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        /**
         * Bind da interface com factory.
         */
        $this->app->bind(
            MarcaServiceInterface::class,
            function () {
                return (new MarcaServiceFactory())();
            }
        );

        /**
         * Bind da interface com factory.
         */
        $this->app->bind(
            MarcaRepositoryInterface::class,
            function () {
                return (new MarcaRepositoryFactory())();
            }
        );

        /**
         * Bind da interface com factory.
         */
        $this->app->bind(
            VeiculoServiceInterface::class,
            function () {
                return (new VeiculoServiceFactory())();
            }
        );

        /**
         * Bind da interface com factory.
         */
        $this->app->bind(
            VeiculoRepositoryInterface::class,
            function () {
                return (new VeiculoRepositoryFactory())();
            }
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
