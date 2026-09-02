<?php

namespace App\Http\Controllers;

use App\Services\GalleryService;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class GalleryController extends Controller
{
    protected GalleryService $galleryService;

    public function __construct(
        GalleryService $galleryService
    ) {
        $this->galleryService = $galleryService;
    }

    /**
     * Daftar gallery.
     */
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');

        $galleries = $this->galleryService
            ->getGalleries($keyword, 10);

        return view(
            'example.content.konten.galeri',
            compact('galleries')
        );
    }

    /**
     * Simpan gallery baru.
     */
    public function store(Request $request)
    {
        try {

            $validated = $request->validate([
                'title' => [
                    'required',
                    'string',
                    'max:255',
                ],

                'image' => [
                    'required',
                    'image',
                    'mimes:jpg,jpeg,png,gif,webp',
                    'max:5120',
                ],

                'sort_order' => [
                    'nullable',
                    'integer',
                    'min:0',
                ],

                'is_active' => [
                    'nullable',
                    'boolean',
                ],
            ]);

            /*
            |--------------------------------------------------------------------------
            | Checkbox
            |--------------------------------------------------------------------------
            */

            $validated['is_active'] =
                $request->boolean('is_active');

            $gallery = $this->galleryService
                ->createGallery($validated);

            if ($request->ajax() || $request->wantsJson()) {

                return response()->json([
                    'success' => true,
                    'message' => 'Gallery berhasil ditambahkan.',
                    'data' => $gallery,
                ]);
            }

            return redirect()
                ->route('galleries.index')
                ->with(
                    'success',
                    'Gallery berhasil ditambahkan.'
                );

        } catch (ValidationException $e) {

            if ($request->ajax() || $request->wantsJson()) {

                return response()->json([
                    'success' => false,
                    'message' => 'Validasi gagal.',
                    'errors' => $e->errors(),
                ], 422);
            }

            throw $e;

        } catch (\Exception $e) {

            if ($request->ajax() || $request->wantsJson()) {

                return response()->json([
                    'success' => false,
                    'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
                ], 500);
            }

            return redirect()
                ->back()
                ->with(
                    'error',
                    'Terjadi kesalahan: ' . $e->getMessage()
                );
        }
    }

    /**
     * Detail gallery.
     */
    public function show(int $id)
    {
        $gallery = $this->galleryService
            ->getGallery($id);

        if (!$gallery) {

            return response()->json([
                'success' => false,
                'message' => 'Gallery tidak ditemukan.',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $gallery,
        ]);
    }

    /**
     * Data gallery untuk modal edit.
     */
    public function edit(int $id)
    {
        $gallery = $this->galleryService
            ->getGallery($id);

        if (!$gallery) {

            return response()->json([
                'success' => false,
                'message' => 'Gallery tidak ditemukan.',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $gallery,
        ]);
    }

    /**
     * Update gallery.
     */
    public function update(Request $request, int $id)
    {
        try {

            $validated = $request->validate([
                'title' => [
                    'required',
                    'string',
                    'max:255',
                ],

                'image' => [
                    'nullable',
                    'image',
                    'mimes:jpg,jpeg,png,gif,webp',
                    'max:5120',
                ],

                'sort_order' => [
                    'nullable',
                    'integer',
                    'min:0',
                ],

                'is_active' => [
                    'nullable',
                    'boolean',
                ],
            ]);

            /*
            |--------------------------------------------------------------------------
            | Checkbox
            |--------------------------------------------------------------------------
            */

            $validated['is_active'] =
                $request->boolean('is_active');

            $gallery = $this->galleryService
                ->updateGallery($id, $validated);

            if (!$gallery) {

                if ($request->ajax() || $request->wantsJson()) {

                    return response()->json([
                        'success' => false,
                        'message' => 'Gallery tidak ditemukan.',
                    ], 404);
                }

                return redirect()
                    ->route('galleries.index')
                    ->with(
                        'error',
                        'Gallery tidak ditemukan.'
                    );
            }

            if ($request->ajax() || $request->wantsJson()) {

                return response()->json([
                    'success' => true,
                    'message' => 'Gallery berhasil diperbarui.',
                    'data' => $gallery,
                ]);
            }

            return redirect()
                ->route('galleries.index')
                ->with(
                    'success',
                    'Gallery berhasil diperbarui.'
                );

        } catch (ValidationException $e) {

            if ($request->ajax() || $request->wantsJson()) {

                return response()->json([
                    'success' => false,
                    'message' => 'Validasi gagal.',
                    'errors' => $e->errors(),
                ], 422);
            }

            throw $e;

        } catch (\Exception $e) {

            if ($request->ajax() || $request->wantsJson()) {

                return response()->json([
                    'success' => false,
                    'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
                ], 500);
            }

            return redirect()
                ->back()
                ->with(
                    'error',
                    'Terjadi kesalahan: ' . $e->getMessage()
                );
        }
    }

    /**
     * Hapus gallery.
     */
    public function destroy(Request $request, int $id)
    {
        try {

            $deleted = $this->galleryService
                ->deleteGallery($id);

            if (!$deleted) {

                if ($request->ajax() || $request->wantsJson()) {

                    return response()->json([
                        'success' => false,
                        'message' => 'Gallery tidak ditemukan.',
                    ], 404);
                }

                return redirect()
                    ->route('galleries.index')
                    ->with(
                        'error',
                        'Gallery tidak ditemukan.'
                    );
            }

            if ($request->ajax() || $request->wantsJson()) {

                return response()->json([
                    'success' => true,
                    'message' => 'Gallery berhasil dihapus.',
                ]);
            }

            return redirect()
                ->route('galleries.index')
                ->with(
                    'success',
                    'Gallery berhasil dihapus.'
                );

        } catch (\Exception $e) {

            if ($request->ajax() || $request->wantsJson()) {

                return response()->json([
                    'success' => false,
                    'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
                ], 500);
            }

            return redirect()
                ->route('galleries.index')
                ->with(
                    'error',
                    'Terjadi kesalahan: ' . $e->getMessage()
                );
        }
    }
}