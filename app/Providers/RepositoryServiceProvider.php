<?php

namespace App\Providers;

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
            'App\Repositories\MBranch\IBranchRepository',
            'App\Repositories\MBranch\BranchRepository'
        );

        $this->app->bind(
            'App\Repositories\MBranch\IBranchProductRepository',
            'App\Repositories\MBranch\BranchProductRepository'
        );

        $this->app->bind(
            'App\Repositories\MSale\IDiscountProductRepository',
            'App\Repositories\MSale\DiscountProductRepository',
        );

        $this->app->bind(
            'App\Repositories\MSale\ITransactionRepository',
            'App\Repositories\MSale\TransactionRepository',
        );

        $this->app->bind(
            'App\Repositories\MSale\IDetailTransactionRepository',
            'App\Repositories\MSale\DetailTransactionRepository',
        );

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

        $this->app->bind(
            'App\Repositories\MUser\IRoleRepository',
            'App\Repositories\MUser\RoleRepository',
        );

        $this->app->bind(
            'App\Repositories\MUser\IMenuRepository',
            'App\Repositories\MUser\MenuRepository',
        );

        $this->app->bind(
            'App\Repositories\MUser\IUserRepository',
            'App\Repositories\MUser\UserRepository',
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
