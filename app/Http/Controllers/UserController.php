<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Menampilkan data user yang sedang login
     */
    public function index()
    {
        $user = Auth::user();

        return view(
            'example.content.crud.user',
            compact('user')
        );
    }

    /**
     * Update data user yang sedang login
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'username' => [
                'required',
                'string',
                'max:255',
                Rule::unique('users', 'username')->ignore($user->id),
            ],

            'email' => [
               'required',
               'string',
               'max:255', 
               Rule::unique('users', 'email')->ignore($user->id),
            ],

            'password' => [
                'nullable',
                'confirmed',
                'min:6',
            ],
        ]);

        // Update username dan nama
        $user->username = $validated['username'];
        $user->email = $validated['email'];

        // Update password hanya jika diisi
        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        return redirect()
            ->route('users.index')
            ->with('success', 'Profil berhasil diperbarui.');
    }
}
