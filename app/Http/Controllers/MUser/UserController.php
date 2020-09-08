<?php

namespace App\Http\Controllers\MUser;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\MUser\CreateUserRequest;
use App\Http\Requests\MUser\UpdateUserRequest;
use App\Http\Requests\MUser\UpdateUserPasswordRequest;
use App\Repositories\MUser\IRoleRepository;
use App\Repositories\MUser\IUserRepository;
use App\Services\MBranchService;
use App\Services\MUserService;
use App\Models\MUser\User;
use Roles;

class UserController extends Controller
{
    private $roleRepository;
    private $userRepository;
    private $userService;
    private $branchService;

    public function __construct(
        IRoleRepository $roleRepository, 
        IUserRepository $userRepository,
        MUserService $userService, 
        MBranchService $branchService
    )
    {
        $this->roleRepository = $roleRepository;
        $this->userRepository = $userRepository;
        $this->userService = $userService;
        $this->branchService = $branchService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $views = $this->userService->menusRole();

        // if(!Roles::canView('User', $views))
        // {
        //     return redirect('dashboard');
        // }

        $branches = $this->branchService->allBranches();
        $roles = $this->roleRepository->all();
        $users = $this->userRepository->all();

        return view('muser.u_index', compact('branches', 'roles', 'users', 'views'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUserRequest $request)
    {
        $this->userRepository->store($request);

        return response()->json(['message' => 'Berhasil tambah user']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $this->userRepository->update($request, $user);

        return response()->json(['message' => 'Berhasil ubah user']);
    }

    public function updatePassword(UpdateUserPasswordRequest $request, User $user)
    {
        $this->userRepository->updatePassword($request, $user);

        return response()->json(['message' => 'Berhasil ubah password user']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $this->userRepository->destroy($user);

        return redirect()->back()->with('success', 'Berhasil hapus user');
    }
}
