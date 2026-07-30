<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\StockHistoryService;

class StockHistoryController extends Controller
{
    protected $stockHistoryService;

    public function __construct(
        StockHistoryService $stockHistoryService
    ) {
        $this->stockHistoryService = $stockHistoryService;
    }

    /**
     * Menampilkan riwayat stok
     */
    public function index(Request $request)
    {
        $date = $request->date;
        $keyword = $request->keyword;

        $histories = $this->stockHistoryService
            ->getHistory($date, $keyword);

        return view(
            'example_admin.content.crud.stock_history',
            compact(
                'histories',
                'date',
                'keyword'
            )
        );
    }
}