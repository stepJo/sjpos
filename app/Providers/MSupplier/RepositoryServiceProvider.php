<?php

namespace App\Providers\MSupplier;

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
            'App\Repositories\MSupplier\ISupplierRepository',
            'App\Repositories\MSupplier\SupplierRepository',
        );

        $this->app->bind(
            'App\Repositories\MSupplier\IProductSupplierRepository',
            'App\Repositories\MSupplier\ProductSupplierRepository',
        );

        $this->app->bind(
            'App\Repositories\MSupplier\IPurchasementSupplierRepository',
            'App\Repositories\MSupplier\PurchasementSupplierRepository',
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
