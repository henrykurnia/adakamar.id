<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\SupplierMService;

class SupplierMController extends Controller
{
    protected $service;

    public function __construct(SupplierMService $service)
    {
        $this->service = $service;
    }

    /**
     * Daftar Supplier
     */
    public function index(Request $request)
    {
        $keyword = $request->keyword;

        $suppliers = $this->service->getAll($keyword);

        return view(
            'example.content.layouts.supplier',
            compact(
                'suppliers',
                'keyword'
            )
        );
    }
}