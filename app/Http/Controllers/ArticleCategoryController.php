<?php

namespace App\Http\Controllers;

use App\Services\ArticleCategoryService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ArticleCategoryController extends Controller
{
    protected ArticleCategoryService $articleCategoryService;

    public function __construct(
        ArticleCategoryService $articleCategoryService
    ) {
        $this->articleCategoryService = $articleCategoryService;
    }

    /**
     * Daftar kategori artikel.
     */
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');

        $articleCategories = $this->articleCategoryService
            ->getArticleCategories(
                $keyword,
                10
            );

        return view(
            'example.content.artikel.article_category',
            compact('articleCategories')
        );
    }

    /**
     * Simpan kategori baru.
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => [
                    'required',
                    'string',
                    'max:255',
                ],

                'slug' => [
                    'nullable',
                    'string',
                    'max:255',
                ],

                'description' => [
                    'nullable',
                    'string',
                ],

                'is_active' => [
                    'nullable',
                    'boolean',
                ],
            ]);

            /*
            |--------------------------------------------------------------------------
            | Default status
            |--------------------------------------------------------------------------
            */

            $validated['is_active'] =
                $request->boolean('is_active');

            $articleCategory = $this->articleCategoryService
                ->createArticleCategory($validated);

            /*
            |--------------------------------------------------------------------------
            | AJAX / JSON
            |--------------------------------------------------------------------------
            */

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Kategori artikel berhasil ditambahkan.',
                    'data' => $articleCategory,
                ]);
            }

            return redirect()
                ->route('article-categories.index')
                ->with(
                    'success',
                    'Kategori artikel berhasil ditambahkan.'
                );

        } catch (\Illuminate\Validation\ValidationException $e) {

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
                ->withInput()
                ->with(
                    'error',
                    'Terjadi kesalahan: ' . $e->getMessage()
                );
        }
    }

    /**
     * Ambil data kategori untuk edit.
     */
    public function edit(int $id)
    {
        $articleCategory = $this->articleCategoryService
            ->getArticleCategory($id);

        if (!$articleCategory) {
            return response()->json([
                'success' => false,
                'message' => 'Kategori artikel tidak ditemukan.',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $articleCategory,
        ]);
    }

    /**
     * Update kategori.
     */
    public function update(
        Request $request,
        int $id
    ) {
        try {

            $validated = $request->validate([
                'name' => [
                    'required',
                    'string',
                    'max:255',
                ],

                'slug' => [
                    'nullable',
                    'string',
                    'max:255',
                ],

                'description' => [
                    'nullable',
                    'string',
                ],

                'is_active' => [
                    'nullable',
                    'boolean',
                ],
            ]);

            $validated['is_active'] =
                $request->boolean('is_active');

            $articleCategory = $this->articleCategoryService
                ->updateArticleCategory(
                    $id,
                    $validated
                );

            if (!$articleCategory) {

                if ($request->ajax() || $request->wantsJson()) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Kategori artikel tidak ditemukan.',
                    ], 404);
                }

                return redirect()
                    ->route('article-categories.index')
                    ->with(
                        'error',
                        'Kategori artikel tidak ditemukan.'
                    );
            }

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Kategori artikel berhasil diperbarui.',
                    'data' => $articleCategory,
                ]);
            }

            return redirect()
                ->route('article-categories.index')
                ->with(
                    'success',
                    'Kategori artikel berhasil diperbarui.'
                );

        } catch (\Illuminate\Validation\ValidationException $e) {

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
                ->withInput()
                ->with(
                    'error',
                    'Terjadi kesalahan: ' . $e->getMessage()
                );
        }
    }

    /**
     * Hapus kategori.
     */
    public function destroy(
        Request $request,
        int $id
    ) {
        $deleted = $this->articleCategoryService
            ->deleteArticleCategory($id);

        if (!$deleted) {

            $message = 'Kategori artikel tidak ditemukan atau masih digunakan oleh artikel.';

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => $message,
                ], 422);
            }

            return redirect()
                ->route('article-categories.index')
                ->with(
                    'error',
                    $message
                );
        }

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Kategori artikel berhasil dihapus.',
            ]);
        }

        return redirect()
            ->route('article-categories.index')
            ->with(
                'success',
                'Kategori artikel berhasil dihapus.'
            );
    }
}