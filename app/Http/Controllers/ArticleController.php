<?php

namespace App\Http\Controllers;

use App\Models\article_categories;
use Illuminate\Http\Request;
use App\Services\ArticleService;

class ArticleController extends Controller
{
    protected $service;

    public function __construct(
        ArticleService $service
    ) {
        $this->service = $service;
    }

    public function index()
    {
        $artikel = $this->service->getAll();

        return view(
            'example.content.crud.artikel.index',
            compact('artikel')
        );
    }

    public function create()
    {
        $kategoris = article_categories::all();

        return view(
            'example.content.crud.artikel.create',
            compact('kategoris')
        );
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'title' => 'required|string|max:255',
                'category_id' => 'required|exists:article_categories,id',
                'slug' => 'required|string|max:255|unique:articles,slug',
                'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
                'content' => 'required',
            ],
            [
                'title.required' => 'Judul artikel wajib diisi.',
                'category_id.required' => 'Kategori artikel wajib dipilih.',
                'category_id.exists' => 'Kategori yang dipilih tidak valid.',
                'slug.required' => 'Slug artikel wajib diisi.',
                'slug.unique' => 'Slug artikel sudah digunakan. Silakan gunakan slug lain.',
                'thumbnail.image' => 'Thumbnail harus berupa gambar.',
                'thumbnail.mimes' => 'Format thumbnail harus jpg, jpeg, png, atau webp.',
                'thumbnail.max' => 'Ukuran thumbnail maksimal 2 MB.',
                'content.required' => 'Isi artikel wajib diisi.',
            ]
        );

        // Ambil semua data dari form KECUALI thumbnail
        $data = $request->except([
            '_token',
            'thumbnail'
        ]);

        // Proses thumbnail
        if ($request->hasFile('thumbnail')) {

            $imageName = time() . '.' .
                $request->file('thumbnail')->extension();

            $request->file('thumbnail')->move(
                public_path('storage/articles'),
                $imageName
            );

            // Simpan PATH thumbnail, bukan temporary file
            $data['thumbnail'] = 'storage/articles/' . $imageName;
        }

        $this->service->create($data);

        return redirect()
            ->route('artikel.index')
            ->with('success', 'Artikel berhasil ditambahkan.');
    }
    public function edit($id)
    {
        $artikel = $this->service->getById($id);

       

        $kategoris = article_categories::all();

        return view(
            'example.content.crud.artikel.edit',
            compact('artikel', 'kategoris')
        );
    }

    public function update(Request $request, $id)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'category_id' => 'required|exists:article_categories,id',
        'slug' => 'required|string|max:255|unique:articles,slug,' . $id,
        'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        'excerpt' => 'nullable|string',
        'content' => 'required',
        'meta_title' => 'nullable|string',
        'meta_description' => 'nullable|string',
        'meta_keywords' => 'nullable|string',
        'status' => 'required|in:Draft,Published',
        'published_at' => 'nullable|date',
    ]);

    /*
    |--------------------------------------------------------------------------
    | Ambil data selain thumbnail
    |--------------------------------------------------------------------------
    */
    $data = $request->except([
        '_token',
        '_method',
        'thumbnail'
    ]);

    /*
    |--------------------------------------------------------------------------
    | Jika upload thumbnail baru
    |--------------------------------------------------------------------------
    */
    if ($request->hasFile('thumbnail')) {

        $imageName = time() . '.' .
            $request->file('thumbnail')->extension();

        $request->file('thumbnail')->move(
            public_path('storage/articles'),
            $imageName
        );

        $data['thumbnail'] = 'storage/articles/' . $imageName;
    }

    /*
    |--------------------------------------------------------------------------
    | Update artikel
    |--------------------------------------------------------------------------
    */
    $this->service->update($id, $data);

    return redirect()
        ->route('artikel.index')
        ->with('success', 'Artikel berhasil diperbarui.');
}

    public function destroy($id)
    {
        $this->service->delete($id);

        return redirect()
            ->route('artikel.index')
            ->with('success', 'Artikel berhasil dihapus.');
    }
}