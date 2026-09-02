<?php

namespace App\Services;

use App\Repositories\Interfaces\AuthRepositoryInterface;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    protected $authRepository;

    public function __construct(
        AuthRepositoryInterface $authRepository
    ) {
        $this->authRepository = $authRepository;
    }

    public function login($username, $password)
    {
        $user = $this->authRepository->findByUsername($username);

        if (!$user || !Hash::check($password, $user->password)) {
            return false;
        }

        return $user;
    }
}