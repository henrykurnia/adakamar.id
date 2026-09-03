<?php

namespace App\Http\Controllers;

use App\Services\BannerService;
use Illuminate\Http\Request;
use Throwable;

class BannerController extends Controller
{
    protected BannerService $service;

    public function __construct(BannerService $service)
    {
        $this->service = $service;
    }

    /*
    |--------------------------------------------------------------------------
    | INDEX
    |--------------------------------------------------------------------------
    */

    /**
     * Menampilkan halaman banner.
     */
    public function index()
    {
        $banners = $this->service->getAll();

        return view(
            'example.content.konten.banner',
            compact('banners')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | STORE
    |--------------------------------------------------------------------------
    */

    /**
     * Menyimpan banner baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => [
                'required',
                'string',
                'max:255',
            ],

            'subtitle' => [
                'nullable',
                'string',
                'max:255',
            ],

            'image' => [
                'required',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],
        ]);

        $this->service->create($validated);

        return redirect()
            ->route('banners.index')
            ->with(
                'success',
                'Banner berhasil ditambahkan.'
            );
    }

    /*
    |--------------------------------------------------------------------------
    | EDIT
    |--------------------------------------------------------------------------
    */

    /**
     * Mengambil data banner untuk modal edit.
     */
    public function edit(int $id)
    {
        try {
            $banner = $this->service->findById($id);

            return response()->json([
                'success' => true,

                'data' => [
                    'id' => $banner->id,
                    'title' => $banner->title,
                    'subtitle' => $banner->subtitle,
                    'image' => $banner->image,
                ],
            ], 200);
        } catch (Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => 'Banner tidak ditemukan.',
            ], 404);
        }
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE
    |--------------------------------------------------------------------------
    */

    /**
     * Mengupdate banner.
     */
    public function update(Request $request, int $id)
    {
        $validated = $request->validate([
            'title' => [
                'required',
                'string',
                'max:255',
            ],

            'subtitle' => [
                'nullable',
                'string',
                'max:255',
            ],

            'image' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],
        ]);

        $this->service->update(
            $id,
            $validated
        );

        return redirect()
            ->route('banners.index')
            ->with(
                'success',
                'Banner berhasil diperbarui.'
            );
    }

    /*
    |--------------------------------------------------------------------------
    | DESTROY
    |--------------------------------------------------------------------------
    */

    /**
     * Menghapus banner.
     */
    public function destroy(int $id)
    {
        $this->service->delete($id);

        return redirect()
            ->route('banners.index')
            ->with(
                'success',
                'Banner berhasil dihapus.'
            );
    }
}
