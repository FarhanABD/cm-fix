<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisPaket extends Model
{
    use HasFactory;

    public function CategoryJenisPaket(){
        return $this->hasMany(Paket::class);
    }
}