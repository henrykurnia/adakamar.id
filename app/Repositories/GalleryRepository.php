<?php

namespace App\Repositories;

use App\Models\Gallery;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class GalleryRepository
{
    /**
     * Ambil semua gallery dengan pagination.
     */
    public function getAll(
        ?string $keyword = null,
        int $perPage = 10
    ): LengthAwarePaginator {
        return Gallery::query()
            ->when($keyword, function ($query) use ($keyword) {
                $query->where('title', 'like', '%' . $keyword . '%');
            })
            ->orderBy('sort_order')
            ->orderByDesc('id')
            ->paginate($perPage)
            ->withQueryString();
    }

    /**
     * Cari gallery berdasarkan ID.
     */
    public function findById(int $id): ?Gallery
    {
        return Gallery::find($id);
    }

    /**
     * Buat gallery baru.
     */
    public function create(array $data): Gallery
    {
        return Gallery::create($data);
    }

    /**
     * Update gallery.
     */
    public function update(
        Gallery $gallery,
        array $data
    ): bool {
        return $gallery->update($data);
    }

    /**
     * Hapus gallery.
     */
    public function delete(Gallery $gallery): bool
    {
        return $gallery->delete();
    }
}
