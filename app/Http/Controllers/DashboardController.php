<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\MUserService;
use Roles;

class DashboardController extends Controller
{   
    private $userService;

    public function __construct(MUserService $userService)
    {
        $this->userService = $userService;
    }

    public function dashboard()
    {
        $views = $this->userService->menusRole();

        return view('dashboard', compact('views'));
    }
}
