<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Maintenance;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Maatwebsite\Excel\Facades\Excel;

class ReportMaintenanceController extends Controller
{
    public function index(Request $request)
    {
        $details = Maintenance::query();
        // $details = Maintenance::orderBy('created_at', 'asc')->get();

        // Filter berdasarkan tanggal dari dan sampai
        if ($request->dari && $request->sampai) {
            $details->whereBetween('tanggal_langganan', [$request->dari, $request->sampai]);
        }

        $details = $details->get(); // Atau gunakan paginate jika diperlukan
        

        return view('admin.reportmaintenance.index', compact('details'));
    }

    public function show($id_maintenance)
    {
        // Pastikan menggunakan model 'Invoice' dengan huruf besar
        $data = Maintenance::where('id_maintenance', $id_maintenance)->get(); // Mengambil satu data dengan first()
        $id_maintenance = urldecode($id_maintenance);

        // Menampilkan view yang sesuai untuk invoice
         return view('admin.reportmaintenance.view', compact('data','id_maintenance'));// Ganti ke 'reportinvoice.view'
    }

    public function showDiagram()
    {
        // Data untuk diagram harian, bulanan, dan tahunan (tanpa filter tanggal)
        $dailyMaintenance = Maintenance::selectRaw('DATE(created_at) as date, COUNT(*) as total')
            ->groupBy('date')
            ->get();

        $monthlyMaintenance = Maintenance::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
            ->groupBy('month')
            ->get();

        $yearlyMaintenance = Maintenance::selectRaw('YEAR(created_at) as year, COUNT(*) as total')
            ->groupBy('year')
            ->get();

        // dd($dailyMaintenance, $monthlyMaintenance, $yearlyMaintenance);
        return view('admin.reportmaintenance.diagram', compact('dailyMaintenance', 'monthlyMaintenance', 'yearlyMaintenance'));
    }

    public function printDiagram()
    {
        // Data harian, bulanan, tahunan untuk PDF
        $dailyMaintenance = Maintenance::selectRaw('DATE(created_at) as date, COUNT(*) as total')
            ->groupBy('date')
            ->get();

        $monthlyMaintenance = Maintenance::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
            ->groupBy('month')
            ->get();

        $yearlyMaintenance = Maintenance::selectRaw('YEAR(created_at) as year, COUNT(*) as total')
            ->groupBy('year')
            ->get();

        // Generate PDF
        $pdf = FacadePdf::loadView('admin.reportmaintenance.diagram_maintenance_report', compact('dailyMaintenance', 'monthlyMaintenance', 'yearlyMaintenance'));
        return $pdf->download('diagram_maintenance_report.pdf');
    }

    public function exportPdf(Request $request)
    {
    $details = Maintenance::query();

    // Filter berdasarkan tanggal dari dan sampai
    if ($request->dari && $request->sampai) {
        $details->whereBetween('tanggal_langganan', [$request->dari, $request->sampai]);
    }

    $details = $details->get();

    // Buat PDF dengan data order yang difilter
    $pdf = FacadePdf::loadView('admin.reportmaintenance.export_pdf', compact('details'));

    // Download PDF
    return $pdf->download('report_maintenance.pdf');
    }
  
    public function exportExcel()
    {
        return Excel::download(new \App\Exports\ExportReportMaintenance, 'data_report_maintenance.xlsx');
    }

    
}