<?php

namespace App\Http\Controllers;

use App\Services\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;

class AuthController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function index()
    {
        return view('example.content.authentication.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required',
        ]);

        $user = $this->authService->login(
            $request->username,
            $request->password
        );

        if (!$user) {
            return back()
                ->withErrors([
                    'email' => 'Email atau password salah.'
                ])
                ->withInput();
        }

        Auth::login($user);

        $request->session()->regenerate();

        return redirect()->route('dashboard');
    }

    public function showForgotPassword()
    {
        return view('example.content.authentication.forgot-password');
    }

    public function sendResetLink(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        if ($status === Password::RESET_LINK_SENT) {
            return back()->with(
                'success',
                'Link reset password telah dikirim ke email Anda.'
            );
        }

        return back()->withErrors([
            'email' => 'Email tidak ditemukan.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}