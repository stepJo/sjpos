<?php

namespace App\Http\Middleware;

use Closure;
use Session;

class AuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(!Session::get('logged_in') && !Session::get('u_name') && !Session::get('u_email') && !Session::get('b_id')) 
        {
            return redirect('auth/login');
        }

        return $next($request);
    }
}
