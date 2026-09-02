<?php

namespace App\Http\Controllers;

use App\Services\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    protected AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    /**
     * Menampilkan halaman login.
     */
    public function showLogin()
    {
        return view('landingpage.content.authentication.sign-in');
    }

    /**
     * Memproses login.
     */
    public function login(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string'],
            'password' => ['required', 'string'],
        ], [
            'name.required' => 'Username wajib diisi.',
            'password.required' => 'Password wajib diisi.',
        ]);

        $user = $this->authService->login(
            $request->name,
            $request->password
        );

        if (!$user) {
            return back()
                ->with('login_error', 'Username atau password yang Anda masukkan salah.')
                ->withInput($request->only('name'));
        }

        Auth::login($user);

        $request->session()->regenerate();

        return redirect()
            ->route('dashboard')
            ->with('success', 'Selamat datang kembali, ' . $user->name . '!');
    }

    /**
     * Logout.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()
            ->route('login')
            ->with('success', 'Anda berhasil logout.');
    }
}