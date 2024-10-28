<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Layanan extends Model
{
    use HasFactory;

    public function categoryPaket(){
        return $this->hasMany(Paket::class);
    }

    public function cart(){
        return $this->hasMany(Cart::class);
    }

}