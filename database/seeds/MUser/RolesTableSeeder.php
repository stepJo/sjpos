<?php

use Illuminate\Database\Seeder;
use App\Models\MUser\Menu;
use App\Models\MUser\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        $role = Role::create([
            'role_name' => 'Admin'
        ]);

        $menus = Menu::all();

        foreach($menus as $menu)
        {
            DB::table('menu_roles')->insert([
                'menu_id' => $menu->menu_id,
                'role_id' => $role->role_id,
                'view'    => 1,
                'add'     => 1,
                'edit'    => 1,
                'delete'  => 1
            ]);
        }
    }
}
