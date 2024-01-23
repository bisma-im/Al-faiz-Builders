<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminAuthentication
{
    public function handle(Request $request, Closure $next)
    {
        if (session()->has('userId')) {
            if (session('authenticated')) {
                return $next($request);
            }
        }
        return redirect()->route('signInPage'); 
    }

}
