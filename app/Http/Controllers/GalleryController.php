<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\GalleryService;

class GalleryController extends Controller
{
    protected $service;

    public function __construct(
        GalleryService $service
    ) {
        $this->service = $service;
    }

    public function index()
    {
        $data = $this->service->getAll();

        return view(
            'example.content.crud.akomodasi.index',
            compact('data')
        );
    }

    public function create()
    {
        return view(
            'example.content.crud.akomodasi.create'
        );
    }

    public function store(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        'sort_order' => 'nullable|integer',
        'is_active' => 'nullable|boolean',
    ]);

    $data = $request->except('_token', 'image');

    $this->service->create(
        $data,
        $request->file('image')
    );

    return redirect()
        ->route('gallery.index')
        ->with('success', 'Galeri berhasil ditambahkan.');
}

    public function show($id)
{
    $data = $this->service->getById($id);

    return view(
        'example.content.crud.akomodasi.detail',
        compact('data')
    );
}

    public function edit($id)
    {
        $data = $this->service->getById($id);

        return view(
            'example.content.crud.akomodasi.edit',
            compact('data')
        );
    }

    public function update(Request $request, $id)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        'sort_order' => 'nullable|integer',
        'is_active' => 'nullable|boolean',
    ]);

    $data = $request->except([
        '_token',
        '_method',
        'image'
    ]);

    $this->service->update(
        $id,
        $data,
        $request->file('image')
    );

    return redirect()
        ->route('gallery.index')
        ->with('success', 'Galeri berhasil diperbarui.');
}

    public function destroy($id)
    {
        $this->service->delete($id);

        return redirect()
            ->route('gallery.index')
            ->with('success', 'Galeri berhasil dihapus.');
    }
}