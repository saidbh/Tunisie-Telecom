<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $role)
    {
        if (!Auth::check())
        {
            return redirect()->route('login');
        }
        if (\auth()->user()->userRole->id == 3 && $role == 'user')
        {
            return $next($request);
        }elseif(\auth()->user()->userRole->id != 3 && $role == 'admin')
            {
                return $next($request);
            }
        abort(404);
    }
}
