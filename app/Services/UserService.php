<?php

namespace App\Services;

use Illuminate\Support\Facades\Hash;
use App\Repositories\Interfaces\UserRepositoryInterface;

class UserService
{
    protected $repository;

    public function __construct(
        UserRepositoryInterface $repository
    ) {
        $this->repository = $repository;
    }

    /**
     * Ambil semua user
     */
    public function getAll($keyword = null)
    {
        return $this->repository->getAll($keyword);
    }

    /**
     * Cari user berdasarkan ID
     */
    public function findById($id)
    {
        return $this->repository->findById($id);
    }

    /**
     * Tambah user
     */
    public function create(array $data)
    {
        $data['password'] = Hash::make($data['password']);

        return $this->repository->create($data);
    }

    /**
     * Update user
     */
    public function update($id, array $data)
    {
        /*
        |--------------------------------------------------------------------------
        | Password
        |--------------------------------------------------------------------------
        | Kalau password kosong, jangan ubah password lama.
        |--------------------------------------------------------------------------
        */

        if (!empty($data['password'])) {

            $data['password'] = Hash::make($data['password']);

        } else {

            unset($data['password']);

        }

        return $this->repository->update($id, $data);
    }

    /**
     * Hapus user
     */
    public function delete($id)
    {
        return $this->repository->delete($id);
    }
}