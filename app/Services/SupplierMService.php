<?php

namespace App\Services;

use App\Repositories\Interfaces\SupplierMRepositoryInterface;

class SupplierMService
{
    protected $repository;

    public function __construct(
        SupplierMRepositoryInterface $repository
    ) {
        $this->repository = $repository;
    }

    /**
     * Daftar supplier + search + pagination
     */
    public function getAll($keyword = null)
    {
        return $this->repository->getAll($keyword);
    }

    public function findById($id)
    {
        return $this->repository->findById($id);
    }

    public function create(array $data)
    {
        return $this->repository->create($data);
    }

    public function update($id, array $data)
    {
        return $this->repository->update($id, $data);
    }

    public function delete($id)
    {
        return $this->repository->delete($id);
    }
}