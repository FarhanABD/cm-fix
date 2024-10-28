<?php

namespace App\Http\Controllers\Backend;

use App\Models\Order;
use App\Models\Paket;
use App\Models\Invoice;
use App\Models\Layanan;
use App\Models\Perusahaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class SuperAdminController extends Controller
{
    public function dashboard()
    {
        $totalCustomer = Perusahaan::count();
        $maintenancesCount = Order::where('tanggal_habis', '<', DB::raw('DATE_ADD(NOW(), INTERVAL 30 DAY)'))->count();
        $maintenancesGetData = Order::where('tanggal_habis', '<', DB::raw('DATE_ADD(NOW(), INTERVAL 30 DAY)'))->get();
        $hasOrdersNearExpiry = $maintenancesGetData->isNotEmpty(); 
        // Cek jika tidak kosong
        $orderCount = Order::count();
        $layananCount = Layanan::count();
        $paketCount = Paket::count();
        $latestInvoices = Invoice::orderBy('created_at', 'desc')->take(5)->get();

        $pendapatan = Invoice::select(
            DB::raw("MONTHNAME(created_at) as bulan"),
            DB::raw("SUM(total) as total_pendapatan"),
            DB::raw("MONTH(created_at) as month_number")
        )
        ->groupBy(DB::raw("MONTHNAME(created_at)"), DB::raw("MONTH(created_at)"))
        ->orderBy('month_number')
        ->pluck('total_pendapatan', 'bulan')
        ->toArray(); // Konversi ke array

        $paketSilverCount = Paket::where('jenis_paket', 'silver')->count();
        $paketGoldCount = Paket::where('jenis_paket', 'gold')->count();
        $paketPlatinumCount = Paket::where('jenis_paket', 'platinum')->count();
        $paketCustomCount = Paket::where('jenis_paket', 'custom')->count();
        $paketBrandingCount = Paket::where('jenis_paket', 'branding')->count();

        return view('super-admin.dashboard', compact('maintenancesCount', 'totalCustomer', 'orderCount', 'layananCount', 'paketCount', 'latestInvoices', 'pendapatan','hasOrdersNearExpiry','maintenancesGetData','paketSilverCount','paketGoldCount','paketPlatinumCount','paketCustomCount','paketBrandingCount'));
    }
}