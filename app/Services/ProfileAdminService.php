<?php

namespace App\Services;

use App\Repositories\Interfaces\ProfileAdminRepositoryInterface;

class ProfileAdminService
{
    protected $profileAdminRepository;

    public function __construct(
        ProfileAdminRepositoryInterface $profileAdminRepository
    ) {
        $this->profileAdminRepository = $profileAdminRepository;
    }

    public function getProfile()
    {
        return $this->profileAdminRepository->getProfile();
    }

    public function updateProfile(array $data)
    {
        return $this->profileAdminRepository->updateProfile($data);
    }
}