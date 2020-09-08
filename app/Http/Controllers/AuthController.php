<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Auth\UserLoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Services\MBranchService;
use App\Services\MUserService;
use App\Models\MBranch\Branch;
use App\Models\MUser\Role;
use App\Models\MUser\User;
use Session;

class AuthController extends Controller
{
    private $branchService;
    private $userService;

    public function __construct(MBranchService $branchService, MUserService $userService)
    {
        $this->branchService = $branchService;
        $this->userService = $userService;
    }

    public function masterLogin()
    {
        
    }

    public function login()
    {
        if(Session::get('logged_in'))
        {
            return redirect('dashboard');
        }

        $branches = $this->branchService->allBranches();
        $roles = $this->userService->allRoles();

        return view('auth.login', compact('branches', 'roles'));  
    }

    public function checkLogin(UserLoginRequest $request)
    {	
        $b_id = $request->b_id;
        $role_id = $request->role_id;

        $branch = Branch::find($b_id);

        $role = Role::find($role_id);

        if($branch && $role)
        {
            $email = $request->u_email;
            $password = $request->u_password;		
    
            $user = User::where('u_email', $email)
                ->where('b_id', $b_id)
                ->where('role_id', $role_id)
                ->first();
    
            if($user)
            {	
                if(Hash::check($password, $user->u_password))
                {	
                    Auth::login($user);

                    $session = Session::put([
                        'logged_in' => true,
                        'u_id'      => $user->u_id,
                        'u_name'    => $user->u_name,
                        'u_email'   => $user->u_email,
                        'u_contact' => $user->u_contact,
                        'b_id'      => $user->b_id,
                        'b_name'    => $branch->b_name,
                        'role_id'   => $user->role_id,
                        'role_name' => $role->role_name,
                        'owner'     => false
                    ]);
                    
                    return redirect()->intended('dashboard');
                }
                else
                {
                    return redirect()->back()->with('failed', 'Email atau password salah !');
                }
            }
            else
            {
                return redirect()->back()->with('failed', 'User tidak ada !');
            }
        }
        else
        {
            return redirect()->back()->with('failed', 'User tidak ada !');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        
        Session::flush();

        return redirect('auth/login');
    }
}
