<?php 

namespace App\Repositories\MUser;
use App\Repositories\MUser\IMenuRepository;
use App\Models\MUser\Menu;

class MenuRepository implements IMenuRepository
{
    public function all()
    {
        return Menu::with('roles:role_name')
            ->orderBy('menu_id', 'asc')
            ->get(['menu_id', 'menu_name']);
            
    }
}