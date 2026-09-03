<?php

namespace App\Services;

use App\Repositories\BannerRepository;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class BannerService
{
    protected BannerRepository $repository;

    public function __construct(BannerRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Mengambil semua banner.
     */
    public function getAll()
    {
        return $this->repository->getAll();
    }

    /**
     * Mengambil satu banner berdasarkan ID.
     */
    public function findById(int $id)
    {
        return $this->repository->findById($id);
    }

    /**
     * Membuat banner baru.
     */
    public function create(array $data)
    {
        if (
            isset($data['image']) &&
            $data['image'] instanceof UploadedFile
        ) {
            $data['image'] = $data['image']->store(
                'banners',
                'public'
            );
        }

        return $this->repository->create($data);
    }

    /**
     * Mengupdate banner.
     */
    public function update(int $id, array $data)
    {
        $banner = $this->repository->findById($id);

        /*
        |--------------------------------------------------------------------------
        | Upload Image Baru
        |--------------------------------------------------------------------------
        */

        if (
            isset($data['image']) &&
            $data['image'] instanceof UploadedFile
        ) {
            /*
            | Hapus image lama
            */
            if (
                !empty($banner->image) &&
                Storage::disk('public')->exists($banner->image)
            ) {
                Storage::disk('public')->delete($banner->image);
            }

            /*
            | Simpan image baru
            */
            $data['image'] = $data['image']->store(
                'banners',
                'public'
            );
        } else {
            /*
            | Jika tidak upload image baru,
            | jangan ubah image yang lama.
            */
            unset($data['image']);
        }

        return $this->repository->update(
            $id,
            $data
        );
    }

    /**
     * Menghapus banner beserta image.
     */
    public function delete(int $id): bool
    {
        $banner = $this->repository->findById($id);

        /*
        |--------------------------------------------------------------------------
        | Hapus Image
        |--------------------------------------------------------------------------
        */

        if (
            !empty($banner->image) &&
            Storage::disk('public')->exists($banner->image)
        ) {
            Storage::disk('public')->delete($banner->image);
        }

        /*
        |--------------------------------------------------------------------------
        | Hapus Data
        |--------------------------------------------------------------------------
        */

        return $this->repository->delete($id);
    }
}
