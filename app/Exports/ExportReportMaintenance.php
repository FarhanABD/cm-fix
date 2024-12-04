<?php

namespace App\Exports;

use App\Models\Maintenance;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;

class ExportReportMaintenance implements FromCollection, WithHeadings
{
    public function collection()
    {
        // Mengambil semua data maintenance dari database
        $maintenances = Maintenance::orderBy('id','asc')->get();
        // return Maintenance::all();
        return $maintenances;
    }

    public function headings(): array
    {
        // Judul kolom di file Excel
        return [
            'ID', 
            'ID Invoice', 
            'ID Order', 
            'jenis layanan', 
            'jenis paket',
            'tanggal langganan',
            'tanggal habis',
            'total',
            'ppn',
            'total amount',
            'Created At',
            'Updated At'
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $lastColumn = $sheet->getHighestColumn();
        $lastRow = $sheet->getHighestRow();
    
        return [
            // Gaya untuk header (baris pertama)
            1 => [
                'font' => [
                    'bold' => true,
                    'color' => ['argb' => Color::COLOR_BLACK],
                ],
                'fill' => [
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => ['argb' => 'FFFF8C00'], // Warna background orange
                ],
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => Border::BORDER_THIN,
                        'color' => ['argb' => 'FF000000'], // Warna border hitam
                    ],
                ],
            ],
        ];
        // Menambahkan border untuk seluruh data (dari A2 hingga kolom terakhir dan baris terakhir)
        $sheet->getStyle("A1:{$lastColumn}{$lastRow}")->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['argb' => 'FF000000'], // Warna border hitam
                ],
            ],
        ]);
    }
}