<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthStudent
{
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->guard('student')->check()) {
            return redirect('/login');
        }

        return $next($request);
    }
}
