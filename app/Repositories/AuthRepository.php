<?php

namespace App\Repositories;

use App\Repositories\Interfaces\AuthRepositoryInterface;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthRepository implements AuthRepositoryInterface
{
    public function findByUsername($username)
    {
        return User::where('username', $username)->first();
    }

    public function create(array $data)
    {
        return User::create($data);
    }

    public function logout(User $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()
            ->route('login')
            ->with('success', 'Berhasil logout.');
    }

}