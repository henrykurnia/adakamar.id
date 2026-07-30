<?php

namespace App\Exports;

use App\Services\ManagerReportService;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class StockOutReportExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    protected $keyword;
    protected $date;
    protected $month;
    protected $supplier;
    protected $product;

    public function __construct(
        $keyword = null,
        $date = null,
        $month = null,
        $supplier = null,
        $product = null
    ) {
        $this->keyword = $keyword;
        $this->date = $date;
        $this->month = $month;
        $this->supplier = $supplier;
        $this->product = $product;
    }

    public function collection()
    {
        $transactions = app(ManagerReportService::class)
            ->getStockOutReport(
                $this->keyword,
                $this->date,
                $this->month,
                $this->supplier,
                $this->product
            );

        return $transactions->map(function ($item) {
            return [
                'Tanggal' => $item->date,
                'Produk' => $item->product->name,
                'Supplier' => $item->product->supplier->name ?? '-',
                'Jenis' => $item->type,
                'Jumlah' => $item->quantity,
                'Keterangan' => $item->description,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Tanggal',
            'Produk',
            'Supplier',
            'Jenis',
            'Jumlah',
            'Keterangan',
        ];
    }
}