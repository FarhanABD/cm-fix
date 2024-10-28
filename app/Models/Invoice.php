<?php

namespace App\Models;

use App\Traits\HasFormatRupiah;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Invoice extends Model
{
    use HasFactory;
    use HasFormatRupiah;

    public function perusahaan(){
        return $this->belongsTo(Perusahaan::class, 'no_perusahaan', 'id');
    }

   public function transaksiDetails(){
    return $this->hasMany(TransaksiDetail::class);
   }

   public function order()
   {
       return $this->belongsTo(Order::class, 'id_order', 'id');
   }
}