<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Repositories\Interfaces\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    /**
     * Menampilkan semua user dengan search + pagination
     */
    public function getAll($keyword = null)
    {
        $query = User::query();

        if (!empty($keyword)) {
            $query->where('name', 'like', '%' . $keyword . '%');
        }

        return $query
            ->latest()
            ->paginate(10)
            ->appends([
                'keyword' => $keyword
            ]);
    }

    /**
     * Cari user berdasarkan ID
     */
    public function findById($id)
    {
        return User::findOrFail($id);
    }

    /**
     * Simpan user baru
     */
    public function create(array $data)
    {
        $data['password'] = Hash::make($data['password']);

        return User::create($data);
    }

    /**
     * Update user
     */
    public function update($id, array $data)
    {
        $user = $this->findById($id);

        // Jika password diisi, hash password baru
        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            // Jika password kosong, jangan update password
            unset($data['password']);
        }

        $user->update($data);

        return $user;
    }

    /**
     * Hapus user
     */
    public function delete($id)
    {
        return $this->findById($id)->delete();
    }
}