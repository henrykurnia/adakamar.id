<?php

namespace App\Repositories;

use App\Repositories\Interfaces\AkomodasiRepositoryInterface;
use App\Models\accommodations;

class AkomodasiRepository implements AkomodasiRepositoryInterface
{
    public function getAll()
    {
        return accommodations::with('category')
            ->latest()
            ->get();
    }

    public function getById($id)
    {
        return accommodations::with('category', 'images')
            ->findOrFail($id);
    }

    public function create(array $data)
    {
        return accommodations::create($data);
    }

    public function update($id, array $data)
    {
        $akomodasi = accommodations::findOrFail($id);

        $akomodasi->update($data);

        return $akomodasi;
    }

    public function delete($id)
    {
        $akomodasi = accommodations::findOrFail($id);

        return $akomodasi->delete();
    }
}