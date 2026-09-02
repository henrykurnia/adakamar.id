<?php

namespace App\Services;

use App\Models\Accommodation;
use App\Repositories\AccommodationRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AccommodationService
{
    protected AccommodationRepository $accommodationRepository;

    public function __construct(
        AccommodationRepository $accommodationRepository
    ) {
        $this->accommodationRepository = $accommodationRepository;
    }

    /**
     * Daftar accommodation.
     */
    public function getAccommodations(
        ?string $keyword = null,
        int $perPage = 10
    ): LengthAwarePaginator {
        return $this->accommodationRepository
            ->getAll($keyword, $perPage);
    }

    /**
     * Detail accommodation.
     */
    public function getAccommodation(int $id): ?Accommodation
    {
        return $this->accommodationRepository
            ->findById($id);
    }

    /**
     * Buat accommodation baru.
     */
    public function createAccommodation(array $data): Accommodation
    {
        return DB::transaction(function () use ($data) {

            /*
            |--------------------------------------------------------------------------
            | Slug
            |--------------------------------------------------------------------------
            */

            $slug = $data['slug'] ?? null;

            if (!$slug) {
                $slug = Str::slug($data['title']);
            }

            $slug = $this->generateUniqueSlug($slug);

            /*
            |--------------------------------------------------------------------------
            | Thumbnail
            |--------------------------------------------------------------------------
            */

            if (
                isset($data['thumbnail']) &&
                $data['thumbnail'] instanceof UploadedFile
            ) {
                $data['thumbnail'] = $this->storeThumbnail(
                    $data['thumbnail']
                );
            }

            /*
            |--------------------------------------------------------------------------
            | Relasi
            |--------------------------------------------------------------------------
            */

            $facilityIds = $data['facility_ids'] ?? [];
            $ruleIds = $data['rule_ids'] ?? [];
            $gallery = $data['gallery'] ?? [];

            /*
            |--------------------------------------------------------------------------
            | Hapus field yang bukan kolom accommodation
            |--------------------------------------------------------------------------
            */

            unset(
                $data['facility_ids'],
                $data['rule_ids'],
                $data['gallery']
            );

            $data['slug'] = $slug;

            /*
            |--------------------------------------------------------------------------
            | Create accommodation
            |--------------------------------------------------------------------------
            */

            $accommodation = $this->accommodationRepository
                ->create($data);

            /*
            |--------------------------------------------------------------------------
            | Fasilitas
            |--------------------------------------------------------------------------
            */

            if (!empty($facilityIds)) {
                $accommodation->facilities()
                    ->sync($facilityIds);
            }

            /*
            |--------------------------------------------------------------------------
            | Aturan
            |--------------------------------------------------------------------------
            */

            if (!empty($ruleIds)) {
                $accommodation->rules()
                    ->sync($ruleIds);
            }

            /*
            |--------------------------------------------------------------------------
            | Gallery
            |--------------------------------------------------------------------------
            */

            if (!empty($gallery)) {
                $this->storeGallery(
                    $accommodation,
                    $gallery
                );
            }

            /*
            |--------------------------------------------------------------------------
            | Return data lengkap
            |--------------------------------------------------------------------------
            */

            return $accommodation->load([
                'category',
                'images',
                'facilities',
                'rules',
            ]);
        });
    }

    /**
     * Update accommodation.
     */
    public function updateAccommodation(
        int $id,
        array $data
    ): ?Accommodation {
        return DB::transaction(function () use ($id, $data) {

            /*
            |--------------------------------------------------------------------------
            | Cari accommodation
            |--------------------------------------------------------------------------
            */

            $accommodation = $this->accommodationRepository
                ->findById($id);

            if (!$accommodation) {
                return null;
            }

            /*
            |--------------------------------------------------------------------------
            | Slug
            |--------------------------------------------------------------------------
            */

            $slug = $data['slug'] ?? null;

            if (!$slug) {
                $slug = Str::slug($data['title']);
            }

            $slug = $this->generateUniqueSlug(
                $slug,
                $accommodation->id
            );

            /*
            |--------------------------------------------------------------------------
            | Thumbnail baru
            |--------------------------------------------------------------------------
            */

            if (
                isset($data['thumbnail']) &&
                $data['thumbnail'] instanceof UploadedFile
            ) {

                /*
                | Hapus thumbnail lama
                */

                if ($accommodation->thumbnail) {
                    $this->deleteFile(
                        $accommodation->thumbnail
                    );
                }

                /*
                | Simpan thumbnail baru
                */

                $data['thumbnail'] = $this->storeThumbnail(
                    $data['thumbnail']
                );
            } else {
                /*
                | Jangan update thumbnail jika tidak ada file baru
                */

                unset($data['thumbnail']);
            }

            /*
            |--------------------------------------------------------------------------
            | Relasi
            |--------------------------------------------------------------------------
            */

            $facilityIds = $data['facility_ids'] ?? [];
            $ruleIds = $data['rule_ids'] ?? [];
            $gallery = $data['gallery'] ?? [];

            /*
            |--------------------------------------------------------------------------
            | Hapus field relasi dari data utama
            |--------------------------------------------------------------------------
            */

            unset(
                $data['facility_ids'],
                $data['rule_ids'],
                $data['gallery']
            );

            $data['slug'] = $slug;

            /*
            |--------------------------------------------------------------------------
            | Update accommodation
            |--------------------------------------------------------------------------
            */

            $this->accommodationRepository
                ->update($accommodation, $data);

            /*
            |--------------------------------------------------------------------------
            | Sync fasilitas
            |--------------------------------------------------------------------------
            */

            $accommodation->facilities()
                ->sync($facilityIds);

            /*
            |--------------------------------------------------------------------------
            | Sync aturan
            |--------------------------------------------------------------------------
            */

            $accommodation->rules()
                ->sync($ruleIds);

            /*
            |--------------------------------------------------------------------------
            | Gallery baru
            |--------------------------------------------------------------------------
            */

            if (!empty($gallery)) {
                $this->storeGallery(
                    $accommodation,
                    $gallery
                );
            }

            /*
            |--------------------------------------------------------------------------
            | Return data terbaru
            |--------------------------------------------------------------------------
            */

            return $accommodation->fresh([
                'category',
                'images',
                'facilities',
                'rules',
            ]);
        });
    }

    /**
     * Hapus accommodation.
     */
    public function deleteAccommodation(int $id): bool
    {
        return DB::transaction(function () use ($id) {

            /*
            |--------------------------------------------------------------------------
            | Cari accommodation
            |--------------------------------------------------------------------------
            */

            $accommodation = $this->accommodationRepository
                ->findById($id);

            if (!$accommodation) {
                return false;
            }

            /*
            |--------------------------------------------------------------------------
            | Hapus thumbnail
            |--------------------------------------------------------------------------
            */

            if ($accommodation->thumbnail) {
                $this->deleteFile(
                    $accommodation->thumbnail
                );
            }

            /*
            |--------------------------------------------------------------------------
            | Hapus semua gallery
            |--------------------------------------------------------------------------
            */

            foreach ($accommodation->images as $image) {

                if ($image->image) {
                    $this->deleteFile(
                        $image->image
                    );
                }

                $image->delete();
            }

            /*
            |--------------------------------------------------------------------------
            | Hapus relasi fasilitas
            |--------------------------------------------------------------------------
            */

            $accommodation->facilities()
                ->detach();

            /*
            |--------------------------------------------------------------------------
            | Hapus relasi aturan
            |--------------------------------------------------------------------------
            */

            $accommodation->rules()
                ->detach();

            /*
            |--------------------------------------------------------------------------
            | Soft delete
            |--------------------------------------------------------------------------
            */

            return $this->accommodationRepository
                ->delete($accommodation);
        });
    }

    /**
     * Generate slug unik.
     */
    protected function generateUniqueSlug(
        string $slug,
        ?int $exceptId = null
    ): string {

        $originalSlug = Str::slug($slug);

        $slug = $originalSlug;

        $counter = 1;

        while (
            $this->accommodationRepository
                ->findBySlug($slug, $exceptId)
        ) {
            $slug = $originalSlug . '-' . $counter;

            $counter++;
        }

        return $slug;
    }

    /**
     * Simpan thumbnail.
     *
     * File:
     * public/accommodations
     *
     * Database:
     * accommodations/nama-file.jpg
     */
    protected function storeThumbnail(
        UploadedFile $file
    ): string {

        /*
        |--------------------------------------------------------------------------
        | Pastikan folder tersedia
        |--------------------------------------------------------------------------
        */

        $directory = public_path('accommodations');

        if (!is_dir($directory)) {
            mkdir(
                $directory,
                0755,
                true
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Nama file
        |--------------------------------------------------------------------------
        */

        $originalName = pathinfo(
            $file->getClientOriginalName(),
            PATHINFO_FILENAME
        );

        $extension = strtolower(
            $file->getClientOriginalExtension()
        );

        $filename =
            time() .
            '_' .
            Str::slug($originalName) .
            '_' .
            uniqid() .
            '.' .
            $extension;

        /*
        |--------------------------------------------------------------------------
        | Pindahkan file
        |--------------------------------------------------------------------------
        */

        $file->move(
            $directory,
            $filename
        );

        /*
        |--------------------------------------------------------------------------
        | Path yang disimpan di database
        |--------------------------------------------------------------------------
        */

        return 'accommodations/' . $filename;
    }

    /**
     * Simpan gallery.
     *
     * File:
     * public/galery_accommodation
     *
     * Database:
     * galery_accommodation/nama-file.jpg
     */
    protected function storeGallery(
        Accommodation $accommodation,
        array $files
    ): void {

        /*
        |--------------------------------------------------------------------------
        | Sort order terakhir
        |--------------------------------------------------------------------------
        */

        $lastSortOrder = $accommodation->images()
            ->max('sort_order') ?? 0;

        /*
        |--------------------------------------------------------------------------
        | Folder gallery
        |--------------------------------------------------------------------------
        */

        $directory = public_path(
            'galery_accommodation'
        );

        if (!is_dir($directory)) {
            mkdir(
                $directory,
                0755,
                true
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Loop file
        |--------------------------------------------------------------------------
        */

        foreach ($files as $file) {

            if (!$file instanceof UploadedFile) {
                continue;
            }

            /*
            | Nama file
            */

            $originalName = pathinfo(
                $file->getClientOriginalName(),
                PATHINFO_FILENAME
            );

            $extension = strtolower(
                $file->getClientOriginalExtension()
            );

            $filename =
                time() .
                '_' .
                Str::slug($originalName) .
                '_' .
                uniqid() .
                '.' .
                $extension;

            /*
            | Pindahkan file
            */

            $file->move(
                $directory,
                $filename
            );

            /*
            | Sort order
            */

            $lastSortOrder++;

            /*
            | Simpan ke database
            */

            $accommodation->images()->create([
                'image' =>
                    'galery_accommodation/' . $filename,

                'sort_order' =>
                    $lastSortOrder,
            ]);
        }
    }

    /**
     * Hapus file dari public.
     */
    protected function deleteFile(
        string $path
    ): void {

        /*
        |--------------------------------------------------------------------------
        | Path fisik
        |--------------------------------------------------------------------------
        */

        $filePath = public_path(
            ltrim($path, '/')
        );

        /*
        |--------------------------------------------------------------------------
        | Hapus jika file ada
        |--------------------------------------------------------------------------
        */

        if (file_exists($filePath)) {
            unlink($filePath);
        }
    }
}