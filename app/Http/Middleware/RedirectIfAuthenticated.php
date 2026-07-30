<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {

            if (Auth::guard($guard)->check()) {

                $role = Auth::user()->role;

                switch ($role) {

                    case 'Admin':
                        return redirect()->route('dashboard.admin');

                    case 'Manajer Gudang':
                        return redirect()->route('dashboard');

                    case 'Staff Gudang':
                        return redirect()->route('dashboard.staff');

                    default:
                        Auth::logout();
                        return redirect()->route('sign-in');
                }
            }
        }

        return $next($request);
    }
}