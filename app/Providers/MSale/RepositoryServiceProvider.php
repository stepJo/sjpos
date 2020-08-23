<?php

namespace App\Providers\MSale;

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
            'App\Repositories\MSale\IDiscountProductRepository',
            'App\Repositories\MSale\DiscountProductRepository',
        );

        $this->app->bind(
            'App\Repositories\MSale\ITransactionRepository',
            'App\Repositories\MSale\TransactionRepository',
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
