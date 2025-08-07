<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    // ... other properties and methods

    protected $routeMiddleware = [
        'auth' => \App\Http\Middleware\Authenticate::class,
        'is_superuser' => \App\Http\Middleware\IsSuperUser::class,
        // Add more middleware here
    ];
}
