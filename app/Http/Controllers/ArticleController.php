<?php

namespace App\Http\Controllers;

use App\Models\ArticleCategory;
use App\Services\ArticleService;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    protected ArticleService $articleService;

    public function __construct(
        ArticleService $articleService
    ) {
        $this->articleService = $articleService;
    }

    /**
     * Daftar artikel.
     */
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');

        $articles = $this->articleService
            ->getArticles($keyword, 10);

        $categories = ArticleCategory::orderBy('name')
            ->get();

        return view(
            'example.content.artikel.article',
            compact(
                'articles',
                'categories'
            )
        );
    }

    /**
     * Simpan artikel baru.
     */
    public function store(Request $request)
    {
        try {

            $validated = $request->validate([
                'category_id' => [
                    'required',
                    'exists:article_categories,id',
                ],

                'title' => [
                    'required',
                    'string',
                    'max:255',
                ],

                'slug' => [
                    'nullable',
                    'string',
                    'max:255',
                ],

                'thumbnail' => [
                    'nullable',
                    'image',
                    'mimes:jpg,jpeg,png,webp',
                    'max:5120',
                ],

                'excerpt' => [
                    'nullable',
                    'string',
                ],

                'content' => [
                    'required',
                    'string',
                ],

                'meta_title' => [
                    'nullable',
                    'string',
                    'max:255',
                ],

                'meta_description' => [
                    'nullable',
                    'string',
                ],

                'meta_keywords' => [
                    'nullable',
                    'string',
                ],

                'status' => [
                    'required',
                    'in:Draft,Published',
                ],

                'published_at' => [
                    'nullable',
                    'date',
                ],
            ]);

            /*
            |--------------------------------------------------------------------------
            | User login sebagai penulis
            |--------------------------------------------------------------------------
            */

            $validated['user_id'] = auth()->id();

            $article = $this->articleService
                ->createArticle($validated);

            if ($request->ajax() || $request->wantsJson()) {

                return response()->json([
                    'success' => true,
                    'message' => 'Artikel berhasil ditambahkan.',
                    'data' => $article,
                ]);
            }

            return redirect()
                ->route('articles.index')
                ->with(
                    'success',
                    'Artikel berhasil ditambahkan.'
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
                ->with(
                    'error',
                    'Terjadi kesalahan: ' . $e->getMessage()
                );
        }
    }

    /**
     * Detail artikel.
     */
    public function show(int $id)
    {
        $article = $this->articleService
            ->getArticle($id);

        if (!$article) {
            return response()->json([
                'success' => false,
                'message' => 'Artikel tidak ditemukan.',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $article,
        ]);
    }

    /**
     * Form edit artikel.
     *
     * Karena edit menggunakan modal,
     * data dikembalikan dalam bentuk JSON.
     */
    public function edit(int $id)
    {
        $article = $this->articleService
            ->getArticle($id);

        if (!$article) {
            return response()->json([
                'success' => false,
                'message' => 'Artikel tidak ditemukan.',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $article,
        ]);
    }

    /**
     * Update artikel.
     */
    public function update(
        Request $request,
        int $id
    ) {
        try {

            $validated = $request->validate([
                'category_id' => [
                    'required',
                    'exists:article_categories,id',
                ],

                'title' => [
                    'required',
                    'string',
                    'max:255',
                ],

                'slug' => [
                    'nullable',
                    'string',
                    'max:255',
                ],

                'thumbnail' => [
                    'nullable',
                    'image',
                    'mimes:jpg,jpeg,png,webp',
                    'max:5120',
                ],

                'excerpt' => [
                    'nullable',
                    'string',
                ],

                'content' => [
                    'required',
                    'string',
                ],

                'meta_title' => [
                    'nullable',
                    'string',
                    'max:255',
                ],

                'meta_description' => [
                    'nullable',
                    'string',
                ],

                'meta_keywords' => [
                    'nullable',
                    'string',
                ],

                'status' => [
                    'required',
                    'in:Draft,Published',
                ],

                'published_at' => [
                    'nullable',
                    'date',
                ],
            ]);

            $article = $this->articleService
                ->updateArticle(
                    $id,
                    $validated
                );

            if (!$article) {

                if ($request->ajax() || $request->wantsJson()) {

                    return response()->json([
                        'success' => false,
                        'message' => 'Artikel tidak ditemukan.',
                    ], 404);
                }

                return redirect()
                    ->route('articles.index')
                    ->with(
                        'error',
                        'Artikel tidak ditemukan.'
                    );
            }

            if ($request->ajax() || $request->wantsJson()) {

                return response()->json([
                    'success' => true,
                    'message' => 'Artikel berhasil diperbarui.',
                    'data' => $article,
                ]);
            }

            return redirect()
                ->route('articles.index')
                ->with(
                    'success',
                    'Artikel berhasil diperbarui.'
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
                ->with(
                    'error',
                    'Terjadi kesalahan: ' . $e->getMessage()
                );
        }
    }

    /**
     * Hapus artikel.
     */
    public function destroy(
        Request $request,
        int $id
    ) {
        $deleted = $this->articleService
            ->deleteArticle($id);

        if (!$deleted) {

            if ($request->ajax() || $request->wantsJson()) {

                return response()->json([
                    'success' => false,
                    'message' => 'Artikel tidak ditemukan.',
                ], 404);
            }

            return redirect()
                ->route('articles.index')
                ->with(
                    'error',
                    'Artikel tidak ditemukan.'
                );
        }

        if ($request->ajax() || $request->wantsJson()) {

            return response()->json([
                'success' => true,
                'message' => 'Artikel berhasil dihapus.',
            ]);
        }

        return redirect()
            ->route('articles.index')
            ->with(
                'success',
                'Artikel berhasil dihapus.'
            );
    }
}
