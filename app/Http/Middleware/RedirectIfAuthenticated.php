<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\AuthSetting;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if ($guard == "customer" && Auth::guard($guard)->check()) {
            AuthSetting::editGuard($guard);
            return redirect('/home');
            
        }
        if ($guard == "vendor" && Auth::guard($guard)->check()) {
            AuthSetting::editGuard($guard);
            return redirect('/home');
        }
        if (Auth::guard($guard)->check()) {
            return redirect('/');
        }

        
        return $next($request);
    }
}
