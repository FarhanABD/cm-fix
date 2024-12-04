<?php

namespace App\Exports;

use App\Models\Perusahaan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;

class ExportCustomer implements FromCollection, WithHeadings, WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $perusahaans = Perusahaan::orderBy('id_perusahaan','asc')->get();
        // return Perusahaan::all();
        return $perusahaans;
    }

    public function headings(): array
    {
        return [
            'ID',
            'id_perusahaan',
            'Email',
            'Nama_perusahaan',
            'Phone',
            'Alamat',
            'Keterangan',
            'Nama_website',
            'Nama_pic',
            'Phone_pic',
            'Email_pic',
            'Keterangan',
            'Create_at',
            'Update_at'
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