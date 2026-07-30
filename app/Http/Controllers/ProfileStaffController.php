<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ProfileStaffService;

class ProfileStaffController extends Controller
{
    protected $profileStaffService;

    public function __construct(
        ProfileStaffService $profileStaffService
    ) {
        $this->profileStaffService = $profileStaffService;
    }

    /**
     * Form Edit Profile
     */
    public function edit()
    {
        $user = $this->profileStaffService->getProfile();

        return view(
            'example_staff.content.authentication.profile_Staff',
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

        $this->profileStaffService->updateProfile($data);

        return back()->with(
            'success',
            'Profile berhasil diperbarui.'
        );
    }
}