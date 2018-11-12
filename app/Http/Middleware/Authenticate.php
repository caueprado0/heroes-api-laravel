<?php

namespace Heroes\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    protected function redirectTo($request)
    {
        return redirect('v1_obter_login');
    }
}
