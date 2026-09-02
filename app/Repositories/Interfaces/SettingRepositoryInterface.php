<?php

namespace App\Repositories\Interfaces;

interface SettingRepositoryInterface
{
    public function getSetting();

    public function update(array $data);
}