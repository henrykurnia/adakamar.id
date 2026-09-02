<?php

namespace App\Repositories;

use App\Models\Facility;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class FacilityRepository
{
    protected Facility $model;

    public function __construct(Facility $model)
    {
        $this->model = $model;
    }

    /**
     * Ambil semua fasilitas dengan pagination dan pencarian.
     */
    public function getAll(
        ?string $keyword = null,
        int $perPage = 10
    ): LengthAwarePaginator {
        return $this->model
            ->when($keyword, function ($query) use ($keyword) {
                $query->where(function ($q) use ($keyword) {
                    $q->where('name', 'like', "%{$keyword}%")
                        ->orWhere('description', 'like', "%{$keyword}%");
                });
            })
            ->latest('id')
            ->paginate($perPage)
            ->withQueryString();
    }

    /**
     * Cari fasilitas berdasarkan ID.
     */
    public function find(int $id): Facility
    {
        return $this->model->findOrFail($id);
    }

    /**
     * Simpan fasilitas baru.
     */
    public function create(array $data): Facility
    {
        return $this->model->create($data);
    }

    /**
     * Update fasilitas.
     */
    public function update(Facility $facility, array $data): Facility
    {
        $facility->update($data);

        return $facility->fresh();
    }

    /**
     * Hapus fasilitas.
     */
    public function delete(Facility $facility): bool
    {
        return $facility->delete();
    }
}