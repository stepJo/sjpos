<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\MUser\UserLoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Session;
use App\Models\MUser\User;

class AuthController extends Controller
{
    public function login()
    {
        if(Session::get('logged_in'))
        {
            return redirect('dashboard');
        }
        else
        {
            return view('auth.login');  
        }
    }


    public function checkLogin(UserLoginRequest $request)
    {	
    	$email = $request->u_email;
    	$password = $request->u_password;		

    	$user = User::where('u_email', $email)->first();

    	if($user)
    	{	
    		if(Hash::check($password, $user->u_password))
    		{	
    			Session::put([
                    'logged_in' => true,
                    'u_id'      => $user->u_id,
                    'u_name'    => $user->u_name,
                    'u_email'   => $user->u_email,
                    'u_contact' => $user->u_contact
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


    public function logout(Request $request)
    {
        Auth::logout();
        
        Session::flush();

        return redirect('auth/login');
    }
}
