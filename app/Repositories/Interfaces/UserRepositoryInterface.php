<?php

namespace App\Repositories\Interfaces;

interface UserRepositoryInterface
{
    /**
     * Menampilkan seluruh user
     * dengan search dan pagination.
     */
    public function getAll($keyword = null);

    /**
     * Mencari user berdasarkan ID.
     */
    public function findById($id);

    /**
     * Menyimpan user baru.
     */
    public function create(array $data);

    /**
     * Mengupdate data user.
     */
    public function update($id, array $data);

    /**
     * Menghapus user.
     */
    public function delete($id);
}