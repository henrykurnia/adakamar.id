<?php

namespace App\Repositories;

use App\Models\User;

class AuthRepository
{
    /**
     * Mencari user berdasarkan name.
     */
    public function findByName(string $name): ?User
    {
        return User::where('name', $name)->first();
    }

    /**
     * Memperbarui waktu login terakhir.
     */
    public function updateLastLogin(User $user): bool
    {
        return $user->update([
            'last_login' => now(),
        ]);
    }
}