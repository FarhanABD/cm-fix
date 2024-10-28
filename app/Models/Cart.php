<?php

namespace App\Models;

use App\Traits\HasFormatRupiah;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Paket;

class Cart extends Model
{
    use HasFactory;
    use HasFormatRupiah;

    public function perusahaan(){
        return $this->belongsTo(Perusahaan::class);
    }

    public function paket(){
        return $this->belongsTo(Paket::class, 'no_paket', 'id');
    }

    public function layanan()
    {
    return $this->belongsTo(Layanan::class);
    }
    
}