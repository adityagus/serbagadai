<?php

namespace App\Http\Middleware;

use App\Util\Constant;
use Closure;
use Illuminate\Support\Facades\Auth;

class CheckUser
{
    public function handle($request, Closure $next)
    {
        if(!in_array(Auth::user()->role,[
                Constant::USER_ROLE_ADMIN,
                Constant::USER_ROLE_HRD,
            ])){
            return redirect()->route('home');
        }

        return $next($request);
    }
}
