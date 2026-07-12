<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserMiddleware
{
    public function handle(
        Request $request,
        Closure $next
    ): Response
    {
        if (
            !session('login')
            || session('role') != 'user'
        ) {
            return redirect('/login')->with(
                'error',
                'Silakan login sebagai user'
            );
        }

        return $next($request);
    }
}