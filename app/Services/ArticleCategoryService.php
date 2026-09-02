<?php

namespace App\Services;

use App\Models\ArticleCategory;
use App\Repositories\ArticleCategoryRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;

class ArticleCategoryService
{
    protected ArticleCategoryRepository $articleCategoryRepository;

    public function __construct(
        ArticleCategoryRepository $articleCategoryRepository
    ) {
        $this->articleCategoryRepository = $articleCategoryRepository;
    }

    /**
     * Daftar kategori artikel.
     */
    public function getArticleCategories(
        ?string $keyword = null,
        int $perPage = 10
    ): LengthAwarePaginator {
        return $this->articleCategoryRepository
            ->getAll($keyword, $perPage);
    }

    /**
     * Detail kategori.
     */
    public function getArticleCategory(
        int $id
    ): ?ArticleCategory {
        return $this->articleCategoryRepository
            ->findById($id);
    }

    /**
     * Buat kategori baru.
     */
    public function createArticleCategory(
        array $data
    ): ArticleCategory {

        $slug = $data['slug'] ?? null;

        if (!$slug) {
            $slug = Str::slug($data['name']);
        }

        $data['slug'] = $this->generateUniqueSlug($slug);

        return $this->articleCategoryRepository
            ->create($data);
    }

    /**
     * Update kategori.
     */
    public function updateArticleCategory(
        int $id,
        array $data
    ): ?ArticleCategory {

        $articleCategory = $this->articleCategoryRepository
            ->findById($id);

        if (!$articleCategory) {
            return null;
        }

        $slug = $data['slug'] ?? null;

        if (!$slug) {
            $slug = Str::slug($data['name']);
        }

        $data['slug'] = $this->generateUniqueSlug(
            $slug,
            $articleCategory->id
        );

        $this->articleCategoryRepository
            ->update(
                $articleCategory,
                $data
            );

        return $articleCategory->fresh();
    }

    /**
     * Hapus kategori.
     */
    public function deleteArticleCategory(
        int $id
    ): bool {

        $articleCategory = $this->articleCategoryRepository
            ->findById($id);

        if (!$articleCategory) {
            return false;
        }

        /*
        |--------------------------------------------------------------------------
        | Cek apakah kategori masih memiliki artikel
        |--------------------------------------------------------------------------
        */

        if ($articleCategory->articles()->exists()) {
            return false;
        }

        return $this->articleCategoryRepository
            ->delete($articleCategory);
    }

    /**
     * Generate slug unik.
     */
    protected function generateUniqueSlug(
        string $slug,
        ?int $exceptId = null
    ): string {

        $originalSlug = Str::slug($slug);

        $slug = $originalSlug;

        $counter = 1;

        while (
            $this->articleCategoryRepository
                ->findBySlug(
                    $slug,
                    $exceptId
                )
        ) {
            $slug = $originalSlug . '-' . $counter;

            $counter++;
        }

        return $slug;
    }
}