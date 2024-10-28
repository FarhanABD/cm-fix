<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
namespace App\Imports;

use App\Models\Perusahaan;
use Maatwebsite\Excel\Concerns\ToModel;


class Customerimport implements ToModel
{
    /**
    * @param array $row
    */
    public function model(array $row)
    {
        // Define how to create a model from the Excel row data
        return new Perusahaan([
            'id_perusahaan' => $row[0],
            'nama_perusahaan' => $row[1],
            'alamat' => $row[2],
            'phone' => $row[1],
            'email' => $row[1],
            'nama_website' => $row[1],
            // Add more columns as needed
        ]);
    }
}