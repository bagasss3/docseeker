<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Auth;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        //dd(auth()->user()->role_id);
        if (auth()->user()) {
            $role = 0;
        } elseif (Auth::guard('admin')->user()) {
            $role = 1;
        } else {
            $role = null;
        }
        if (!$request->expectsJson()) {
            switch ($role) {
                case 0:
                    return route('main');
                    break;
                case 1:
                    return route('dashboard');
                    break;
                default:
                    return route('login');
                    break;
            }
        }
        return route('login');
    }
}
