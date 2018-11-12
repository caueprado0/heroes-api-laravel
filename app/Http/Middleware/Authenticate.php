<?php

namespace Heroes\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    protected function redirectTo($request)
    {
        return route('api/v1/auth/login');
    }
}
