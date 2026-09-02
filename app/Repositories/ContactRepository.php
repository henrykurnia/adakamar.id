<?php

namespace App\Repositories;

use App\Models\contacts;
use App\Repositories\Interfaces\ContactRepositoryInterface;

class ContactRepository implements ContactRepositoryInterface
{
    public function getAll()
    {
        return contacts::latest()->get();
    }

    public function getById($id)
    {
        return contacts::findOrFail($id);
    }

    public function create(array $data)
    {
        return contacts::create($data);
    }

    public function update($id, array $data)
    {
        $contact = contacts::findOrFail($id);

        $contact->update($data);

        return $contact;
    }

    public function delete($id)
    {
        return contacts::findOrFail($id)->delete();
    }
}