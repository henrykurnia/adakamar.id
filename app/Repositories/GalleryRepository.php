<?php

namespace App\Repositories;

use App\Models\galleries;
use App\Repositories\Interfaces\GalleryRepositoryInterface;

class GalleryRepository implements GalleryRepositoryInterface
{
    public function getAll()
    {
        return galleries::latest()->get();
    }

    public function getById($id)
    {
        return galleries::with('images')->findOrFail($id);
    }

    public function create(array $data)
    {
        return galleries::create($data);
    }

    public function update($id, array $data)
    {
        $gallery = galleries::findOrFail($id);

        $gallery->update($data);

        return $gallery;
    }

    public function delete($id)
    {
        return galleries::findOrFail($id)->delete();
    }
}