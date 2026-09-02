<?php

namespace App\Repositories;

use App\Models\galleries;
use App\Repositories\Interfaces\GaleriesRepositoryInterface;

class GaleriesRepository implements GaleriesRepositoryInterface
{
    protected $model;

    public function __construct(galleries $model)
    {
        $this->model = $model;
    }

    /**
     * Mengambil semua gallery
     */
    public function getAll()
    {
        return $this->model
            ->orderBy('sort_order')
            ->get();
    }

    /**
     * Mengambil gallery berdasarkan ID
     */
    public function getById($id)
    {
        return $this->model
            ->findOrFail($id);
    }

    /**
     * Gallery landing page berdasarkan ID
     */
    public function getLandingGaleriesById($id)
    {
        return $this->model
            ->findOrFail($id);
    }

    /**
     * Semua gallery landing page
     */
    public function getLandingGaleries()
    {
        return $this->model
            ->orderBy('sort_order')
            ->get();
    }

    /**
     * Gallery berdasarkan akomodasi
     *
     * Karena tabel galleries kamu tidak memiliki
     * accommodation_id, method ini tidak digunakan
     * untuk gallery landing page.
     */
    public function getByAccommodation($accommodationId)
    {
        return collect();
    }

    /**
     * Tambah gallery
     */
    public function create(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * Update gallery
     */
    public function update($id, array $data)
    {
        $gallery = $this->model->findOrFail($id);

        $gallery->update($data);

        return $gallery;
    }

    /**
     * Hapus gallery
     */
    public function delete($id)
    {
        $gallery = $this->model->findOrFail($id);

        return $gallery->delete();
    }
}
