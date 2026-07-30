<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Interfaces\AuthRepositoryInterface;

class AuthService
{
    protected AuthRepositoryInterface $authRepository;

    public function __construct(AuthRepositoryInterface $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    public function login(Request $request): ?string
    {
        $credentials = $request->only('email', 'password');

        if (!Auth::attempt($credentials, $request->remember)) {
            return null;
        }

        $request->session()->regenerate();

        $role = Auth::user()->role;

        switch ($role) {

            case 'Admin':
                return 'dashboard.admin';

            case 'Manajer Gudang':
                // sementara diarahkan ke dashboard yang sama
                return 'dashboard';

            case 'Staff Gudang':
                return 'dashboard.staff';

            default:
                Auth::logout();
                return null;
        }
    }

    public function logout(Request $request): void
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
    }
}