<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ProfileManagerService;

class ProfileManagerController extends Controller
{
    protected $profileManagerService;

    public function __construct(
        ProfileManagerService $profileManagerService
    ) {
        $this->profileManagerService = $profileManagerService;
    }

    /**
     * Form Edit Profile
     */
    public function edit()
    {
        $user = $this->profileManagerService->getProfile();

        return view(
            'example.content.authentication.profile_manager',
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

        $this->profileManagerService->updateProfile($data);

        return back()->with(
            'success',
            'Profile berhasil diperbarui.'
        );
    }
}