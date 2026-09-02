<?php

namespace App\Http\Controllers;

use App\Services\SettingService;
use Illuminate\Http\Request;
use App\Models\Setting;

class SettingController extends Controller
{
    protected $settingService;

    public function __construct(SettingService $settingService)
    {
        $this->settingService = $settingService;
    }

    /**
     * Menampilkan halaman setting
     */
    public function index()
    {
        $tentang = $this->settingService->getSetting();

        return view(
            'example.content.crud.tentang.index',
            compact('tentang')
        );
    }

    /**
     * Menampilkan form tambah setting
     */
    public function create()
    {
        return view(
            'example.content.crud.tentang.create'
        );
    }

    /**
     * Menyimpan setting baru
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'site_name' => 'required|string|max:255',
            'tagline' => 'nullable|string|max:255',
            'about' => 'nullable|string',

            'logo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'favicon' => 'nullable|image|mimes:jpg,jpeg,png,webp,ico|max:2048',

            'address' => 'nullable|string',
            'phone' => 'nullable|string|max:50',
            'whatsapp' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:255',

            
            

            'maps_embed' => 'nullable|string',

            'facebook' => 'nullable|url|max:255',
            'instagram' => 'nullable|url|max:255',
            'youtube' => 'nullable|url|max:255',
            'tiktok' => 'nullable|url|max:255',

            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string',

            'footer_description' => 'nullable|string',
            'copyright' => 'nullable|string|max:255',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Upload Logo
        |--------------------------------------------------------------------------
        */
        if ($request->hasFile('logo')) {

            $file = $request->file('logo');

            $folder = public_path('setting/logo');

            if (!file_exists($folder)) {
                mkdir($folder, 0755, true);
            }

            $filename = time() . '_logo.' . $file->getClientOriginalExtension();

            $file->move($folder, $filename);

            $data['logo'] = 'setting/logo/' . $filename;
        }

        /*
        |--------------------------------------------------------------------------
        | Upload Favicon
        |--------------------------------------------------------------------------
        */
        if ($request->hasFile('favicon')) {

            $file = $request->file('favicon');

            $folder = public_path('setting/favicon');

            if (!file_exists($folder)) {
                mkdir($folder, 0755, true);
            }

            $filename = time() . '_favicon.' . $file->getClientOriginalExtension();

            $file->move($folder, $filename);

            $data['favicon'] = 'setting/favicon/' . $filename;
        }

        Setting::create($data);

        return redirect()
            ->route('tentang.index')
            ->with('success', 'Pengaturan website berhasil ditambahkan.');
    }

    /**
     * Menampilkan form edit setting
     */
    public function edit($id)
    {
        $setting = Setting::findOrFail($id);

        return view(
            'example.content.crud.tentang.edit',
            compact('setting')
        );
    }

    /**
     * Menyimpan perubahan setting
     */
    public function update(Request $request)
    {
    $validated = $request->validate([
    'site_name' => 'required|string|max:255',
    'tagline' => 'nullable|string|max:255',
    'about' => 'nullable|string',


        'logo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        'favicon' => 'nullable|image|mimes:ico,png,jpg,jpeg,webp|max:1024',

        'address' => 'nullable|string',
        'phone' => 'nullable|string|max:50',
        'whatsapp' => 'nullable|string|max:50',
        'email' => 'nullable|email|max:255',

        

        'maps_embed' => 'nullable|string',

        'facebook' => 'nullable|string|max:255',
        'instagram' => 'nullable|string|max:255',
        'youtube' => 'nullable|string|max:255',
        'tiktok' => 'nullable|string|max:255',

        'meta_title' => 'nullable|string|max:255',
        'meta_description' => 'nullable|string',
        'meta_keywords' => 'nullable|string',

        'footer_description' => 'nullable|string',
        'copyright' => 'nullable|string|max:255',
    ]);

    $this->settingService->update(
        $validated,
        $request->file('logo'),
        $request->file('favicon')
    );

    return redirect()
        ->route('tentang.index')
        ->with('success', 'Pengaturan website berhasil diperbarui.');


    }

}
