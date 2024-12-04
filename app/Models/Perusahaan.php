<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perusahaan extends Model
{
    public $timestamps = true; // Pastikan timestamps aktif
    use HasFactory;
    // protected $table = 'perusahaans';

    protected $fillable = [
        'id_perusahaan',
        'email',
        'nama_perusahaan',
        'phone',
        'alamat',
        'keterangan',
        'nama_website',
        'nama_pic',
        'phone_pic',
        'email_pic',
        'keterangan',
        'create_at'
    ];
    public function invoice(){
        return $this->hasMany(Invoice::class);
    }
}