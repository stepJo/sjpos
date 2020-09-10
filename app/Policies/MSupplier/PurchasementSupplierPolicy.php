<?php

namespace App\Policies\MSupplier;

use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;
use App\Services\MUserService;

class PurchasementSupplierPolicy
{
    use HandlesAuthorization;

    private $userService;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    
    public function __construct(MUserService $userService)
    {
        $this->userService = $userService;
    }

    public function access()
    {
        $menu = $this->userService->findMenu('Pembelian Barang');

        $access = $this->userService->findMenuRole($menu->menu_id, Auth::user()->role_id);

        return $access;
    }
}
