<?php

namespace App\Repositories\Interfaces;

interface GaleriesRepositoryInterface
{
    public function getAll();

    public function getById($id);

    public function getLandingGaleriesById($id);

     public function getLandingGaleries();

    public function getByAccommodation($accommodationId);

    public function create(array $data);

    public function update($id, array $data);

    public function delete($id);
}