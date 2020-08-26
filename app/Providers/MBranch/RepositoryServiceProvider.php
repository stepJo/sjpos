<?php

namespace App\Providers\MBranch;

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
