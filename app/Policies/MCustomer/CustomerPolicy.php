<?php

namespace App\Policies\MCustomer;

use App\Models\MUser\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;
use App\Services\MUserService;


class CustomerPolicy
{
    use HandlesAuthorization;

    private $userService;

    public function __construct(MUserService $userService)
    {
        $this->userService = $userService;
    }

    public function access()
    {
        $menu = $this->userService->findMenu('Pelanggan');

        $access = $this->userService->findMenuRole($menu->menu_id, Auth::user()->role_id);

        return $access;
    }
}
