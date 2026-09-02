<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ArticleCategoryService;

class ArticleCategoryController extends Controller
{
    protected $service;

    public function __construct(
        ArticleCategoryService $service
    ) {
        $this->service = $service;
    }

    public function index()
    {
        $kategoris = $this->service->getAll();

        return view(
            'example.content.crud.kategoriartikel.index',
            compact('kategoris')
        );
    }

    public function create()
    {
        return view(
            'example.content.crud.kategoriartikel.create'
        );
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|string|max:255|unique:accommodation_categories,name',
                'slug' => 'required|string|max:255|unique:accommodation_categories,slug',
                'description' => 'nullable|string',
                'is_active' => 'required|boolean',
            ],
            [
                'name.required' => 'Nama kategori wajib diisi.',
                'name.unique' => 'Nama kategori sudah digunakan.',
                'slug.required' => 'Slug kategori wajib diisi.',
                'slug.unique' => 'Slug kategori sudah digunakan.',
                'description.string' => 'Deskripsi harus berupa teks.',
                'is_active.required' => 'Status kategori wajib dipilih.',
                'is_active.boolean' => 'Status kategori tidak valid.',
            ]
        );
        $data = $request->except('_token');

        $this->service->create($data);

        return redirect()
            ->route('artikel_kategori.index')
            ->with('success', 'Kategori artikel berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $artikel_kategori = $this->service->getById($id);

        return view(
            'example.content.crud.kategoriartikel.edit',
            compact('artikel_kategori')
        );
    }

    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'name' => 'required|string|max:255|unique:accommodation_categories,name',
                'slug' => 'required|string|max:255|unique:accommodation_categories,slug',
                'description' => 'nullable|string',
                'is_active' => 'required|boolean',
            ],
            [
                'name.required' => 'Nama kategori wajib diisi.',
                'name.unique' => 'Nama kategori sudah digunakan.',
                'slug.required' => 'Slug kategori wajib diisi.',
                'slug.unique' => 'Slug kategori sudah digunakan.',
                'description.string' => 'Deskripsi harus berupa teks.',
                'is_active.required' => 'Status kategori wajib dipilih.',
                'is_active.boolean' => 'Status kategori tidak valid.',
            ]
        );

        $artikel_kategori = $request->except([
            '_token',
            '_method'
        ]);

        $this->service->update($id, $artikel_kategori);

        return redirect()
            ->route('artikel_kategori.index')
            ->with('success', 'Kategori artikel berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $this->service->delete($id);

        return redirect()
            ->route('artikel_kategori.index')
            ->with('success', 'Kategori artikel berhasil dihapus.');
    }
}