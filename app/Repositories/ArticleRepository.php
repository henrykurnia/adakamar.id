<?php

namespace App\Repositories;

use App\Models\Article;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ArticleRepository
{
    /**
     * Ambil semua artikel dengan pagination.
     */
    public function getAll(
        ?string $keyword = null,
        int $perPage = 10
    ): LengthAwarePaginator {
        return Article::with([
            'category',
            'user',
        ])
            ->when($keyword, function ($query) use ($keyword) {
                $query->where(function ($q) use ($keyword) {
                    $q->where('title', 'like', '%' . $keyword . '%')
                        ->orWhere('excerpt', 'like', '%' . $keyword . '%')
                        ->orWhere('content', 'like', '%' . $keyword . '%');
                });
            })
            ->latest()
            ->paginate($perPage);
    }

    /**
     * Cari artikel berdasarkan ID.
     */
    public function findById(int $id): ?Article
    {
        return Article::with([
            'category',
            'user',
        ])->find($id);
    }

    /**
     * Cari artikel berdasarkan slug.
     */
    public function findBySlug(
        string $slug,
        ?int $exceptId = null
    ): ?Article {
        return Article::when($exceptId, function ($query) use ($exceptId) {
            $query->where('id', '!=', $exceptId);
        })
            ->where('slug', $slug)
            ->first();
    }

    /**
     * Buat artikel.
     */
    public function create(array $data): Article
    {
        return Article::create($data);
    }

    /**
     * Update artikel.
     */
    public function update(
        Article $article,
        array $data
    ): Article {
        $article->update($data);

        return $article->fresh([
            'category',
            'user',
        ]);
    }

    /**
     * Hapus artikel.
     */
    public function delete(Article $article): bool
    {
        return $article->delete();
    }
}