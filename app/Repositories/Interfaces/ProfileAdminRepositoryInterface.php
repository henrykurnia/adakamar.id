<?php

namespace App\Repositories\Interfaces;

use App\Models\User;

interface ProfileAdminRepositoryInterface
{
    public function getProfile(): User;

    public function updateProfile(array $data): User;
}