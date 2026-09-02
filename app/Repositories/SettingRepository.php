<?php

namespace App\Repositories;

use App\Models\Setting;
use App\Repositories\Interfaces\SettingRepositoryInterface;

class SettingRepository implements SettingRepositoryInterface
{
    public function getSetting()
    {
        return Setting::first();
    }

    public function update(array $data)
    {
        $setting = Setting::first();

        if (!$setting) {
            return Setting::create($data);
        }

        $setting->update($data);

        return $setting->fresh();
    }
}