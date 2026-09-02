<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use App\Services\FacilityService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FacilityController extends Controller
{
    protected FacilityService $service;

    public function __construct(FacilityService $service)
    {
        $this->service = $service;
    }

    /**
     * Menampilkan daftar fasilitas.
     */
    public function index(Request $request): View
    {
        $keyword = $request->input('keyword');

        $facilities = $this->service->getAll(
            $keyword,
            10
        );

        return view(
            'example.content.accomodation.fasilitas',
            compact('facilities', 'keyword')
        );
    }

    /**
     * Simpan fasilitas baru.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                'unique:facilities,name',
            ],
            'description' => [
                'nullable',
                'string',
            ],
            'is_active' => [
                'nullable',
                'boolean',
            ],
        ], [
            'name.required' => 'Nama fasilitas wajib diisi.',
            'name.unique' => 'Nama fasilitas sudah digunakan.',
            'name.max' => 'Nama fasilitas maksimal 255 karakter.',
        ]);

        $this->service->create($validated);

        return redirect()
            ->route('facilities.index')
            ->with('success', 'Fasilitas berhasil ditambahkan.');
    }

    /**
     * Mengambil data fasilitas untuk modal edit.
     */
    public function edit(Facility $facility): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => $facility,
        ]);
    }

    /**
     * Update fasilitas.
     */
    public function update(
        Request $request,
        Facility $facility
    ): RedirectResponse {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                'unique:facilities,name,' . $facility->id,
            ],
            'description' => [
                'nullable',
                'string',
            ],
            'is_active' => [
                'nullable',
                'boolean',
            ],
        ], [
            'name.required' => 'Nama fasilitas wajib diisi.',
            'name.unique' => 'Nama fasilitas sudah digunakan.',
            'name.max' => 'Nama fasilitas maksimal 255 karakter.',
        ]);

        $this->service->update($facility, $validated);

        return redirect()
            ->route('facilities.index')
            ->with('success', 'Fasilitas berhasil diperbarui.');
    }

    /**
     * Hapus fasilitas.
     */
    public function destroy(Facility $facility): RedirectResponse
    {
        $this->service->delete($facility);

        return redirect()
            ->route('facilities.index')
            ->with('success', 'Fasilitas berhasil dihapus.');
    }
}