<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\reportinvoiceDataTable;
use App\Exports\ExportReportInvoice;
use App\Models\Invoice;
use Carbon\Carbon;
use App\Models\reportinvoice;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Maatwebsite\Excel\Facades\Excel;
class reportinvoiceController extends Controller
{
    public function index(Request $request)
    {
        $details = Invoice::query();
        // $details = Maintenance::orderBy('created_at', 'asc')->get();

        // Filter berdasarkan tanggal dari dan sampai
        if ($request->dari && $request->sampai) {
            $details->whereBetween('tanggal_langganan', [$request->dari, $request->sampai]);
        }

        $details = $details->get(); // Atau gunakan paginate jika diperlukan
        

        return view('admin.reportinvoice.index', compact('details'));
    }

    public function indexSuperAdmin(Request $request)
    {
        $details = Invoice::query();
        // $details = Maintenance::orderBy('created_at', 'asc')->get();
        // Filter berdasarkan tanggal dari dan sampai
        if ($request->dari && $request->sampai) {
            $details->whereBetween('tanggal_langganan', [$request->dari, $request->sampai]);
        }
        $details = $details->get(); // Atau gunakan paginate jika diperlukan
        return view('super-admin.reportinvoice.index', compact('details'));
    }

    public function cari(Request $request)
    {
        $order = Invoice::all();
        $dari = $request->dari;
        $sampai = $request->sampai;
        $tanggalSampai = Carbon::parse($sampai)->addDays(1)->format('Y-m-d');
        $orders = Invoice::whereBetween('created_at', [$dari, $tanggalSampai])->get();
        return view('admin.reportinvoice.cari',compact('orders', 'dari', 'sampai','order'));
    }

    public function cariSuperAdmin(Request $request)
    {
        // Mendapatkan semua invoice
        $details = Invoice::all();

        // Parsing input tanggal dari request
        $dari = Carbon::parse($request->dari)->format('Y-m-d');
        $sampai = Carbon::parse($request->sampai)->format('Y-m-d');

        // Termasuk tanggal akhir dalam filter
        $tanggalSampai = Carbon::parse($sampai);

        // Mengambil data invoice berdasarkan rentang tanggal yang diberikan
        $filteredInvoices = Invoice::whereBetween('created_at', [$dari, $tanggalSampai])->get();

        // Menyimpan input tanggal untuk dikirim ke view
        $dari = $request->input('dari');
        $sampai = $request->input('sampai');

        // Query dasar untuk data reportinvoice
        $query = Invoice::query();

        // Memfilter berdasarkan tanggal jika ada input
        if ($dari && $sampai) {
            $query->whereBetween('created_at', [$dari, $sampai]);
        } elseif ($dari) {
            $query->whereDate('created_at', '<=', $dari);
        } elseif ($sampai) {
            $query->whereDate('created_at', '<=', $sampai);
        }
        $result = $query->get();
        return view('super-admin.reportinvoice.cari', compact('details', 'dari', 'sampai', 'filteredInvoices', 'result'));
    }

    public function filter(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $filteredInvoices = Invoice::whereBetween('created_at', [$startDate, $endDate])->get();

        return view('admin.reportinvoice.index', compact('filteredInvoices'));
    }

    public function filterSuperAdmin(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $filteredInvoices = Invoice::whereBetween('created_at', [$startDate, $endDate])->get();

        return view('super-admin.reportinvoice.index', compact('filteredInvoices'));
    }

    public function showDiagram(Request $request)
    {
        // Filter Tanggal (Default ke seluruh data jika tidak difilter)
        $dari = $request->input('dari', now()->startOfMonth()->toDateString());
        $sampai = $request->input('sampai', now()->endOfMonth()->toDateString());

        // Data harian
        $dailyInvoices = Invoice::selectRaw('DATE(created_at) as date, SUM(total) as total_amount')
            ->whereBetween('created_at', [$dari, $sampai])
            ->groupBy('date')
            ->get();

        // Data bulanan
        $monthlyInvoices = Invoice::selectRaw('MONTH(created_at) as month, SUM(total) as total_amount')
            ->whereYear('created_at', now()->year)
            ->groupBy('month')
            ->get();

        // Data tahunan
        $yearlyInvoices = Invoice::selectRaw('YEAR(created_at) as year, SUM(total) as total_amount')
            ->groupBy('year')
            ->get();

        return view('admin.reportinvoice.diagram', compact('dailyInvoices', 'monthlyInvoices', 'yearlyInvoices', 'dari', 'sampai'));
    }

    public function showDiagramSuperAdmin(Request $request)
    {
        // Filter Tanggal (Default ke seluruh data jika tidak difilter)
        $dari = $request->input('dari', now()->startOfMonth()->toDateString());
        $sampai = $request->input('sampai', now()->endOfMonth()->toDateString());

        // Data harian
        $dailyInvoices = Invoice::selectRaw('DATE(created_at) as date, SUM(total) as total_amount')
            ->whereBetween('created_at', [$dari, $sampai])
            ->groupBy('date')
            ->get();

        // Data bulanan
        $monthlyInvoices = Invoice::selectRaw('MONTH(created_at) as month, SUM(total) as total_amount')
            ->whereYear('created_at', now()->year)
            ->groupBy('month')
            ->get();

        // Data tahunan
        $yearlyInvoices = Invoice::selectRaw('YEAR(created_at) as year, SUM(total) as total_amount')
            ->groupBy('year')
            ->get();

        return view('super-admin.reportinvoice.diagram', compact('dailyInvoices', 'monthlyInvoices', 'yearlyInvoices', 'dari', 'sampai'));
    }

