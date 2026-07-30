<?php

namespace App\Exports;

use App\Models\StockOpname;
use Maatwebsite\Excel\Concerns\FromCollection;

class StockOpnameReportExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return StockOpname::all();
    }
}
