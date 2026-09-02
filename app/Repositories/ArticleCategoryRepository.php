<?php

namespace App\Repositories;

use App\Models\article_categories;
use App\Repositories\Interfaces\ArticleCategoryRepositoryInterface;

class ArticleCategoryRepository implements ArticleCategoryRepositoryInterface
{
    public function getAll()
    {
        return article_categories::latest()->get();
    }

    public function getById($id)
    {
        return article_categories::findOrFail($id);
    }

    public function create(array $data)
    {
        return article_categories::create($data);
    }

    public function update($id, array $data)
    {
        $dataCategory = article_categories::findOrFail($id);

        $dataCategory->update($data);

        return $dataCategory;
    }

    public function delete($id)
    {
        $dataCategory = article_categories::findOrFail($id);

        return $dataCategory->delete();
    }
}