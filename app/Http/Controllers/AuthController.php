<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AuthService;

class AuthController extends Controller
{
    protected AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    /**
     * Menampilkan halaman login
     */
    public function showLogin()
    {
        if (auth()->check()) {

            return match (auth()->user()->role) {
                'Admin' => redirect()->route('dashboard.admin'),
                'Staff Gudang' => redirect()->route('dashboard.staff'),
                'Manajer Gudang' => redirect()->route('dashboard'),
                default => redirect()->route('dashboard'),
            };
        }

        return view('example.content.authentication.sign-in', [
            'title' => 'Login | Stockify',
        ]);
    }

    /**
     * Proses Login
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $route = $this->authService->login($request);

        if ($route) {
            return redirect()
                ->route($route)
                ->with('success', 'Login berhasil.');
        }

        return back()
            ->withErrors([
                'email' => 'Email atau password salah.',
            ])
            ->withInput();
    }

    /**
     * Logout
     */
    public function logout(Request $request)
    {
        $this->authService->logout($request);

        return redirect()
            ->route('sign-in')
            ->with('success', 'Berhasil logout.');
    }
}