<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class reportcustomer extends Model
{
    use HasFactory;
    protected $table = 'perusahaans'; // Sesuaikan dengan nama tabel

    // Jika ada kolom yang tidak dapat diisi massal
    protected $guarded = []; // Atau, gunakan $fillable jika perlu
}