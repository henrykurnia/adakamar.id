<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\BannerService;

class BannerController extends Controller
{
    protected $service;

    public function __construct(
        BannerService $service
    ) {
        $this->service = $service;
    }

    public function index()
    {
        $banners = $this->service->getAll();

        return view(
            'example.content.crud.banner.index',
            compact('banners')
        );
    }

    public function create()
    {
        return view(
            'example.content.crud.banner.create'
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'is_active' => 'nullable|boolean',
        ]);

        $data = $request->except([
            '_token',
            'image'
        ]);

        if ($request->hasFile('image')) {

            $imageName = time() . '_' . $request->file('image')->getClientOriginalName();

            $request->file('image')->move(
                public_path('banners'),
                $imageName
            );

            $data['image'] = 'banners/' . $imageName;
        }

        $this->service->create($data);

        return redirect()
            ->route('banner.index')
            ->with('success', 'Banner berhasil ditambahkan.');
    }

    

    public function edit($id)
    {
        $banners = $this->service->getById($id);

        return view(
            'example.content.crud.banner.edit',
            compact('banners')
        );
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'is_active' => 'nullable|boolean',
        ]);

        $data = $request->except([
            '_token',
            '_method',
            'image'
        ]);

        if ($request->hasFile('image')) {

            $imageName = time() . '_' . $request->file('image')->getClientOriginalName();

            $request->file('image')->move(
                public_path('banners'),
                $imageName
            );

            $data['image'] = 'banners/' . $imageName;
        }

        $this->service->update($id, $data);

        return redirect()
            ->route('banner.index')
            ->with('success', 'Banner berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $this->service->delete($id);

        return redirect()
            ->route('banner.index')
            ->with('success', 'Banner berhasil dihapus.');
    }
}