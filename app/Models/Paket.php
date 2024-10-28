<?php

namespace App\Models;

use App\Traits\HasFormatRupiah;
use App\Models\Cart;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paket extends Model
{
    use HasFactory;
    use HasFormatRupiah;
    public function layanan(){
        return $this->belongsTo(Layanan::class);
    }

    public function cart(){
        return $this->hasMany(Cart::class);
    }

}