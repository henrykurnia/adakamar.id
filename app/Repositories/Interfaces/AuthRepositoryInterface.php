<?php

namespace App\Repositories\Interfaces;

interface AuthRepositoryInterface
{
    public function findByUsername($username);

    public function create(array $data);
}