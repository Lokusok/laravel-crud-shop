<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthMiddleware
{
    public function handle(Request $request, \Closure $next): Response
    {
        if (Auth::guest()) {
            return redirect()->route('auth.login');
        }

        return $next($request);
    }
}
