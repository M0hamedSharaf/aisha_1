<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MultiAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $guards = config('auth.guards');

        unset($guards['web']);
        unset($guards['sanctum']);

        $guards = array_keys($guards);
        
        foreach($guards as $guard)
        {
            if(Auth::guard($guard)->check())
            {
                return $next($request);
            }
        }
        return redirect(route('loginPage'));
    }
}
