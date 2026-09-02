<?php

namespace App\Http\Controllers;

use App\Models\Accommodation;
use App\Models\AccommodationCategory;
use App\Models\Facility;
use App\Models\Rule;
use App\Services\AccommodationService;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class AccommodationController extends Controller
{
    protected AccommodationService $accommodationService;

    public function __construct(
        AccommodationService $accommodationService
    ) {
        $this->accommodationService = $accommodationService;
    }

    /**
     * Daftar penginapan.
     */
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');

        $accommodations = $this->accommodationService
            ->getAccommodations($keyword, 10);

        $categories = AccommodationCategory::orderBy('name')->get();

        $facilities = Facility::orderBy('name')->get();

        $rules = Rule::orderBy('name')->get();

        return view(
            'example.content.accomodation.penginapan',
            compact(
                'accommodations',
                'categories',
                'facilities',
                'rules'
            )
        );
    }

    /**
     * Simpan penginapan baru.
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate(
                $this->storeRules()
            );

            $accommodation = $this->accommodationService
                ->createAccommodation($validated);

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Penginapan berhasil ditambahkan.',
                    'data' => $accommodation,
                ]);
            }

            return redirect()
                ->route('accommodations.index')
                ->with(
                    'success',
                    'Penginapan berhasil ditambahkan.'
                );

        } catch (ValidationException $e) {
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
                ->withInput()
                ->with(
                    'error',
                    'Terjadi kesalahan: ' . $e->getMessage()
                );
        }
    }

    /**
     * Detail penginapan.
     */
    public function show(int $id)
    {
        $accommodation = $this->accommodationService
            ->getAccommodation($id);

        if (!$accommodation) {
            return response()->json([
                'success' => false,
                'message' => 'Penginapan tidak ditemukan.',
            ], 404);
        }

        $accommodation->load([
            'category',
            'images',
            'facilities',
            'rules',
        ]);

        $data = $accommodation->toArray();

        /**
         * ID fasilitas.
         */
        $data['facility_ids'] = $accommodation
            ->facilities
            ->pluck('id')
            ->toArray();

        /**
         * ID aturan.
         */
        $data['rule_ids'] = $accommodation
            ->rules
            ->pluck('id')
            ->toArray();

        /**
         * Format gambar.
         */
        $data['images'] = $accommodation->images
            ->map(function ($item) {
                return [
                    'id' => $item->id,
                    'image' => $item->image,
                    'sort_order' => $item->sort_order,
                    'image_url' => $item->image
                        ? asset($item->image)
                        : null,
                ];
            })
            ->values();

        return response()->json([
            'success' => true,
            'data' => $data,
        ]);
    }

    /**
     * Update penginapan.
     */
    public function update(Request $request, int $id)
    {
        try {
            $validated = $request->validate(
                $this->updateRules()
            );

            $accommodation = $this->accommodationService
                ->updateAccommodation($id, $validated);

            if (!$accommodation) {
                if ($request->ajax() || $request->wantsJson()) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Penginapan tidak ditemukan.',
                    ], 404);
                }

                return redirect()
                    ->route('accommodations.index')
                    ->with(
                        'error',
                        'Penginapan tidak ditemukan.'
                    );
            }

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Penginapan berhasil diperbarui.',
                    'data' => $accommodation,
                ]);
            }

            return redirect()
                ->route('accommodations.index')
                ->with(
                    'success',
                    'Penginapan berhasil diperbarui.'
                );

        } catch (ValidationException $e) {
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
                ->withInput()
                ->with(
                    'error',
                    'Terjadi kesalahan: ' . $e->getMessage()
                );
        }
    }

    /**
     * Hapus penginapan.
     */
    public function destroy(int $id)
    {
        $deleted = $this->accommodationService
            ->deleteAccommodation($id);

        if (!$deleted) {
            return redirect()
                ->route('accommodations.index')
                ->with(
                    'error',
                    'Penginapan tidak ditemukan.'
                );
        }

        return redirect()
            ->route('accommodations.index')
            ->with(
                'success',
                'Penginapan berhasil dihapus.'
            );
    }

    /**
     * Validation rules untuk store.
     */
    protected function storeRules(): array
    {
        return [
            'category_id' => [
                'required',
                'exists:accommodation_categories,id',
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
                'required',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:5120',
            ],

            'price' => [
                'required',
                'numeric',
                'min:0',
            ],

            'address' => [
                'required',
                'string',
                'max:500',
            ],

            'capacity' => [
                'required',
                'integer',
                'min:1',
            ],

            'bedroom' => [
                'required',
                'integer',
                'min:0',
            ],

            'bathroom' => [
                'required',
                'integer',
                'min:0',
            ],

            'size' => [
                'nullable',
                'string',
                'max:255',
            ],

            'status' => [
                'required',
                'in:Available,Full,Maintenance',
            ],

            'description' => [
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

            'facility_ids' => [
                'nullable',
                'array',
            ],

            'facility_ids.*' => [
                'exists:facilities,id',
            ],

            'rule_ids' => [
                'nullable',
                'array',
            ],

            'rule_ids.*' => [
                'exists:rules,id',
            ],

            'gallery' => [
                'required',
                'array',
                'min:2',
                'max:10',
            ],

            'gallery.*' => [
                'image',
                'mimes:jpg,jpeg,png,gif,webp',
                'max:5120',
            ],
        ];
    }

    /**
     * Validation rules untuk update.
     */
    protected function updateRules(): array
    {
        return [
            'category_id' => [
                'required',
                'exists:accommodation_categories,id',
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

            'price' => [
                'required',
                'numeric',
                'min:0',
            ],

            'address' => [
                'required',
                'string',
                'max:500',
            ],

            'capacity' => [
                'required',
                'integer',
                'min:1',
            ],

            'bedroom' => [
                'required',
                'integer',
                'min:0',
            ],

            'bathroom' => [
                'required',
                'integer',
                'min:0',
            ],

            'size' => [
                'nullable',
                'string',
                'max:255',
            ],

            'status' => [
                'required',
                'in:Available,Full,Maintenance',
            ],

            'description' => [
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

            'facility_ids' => [
                'nullable',
                'array',
            ],

            'facility_ids.*' => [
                'exists:facilities,id',
            ],

            'rule_ids' => [
                'nullable',
                'array',
            ],

            'rule_ids.*' => [
                'exists:rules,id',
            ],

            'gallery' => [
                'nullable',
                'array',
                'max:10',
            ],

            'gallery.*' => [
                'image',
                'mimes:jpg,jpeg,png,gif,webp',
                'max:5120',
            ],
        ];
    }
}
