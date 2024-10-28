<?php

namespace App\Exports;

use App\Models\Invoice;
use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class ExportReportInvoice implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $invoice = Invoice::orderBy('id_order','asc')->get();
        return $invoice;
    }
}