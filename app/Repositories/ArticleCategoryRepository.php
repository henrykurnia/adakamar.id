<?php

namespace App\Repositories;

use App\Models\ArticleCategory;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ArticleCategoryRepository
{
    /**
     * Ambil semua kategori artikel dengan pagination.
     */
    public function getAll(
        ?string $keyword = null,
        int $perPage = 10
    ): LengthAwarePaginator {
        return ArticleCategory::query()
            ->when($keyword, function ($query) use ($keyword) {
                $query->where(function ($q) use ($keyword) {
                    $q->where('name', 'like', "%{$keyword}%")
                        ->orWhere('description', 'like', "%{$keyword}%");
                });
            })
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
    }

    /**
     * Cari berdasarkan ID.
     */
    public function findById(int $id): ?ArticleCategory
    {
        return ArticleCategory::find($id);
    }

    /**
     * Cari berdasarkan slug.
     */
    public function findBySlug(
        string $slug,
        ?int $exceptId = null
    ): ?ArticleCategory {
        return ArticleCategory::query()
            ->where('slug', $slug)
            ->when($exceptId, function ($query) use ($exceptId) {
                $query->where('id', '!=', $exceptId);
            })
            ->first();
    }

    /**
     * Buat kategori.
     */
    public function create(array $data): ArticleCategory
    {
        return ArticleCategory::create($data);
    }

    /**
     * Update kategori.
     */
    public function update(
        ArticleCategory $articleCategory,
        array $data
    ): bool {
        return $articleCategory->update($data);
    }

    /**
     * Hapus kategori.
     */
    public function delete(
        ArticleCategory $articleCategory
    ): bool {
        return $articleCategory->delete();
    }
}