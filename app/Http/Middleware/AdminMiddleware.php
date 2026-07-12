<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(
        Request $request,
        Closure $next
    ): Response
    {
        if (
            !session('login')
            || session('role') != 'admin'
        ) {
            return redirect('/admin/login')->with(
                'error',
                'Silakan login sebagai admin'
            );
        }

        return $next($request);
    }
}