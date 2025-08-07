<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class SuperuserMiddleware
{
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->is_superuser) {
            return $next($request);
        }

        abort(403, 'Unauthorized access');
    }
}

