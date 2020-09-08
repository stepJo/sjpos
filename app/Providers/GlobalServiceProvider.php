<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use App\Models\MUser\Menu;
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
                $views = [];

                if(Session::get('owner'))
                {
                    $views = Menu::get('menu_name')->toArray();
                }
                else
                {
                    $role = Role::with('menus')->find(Auth::user()->role_id);
                
                    foreach($role->menus as $menu)
                    {
                        if($menu->pivot->view == 1)
                        {
                            $views[]  = $menu->menu_name;
                        }   
                    }
                }
                
                $view->with('views', $views);
            });
        }
    }
}
