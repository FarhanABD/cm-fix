<?php

namespace App\Exports;

use App\Models\Maintenance;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportReportMaintenance implements FromCollection, WithHeadings
{
    public function collection()
    {
        // Mengambil semua data maintenance dari database
        return Maintenance::all();
    }

    public function headings(): array
    {
        // Judul kolom di file Excel
        return [
            'ID', 
            'Jenis Maintenance',
            'Tanggal Langganan',
            'Tanggal Habis',
            'Created At',
            'Updated At'
        ];
    }
}