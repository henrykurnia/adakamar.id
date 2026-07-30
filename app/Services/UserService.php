<?php

namespace App\Services;

use App\Repositories\Interfaces\UserRepositoryInterface;

class UserService
{
    protected UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Menampilkan semua user
     * dengan search dan pagination.
     */
    public function getAll($keyword = null)
    {
        return $this->userRepository->getAll($keyword);
    }

    /**
     * Cari user berdasarkan ID.
     */
    public function findById($id)
    {
        return $this->userRepository->findById($id);
    }

    /**
     * Simpan user baru.
     */
    public function create(array $data)
    {
        return $this->userRepository->create($data);
    }

    /**
     * Update data user.
     */
    public function update($id, array $data)
    {
        return $this->userRepository->update($id, $data);
    }

    /**
     * Hapus user.
     */
    public function delete($id)
    {
        return $this->userRepository->delete($id);
    }
}