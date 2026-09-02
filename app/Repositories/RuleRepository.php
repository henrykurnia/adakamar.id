<?php

namespace App\Repositories;

use App\Models\rules;
use App\Repositories\Interfaces\RuleRepositoryInterface;

class RuleRepository implements RuleRepositoryInterface
{
    public function getAll()
    {
        return rules::latest()->get();
    }

    public function getById($id)
    {
        return rules::findOrFail($id);
    }

    public function create(array $data)
    {
        return rules::create($data);
    }

    public function update($id, array $data)
    {
        $rule = rules::findOrFail($id);

        $rule->update($data);

        return $rule;
    }

    public function delete($id)
    {
        return rules::findOrFail($id)->delete();
    }
}