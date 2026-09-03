<?php

namespace App\Repositories;

use App\Models\Setting;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class SettingRepository
{
    protected Setting $model;

    public function __construct(Setting $model)
    {
        $this->model = $model;
    }

    /**
     * Mengambil semua setting.
     */
    public function getAll()
    {
        return $this->model
            ->latest()
            ->get();
    }

    /**
     * Mengambil setting dengan pagination.
     *
     * Tidak wajib digunakan jika settings
     * hanya memiliki satu record.
     */
    public function getPaginated(
        int $perPage = 10
    ): LengthAwarePaginator {
        return $this->model
            ->latest()
            ->paginate($perPage);
    }

    /**
     * Mengambil setting berdasarkan ID.
     */
    public function findById(int $id): ?Setting
    {
        return $this->model->find($id);
    }

    /**
     * Mengambil setting pertama.
     */
    public function first(): ?Setting
    {
        return $this->model
            ->latest('id')
            ->first();
    }

    /**
     * Membuat setting baru.
     */
    public function create(array $data): Setting
    {
        return $this->model->create($data);
    }

    /**
     * Update setting.
     */
    public function update(
        Setting $setting,
        array $data
    ): Setting {
        $setting->update($data);

        return $setting->fresh();
    }

    /**
     * Hapus setting.
     */
    public function delete(Setting $setting): bool
    {
        return $setting->delete();
    }
}