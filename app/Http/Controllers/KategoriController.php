<?php

namespace App\Http\Controllers;

use App\Services\KategoriService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
class KategoriController extends Controller
{
    protected $kategoriService;

    public function __construct(
        KategoriService $kategoriService
    ) {
        $this->kategoriService = $kategoriService;
    }

    /**
     * Menampilkan semua kategori
     */
    public function index()
    {
        $kategoris = $this->kategoriService->getAll();

        return view(
            'example.content.crud.kategori.index',
            compact('kategoris')
        );
    }

    /**
     * Form tambah kategori
     */
    public function create()
    {
        return view(
            'example.content.crud.kategori.create'
        );
    }

    /**
     * Simpan kategori
     */
    public function store(Request $request)
    {
         $validated = $request->validate([
            'name' => 'required|string|max:255|unique:accommodation_categories,name',
            'description' => 'nullable|string',
            
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // Slug otomatis dari nama
    $validated['slug'] = Str::slug($validated['name']);

    if ($request->hasFile('image')) {

        $imageName = time() . '_' . $request->image->getClientOriginalName();

        $request->image->move(
            public_path('categories'),
            $imageName
        );

        $validated['image'] = 'categories/' . $imageName;
    }

        $this->kategoriService->create($validated);

        return redirect()
            ->route('kategori.index')
            ->with(
                'success',
                'Kategori berhasil ditambahkan.'
            );
    }

    /**
     * Detail kategori
     */
    public function show($id)
    {
        $kategori = $this->kategoriService->getById($id);

        return view(
            'example.content.crud.kategori.show',
            compact('kategori')
        );
    }

    /**
     * Form edit kategori
     */
    public function edit($id)
    {
        $kategori = $this->kategoriService->getById($id);

        return view(
            'example.content.crud.kategori.edit',
            compact('kategori')
        );
    }

    /**
     * Update kategori
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:accommodation_categories,name,' . $id,
            'description' => 'nullable|string',
           
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // Slug otomatis dari nama
        $validated['slug'] = Str::slug($validated['name']);

        if ($request->hasFile('image')) {

        $imageName = time() . '_' . $request->image->getClientOriginalName();

        $request->image->move(
            public_path('categories'),
            $imageName
        );

        $validated['image'] = 'categories/' . $imageName;
    }
    
        $this->kategoriService->update(
            $id,
            $validated
        );

        return redirect()
            ->route('kategori.index')
            ->with(
                'success',
                'Kategori berhasil diperbarui.'
            );
    }

    /**
     * Hapus kategori
     */
    public function destroy($id)
    {
        $this->kategoriService->delete($id);

        return redirect()
            ->route('kategori.index')
            ->with(
                'success',
                'Kategori berhasil dihapus.'
            );
    }
}