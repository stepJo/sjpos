<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use App\Models\MUser\Role;
use App\Models\MUser\Menu;
use App\Models\MUser\User;
use DB;

class MUserService {
    public function allRoles()
    {
        return Role::get(['role_id', 'role_name']);
    }

    public function menusRole()
    {
        $role = Role::with('menus:menu_name')
            ->find(Auth::user()->role_id, ['role_id', 'role_name']);

        $views = [];

        foreach($role->menus as $menu)
        {
            if($menu->pivot->view == 1)
            {
                $views[]  = $menu->menu_name;
            }   
        }

        return $views;
    }

    public function findMenu($menu_name)
    {
        return Menu::where('menu_name', $menu_name)->first(['menu_id', 'menu_name']);
    }

    public function findMenuRole($menu_id, $role_id)
    {
        return DB::table('menu_roles')
        ->where('menu_id', $menu_id)
        ->where('role_id', $role_id)
        ->first();
    }
}