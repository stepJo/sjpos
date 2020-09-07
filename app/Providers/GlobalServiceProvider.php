<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\MUser\Role;
use Request;
use Session;
use View;

class GlobalServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //ROLE
        if(Request::segment(2) != 'login')
        {
            View::composer('*', function ($view) {
                $role = Role::with('menus')->find(Session::get('role_id'));

                $views = [];
            
                foreach($role->menus as $menu)
                {
                    if($menu->pivot->view == 1)
                    {
                        $views[]  = $menu->menu_name;
                    }   
                }

                $view->with('views', $views);
            });
        }
    }
}
