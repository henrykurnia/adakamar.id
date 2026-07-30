<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class PreventBackHistory
{
    public function handle(Request $request, Closure $next): Response
    {
        // Jika user SUDAH LOGIN jangan beri cache pada halaman login
        if (Auth::check() && $request->routeIs('sign-in')) {
            return redirect($this->redirectDashboard());
        }

        $response = $next($request);

        // Disable cache hanya untuk halaman yang memerlukan auth
        if (Auth::check()) {
            $response->headers->set(
                'Cache-Control',
                'no-store, no-cache, must-revalidate, max-age=0'
            );

            $response->headers->set(
                'Pragma',
                'no-cache'
            );

            $response->headers->set(
                'Expires',
                'Sat, 01 Jan 2000 00:00:00 GMT'
            );
        }

        return $response;
    }

    /**
     * Redirect sesuai role
     */
    private function redirectDashboard()
    {
        $role = Auth::user()->role;

        return match ($role) {
            'Admin' => route('dashboard.admin'),
            'Manajer Gudang' => route('dashboard'),
            'Staff Gudang' => route('dashboard.staff'),
            default => route('sign-in'),
        };
    }
}