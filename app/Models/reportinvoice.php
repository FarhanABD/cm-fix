<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class reportinvoice extends Model
{
    use HasFactory;
    protected $table = 'invoices'; // Sesuaikan dengan nama tabel

    // Jika ada kolom yang tidak dapat diisi massal
    protected $guarded = []; // Atau, gunakan $fillable jika perlu
}