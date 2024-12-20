<?php

namespace App\Http\Middlewares;

use Closure;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAdmin
{
    public function handle(Request $request, Closure $next, $admin): Response
    {
        if ($admin == 'true') {
            if (Auth::check() && Auth::user()->admin == 1) {
                return $next($request);
            }
        } else {
            if (Auth::check() && Auth::user()->admin == 0) {
                return $next($request);
            }
        }
        return redirect('/home');
    }
}
