<?php

namespace App\Repositories\Interfaces;

interface SupplierMRepositoryInterface
{
    public function getAll($keyword = null);

    public function findById($id);

    public function create(array $data);

    public function update($id, array $data);

    public function delete($id);
}