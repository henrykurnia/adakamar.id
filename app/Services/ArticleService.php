<?php

namespace App\Services;

use App\Models\Article;
use App\Repositories\ArticleRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ArticleService
{
    protected ArticleRepository $articleRepository;

    public function __construct(
        ArticleRepository $articleRepository
    ) {
        $this->articleRepository = $articleRepository;
    }

    /**
     * Daftar artikel.
     */
    public function getArticles(
        ?string $keyword = null,
        int $perPage = 10
    ): LengthAwarePaginator {
        return $this->articleRepository
            ->getAll($keyword, $perPage);
    }

    /**
     * Detail artikel.
     */
    public function getArticle(int $id): ?Article
    {
        return $this->articleRepository
            ->findById($id);
    }

    /**
     * Buat artikel baru.
     */
    public function createArticle(array $data): Article
    {
        return DB::transaction(function () use ($data) {

            /*
            |--------------------------------------------------------------------------
            | Slug
            |--------------------------------------------------------------------------
            */

            $slug = $data['slug'] ?? null;

            if (!$slug) {
                $slug = Str::slug($data['title']);
            }

            $slug = $this->generateUniqueSlug($slug);

            /*
            |--------------------------------------------------------------------------
            | Thumbnail
            |--------------------------------------------------------------------------
            */

            if (
                isset($data['thumbnail']) &&
                $data['thumbnail'] instanceof UploadedFile
            ) {
                $data['thumbnail'] = $this->storeThumbnail(
                    $data['thumbnail']
                );
            }

            /*
            |--------------------------------------------------------------------------
            | Published At
            |--------------------------------------------------------------------------
            */

            if (($data['status'] ?? 'Draft') === 'Published') {
                $data['published_at'] = $data['published_at'] ?? now();
            } else {
                $data['published_at'] = null;
            }

            $data['slug'] = $slug;

            /*
            |--------------------------------------------------------------------------
            | Create
            |--------------------------------------------------------------------------
            */

            $article = $this->articleRepository
                ->create($data);

            return $article->load([
                'category',
                'user',
            ]);
        });
    }

    /**
     * Update artikel.
     */
    public function updateArticle(
        int $id,
        array $data
    ): ?Article {
        return DB::transaction(function () use ($id, $data) {

            /*
            |--------------------------------------------------------------------------
            | Cari artikel
            |--------------------------------------------------------------------------
            */

            $article = $this->articleRepository
                ->findById($id);

            if (!$article) {
                return null;
            }

            /*
            |--------------------------------------------------------------------------
            | Slug
            |--------------------------------------------------------------------------
            */

            $slug = $data['slug'] ?? null;

            if (!$slug) {
                $slug = Str::slug($data['title']);
            }

            $slug = $this->generateUniqueSlug(
                $slug,
                $article->id
            );

            /*
            |--------------------------------------------------------------------------
            | Thumbnail baru
            |--------------------------------------------------------------------------
            */

            if (
                isset($data['thumbnail']) &&
                $data['thumbnail'] instanceof UploadedFile
            ) {

                if ($article->thumbnail) {
                    $this->deleteFile(
                        $article->thumbnail
                    );
                }

                $data['thumbnail'] = $this->storeThumbnail(
                    $data['thumbnail']
                );

            } else {
                unset($data['thumbnail']);
            }

            /*
            |--------------------------------------------------------------------------
            | Published At
            |--------------------------------------------------------------------------
            */

            if (($data['status'] ?? $article->status) === 'Published') {

                if (!$article->published_at) {
                    $data['published_at'] = now();
                }

            } else {
                $data['published_at'] = null;
            }

            $data['slug'] = $slug;

            /*
            |--------------------------------------------------------------------------
            | Update
            |--------------------------------------------------------------------------
            */

            return $this->articleRepository
                ->update($article, $data);
        });
    }

    /**
     * Hapus artikel.
     */
    public function deleteArticle(int $id): bool
    {
        return DB::transaction(function () use ($id) {

            $article = $this->articleRepository
                ->findById($id);

            if (!$article) {
                return false;
            }

            /*
            |--------------------------------------------------------------------------
            | Hapus thumbnail
            |--------------------------------------------------------------------------
            */

            if ($article->thumbnail) {
                $this->deleteFile(
                    $article->thumbnail
                );
            }

            /*
            |--------------------------------------------------------------------------
            | Soft delete
            |--------------------------------------------------------------------------
            */

            return $this->articleRepository
                ->delete($article);
        });
    }

    /**
     * Generate slug unik.
     */
    protected function generateUniqueSlug(
        string $slug,
        ?int $exceptId = null
    ): string {

        $originalSlug = Str::slug($slug);

        if (!$originalSlug) {
            $originalSlug = 'artikel';
        }

        $slug = $originalSlug;
        $counter = 1;

        while (
            $this->articleRepository
                ->findBySlug($slug, $exceptId)
        ) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }

    /**
     * Simpan thumbnail artikel.
     *
     * File:
     * public/articles
     *
     * Database:
     * articles/nama-file.jpg
     */
    protected function storeThumbnail(
        UploadedFile $file
    ): string {

        $directory = public_path('articles');

        if (!is_dir($directory)) {
            mkdir(
                $directory,
                0755,
                true
            );
        }

        $originalName = pathinfo(
            $file->getClientOriginalName(),
            PATHINFO_FILENAME
        );

        $extension = strtolower(
            $file->getClientOriginalExtension()
        );

        $filename =
            time() .
            '_' .
            Str::slug($originalName) .
            '_' .
            uniqid() .
            '.' .
            $extension;

        $file->move(
            $directory,
            $filename
        );

        return 'articles/' . $filename;
    }

    /**
     * Hapus file.
     */
    protected function deleteFile(
        string $path
    ): void {

        $filePath = public_path(
            ltrim($path, '/')
        );

        if (file_exists($filePath)) {
            unlink($filePath);
        }
    }
}