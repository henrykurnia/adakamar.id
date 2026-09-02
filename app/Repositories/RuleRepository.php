<?php

namespace App\Repositories;

use App\Models\Rule;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class RuleRepository
{
    protected Rule $model;

    public function __construct(Rule $model)
    {
        $this->model = $model;
    }

    public function getAll(
        ?string $keyword = null,
        int $perPage = 10
    ): LengthAwarePaginator {
        return $this->model
            ->when($keyword, function ($query) use ($keyword) {
                $query->where(function ($q) use ($keyword) {
                    $q->where('name', 'like', "%{$keyword}%")
                        ->orWhere('description', 'like', "%{$keyword}%");
                });
            })
            ->latest()
            ->paginate($perPage)
            ->withQueryString();
    }

    public function find(int $id): ?Rule
    {
        return $this->model->find($id);
    }

    public function create(array $data): Rule
    {
        return $this->model->create($data);
    }

    public function update(Rule $rule, array $data): bool
    {
        return $rule->update($data);
    }

    public function delete(Rule $rule): bool
    {
        return $rule->delete();
    }
}