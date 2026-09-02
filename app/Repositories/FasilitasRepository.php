<?php

namespace App\Repositories;

use App\Models\facilities;
use App\Repositories\Interfaces\FasilitasRepositoryInterface;

class FasilitasRepository implements FasilitasRepositoryInterface
{
    public function getAll()
    {
        return facilities::latest()->get();
    }

    public function getById($id)
    {
        return facilities::findOrFail($id);
    }

    public function create(array $data)
    {
        return facilities::create($data);
    }

    public function update($id, array $data)
    {
        $fasilitas = facilities::findOrFail($id);

        $fasilitas->update($data);

        return $fasilitas;
    }

    public function delete($id)
    {
        return facilities::findOrFail($id)->delete();
    }
}