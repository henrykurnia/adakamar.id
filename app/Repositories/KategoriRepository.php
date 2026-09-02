<?php

namespace App\Repositories;

use App\Repositories\Interfaces\KategoriRepositoryInterface;
use App\Models\accommodation_categories;

class KategoriRepository implements KategoriRepositoryInterface
{
    public function getAll()
    {
        return accommodation_categories::latest()->get();
    }

    public function getById($id)
    {
        return accommodation_categories::findOrFail($id);
    }

    public function create(array $data)
    {
        return accommodation_categories::create($data);
    }

    public function update($id, array $data)
    {
        $kategori = accommodation_categories::findOrFail($id);

        $kategori->update($data);

        return $kategori;
    }

    public function delete($id)
    {
        $kategori = accommodation_categories::findOrFail($id);

        return $kategori->delete();
    }
}