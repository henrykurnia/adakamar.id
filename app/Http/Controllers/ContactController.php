<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ContactService;

class ContactController extends Controller
{
    protected $service;

    public function __construct(
        ContactService $service
    ) {
        $this->service = $service;
    }

    public function index()
    {
        $data = $this->service->getAll();

        return view(
            'example.content.crud.contacts.index',
            compact('data')
        );
    }

    public function show($id)
    {
        $data = $this->service->getById($id);

        return view(
            'example.content.crud.contacts.show',
            compact('data')
        );
    }

    public function destroy($id)
    {
        $this->service->delete($id);

        return redirect()
            ->route('contact.index')
            ->with('success', 'Pesan berhasil dihapus.');
    }
}