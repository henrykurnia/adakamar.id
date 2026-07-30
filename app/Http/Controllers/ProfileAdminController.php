<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ProfileAdminService;

class ProfileAdminController extends Controller
{
    protected $profileAdminService;

    public function __construct(
        ProfileAdminService $profileAdminService
    ) {
        $this->profileAdminService = $profileAdminService;
    }

    /**
     * Form Edit Profile
     */
    public function edit()
    {
        $user = $this->profileAdminService->getProfile();

        return view(
            'example_admin.content.authentication.profile_admin',
            compact('user')
        );
    }

    /**
     * Update Profile
     */
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email,' . auth()->id(),
            'password' => 'nullable|min:8|confirmed',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->only([
            'name',
            'email',
            'password',
        ]);

        if ($request->hasFile('photo')) {

            $file = $request->file('photo');

            $filename = time() . '_' . $file->getClientOriginalName();

            $file->move(
                public_path('static/images/users'),
                $filename
            );

            $data['photo'] = $filename;
        }

        $this->profileAdminService->updateProfile($data);

        return back()->with(
            'success',
            'Profile berhasil diperbarui.'
        );
    }
}