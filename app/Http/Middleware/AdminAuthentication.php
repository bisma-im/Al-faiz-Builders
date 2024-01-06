<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\DB;

class AdminAuthentication
{
    public function handle(Request $request, Closure $next)
    {
        if (session()->has('userId')) {
            $userId = session('userId');
            $email = session('email');
            $adminExists = DB::table('admin')->where('id', $userId)->where('email', $email)->exists();

            if ($adminExists) {
                return $next($request);
            }
        }
        return redirect()->route('signInPage'); 
    }

}
