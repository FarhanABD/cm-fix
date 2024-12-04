<?php

namespace App\Http\Controllers\Backend;

use App\Models\Perusahaan;
use Illuminate\Http\Request;
use App\Models\reportcustomer;
use Illuminate\Support\Carbon;
use App\Exports\ExportCustomer;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
class reportCustomerController extends Controller
{
    public function index()
    {
        $details = reportcustomer::orderBy('created_at', 'asc')->get();
        return view('admin.reportcustomer.index', compact('details'));
    }

    public function indexSuperAdmin()
    {
        $details = reportcustomer::orderBy('created_at', 'asc')->get();
        return view('super-admin.reportcustomer.index', compact('details'));
    }

    public function cari(Request $request)
    {
        // Mendapatkan semua invoice
        $perusahaans = Perusahaan::all();

        // Parsing input tanggal dari request
        $dari = Carbon::parse($request->dari)->format('Y-m-d');
        $sampai = Carbon::parse($request->sampai)->format('Y-m-d');

        // Termasuk tanggal akhir dalam filter
        $tanggalSampai = Carbon::parse($sampai);

        // Mengambil data invoice berdasarkan rentang tanggal yang diberikan
        $filteredCustomers = Perusahaan::whereBetween('created_at', [$dari, $tanggalSampai])->get();

        // Menyimpan input tanggal untuk dikirim ke view
        $dari = $request->input('dari');
        $sampai = $request->input('sampai');

        // Query dasar untuk data reportinvoice
        $query = reportcustomer::query();

        // Memfilter berdasarkan tanggal jika ada input
        if ($dari && $sampai) {
            $query->whereBetween('created_at', [$dari, $sampai]);
        } elseif ($dari) {
            $query->whereDate('created_at', '<=', $dari);
        } elseif ($sampai) {
            $query->whereDate('created_at', '<=', $sampai);
        }

        // Mendapatkan hasil query
        $result = $query->get();

        // Mengembalikan view dengan data yang sudah difilter
        return view('admin.reportcustomer.cari', compact('perusahaans', 'dari', 'sampai', 'filteredCustomers', 'result'));
    }

    public function cariSuperAdmin(Request $request)
    {
        // Mendapatkan semua invoice
        $perusahaans = Perusahaan::all();

        // Parsing input tanggal dari request
        $dari = Carbon::parse($request->dari)->format('Y-m-d');
        $sampai = Carbon::parse($request->sampai)->format('Y-m-d');

        // Termasuk tanggal akhir dalam filter
        $tanggalSampai = Carbon::parse($sampai);

        // Mengambil data invoice berdasarkan rentang tanggal yang diberikan
        $filteredCustomers = Perusahaan::whereBetween('created_at', [$dari, $tanggalSampai])->get();

        // Menyimpan input tanggal untuk dikirim ke view
        $dari = $request->input('dari');
        $sampai = $request->input('sampai');

        // Query dasar untuk data reportinvoice
        $query = reportcustomer::query();

        // Memfilter berdasarkan tanggal jika ada input
        if ($dari && $sampai) {
            $query->whereBetween('created_at', [$dari, $sampai]);
        } elseif ($dari) {
            $query->whereDate('created_at', '<=', $dari);
        } elseif ($sampai) {
            $query->whereDate('created_at', '<=', $sampai);
        }

        // Mendapatkan hasil query
        $result = $query->get();

        // Mengembalikan view dengan data yang sudah difilter
        return view('super-admin.reportcustomer.cari', compact('perusahaans', 'dari', 'sampai', 'filteredCustomers', 'result'));
    }

    public function filter(Request $request)
    {
        // Mendapatkan input tanggal
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // Memfilter data berdasarkan rentang tanggal
        $filteredCustomers = reportcustomer::whereBetween('created_at', [$startDate, $endDate])->get();

        // Mengembalikan view dengan data yang sudah difilter
        return view('admin.reportcustomer.index', compact('filteredCustomers'));
    }

    public function filterSuperAdmin(Request $request)
    {
        // Mendapatkan input tanggal
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // Memfilter data berdasarkan rentang tanggal
        $filteredCustomers = reportcustomer::whereBetween('created_at', [$startDate, $endDate])->get();

        // Mengembalikan view dengan data yang sudah difilter
        return view('super-admin.reportcustomer.index', compact('filteredCustomers'));
    }

