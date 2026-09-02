<?php

namespace App\Services;

use App\Repositories\Interfaces\GalleryRepositoryInterface;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class GalleryService
{
    protected $repository;

    public function __construct(
        GalleryRepositoryInterface $repository
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

    public function create(array $data, array $images = [])
    {
        $results = [];

        foreach ($images as $image) {

            if ($image instanceof UploadedFile) {

                $imagePath = $image->store('galleries', 'public');

                $galleryData = $data;

                $galleryData['image'] = $imagePath;

                $results[] = $this->repository->create($galleryData);
            }
        }

        return $results;
    }

    public function update($id, array $data, ?UploadedFile $image = null)
    {
        $gallery = $this->repository->getById($id);

        if ($image) {

            if ($gallery->image) {
                Storage::disk('public')->delete($gallery->image);
            }

            $data['image'] = $image->store('galleries', 'public');
        }

        return $this->repository->update($id, $data);
    }

    public function delete($id)
    {
        $gallery = $this->repository->getById($id);

        if ($gallery->image) {
            Storage::disk('public')->delete($gallery->image);
        }

        return $this->repository->delete($id);
    }
}