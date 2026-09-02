<?php

namespace App\Services;

use App\Repositories\Interfaces\SettingRepositoryInterface;
use Illuminate\Http\UploadedFile;

class SettingService
{
    protected $settingRepository;

    public function __construct(
        SettingRepositoryInterface $settingRepository
    ) {
        $this->settingRepository = $settingRepository;
    }

    public function getSetting()
    {
        return $this->settingRepository->getSetting();
    }

    public function update(
        array $data,
        ?UploadedFile $logo = null,
        ?UploadedFile $favicon = null
    ) {
        $setting = $this->settingRepository->getSetting();

        /*
        |--------------------------------------------------------------------------
        | LOGO
        |--------------------------------------------------------------------------
        */
        if ($logo) {

            $folder = public_path('setting/logo');

            /*
             * Buat folder jika belum ada
             */
            if (!file_exists($folder)) {
                mkdir($folder, 0755, true);
            }

            /*
             * Nama file baru
             */
            $filename = time() . '_logo.' . $logo->getClientOriginalExtension();

            /*
             * Simpan ke public/setting/logo
             */
            $logo->move($folder, $filename);

            /*
             * Hapus logo lama
             */
            if (
                $setting &&
                $setting->logo &&
                file_exists(public_path($setting->logo))
            ) {
                unlink(public_path($setting->logo));
            }

            /*
             * Simpan path relatif ke database
             */
            $data['logo'] = 'setting/logo/' . $filename;
        }

        /*
        |--------------------------------------------------------------------------
        | FAVICON
        |--------------------------------------------------------------------------
        */
        if ($favicon) {

            $folder = public_path('setting/favicon');

            /*
             * Buat folder jika belum ada
             */
            if (!file_exists($folder)) {
                mkdir($folder, 0755, true);
            }

            /*
             * Nama file baru
             */
            $filename = time() . '_favicon.' . $favicon->getClientOriginalExtension();

            /*
             * Simpan ke public/setting/favicon
             */
            $favicon->move($folder, $filename);

            /*
             * Hapus favicon lama
             */
            if (
                $setting &&
                $setting->favicon &&
                file_exists(public_path($setting->favicon))
            ) {
                unlink(public_path($setting->favicon));
            }

            /*
             * Simpan path relatif ke database
             */
            $data['favicon'] = 'setting/favicon/' . $filename;
        }

        /*
        |--------------------------------------------------------------------------
        | UPDATE DATABASE
        |--------------------------------------------------------------------------
        */
        return $this->settingRepository->update($data);
    }
}
