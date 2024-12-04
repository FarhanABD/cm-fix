<?php

namespace App\Exports;

use App\Models\Invoice;
use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;
use Illuminate\Contracts\View\View;

class ExportReportInvoice implements FromCollection, WithHeadings, WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $invoice = Invoice::orderBy('id_order','asc')->get();
        return $invoice;
    }

    public function headings(): array
    {
        return [
            'id',
            'id_invoice',
            'id_order',
            'Nama_perusahaan',
            'jenis_layanan',
            'jenis_paket',
            'tanggal_langganan',
            'tanggal_habis',
            'alamat',
            'kota',
            'provinsi',
            'country',
            'phone_pic',
            'nama_pic',
            'email_pic',
            'item_desc',
            'qty',
            'price',
            'ppn',
            'total',
            'total_amount',
           
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