<?php

namespace App\Policies\MSale;

use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;
use App\Services\MUserService;

class TransactionPolicy
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
        $menu = $this->userService->findMenu('Riwayat Transaksi');

        $access = $this->userService->findMenuRole($menu->menu_id, Auth::user()->role_id);

        return $access;
    }
}
