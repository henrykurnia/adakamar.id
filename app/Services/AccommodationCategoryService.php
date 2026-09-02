<?php

namespace App\Services;

use App\Models\AccommodationCategory;
use App\Repositories\AccommodationCategoryRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class AccommodationCategoryService
{
    protected AccommodationCategoryRepository $repository;

    public function __construct(
        AccommodationCategoryRepository $repository
    ) {
        $this->repository = $repository;
    }

    /**
     * Mengambil semua kategori.
     */
    public function getAll(): Collection
    {
        return $this->repository->getAll();
    }

    /**
     * Mengambil kategori dengan pagination.
     */
    public function getPaginated(
        ?string $keyword = null,
        int $perPage = 10
    ): LengthAwarePaginator {
        return $this->repository->getPaginated(
            $keyword,
            $perPage
        );
    }

    /**
     * Cari kategori berdasarkan ID.
     */
    public function findById(
        int $id
    ): ?AccommodationCategory {
        return $this->repository->findById($id);
    }

    /**
     * Cari kategori berdasarkan slug.
     */
    public function findBySlug(
        string $slug
    ): ?AccommodationCategory {
        return $this->repository->findBySlug($slug);
    }

    /**
     * Buat kategori baru.
     */
    public function create(
        array $data
    ): AccommodationCategory {
        return $this->repository->create($data);
    }

    /**
     * Update kategori.
     */
    public function update(
        AccommodationCategory $category,
        array $data
    ): AccommodationCategory {
        return $this->repository->update(
            $category,
            $data
        );
    }

    /**
     * Hapus kategori.
     */
    public function delete(
        AccommodationCategory $category
    ): bool {
        return $this->repository->delete(
            $category
        );
    }
}
