<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Supplier;
use App\Services\ManagerReportService;

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\StockReportExport;
use App\Exports\StockInReportExport;
use App\Exports\StockOutReportExport;
use App\Exports\StockOpnameReportExport;

class ManagerReportController extends Controller
{
    protected $managerReportService;

    public function __construct(
        ManagerReportService $managerReportService
    ) {
        $this->managerReportService = $managerReportService;
    }

    /**
     * ==========================================
     * LAPORAN STOK BARANG
     * ==========================================
     */
    public function stockReport(Request $request)
    {
        $keyword = $request->keyword;
        $category = $request->category;

        $products = $this->managerReportService
            ->getStockReport($keyword, $category);

        $categories = Category::orderBy('name')->get();

        if (auth()->user()->role == 'Admin') {

            return view(
                'example_admin.content.report.stock_report',
                compact(
                    'products',
                    'categories',
                    'keyword',
                    'category'
                )
            );
        }

        return view(
            'example.content.report.stock_report',
            compact(
                'products',
                'categories',
                'keyword',
                'category'
            )
        );
    }

    /**
     * Export Laporan Stok Barang
     */
    public function exportStockReport(Request $request)
    {
        return Excel::download(
            new StockReportExport(
                $request->keyword,
                $request->category
            ),
            'laporan_stok_barang.xlsx'
        );
    }

    /**
     * ==========================================
     * LAPORAN BARANG MASUK
     * ==========================================
     */
    public function stockInReport(Request $request)
    {
        $keyword = $request->keyword;
        $date = $request->date;
        $month = $request->month;
        $supplier = $request->supplier;
        $product = $request->product;

        $transactions = $this->managerReportService
            ->getStockInReport(
                $keyword,
                $date,
                $month,
                $supplier,
                $product
            );

        $suppliers = Supplier::orderBy('name')->get();
        $products = Product::orderBy('name')->get();

        if (auth()->user()->role == 'Admin') {

            return view(
                'example_admin.content.report.stock_in_report',
                compact(
                    'transactions',
                    'suppliers',
                    'products',
                    'keyword',
                    'date',
                    'month',
                    'supplier',
                    'product'
                )
            );
        }

        return view(
            'example.content.report.stock_in_report',
            compact(
                'transactions',
                'suppliers',
                'products',
                'keyword',
                'date',
                'month',
                'supplier',
                'product'
            )
        );
    }

    /**
     * Export Laporan Barang Masuk
     */
    public function exportStockInReport(Request $request)
    {
        return Excel::download(
            new StockInReportExport(
                $request->keyword,
                $request->date,
                $request->month,
                $request->supplier,
                $request->product
            ),
            'laporan_barang_masuk.xlsx'
        );
    }

    /**
     * ==========================================
     * LAPORAN BARANG KELUAR
     * ==========================================
     */
    public function stockOutReport(Request $request)
    {
        $keyword = $request->keyword;
        $date = $request->date;
        $month = $request->month;
        $supplier = $request->supplier;
        $product = $request->product;

        $transactions = $this->managerReportService
            ->getStockOutReport(
                $keyword,
                $date,
                $month,
                $supplier,
                $product
            );

        $suppliers = Supplier::orderBy('name')->get();
        $products = Product::orderBy('name')->get();

        if (auth()->user()->role == 'Admin') {

            return view(
                'example_admin.content.report.stock_out_report',
                compact(
                    'transactions',
                    'suppliers',
                    'products',
                    'keyword',
                    'date',
                    'month',
                    'supplier',
                    'product'
                )
            );
        }

        return view(
            'example.content.report.stock_out_report',
            compact(
                'transactions',
                'suppliers',
                'products',
                'keyword',
                'date',
                'month',
                'supplier',
                'product'
            )
        );
    }

    /**
     * Export Laporan Barang Keluar
     */
    public function exportStockOutReport(Request $request)
    {
        return Excel::download(
            new StockOutReportExport(
                $request->keyword,
                $request->date,
                $request->month,
                $request->supplier,
                $request->product
            ),
            'laporan_barang_keluar.xlsx'
        );
    }

    /**
     * ==========================================
     * LAPORAN STOCK OPNAME
     * ==========================================
     */
    public function stockOpnameReport()
    {
        $stockOpnames = $this->managerReportService
            ->getStockOpnameReport();

        if (auth()->user()->role == 'Admin') {

            return view(
                'example_admin.content.report.stock_opname_report',
                compact('stockOpnames')
            );
        }

        return view(
            'example.content.report.stock_opname_report',
            compact('stockOpnames')
        );
    }

    /**
     * Export Laporan Stock Opname
     */
    public function exportStockOpnameReport()
    {
        return Excel::download(
            new StockOpnameReportExport(),
            'laporan_stock_opname.xlsx'
        );
    }
}