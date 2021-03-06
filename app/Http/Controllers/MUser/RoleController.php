<?php

namespace App\Http\Controllers\MUser;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\MUser\CreateRoleRequest;
use App\Http\Requests\MUser\UpdateRoleRequest;
use App\Repositories\MUser\IRoleRepository;
use App\Repositories\MUser\IMenuRepository;
use App\Services\MUserService;
use App\Models\MUser\Role;
use Roles;

class RoleController extends Controller
{
    private $menuRepository;
    private $roleRepository;
    private $userService;
    
    public function __construct(
        IMenuRepository $menuRepository, 
        IRoleRepository $roleRepository,
        MUserService $userService
    )
    {
        $this->menuRepository = $menuRepository;
        $this->roleRepository = $roleRepository;
        $this->userService = $userService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $views = $this->userService->menusRole();

        // if(!Roles::canView('Role', $views))
        // {
        //     return redirect('dashboard');
        // }

        $menus = $this->menuRepository->all();
        $roles = $this->roleRepository->all();
        
        return view('muser.r_index', compact('menus', 'roles', 'views'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRoleRequest $request)
    {
        $this->roleRepository->store($request);

        return response()->json(['message' => 'Berhasil tambah role']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRoleRequest $request, Role $role)
    {
        $this->roleRepository->update($request, $role);

        return response()->json(['message' => 'Berhasil ubah role']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $this->roleRepository->destroy($role);

        return redirect()->back()->with('success', 'Berhasil hapus role');
    }
}
