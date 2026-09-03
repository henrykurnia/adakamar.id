<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Services\SettingService;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class SettingController extends Controller
{
    protected SettingService $service;

    public function __construct(
        SettingService $service
    ) {
        $this->service = $service;
    }

    /**
     * Menampilkan halaman pengaturan.
     */
    public function index()
    {
        $settings = $this->service->getAll();

        return view(
            'example.content.konten.settings',
            compact('settings')
        );
    }

    /**
     * Menyimpan pengaturan baru.
     */
    public function store(Request $request)
    {
        try {

            $validated = $request->validate(
                $this->rules(),
                $this->messages()
            );

            $setting = $this->service->create(
                $validated,
                $request->file('logo')
            );

            /*
            |--------------------------------------------------------------------------
            | AJAX / JSON
            |--------------------------------------------------------------------------
            */

            if ($this->isAjax($request)) {
                return response()->json([
                    'success' => true,
                    'message' => 'Pengaturan berhasil ditambahkan.',
                    'data' => $setting,
                ], 201);
            }

            /*
            |--------------------------------------------------------------------------
            | Request biasa
            |--------------------------------------------------------------------------
            */

            return redirect()
                ->route('pengaturan.index')
                ->with(
                    'success',
                    'Pengaturan berhasil ditambahkan.'
                );

        } catch (ValidationException $e) {

            if ($this->isAjax($request)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validasi gagal.',
                    'errors' => $e->errors(),
                ], 422);
            }

            throw $e;

        } catch (\Throwable $e) {

            \Log::error(
                'Gagal menambahkan pengaturan',
                [
                    'message' => $e->getMessage(),
                    'file' => $e->getFile(),
                    'line' => $e->getLine(),
                ]
            );

            if ($this->isAjax($request)) {
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
                    'Terjadi kesalahan saat menambahkan pengaturan.'
                );
        }
    }

    /**
     * Mengambil data pengaturan untuk modal edit.
     */
    public function edit(
        Setting $setting
    ) {
        return response()->json([
            'success' => true,

            'data' => [
                'id' => $setting->id,

                // Website
                'site_name' => $setting->site_name,
                'tagline' => $setting->tagline,
                'about' => $setting->about,

                // Branding
                'logo' => $setting->logo,
                'logo_url' => $setting->logo
                    ? asset($setting->logo)
                    : null,

                // Kontak
                'address' => $setting->address,
                'phone' => $setting->phone,
                'whatsapp' => $setting->whatsapp,
                'email' => $setting->email,

                // Maps
                'maps_embed' => $setting->maps_embed,

                // Social Media
                'facebook' => $setting->facebook,
                'instagram' => $setting->instagram,
                'x' => $setting->x,
                'youtube' => $setting->youtube,
                'tiktok' => $setting->tiktok,

                // SEO
                'meta_title' => $setting->meta_title,
                'meta_description' => $setting->meta_description,
                'meta_keywords' => $setting->meta_keywords,

                // Footer
                'footer_description' =>
                    $setting->footer_description,

                'copyright' =>
                    $setting->copyright,
            ],
        ]);
    }

    /**
     * Update pengaturan.
     */
    public function update(
        Request $request,
        Setting $setting
    ) {
        try {

            $validated = $request->validate(
                $this->rules(),
                $this->messages()
            );

            $setting = $this->service->update(
                $setting,
                $validated,
                $request->file('logo')
            );

            /*
            |--------------------------------------------------------------------------
            | AJAX / JSON
            |--------------------------------------------------------------------------
            */

            if ($this->isAjax($request)) {
                return response()->json([
                    'success' => true,
                    'message' => 'Pengaturan berhasil diperbarui.',
                    'data' => $setting,
                ]);
            }

            /*
            |--------------------------------------------------------------------------
            | Request biasa
            |--------------------------------------------------------------------------
            */

            return redirect()
                ->route('pengaturan.index')
                ->with(
                    'success',
                    'Pengaturan berhasil diperbarui.'
                );

        } catch (ValidationException $e) {

            if ($this->isAjax($request)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validasi gagal.',
                    'errors' => $e->errors(),
                ], 422);
            }

            throw $e;

        } catch (\Throwable $e) {

            \Log::error(
                'Gagal memperbarui pengaturan',
                [
                    'setting_id' => $setting->id,
                    'message' => $e->getMessage(),
                    'file' => $e->getFile(),
                    'line' => $e->getLine(),
                ]
            );

            if ($this->isAjax($request)) {
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
                    'Terjadi kesalahan saat memperbarui pengaturan.'
                );
        }
    }

    /**
     * Hapus pengaturan.
     */
    public function destroy(
        Request $request,
        Setting $setting
    ) {
        try {

            $this->service->delete(
                $setting
            );

            /*
            |--------------------------------------------------------------------------
            | AJAX / JSON
            |--------------------------------------------------------------------------
            */

            if ($this->isAjax($request)) {
                return response()->json([
                    'success' => true,
                    'message' => 'Pengaturan berhasil dihapus.',
                ]);
            }

            /*
            |--------------------------------------------------------------------------
            | Request biasa
            |--------------------------------------------------------------------------
            */

            return redirect()
                ->route('pengaturan.index')
                ->with(
                    'success',
                    'Pengaturan berhasil dihapus.'
                );

        } catch (\Throwable $e) {

            \Log::error(
                'Gagal menghapus pengaturan',
                [
                    'setting_id' => $setting->id,
                    'message' => $e->getMessage(),
                    'file' => $e->getFile(),
                    'line' => $e->getLine(),
                ]
            );

            if ($this->isAjax($request)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
                ], 500);
            }

            return redirect()
                ->route('pengaturan.index')
                ->with(
                    'error',
                    'Terjadi kesalahan saat menghapus pengaturan.'
                );
        }
    }

    /**
     * Cek request AJAX / JSON.
     */
    protected function isAjax(
        Request $request
    ): bool {
        return $request->ajax()
            || $request->wantsJson()
            || $request->expectsJson();
    }

    /**
     * Validation rules.
     */
    protected function rules(): array
    {
        return [

            // Website
            'site_name' => [
                'required',
                'string',
                'max:255',
            ],

            'tagline' => [
                'nullable',
                'string',
                'max:255',
            ],

            'about' => [
                'nullable',
                'string',
            ],

            // Branding
            'logo' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:20480',
            ],

            // Kontak
            'address' => [
                'nullable',
                'string',
            ],

            'phone' => [
                'nullable',
                'string',
                'max:20',
            ],

            'whatsapp' => [
                'nullable',
                'string',
                'max:20',
            ],

            'email' => [
                'nullable',
                'email',
                'max:255',
            ],

            // Maps
            'maps_embed' => [
                'nullable',
                'string',
            ],

            // Social Media
            'facebook' => [
                'nullable',
                'string',
                'max:255',
            ],

            'instagram' => [
                'nullable',
                'string',
                'max:255',
            ],

            'x' => [
                'nullable',
                'string',
                'max:255',
            ],

            'youtube' => [
                'nullable',
                'string',
                'max:255',
            ],

            'tiktok' => [
                'nullable',
                'string',
                'max:255',
            ],

            // SEO
            'meta_title' => [
                'nullable',
                'string',
                'max:255',
            ],

            'meta_description' => [
                'nullable',
                'string',
            ],

            'meta_keywords' => [
                'nullable',
                'string',
                'max:255',
            ],

            // Footer
            'footer_description' => [
                'nullable',
                'string',
            ],

            'copyright' => [
                'nullable',
                'string',
                'max:255',
            ],
        ];
    }

    /**
     * Validation messages.
     */
    protected function messages(): array
    {
        return [

            'site_name.required' =>
                'Nama website wajib diisi.',

            'site_name.string' =>
                'Nama website harus berupa teks.',

            'site_name.max' =>
                'Nama website maksimal 255 karakter.',

            'tagline.max' =>
                'Tagline maksimal 255 karakter.',

            'logo.image' =>
                'Logo harus berupa gambar.',

            'logo.mimes' =>
                'Logo harus berformat JPG, JPEG, PNG, atau WEBP.',

            'logo.max' =>
                'Ukuran logo maksimal 20MB.',

            'phone.max' =>
                'Nomor telepon maksimal 20 karakter.',

            'whatsapp.max' =>
                'Nomor WhatsApp maksimal 20 karakter.',

            'email.email' =>
                'Format email tidak valid.',

            'email.max' =>
                'Email maksimal 255 karakter.',

            'facebook.max' =>
                'URL Facebook maksimal 255 karakter.',

            'instagram.max' =>
                'URL Instagram maksimal 255 karakter.',

            'x.max' =>
                'URL X maksimal 255 karakter.',

            'youtube.max' =>
                'URL YouTube maksimal 255 karakter.',

            'tiktok.max' =>
                'URL TikTok maksimal 255 karakter.',

            'meta_title.max' =>
                'Meta title maksimal 255 karakter.',

            'meta_keywords.max' =>
                'Meta keywords maksimal 255 karakter.',

            'copyright.max' =>
                'Copyright maksimal 255 karakter.',
        ];
    }
}