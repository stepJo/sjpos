<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use App\Models\MUser\Role;
use App\Models\MUser\User;

class MUserService {
    public function allRoles()
    {
        return Role::get(['role_id', 'role_name']);
    }

    public function menusRole()
    {
        $role = Role::with('menus:menu_name')->find(Auth::user()->role_id);

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
}