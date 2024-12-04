<?php

namespace App\Imports;

use App\Models\NamaModel;
use App\Models\Perusahaan;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class Customerimport implements ToModel, WithStartRow
{
    public function startRow(): int{
        return 2;
    }
    public function model(array $row)
    {
    // dd($row);
        return new Perusahaan([
            'id_perusahaan'    => $row[1],
            'email'            => $row[2],
            'nama_perusahaan'  => $row[3],
            'phone'            => $row[4],
            'alamat'           => $row[5],
            'keterangan'       => $row[6],
            'nama_website'     => $row[7],
            'nama_pic'         => $row[8],
            'phone_pic'        => $row[9],
            'email_pic'        => $row[10],
            'keterangan'       => $row[11],
            // Sesuaikan dengan kolom dalam file Excel Anda
        ]);
    }
}