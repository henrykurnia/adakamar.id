<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\RuleService;

class RuleController extends Controller
{
    protected $service;

    public function __construct(
        RuleService $service
    ) {
        $this->service = $service;
    }

    public function index()
    {
        $rules = $this->service->getAll();

        return view(
            'example.content.crud.aturan.index',
            compact('rules')
        );
    }

    public function create()
    {
        return view(
            'example.content.crud.aturan.create'
        );
    }

    public function store(Request $request)
    {
        $data = $request->except('_token');

        $this->service->create($data);

        return redirect()
            ->route('aturan.index')
            ->with('success', 'Aturan berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $data = $this->service->getById($id);

        return view(
            'example.content.crud.aturan.edit',
            compact('data')
        );
    }

    public function update(Request $request, $id)
    {
        $data = $request->except([
            '_token',
            '_method'
        ]);

        $this->service->update($id, $data);

        return redirect()
            ->route('aturan.index')
            ->with('success', 'Aturan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $this->service->delete($id);

        return redirect()
            ->route('aturan.index')
            ->with('success', 'Aturan berhasil dihapus.');
    }
}