<?php

namespace App\Repositories\Interfaces;

interface ProductRepositoryInterface
{
    public function getAllProducts($keyword = null);

    public function create(array $data);

    public function findById($id);

    public function update($id, array $data);

    public function delete(int $id);
}