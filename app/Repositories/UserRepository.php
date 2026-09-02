<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    protected $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function getAll($keyword = null)
    {
        $query = $this->model->query();

        if ($keyword) {
            $query->where(function ($q) use ($keyword) {

                $q->where('username', 'like', '%' . $keyword . '%')
                  ->orWhere('name', 'like', '%' . $keyword . '%');

            });
        }

        return $query
            ->latest()
            ->get();
    }

    public function findById($id)
    {
        return $this->model->findOrFail($id);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update($id, array $data)
    {
        $user = $this->findById($id);

        $user->update($data);

        return $user;
    }

    public function delete($id)
    {
        $user = $this->findById($id);

        return $user->delete();
    }
}