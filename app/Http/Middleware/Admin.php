<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App\Util\Constant;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, ... $roles)
    {
        if (!Auth::check()) // I included this check because you have it, but it really should be part of your 'auth' middleware, most likely added as part of a route group.
            return redirect('admin.login');

        $user = Auth::user();

        if(in_array($user->role,[
            Constant::USER_ROLE_ADMIN,
            Constant::USER_ROLE_HRD,
        ])){
            return $next($request);
        }

        return redirect('admin.login');
    }
}
