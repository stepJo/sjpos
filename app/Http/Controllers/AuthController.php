<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Auth\UserLoginRequest;
use App\Repositories\MBranch\IBranchRepository;
use App\Repositories\MUser\IRoleRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\MUser\User;
use App\Models\MBranch\Branch;
use Session;

class AuthController extends Controller
{
    private $branchRepository;
    private $roleRepository;

    public function __construct(IBranchRepository $branchRepository, IRoleRepository $roleRepository)
    {
        $this->branchRepository = $branchRepository;
        $this->roleRepository = $roleRepository;
    }

    public function login()
    {
        if(Session::get('logged_in'))
        {
            return redirect('dashboard');
        }
        else
        {
            $branches = $this->branchRepository->all();
            $roles = $this->roleRepository->all();

            return view('auth.login', compact('branches', 'roles'));  
        }
    }


    public function checkLogin(UserLoginRequest $request)
    {	
        $b_id = $request->b_id;

        $branch = Branch::find($b_id);

        if($branch)
        {
            $role_id = $request->role_id;
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
                    Session::put([
                        'logged_in' => true,
                        'u_id'      => $user->u_id,
                        'u_name'    => $user->u_name,
                        'u_email'   => $user->u_email,
                        'u_contact' => $user->u_contact,
                        'b_id'      => $user->b_id,
                        'role_id'   => $user->role_id
                    ]);
                    
                    return redirect()->intended('dashboard');
                }
                else
                {
                    return redirect()->back()->with('failed', 'email atau password salah !');
                }
            }
            else
            {
                return redirect()->back()->with('failed', 'email atau password salah !');
            }
        }
        else
        {
            return redirect()->back()->with('failed', 'email atau password salah !');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        
        Session::flush();

        return redirect('auth/login');
    }
}
