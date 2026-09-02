<?php

namespace App\Http\Controllers;

use App\Models\facilities;
use App\Services\AkomodasiService;
use App\Models\accommodation_categories;
use App\Models\rules;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class AkomodasiController extends Controller
{
    protected $akomodasiService;

    public function __construct(AkomodasiService $akomodasiService)
    {
        $this->akomodasiService = $akomodasiService;
    }

    /**
     * Menampilkan semua akomodasi
     */
    public function index()
    {
        $akomodasi = $this->akomodasiService->getAll();
        
        return view(
            'example.content.crud.akomodasi.index',
            compact('akomodasi')
        );
    }

    /**
     * Menampilkan form tambah akomodasi
     */
    public function create()
    {
        $kategoris = accommodation_categories::all();
        $rules = Rules::all();
        $fasilitas = facilities::where('is_active', 1)->get();
        return view(
            'example.content.crud.akomodasi.create',
            compact('kategoris', 'rules', 'fasilitas')
        );
    }

    /**
     * Menyimpan akomodasi baru
     */
    public function store(Request $request)
{
    $validated = $request->validate([
        'category_id' => 'required|exists:accommodation_categories,id',

        'title' => 'required|string|max:255',

        'slug' => 'required|string|max:255|unique:accommodations,slug',

        'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

        'price' => 'bail|required|regex:/^[0-9]+$/|digits_between:6,15',

        'address' => 'required|string',

        'link_gmaps' => 'nullable|url|max:500',

        'capacity' => 'required|integer',

        'bedroom' => 'required|integer',

        'bathroom' => 'required|integer',

        'size' => 'nullable|numeric',

        'status' => 'required',

        'description' => 'nullable|string',

        'meta_title' => 'nullable|string|max:255',

        'meta_description' => 'nullable|string',

        // RULES
        'rules' => 'nullable|array',
        'rules.*' => 'exists:rules,id',

        // FASILITAS
        'facilities' => 'nullable|array',
        'facilities.*' => 'exists:facilities,id',

        // GALLERY
        'gallery' => 'nullable|array',
        'gallery.*' => 'image|mimes:jpg,jpeg,png,webp|max:2048',
    ]);

    /*
    |--------------------------------------------------------------------------
    | Simpan checklist terlebih dahulu
    |--------------------------------------------------------------------------
    */

    $selectedRules = $validated['rules'] ?? [];

    $selectedFacilities = $validated['facilities'] ?? [];

    /*
    |--------------------------------------------------------------------------
    | Jangan ikut dikirim ke accommodations
    |--------------------------------------------------------------------------
    */

    unset(
        $validated['rules'],
        $validated['facilities'],
        $validated['gallery']
    );

    /*
    |--------------------------------------------------------------------------
    | Upload Thumbnail
    |--------------------------------------------------------------------------
    */

    if ($request->hasFile('thumbnail')) {

        $imageName = time() . '.' .
            $request->thumbnail->extension();

        $request->thumbnail->move(
            public_path('accommodations'),
            $imageName
        );

        $validated['thumbnail'] =
            'accommodations/' . $imageName;
    }

    /*
    |--------------------------------------------------------------------------
    | Simpan Akomodasi
    |--------------------------------------------------------------------------
    */

    $akomodasi = $this->akomodasiService->create($validated);

    /*
    |--------------------------------------------------------------------------
    | Simpan Rules
    |--------------------------------------------------------------------------
    */

    DB::table('accommodation_rules')->insert(
        collect($selectedRules)->map(function ($ruleId) use ($akomodasi) {
            return [
                'accommodation_id' => $akomodasi->id,
                'rule_id' => $ruleId,
            ];
        })->toArray()
    );

    /*
    |--------------------------------------------------------------------------
    | Simpan Fasilitas
    |--------------------------------------------------------------------------
    */

    DB::table('accommodation_facilities')->insert(
        collect($selectedFacilities)->map(function ($facilityId) use ($akomodasi) {
            return [
                'accommodation_id' => $akomodasi->id,
                'facility_id' => $facilityId,
            ];
        })->toArray()
    );

    /*
    |--------------------------------------------------------------------------
    | Simpan Gallery
    |--------------------------------------------------------------------------
    */

    if ($request->hasFile('gallery')) {

        foreach ($request->file('gallery') as $index => $file) {

            $imageName = time() . '_' . $index . '.' .
                $file->extension();

            $file->move(
                public_path('accommodations/gallery'),
                $imageName
            );

            \App\Models\AccommodationImage::create([
                'accommodation_id' => $akomodasi->id,
                'image' => 'accommodations/gallery/' . $imageName,
                'sort_order' => $index,
            ]);
        }
    }

    return redirect()
        ->route('akomodasi.index')
        ->with(
            'success',
            'Akomodasi berhasil ditambahkan.'
        );
}

    /**
     * Menampilkan detail akomodasi
     */
    public function show($id)
    {
        $akomodasi = $this->akomodasiService->getById($id);

        return view(
            'example.content.crud.akomodasi.detail',
            compact('akomodasi')
        );
    }

    /**
     * Menampilkan form edit
     */
    public function edit($id)
    {
        $akomodasi = $this->akomodasiService->getById($id);

        $kategoris = accommodation_categories::all();

        $rules = rules::where('is_active', 1)->get();

        $fasilitas = facilities::where('is_active', 1)->get();

        // Ambil aturan yang sudah dipilih
        $selectedRules = \DB::table('accommodation_rules')
            ->where('accommodation_id', $id)
            ->pluck('rule_id')
            ->toArray();

        // Ambil fasilitas yang sudah dipilih
        $selectedFacilities = \DB::table('accommodation_facilities')
            ->where('accommodation_id', $id)
            ->pluck('facility_id')
            ->toArray();

        return view(
            'example.content.crud.akomodasi.edit',
            compact(
                'akomodasi',
                'kategoris',
                'rules',
                'fasilitas',
                'selectedRules',
                'selectedFacilities'
            )
        );
    }

    /**
     * Update akomodasi
     */
    public function update(Request $request, $id)
{
    $validated = $request->validate([
        'category_id' =>
            'required|exists:accommodation_categories,id',

        'title' =>
            'required|string|max:255',

        'slug' =>
            'required|string|max:255|unique:accommodations,slug,' . $id,

        'thumbnail' =>
            'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

        'price' =>
            'bail|required|regex:/^[0-9]+$/|digits_between:6,15',

        'address' =>
            'required|string',

        'link_gmaps' => 'nullable|url|max:500',

        'capacity' =>
            'required|integer',

        'bedroom' =>
            'required|integer',

        'bathroom' =>
            'required|integer',

        'size' =>
            'nullable|numeric',

        'status' =>
            'required',

        'description' =>
            'nullable|string',

        'meta_title' =>
            'nullable|string|max:255',

        'meta_description' =>
            'nullable|string',

        // RULES
        'rules' =>
            'nullable|array',

        'rules.*' =>
            'exists:rules,id',

        // FASILITAS
        'facilities' =>
            'nullable|array',

        'facilities.*' =>
            'exists:facilities,id',

        // GALLERY
        'gallery' =>
            'nullable|array',

        'gallery.*' =>
            'image|mimes:jpg,jpeg,png,webp|max:2048',
    ]);

    /*
    |--------------------------------------------------------------------------
    | Ambil checklist
    |--------------------------------------------------------------------------
    */

    $selectedRules = $validated['rules'] ?? [];

    $selectedFacilities = $validated['facilities'] ?? [];

    /*
    |--------------------------------------------------------------------------
    | Jangan kirim checklist/gallery ke tabel accommodations
    |--------------------------------------------------------------------------
    */

    unset(
        $validated['rules'],
        $validated['facilities'],
        $validated['gallery']
    );

    /*
    |--------------------------------------------------------------------------
    | Upload Thumbnail Baru
    |--------------------------------------------------------------------------
    */

    if ($request->hasFile('thumbnail')) {

        $imageName = time() . '.' .
            $request->thumbnail->extension();

        $request->thumbnail->move(
            public_path('accommodations'),
            $imageName
        );

        $validated['thumbnail'] =
            'accommodations/' . $imageName;
    }

    /*
    |--------------------------------------------------------------------------
    | Update Akomodasi
    |--------------------------------------------------------------------------
    */

    $this->akomodasiService->update(
        $id,
        $validated
    );

    /*
    |--------------------------------------------------------------------------
    | Update Rules
    |--------------------------------------------------------------------------
    */

    DB::table('accommodation_rules')
        ->where('accommodation_id', $id)
        ->delete();

    if (!empty($selectedRules)) {

        $rulesData = [];

        foreach ($selectedRules as $ruleId) {

            $rulesData[] = [
                'accommodation_id' => $id,
                'rule_id' => $ruleId,
            ];
        }

        DB::table('accommodation_rules')
            ->insert($rulesData);
    }

    /*
    |--------------------------------------------------------------------------
    | Update Fasilitas
    |--------------------------------------------------------------------------
    */

    DB::table('accommodation_facilities')
        ->where('accommodation_id', $id)
        ->delete();

    if (!empty($selectedFacilities)) {

        $facilitiesData = [];

        foreach ($selectedFacilities as $facilityId) {

            $facilitiesData[] = [
                'accommodation_id' => $id,
                'facility_id' => $facilityId,
            ];
        }

        DB::table('accommodation_facilities')
            ->insert($facilitiesData);
    }

    /*
    |--------------------------------------------------------------------------
    | Upload Gallery Baru
    |--------------------------------------------------------------------------
    */

    if ($request->hasFile('gallery')) {

        foreach ($request->file('gallery') as $index => $file) {

            $imageName = time() . '_' . $index . '.' .
                $file->extension();

            $file->move(
                public_path('accommodations/gallery'),
                $imageName
            );

            \App\Models\AccommodationImage::create([
                'accommodation_id' => $id,
                'image' => 'accommodations/gallery/' . $imageName,
                'sort_order' => $index,
            ]);
        }
    }

    return redirect()
        ->route('akomodasi.index')
        ->with(
            'success',
            'Akomodasi berhasil diperbarui.'
        );
}

    /**
     * Hapus akomodasi
     */
    public function destroy($id)
    {
        $this->akomodasiService->delete($id);

        return redirect()
            ->route('akomodasi.index')
            ->with(
                'success',
                'Akomodasi berhasil dihapus.'
            );
    }
}