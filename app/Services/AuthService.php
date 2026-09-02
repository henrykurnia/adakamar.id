<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\AuthRepository;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    protected AuthRepository $authRepository;

    public function __construct(AuthRepository $authRepository)
    {
        $this->authRepository = $authRepository;
    }

    /**
     * Memproses login berdasarkan name dan password.
     */
    public function login(string $name, string $password): ?User
    {
        $user = $this->authRepository->findByName($name);

        // User tidak ditemukan
        if (!$user) {
            return null;
        }

        // Password tidak sesuai
        if (!Hash::check($password, $user->password)) {
            return null;
        }

        // Update waktu login terakhir
        $this->authRepository->updateLastLogin($user);

        return $user;
    }
}