<?php

namespace App\Repositories\Interfaces;

use App\Models\User;

interface ProfileStaffRepositoryInterface
{
    public function getProfile(): User;

    public function updateProfile(array $data): User;
}