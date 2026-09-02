<?php

namespace App\Repositories;

use App\Models\banners;
use App\Repositories\Interfaces\BannerRepositoryInterface;

class BannerRepository implements BannerRepositoryInterface
{
    public function getAll()
    {
        return banners::latest()->get();
    }

    public function getById($id)
    {
        return banners::findOrFail($id);
    }

    public function create(array $data)
    {
        return banners::create($data);
    }

    public function update($id, array $data)
    {
        $banner = banners::findOrFail($id);

        $banner->update($data);

        return $banner;
    }

    public function delete($id)
    {
        return banners::findOrFail($id)->delete();
    }
}