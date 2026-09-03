<?php

namespace App\Repositories;

use App\Models\Banner;

class BannerRepository
{
    protected Banner $model;

    public function __construct(Banner $model)
    {
        $this->model = $model;
    }

    /**
     * Mengambil semua data banner.
     */
    public function getAll()
    {
        return $this->model
            ->latest()
            ->get();
    }

    /**
     * Mengambil banner berdasarkan ID.
     */
    public function findById(int $id): Banner
    {
        return $this->model->findOrFail($id);
    }

    /**
     * Membuat banner baru.
     */
    public function create(array $data): Banner
    {
        return $this->model->create($data);
    }

    /**
     * Mengupdate banner berdasarkan ID.
     */
    public function update(int $id, array $data): Banner
    {
        $banner = $this->findById($id);

        $banner->update($data);

        return $banner->fresh();
    }

    /**
     * Menghapus banner berdasarkan ID.
     */
    public function delete(int $id): bool
    {
        $banner = $this->findById($id);

        return $banner->delete();
    }
}