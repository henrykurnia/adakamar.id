<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role)
    {
        if (!Auth::check()) {
            return redirect()->route('sign-in');
        }

        $roles = [
            'admin' => 'Admin',
            'manager' => 'Manajer Gudang',
            'staff' => 'Staff Gudang',
        ];

        if (Auth::user()->role !== ($roles[$role] ?? $role)) {
            abort(403, 'Unauthorized');
        }

        return $next($request);
    }
}