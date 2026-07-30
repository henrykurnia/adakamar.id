<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use App\Repositories\Interfaces\ProfileManagerRepositoryInterface;

class ProfileManagerRepository implements ProfileManagerRepositoryInterface
{
    public function getProfile(): User
    {
        return Auth::user();
    }

    public function updateProfile(array $data): User
    {
        $user = Auth::user();

        $user->name = $data['name'];
        $user->email = $data['email'];

        if (!empty($data['password'])) {
            $user->password = Hash::make($data['password']);
        }

        if (!empty($data['photo'])) {

            // Hapus foto lama jika ada
            if (
                $user->photo &&
                File::exists(public_path('static/images/users/' . $user->photo))
            ) {
                File::delete(public_path('static/images/users/' . $user->photo));
            }

            $user->photo = $data['photo'];
        }

        $user->save();

        return $user;
    }
}