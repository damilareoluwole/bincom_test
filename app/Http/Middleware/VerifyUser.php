<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Classes\General\General;

class VerifyUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(Auth::guest()){
            Session::put('message','Unauthorised Access.');
            return redirect('/CoFighter/login');
        }

        if(!Auth::user()->password_reset){
            if(Auth::user()->verify){
                Session::put('message','We received your reset password request. Please enter your new password!');
                return redirect('/CoFighter/reset/complete');
            }
            Session::put('message','You must first reset your default password.');
            return redirect('/CoFighter/reset/initiate');
        }

        return $next($request);
    }

}
