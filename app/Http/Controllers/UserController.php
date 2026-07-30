<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    protected UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Daftar User
     */
    public function index(Request $request)
    {
        $keyword = $request->keyword;

        $users = $this->userService->getAll($keyword);

        return view(
            'example_admin.content.crud.users',
            compact(
                'users',
                'keyword'
            )
        );
    }

    /**
     * Form tambah user
     */
    public function create()
    {
        $roles = User::ROLES;

        return view(
            'example_admin.content.crud.add_users',
            compact('roles')
        );
    }

    /**
     * Simpan user
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'email' => [
                'required',
                'email',
                'max:255',
                'unique:users,email',
            ],

            'password' => [
                'required',
                'confirmed',
                'min:6',
            ],

            'role' => [
                'required',
                Rule::in(array_keys(User::ROLES)),
            ],
        ]);

        $this->userService->create($validated);

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'User berhasil ditambahkan.');
    }

    /**
     * Form edit
     */
    public function edit($id)
    {
        $user = $this->userService->findById($id);
        $roles = User::ROLES;

        return view(
            'example_admin.content.crud.upd_users',
            compact(
                'user',
                'roles'
            )
        );
    }

    /**
     * Update user
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($id),
            ],

            'password' => [
                'nullable',
                'confirmed',
                'min:6',
            ],

            'role' => [
                'required',
                Rule::in(array_keys(User::ROLES)),
            ],
        ]);

        $this->userService->update($id, $validated);

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'User berhasil diperbarui.');
    }

    /**
     * Hapus user
     */
    public function destroy($id)
    {
        $this->userService->delete($id);

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'User berhasil dihapus.');
    }
}