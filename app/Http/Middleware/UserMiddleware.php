<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class UserMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!$request->session()->has('member')) {
            return redirect('login/index');
        }
        return $next($request);
    }
}
