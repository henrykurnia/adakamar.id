<?php

namespace App\Repositories\Interfaces;

interface StockOpnameRepositoryInterface
{
    /**
     * Menampilkan seluruh data stock opname
     * dengan pencarian nama produk dan pagination.
     *
     * @param string|null $keyword
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getAll($keyword = null);

    /**
     * Menampilkan daftar produk.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getProducts();

    /**
     * Simpan stock opname.
     *
     * @param array $data
     * @return mixed
     */
    public function store(array $data);

    /**
     * Detail stock opname.
     *
     * @param int $id
     * @return mixed
     */
    public function getById($id);

    /**
     * Update stock opname.
     *
     * @param int $id
     * @param array $data
     * @return mixed
     */
    public function update($id, array $data);

    /**
     * Hapus stock opname.
     *
     * @param int $id
     * @return mixed
     */
    public function delete($id);
}