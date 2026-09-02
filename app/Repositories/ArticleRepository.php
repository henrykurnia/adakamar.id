<?php

namespace App\Repositories;

use App\Models\articles;
use App\Repositories\Interfaces\ArticleRepositoryInterface;

class ArticleRepository implements ArticleRepositoryInterface
{
    public function getAll()
    {
        return articles::latest()->get();
    }

    public function getById($id)
    {
        return articles::findOrFail($id);
    }

    public function create(array $data)
    {
        return articles::create($data);
    }

    public function update($id, array $data)
    {
        $article = articles::findOrFail($id);

        $article->update($data);

        return $article;
    }

    public function delete($id)
    {
        return articles::findOrFail($id)->delete();
    }

    public function getArtikelTerbit()
    {
        return articles::where('status', 'Published')->count();
    }

    public function getArtikelTerbaru()
    {
        return articles::latest('created_at')
            ->take(5)
            ->get();
}
}