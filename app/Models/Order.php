<?php

namespace App\Models;

use App\Traits\HasFormatRupiah;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;
    use HasFormatRupiah;
    public function paket(){
        return $this->belongsTo(Paket::class);
    }

    public function perusahaan(){
        return $this->belongsTo(Perusahaan::class);
    }

    public function transaksiDetails()
    {
        return $this->hasMany(TransaksiDetail::class, 'id_order', 'id_order');
    }

    public function getFormattedTotalAttribute()
    {
        return $this->formatTotalRupiah('total');
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class, 'id_order', 'id');
    }

    // Properti yang ditambahkan ke JSON response
    protected $appends = ['formatted_total'];


}