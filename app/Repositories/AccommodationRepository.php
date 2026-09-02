<?php

namespace App\Repositories;

use App\Models\Accommodation;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class AccommodationRepository
{
    protected Accommodation $model;

    public function __construct(Accommodation $model)
    {
        $this->model = $model;
    }

    /**
     * Ambil daftar accommodation.
     */
    public function getAll(
        ?string $keyword = null,
        int $perPage = 10
    ): LengthAwarePaginator {
        return $this->model
            ->with([
                'category',
                'images',
                'facilities',
                'rules',
            ])
            ->when(
                filled($keyword),
                function ($query) use ($keyword) {
                    $query->where(function ($q) use ($keyword) {
                        $q->where(
                            'title',
                            'like',
                            '%' . $keyword . '%'
                        )
                        ->orWhere(
                            'address',
                            'like',
                            '%' . $keyword . '%'
                        )
                        ->orWhere(
                            'description',
                            'like',
                            '%' . $keyword . '%'
                        );
                    });
                }
            )
            ->latest()
            ->paginate($perPage);
    }

    /**
     * Ambil satu accommodation berdasarkan ID.
     */
    public function findById(int $id): ?Accommodation
    {
        return $this->model
            ->with([
                'category',
                'images',
                'facilities',
                'rules',
            ])
            ->find($id);
    }

    /**
     * Buat accommodation baru.
     */
    public function create(array $data): Accommodation
    {
        return $this->model->create($data);
    }

    /**
     * Update accommodation.
     */
    public function update(
        Accommodation $accommodation,
        array $data
    ): bool {
        return $accommodation->update($data);
    }

    /**
     * Hapus accommodation.
     *
     * Menggunakan SoftDeletes karena model
     * menggunakan trait SoftDeletes.
     */
    public function delete(Accommodation $accommodation): bool
    {
        return $accommodation->delete();
    }

    /**
     * Cari accommodation berdasarkan slug.
     *
     * $exceptId digunakan ketika update agar
     * slug milik record sendiri tidak dianggap duplikat.
     */
    public function findBySlug(
        string $slug,
        ?int $exceptId = null
    ): ?Accommodation {
        return $this->model
            ->when(
                $exceptId !== null,
                function ($query) use ($exceptId) {
                    $query->where('id', '!=', $exceptId);
                }
            )
            ->where('slug', $slug)
            ->first();
    }
}
