<?php

namespace App\Services;

use App\Repositories\Interfaces\GaleriesRepositoryInterface;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;

class GaleriesService
{
    protected $repository;

    public function __construct(
        GaleriesRepositoryInterface $repository
    ) {
        $this->repository = $repository;
    }

    public function getAll()
    {
        return $this->repository->getAll();
    }

    public function getById($id)
    {
        return $this->repository->getById($id);
    }

    public function getLandingGaleriesById($id)
    {
        return $this->repository->getLandingGaleriesById($id);
    }

    public function getLandingGaleries()
    {
        return $this->repository->getLandingGaleries();
    }

    public function getByAccommodation($accommodationId)
    {
        return $this->repository->getByAccommodation($accommodationId);
    }

    /**
     * CREATE
     */
    public function create(
        array $data,
        ?UploadedFile $image = null
    ) {
        if ($image) {

            $folder = public_path('uploads/galeries');

            if (!File::exists($folder)) {
                File::makeDirectory($folder, 0755, true);
            }

            $filename = time() . '_' .
                $image->getClientOriginalName();

            $image->move(
                $folder,
                $filename
            );

            $data['image'] =
                'uploads/galeries/' . $filename;
        }

        return $this->repository->create($data);
    }

    /**
     * UPDATE
     */
    public function update(
        $id,
        array $data,
        ?UploadedFile $image = null
    ) {
        $gallery = $this->repository->getById($id);

        if ($image) {

            /*
             * Hapus gambar lama
             */
            if ($gallery && $gallery->image) {

                $oldImage =
                    public_path($gallery->image);

                if (File::exists($oldImage)) {
                    File::delete($oldImage);
                }
            }

            /*
             * Folder
             */
            $folder =
                public_path('uploads/galeries');

            if (!File::exists($folder)) {
                File::makeDirectory(
                    $folder,
                    0755,
                    true
                );
            }

            /*
             * Simpan gambar baru
             */
            $filename = time() . '_' .
                $image->getClientOriginalName();

            $image->move(
                $folder,
                $filename
            );

            $data['image'] =
                'uploads/galeries/' . $filename;
        }

        return $this->repository->update(
            $id,
            $data
        );
    }

    /**
     * DELETE
     */
    public function delete($id)
    {
        $gallery =
            $this->repository->getById($id);

        if ($gallery && $gallery->image) {

            $imagePath =
                public_path($gallery->image);

            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }
        }

        return $this->repository->delete($id);
    }
}
