<?php

namespace App\Providers\MProduct;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\Repositories\MProduct\IProductRepository',
            'App\Repositories\MProduct\ProductRepository',
        );

        $this->app->bind(
            'App\Repositories\MProduct\ICategoryRepository',
            'App\Repositories\MProduct\CategoryRepository',
        );

        $this->app->bind(
            'App\Repositories\MProduct\IUnitRepository',
            'App\Repositories\MProduct\UnitRepository',
        );

        $this->app->bind(
            'App\Repositories\MProduct\IBarcodeRepository',
            'App\Repositories\MProduct\BarcodeRepository',
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
