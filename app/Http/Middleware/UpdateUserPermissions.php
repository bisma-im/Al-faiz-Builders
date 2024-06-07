<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\DB;

class UpdateUserPermissions
{
    public function handle($request, Closure $next)
    {
        $userId = session('userId');
        if ($userId) {
            $user = DB::table('user')->where('id', $userId)->first();

            if ($user) {
                $currentPermissions = session('permissions', []);
                $permissions = $this->gatherPermissions($user);

                if ($currentPermissions !== $permissions) {
                    session(['permissions' => $permissions]);
                }
            }
        }

        return $next($request);
    }

    private function gatherPermissions($user)
    {
        $permissions = [];
        if ($user->invoicing == 1) {
            $permissions[] = 'invoicing';
        }
        if ($user->booking == 1) {
            $permissions[] = 'booking';
        }
        if ($user->leads == 1) {
            $permissions[] = 'leads';
        }
        if ($user->accounting == 1) {
            $permissions[] = 'accounting';
        }
        return $permissions;
    }
}

