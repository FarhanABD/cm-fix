<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maintenance extends Model
{
    // protected $maintenance_date = 'maintenances'; // Sesuaikan dengan nama tabel yang benar
    public function order()
    {
        return $this->belongsTo(Order::class, 'id_order');
    }

    public function scopeFilterTanggalHabis($query)
{
    $today = Carbon::now();
    $next30Days = Carbon::now()->addDays(30);
    
    return $query->whereBetween('tanggal_habis', [$today, $next30Days])
                 ->orderBy('tanggal_habis', 'ASC');
}

}