    public function showDiagram(Request $request)
    {
        // Filter Tanggal (Default ke seluruh data jika tidak difilter)
        $dari = $request->input('dari', now()->startOfMonth()->toDateString());
        $sampai = $request->input('sampai', now()->endOfMonth()->toDateString());

        // Data harian
        $dailyCustomers = reportcustomer::selectRaw('DATE(created_at) as date, COUNT(*) as total')
            ->whereBetween('created_at', [$dari, $sampai])
            ->groupBy('date')
            ->get();

        // Data bulanan
        $monthlyCustomers = reportcustomer::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
            ->whereYear('created_at', now()->year)
            ->groupBy('month')
            ->get();

        // Data tahunan
        $yearlyCustomers = reportcustomer::selectRaw('YEAR(created_at) as year, COUNT(*) as total')
            ->groupBy('year')
            ->get();

        return view('admin.reportcustomer.diagram', compact('dailyCustomers', 'monthlyCustomers', 'yearlyCustomers', 'dari', 'sampai'));
    }

    public function showDiagramSuperAdmin(Request $request)
    {
        // Filter Tanggal (Default ke seluruh data jika tidak difilter)
        $dari = $request->input('dari', now()->startOfMonth()->toDateString());
        $sampai = $request->input('sampai', now()->endOfMonth()->toDateString());

        // Data harian
        $dailyCustomers = reportcustomer::selectRaw('DATE(created_at) as date, COUNT(*) as total')
            ->whereBetween('created_at', [$dari, $sampai])
            ->groupBy('date')
            ->get();

        // Data bulanan
        $monthlyCustomers = reportcustomer::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
            ->whereYear('created_at', now()->year)
            ->groupBy('month')
            ->get();

        // Data tahunan
        $yearlyCustomers = reportcustomer::selectRaw('YEAR(created_at) as year, COUNT(*) as total')
            ->groupBy('year')
            ->get();

        return view('admin.reportcustomer.diagram', compact('dailyCustomers', 'monthlyCustomers', 'yearlyCustomers', 'dari', 'sampai'));
    }

    // public function printDiagram(Request $request)
    // {
    //     // Ambil data yang sama seperti di diagram untuk PDF
    //     $dari = $request->input('dari');
    //     $sampai = $request->input('sampai');
    //     // Data harian
    //     $dailyCustomers = reportcustomer::selectRaw('DATE(created_at) as date, SUM(total_amount) as total_amount')
    //         ->whereBetween('created_at', [$dari, $sampai])
    //         ->groupBy('date')
    //         ->get();
    //     // Data bulanan
    //     $monthlyCustomers = reportcustomer::selectRaw('MONTH(created_at) as month, SUM(total_amount) as total_amount')
    //         ->whereYear('created_at', now()->year)
    //         ->groupBy('month')
    //         ->get();
    //     // Data tahunan
    //     $yearlyCustomers = reportcustomer::selectRaw('YEAR(created_at) as year, SUM(total_amount) as total_amount')
    //         ->groupBy('year')
    //         ->get();
    //     // Generate PDF dengan data yang benar
    //     $pdf = FacadePdf::loadView('admin.reportcustomer.diagram_customer_report', compact('dailyCustomers', 'monthlyCustomers', 'yearlyCustomers', 'dari', 'sampai'));
    //     // Kembalikan PDF yang dihasilkan
    //     return $pdf->download('diagram_customer_report_' . $dari . 'to' . $sampai . '.pdf');
    // }

    public function exportExcel(Request $request)
    {
        return Excel::download(new ExportCustomer, 'users.xlsx'); //download xlsx format file
    }

    public function exportPDF()
    {
        // Ambil data dari database, misalnya dari model Customer atau Perusahaan
        $customers = Perusahaan::all();

        // Kirim data ke view yang akan dirender menjadi PDF
        $pdf = FacadePdf::loadView('admin.reportcustomer.exportpdf', compact('customers'));

        // Download PDF dengan nama file 'report_customer.pdf'
        return $pdf->download('report_customer.pdf');
    }

    public function exportPDFSuperAdmin()
    {
        // Ambil data dari database, misalnya dari model Customer atau Perusahaan
        $customers = Perusahaan::all();
        // Kirim data ke view yang akan dirender menjadi PDF
        $pdf = FacadePdf::loadView('super-admin.reportcustomer.exportpdf', compact('customers'));
        // Download PDF dengan nama file 'report_customer.pdf'
        return $pdf->download('report_customer.pdf');
    }
}