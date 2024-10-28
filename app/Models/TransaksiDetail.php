<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasFormatRupiah;

class TransaksiDetail extends Model
{
    use HasFactory;
    use HasFormatRupiah;

    public function order()
    {
        return $this->belongsTo(Order::class, 'id_order', 'id_order');
    }

    public function perusahaan()
    {
        return $this->belongsTo(Perusahaan::class, 'no_perusahaan', 'id');
    }
}