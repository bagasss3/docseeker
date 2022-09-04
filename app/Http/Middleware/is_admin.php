<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;

use Closure;
use Illuminate\http\Request;

class is_admin
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::guard('admin')->user()->role_id != 1) {
            return redirect(RouteServiceProvider::HOME);
        }
        return $next($request);
    }
}
