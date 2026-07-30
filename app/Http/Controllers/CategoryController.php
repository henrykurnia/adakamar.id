<?php

namespace App\Http\Controllers;

use App\Services\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index(Request $request)
    {
        $keyword = $request->keyword;

        $categories = $this->categoryService->getAllCategories($keyword);

        return view(
            'example_admin.content.layouts.category',
            compact('categories', 'keyword')
        );
    }

    public function create()
    {
        return view('example_admin.content.layouts.add_category');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255|unique:categories,name',
            'description' => 'nullable|string'
        ]);

        $this->categoryService->createCategory($validated);

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $category = $this->categoryService->getCategoryById($id);

        return view(
            'example_admin.content.layouts.upd_category',
            compact('category')
        );
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|max:255|unique:categories,name,' . $id,
            'description' => 'nullable|string'
        ]);

        $this->categoryService->updateCategory($id, $validated);

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $this->categoryService->deleteCategory($id);

        return redirect()
            ->route('admin.categories.index')
            ->with('success', 'Kategori berhasil dihapus.');
    }
}