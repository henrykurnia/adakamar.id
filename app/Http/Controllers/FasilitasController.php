<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\FasilitasService;

class FasilitasController extends Controller
{
    protected $service;

    public function __construct(
        FasilitasService $service
    ) {
        $this->service = $service;
    }

    public function index()
    {
        $data = $this->service->getAll();
        


        return view(
            'example.content.crud.fasilitas.index',
            compact('data', )
        );
    }

    public function create()
    {
        return view(
            'example.content.crud.fasilitas.create'
        );
    }

    public function store(Request $request)
    {
        $data = $request->except('_token');

        $this->service->create($data);

        return redirect()
            ->route('fasilitas.index')
            ->with('success', 'Fasilitas berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $fasilitas = $this->service->getById($id);

        return view(
            'example.content.crud.fasilitas.edit',
            compact('fasilitas')
        );
    }

    public function update(Request $request, $id)
    {
        $fasilitas = $request->except([
            '_token',
            '_method'
        ]);

        $this->service->update($id, $fasilitas);

        return redirect()
            ->route('fasilitas.index')
            ->with('success', 'Fasilitas berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $this->service->delete($id);

        return redirect()
            ->route('fasilitas.index')
            ->with('success', 'Fasilitas berhasil dihapus.');
    }
}