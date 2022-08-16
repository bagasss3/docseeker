<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\http\Request;

class is_admin
{

    public function handle(Request $request, Closure $next){
        if(auth()->user()->role_id!=1){
            abort(403);
        }
        return $next($request);
    }
}