    public function printDiagram(Request $request)
    {
        $dari = $request->input('dari');
        $sampai = $request->input('sampai');
        // Data harian
        $dailyInvoices = Invoice::selectRaw('DATE(created_at) as date, SUM(total) as total_amount')
            ->whereBetween('created_at', [$dari, $sampai])
            ->groupBy('date')
            ->get();
        // Data bulanan
        $monthlyInvoices = Invoice::selectRaw('MONTH(created_at) as month, SUM(total) as total_amount')
            ->whereYear('created_at', now()->year)
            ->groupBy('month')
            ->get();
        // Data tahunan
        $yearlyInvoices = Invoice::selectRaw('YEAR(created_at) as year, SUM(total) as total_amount')
            ->groupBy('year')
            ->get();
        // Generate PDF dengan data yang benar
        $pdf = FacadePdf::loadView('admin.reportinvoice.diagram_invoice_report', compact('dailyInvoices', 'monthlyInvoices', 'yearlyInvoices', 'dari', 'sampai'));
        // Kembalikan PDF yang dihasilkan
        return $pdf->download('diagram_invoice_report_' . $dari . 'to' . $sampai . '.pdf');
    }

    public function printDiagramSuperAdmin(Request $request)
    {
        $dari = $request->input('dari');
        $sampai = $request->input('sampai');
        // Data harian
        $dailyInvoices = Invoice::selectRaw('DATE(created_at) as date, SUM(total) as total_amount')
            ->whereBetween('created_at', [$dari, $sampai])
            ->groupBy('date')
            ->get();
        // Data bulanan
        $monthlyInvoices = Invoice::selectRaw('MONTH(created_at) as month, SUM(total) as total_amount')
            ->whereYear('created_at', now()->year)
            ->groupBy('month')
            ->get();
        // Data tahunan
        $yearlyInvoices = Invoice::selectRaw('YEAR(created_at) as year, SUM(total) as total_amount')
            ->groupBy('year')
            ->get();
        // Generate PDF dengan data yang benar
        $pdf = FacadePdf::loadView('super-admin.reportinvoice.diagram_invoice_report', compact('dailyInvoices', 'monthlyInvoices', 'yearlyInvoices', 'dari', 'sampai'));
        // Kembalikan PDF yang dihasilkan
        return $pdf->download('diagram_invoice_report_' . $dari . 'to' . $sampai . '.pdf');
    }

    public function exportExcel(){
        return Excel::download(new ExportReportInvoice,"data_report_invoice.xlsx");
    }
    
    public function exportPDF(Request $request)
    {
        $details = Invoice::query();

        // Filter berdasarkan tanggal dari dan sampai
        if ($request->dari && $request->sampai) {
            $details->whereBetween('tanggal_langganan', [$request->dari, $request->sampai]);
        }
        $details = $details->get();
        // Buat PDF dengan data order yang difilter
        $pdf = FacadePdf::loadView('admin.reportinvoice.exportpdf', compact('details'));
        // Download PDF
        return $pdf->download('report_invoice.pdf');
    }

    public function exportPDFSuperAdmin(Request $request)
    {
        $details = Invoice::query();

        // Filter berdasarkan tanggal dari dan sampai
        if ($request->dari && $request->sampai) {
            $details->whereBetween('tanggal_langganan', [$request->dari, $request->sampai]);
        }
        $details = $details->get();
        // Buat PDF dengan data order yang difilter
        $pdf = FacadePdf::loadView('super-admin.reportinvoice.exportpdf', compact('details'));
        // Download PDF
        return $pdf->download('report_invoice.pdf');
    }
    
    public function create()
    {
        //
    }
    public function store(Request $request)
    {
        //
    }
    public function show($id_invoice)
    {
        $data = Invoice::where('id_invoice', $id_invoice)->get();
        $id_invoice = urldecode($id_invoice);
    
        return view('admin.reportinvoice.view', compact('data','id_invoice'));
    }

    public function showSuperAdmin($id_invoice)
    {
        $data = Invoice::where('id_invoice', $id_invoice)->get();
        $id_invoice = urldecode($id_invoice);
    
        return view('super-admin.reportinvoice.view', compact('data','id_invoice'));
    }
    public function cetak(string $id_invoice)
    {
        $data = Invoice::where('id_invoice', $id_invoice)->get();
        // $details = TransaksiDetail::where('id_order', $id_order)->get();
        $id_invoice = urldecode($id_invoice);
        return view('admin.reportinvoice.cetak', compact('data','id_invoice'));
    }

    public function cetakSuperAdmin(string $id_invoice)
    {
        $data = Invoice::where('id_invoice', $id_invoice)->get();
        // $details = TransaksiDetail::where('id_order', $id_order)->get();
        $id_invoice = urldecode($id_invoice);
        return view('super-admin.reportinvoice.cetak', compact('data','id_invoice'));
    }

    public function edit(string $id)
    {
        //
    }
    public function update(Request $request, string $id)
    {
        //
    }
    public function destroy(string $id)
    {
        //
    }
}