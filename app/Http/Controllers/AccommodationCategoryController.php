<?php

namespace App\Http\Controllers;

use App\Models\AccommodationCategory;
use App\Services\AccommodationCategoryService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class AccommodationCategoryController extends Controller
{
    protected AccommodationCategoryService $service;

    public function __construct(
        AccommodationCategoryService $service
    ) {
        $this->service = $service;
    }

    /**
     * Menampilkan daftar kategori.
     */
    public function index(Request $request)
    {
        $categories = $this->service->getPaginated(
            $request->input('keyword')
        );

        return view(
            'example.content.accomodation.kategori',
            compact('categories')
        );
    }

    /**
     * Menyimpan kategori baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate(
            $this->storeRules(),
            $this->validationMessages()
        );

        /*
        |--------------------------------------------------------------------------
        | Bersihkan slug
        |--------------------------------------------------------------------------
        */

        $validated['slug'] = Str::slug(
            $validated['slug']
        );

        /*
        |--------------------------------------------------------------------------
        | Upload thumbnail
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('thumbnail')) {
            $validated['thumbnail'] = $this->storeThumbnail(
                $request->file('thumbnail')
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Simpan kategori melalui service
        |--------------------------------------------------------------------------
        */

        $this->service->create($validated);

        return redirect()
            ->route('accommodation-categories.index')
            ->with(
                'success',
                'Kategori berhasil ditambahkan.'
            );
    }

    /**
     * Mengambil data kategori untuk modal edit.
     */
    public function edit(
        AccommodationCategory $accommodationCategory
    ) {
        return response()->json([
            'success' => true,
            'data' => [
                'id' => $accommodationCategory->id,
                'name' => $accommodationCategory->name,
                'slug' => $accommodationCategory->slug,
                'thumbnail' => $accommodationCategory->thumbnail,
                'thumbnail_url' => $accommodationCategory->thumbnail
                    ? asset($accommodationCategory->thumbnail)
                    : null,
                'description' => $accommodationCategory->description,
            ],
        ]);
    }

    /**
     * Update kategori.
     */
    public function update(
        Request $request,
        AccommodationCategory $accommodationCategory
    ) {
        $validated = $request->validate(
            $this->updateRules($accommodationCategory),
            $this->validationMessages()
        );

        /*
        |--------------------------------------------------------------------------
        | Bersihkan slug
        |--------------------------------------------------------------------------
        */

        $validated['slug'] = Str::slug(
            $validated['slug']
        );

        /*
        |--------------------------------------------------------------------------
        | Upload thumbnail baru
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('thumbnail')) {

            /*
            | Hapus thumbnail lama.
            */

            if ($accommodationCategory->thumbnail) {
                $this->deleteFile(
                    $accommodationCategory->thumbnail
                );
            }

            /*
            | Simpan thumbnail baru.
            */

            $validated['thumbnail'] = $this->storeThumbnail(
                $request->file('thumbnail')
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Update kategori melalui service
        |--------------------------------------------------------------------------
        */

        $this->service->update(
            $accommodationCategory,
            $validated
        );

        return redirect()
            ->route('accommodation-categories.index')
            ->with(
                'success',
                'Kategori berhasil diperbarui.'
            );
    }

    /**
     * Hapus kategori.
     */
    public function destroy(
        AccommodationCategory $accommodationCategory
    ) {
        /*
        |--------------------------------------------------------------------------
        | Hapus thumbnail
        |--------------------------------------------------------------------------
        */

        if ($accommodationCategory->thumbnail) {
            $this->deleteFile(
                $accommodationCategory->thumbnail
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Hapus kategori melalui service.
        |--------------------------------------------------------------------------
        */

        $this->service->delete(
            $accommodationCategory
        );

        return redirect()
            ->route('accommodation-categories.index')
            ->with(
                'success',
                'Kategori berhasil dihapus.'
            );
    }

    /**
     * Validation rules untuk store.
     */
    protected function storeRules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'slug' => [
                'required',
                'string',
                'max:255',
                'unique:accommodation_categories,slug',
            ],

            'thumbnail' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:20480',
            ],

            'description' => [
                'nullable',
                'string',
            ],
        ];
    }

    /**
     * Validation rules untuk update.
     */
    protected function updateRules(
        AccommodationCategory $accommodationCategory
    ): array {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'slug' => [
                'required',
                'string',
                'max:255',
                Rule::unique(
                    'accommodation_categories',
                    'slug'
                )->ignore(
                    $accommodationCategory->id
                ),
            ],

            'thumbnail' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:20480',
            ],

            'description' => [
                'nullable',
                'string',
            ],
        ];
    }

    /**
     * Pesan validasi.
     */
    protected function validationMessages(): array
    {
        return [
            'name.required' =>
                'Nama kategori wajib diisi.',

            'slug.required' =>
                'Slug wajib diisi.',

            'slug.unique' =>
                'Slug tersebut sudah digunakan.',

            'thumbnail.image' =>
                'File harus berupa gambar.',

            'thumbnail.mimes' =>
                'Format gambar harus JPG, JPEG, PNG, atau WEBP.',

            'thumbnail.max' =>
                'Ukuran gambar maksimal 20MB.',
        ];
    }

    /**
     * Simpan thumbnail kategori.
     *
     * File:
     * public/kategori
     *
     * Database:
     * kategori/nama-file.jpg
     */
    protected function storeThumbnail($file): string
    {
        $folder = public_path('kategori');

        /*
        |--------------------------------------------------------------------------
        | Buat folder jika belum ada.
        |--------------------------------------------------------------------------
        */

        if (!File::exists($folder)) {
            File::makeDirectory(
                $folder,
                0755,
                true
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Nama file unik.
        |--------------------------------------------------------------------------
        */

        $extension = strtolower(
            $file->getClientOriginalExtension()
        );

        $filename =
            time() .
            '_' .
            Str::random(10) .
            '.' .
            $extension;

        /*
        |--------------------------------------------------------------------------
        | Pindahkan file.
        |--------------------------------------------------------------------------
        */

        $file->move(
            $folder,
            $filename
        );

        /*
        |--------------------------------------------------------------------------
        | Path yang disimpan di database.
        |--------------------------------------------------------------------------
        */

        return 'kategori/' . $filename;
    }

    /**
     * Hapus file dari public.
     */
    protected function deleteFile(string $path): void
    {
        $file = public_path(
            ltrim($path, '/')
        );

        if (File::exists($file)) {
            File::delete($file);
        }
    }
}