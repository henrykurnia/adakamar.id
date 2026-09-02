<?php

namespace App\Repositories;

use App\Models\AccommodationCategory;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class AccommodationCategoryRepository
{
    protected AccommodationCategory $model;

    public function __construct(
        AccommodationCategory $model
    ) {
        $this->model = $model;
    }

    /**
     * Mengambil semua kategori.
     */
    public function getAll(): Collection
    {
        return $this->model
            ->latest()
            ->get();
    }

    /**
     * Mengambil kategori dengan pagination.
     */
    public function getPaginated(
        ?string $keyword = null,
        int $perPage = 10
    ): LengthAwarePaginator {
        return $this->model
            ->when(
                filled($keyword),
                function ($query) use ($keyword) {
                    $query->where(function ($q) use ($keyword) {
                        $q->where(
                            'name',
                            'like',
                            '%' . $keyword . '%'
                        )
                        ->orWhere(
                            'slug',
                            'like',
                            '%' . $keyword . '%'
                        );
                    });
                }
            )
            ->latest()
            ->paginate($perPage)
            ->withQueryString();
    }

    /**
     * Cari kategori berdasarkan ID.
     */
    public function findById(
        int $id
    ): ?AccommodationCategory {
        return $this->model->find($id);
    }

    /**
     * Cari kategori berdasarkan slug.
     */
    public function findBySlug(
        string $slug
    ): ?AccommodationCategory {
        return $this->model
            ->where('slug', $slug)
            ->first();
    }

    /**
     * Buat kategori baru.
     */
    public function create(
        array $data
    ): AccommodationCategory {
        return $this->model->create($data);
    }

    /**
     * Update kategori.
     */
    public function update(
        AccommodationCategory $category,
        array $data
    ): AccommodationCategory {
        $category->update($data);

        return $category->fresh();
    }

    /**
     * Hapus kategori.
     */
    public function delete(
        AccommodationCategory $category
    ): bool {
        return $category->delete();
    }
}
