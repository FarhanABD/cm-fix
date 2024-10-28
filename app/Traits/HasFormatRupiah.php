<?php

namespace App\Traits;

use PhpOffice\PhpSpreadsheet\Style\NumberFormat\NumberFormatter;

trait HasFormatRupiah
{
    function formatRupiah($field)
    {
        $nominal = $this->attributes[$field];
        return 'Rp '. number_format($nominal, 0, ',', '.');
    }

    function formatTotalRupiah($field)
    {
        $nominal = $this->attributes[$field];
        return number_format($nominal, 0, ',', '.');
    }
}