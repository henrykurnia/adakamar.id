<?php

namespace App\Http\Controllers;

use App\Models\accommodations;
use Illuminate\Http\Request;
use App\Services\GaleriesService;

class GaleriesController extends Controller
{
    protected $service;

    public function __construct(GaleriesService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $galeries = $this->service->getLandingGaleries();

        return view(
            'example.content.crud.galeries.index',
            compact('galeries')
        );
    }

    public function create()
    {
        $akomodasis = accommodations::all();

        return view(
            'example.content.crud.galeries.create',
            compact('akomodasis')
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


    $data = $request->except([
        '_token',
        'image'
    ]);

    $this->service->create(
        $data,
        $request->file('image')
    );

    return redirect()
        ->route('galeries.index')
        ->with(
            'success',
            'Galeri landing page berhasil ditambahkan.'
        );

    }


    public function edit($id)
    {
        $galeries = $this->service->getLandingGaleriesById($id);

        return view(
            'example.content.crud.galeries.edit',
            compact('galeries')
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
        ->route('galeries.index')
        ->with(
            'success',
            'Galeri landing page berhasil diperbarui.'
        );


    }


    public function destroy($id)
    {
        $this->service->delete($id);

        return redirect()
            ->route('galeries.index')
            ->with(
                'success',
                'Galeri landing page berhasil dihapus.'
            );
    }

}
