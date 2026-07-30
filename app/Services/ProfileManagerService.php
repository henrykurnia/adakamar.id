<?php

namespace App\Services;

use App\Repositories\Interfaces\ProfileManagerRepositoryInterface;

class ProfileManagerService
{
    protected $profileManagerRepository;

    public function __construct(
        ProfileManagerRepositoryInterface $profileManagerRepository
    ) {
        $this->profileManagerRepository = $profileManagerRepository;
    }

    public function getProfile()
    {
        return $this->profileManagerRepository->getProfile();
    }

    public function updateProfile(array $data)
    {
        return $this->profileManagerRepository->updateProfile($data);
    }
}