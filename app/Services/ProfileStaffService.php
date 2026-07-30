<?php

namespace App\Services;

use App\Repositories\Interfaces\ProfileStaffRepositoryInterface;

class ProfileStaffService
{
    protected $profileStaffRepository;

    public function __construct(
        ProfileStaffRepositoryInterface $profileStaffRepository
    ) {
        $this->profileStaffRepository = $profileStaffRepository;
    }

    public function getProfile()
    {
        return $this->profileStaffRepository->getProfile();
    }

    public function updateProfile(array $data)
    {
        return $this->profileStaffRepository->updateProfile($data);
    }
}