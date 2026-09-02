<?php

namespace App\Services;

use App\Models\Facility;
use App\Repositories\FacilityRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class FacilityService
{
    protected FacilityRepository $repository;

    public function __construct(FacilityRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Ambil daftar fasilitas.
     */
    public function getAll(
        ?string $keyword = null,
        int $perPage = 10
    ): LengthAwarePaginator {
        return $this->repository->getAll($keyword, $perPage);
    }

    /**
     * Ambil satu fasilitas.
     */
    public function find(int $id): Facility
    {
        return $this->repository->find($id);
    }

    /**
     * Buat fasilitas baru.
     */
    public function create(array $data): Facility
    {
        return DB::transaction(function () use ($data) {
            return $this->repository->create([
                'name' => $data['name'],
                'description' => $data['description'] ?? null,
                'is_active' => $data['is_active'] ?? true,
            ]);
        });
    }

    /**
     * Update fasilitas.
     */
    public function update(Facility $facility, array $data): Facility
    {
        return DB::transaction(function () use ($facility, $data) {
            return $this->repository->update($facility, [
                'name' => $data['name'],
                'description' => $data['description'] ?? null,
                'is_active' => $data['is_active'] ?? $facility->is_active,
            ]);
        });
    }

    /**
     * Hapus fasilitas.
     */
    public function delete(Facility $facility): bool
    {
        return DB::transaction(function () use ($facility) {
            return $this->repository->delete($facility);
        });
    }
}