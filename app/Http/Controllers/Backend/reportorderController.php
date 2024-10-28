<?php

namespace App\Http\Controllers\Backend;
use PDF;
use Carbon\Carbon;
use App\Models\Order;
use App\Models\reportorder;
use Illuminate\Http\Request;
use App\Models\TransaksiDetail;
use App\Exports\ExportReportOrder;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\PDF as DomPDFPDF;
use App\DataTables\reportorderDataTable;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;

class reportorderController extends Controller
{    
    public function index(Request $request)
    {
        $orders = Order::query();

        // Filter berdasarkan tanggal dari dan sampai
        if ($request->dari && $request->sampai) {
            $orders->whereBetween('tanggal_langganan', [$request->dari, $request->sampai]);
        }
        $orders = $orders->get(); // Atau gunakan paginate jika diperlukan
        return view('admin.reportorder.index', compact('orders'));
    }
    public function indexSuperAdmin()
    {
        $orders = TransaksiDetail::orderBy('created_at', 'asc')->get();
        return view('super-admin.reportorder.index', compact('orders'));
    }

    public function cari(Request $request)
    {
        $order = Order::all();
        $dari = $request->dari;
        $sampai = $request->sampai;
        $tanggalSampai = Carbon::parse($sampai)->addDays(1)->format('Y-m-d');
        $orders = Order::whereBetween('created_at', [$dari, $tanggalSampai])->get();
        return view('admin.reportorder.cari',compact('orders', 'dari', 'sampai','order'));
    }

    public function cariSuperAdmin(Request $request)
    {
        $order = Order::all();
        $dari = Carbon::parse($request->dari)->format('Y-m-d');
        $sampai = Carbon::parse($request->sampai)->format('Y-m-d');
        $tanggalSampai = Carbon::parse($sampai); // Remove addDays(1) if necessary
        $orders = Order::whereBetween('created_at', [$dari, $tanggalSampai])->get();
        return view('super-admin.reportorder.cari', compact('order', 'dari', 'sampai', 'orders'));
    }

    public function create()
    {
        //
    }
    public function exportExcel(Request $request)
    {
        return Excel::download(new ExportReportOrder,"data_report_order.xlsx");
    }

    public function exportPdf(Request $request)
    {
    $orders = Order::query();

    // Filter berdasarkan tanggal dari dan sampai
    if ($request->dari && $request->sampai) {
        $orders->whereBetween('tanggal_langganan', [$request->dari, $request->sampai]);
    }

    $orders = $orders->get();

    // Buat PDF dengan data order yang difilter
    $pdf = FacadePdf::loadView('admin.reportorder.export_pdf', compact('orders'));

    // Download PDF
    return $pdf->download('report_order.pdf');
    }
  
    public function showDiagram(Request $request)
    {
    $dari = $request->input('dari', now()->startOfMonth()->toDateString());
    $sampai = $request->input('sampai', now()->endOfMonth()->toDateString());

        // Data harian
        $dailyOrders = Order::selectRaw('DATE(created_at) as date, COUNT(*) as total')
            ->groupBy('date')
            ->get();

        // Data bulanan
        $monthlyOrders = Order::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
            ->groupBy('month')
            ->get();

        // Data tahunan
        $yearlyOrders = Order::selectRaw('YEAR(created_at) as year, COUNT(*) as total')
            ->groupBy('year')
            ->get();

        return view('admin.reportorder.diagram', compact('dailyOrders', 'monthlyOrders', 'yearlyOrders', 'dari', 'sampai'));
    }

    public function showDiagramSuperAdmin(Request $request)
    {
    $dari = $request->input('dari', now()->startOfMonth()->toDateString());
    $sampai = $request->input('sampai', now()->endOfMonth()->toDateString());

        // Data harian
        $dailyOrders = Order::selectRaw('DATE(created_at) as date, COUNT(*) as total')
            ->groupBy('date')
            ->get();

        // Data bulanan
        $monthlyOrders = Order::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
            ->groupBy('month')
            ->get();

        // Data tahunan
        $yearlyOrders = Order::selectRaw('YEAR(created_at) as year, COUNT(*) as total')
            ->groupBy('year')
            ->get();

        return view('super-admin.reportorder.diagram', compact('dailyOrders', 'monthlyOrders', 'yearlyOrders', 'dari', 'sampai'));
    }

    public function printDiagram(Request $request)
    {
        $orders = Order::all();
        $dari = $request->input('dari');
        $sampai = $request->input('sampai');

        // Ambil data order berdasarkan rentang waktu yang diberikan
        $dailyOrders = Order::selectRaw('DATE(created_at) as date, COUNT(*) as total')
        ->whereBetween('created_at', [$dari, $sampai])
        ->groupBy('date')
        ->get();

        $monthlyOrders = Order::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
        ->whereYear('created_at', now()->year)
        ->groupBy('month')
        ->get();

        $yearlyOrders = Order::selectRaw('YEAR(created_at) as year, COUNT(*) as total')
        ->groupBy('year')
        ->get();

        $pdf = FacadePdf::loadView('admin.reportorder.diagram_order_report', compact('dailyOrders', 'monthlyOrders', 'yearlyOrders', 'dari', 'sampai','orders'));
        
        return $pdf->download('diagram_order_report_' . $dari . 'to' . $sampai . '.pdf');
    }

    public function printDiagramSuperAdmin(Request $request)
    {
        // Ambil data yang sama seperti di diagram untuk PDF
        $dari = $request->input('dari');
        $sampai = $request->input('sampai');

        // Ambil data order berdasarkan rentang waktu yang diberikan
        $dailyOrders = Order::selectRaw('DATE(created_at) as date, COUNT(*) as total')
        ->whereBetween('created_at', [$dari, $sampai])
        ->groupBy('date')
        ->get();

        $monthlyOrders = Order::selectRaw('MONTH(created_at) as month, COUNT(*) as total')
        ->whereYear('created_at', now()->year)
        ->groupBy('month')
        ->get();

        $yearlyOrders = Order::selectRaw('YEAR(created_at) as year, COUNT(*) as total')
        ->groupBy('year')
        ->get();

        // Generate PDF dengan data yang benar
        return view('super-admin.reportorder.diagram_order_report', compact('orders', 'dari', 'sampai'));

        // Kembalikan PDF yang dihasilkan
        return $pdf->download('diagram_order_report_' . $dari . 'to' . $sampai . '.pdf');
    }

    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id_order)
    {
        $data = Order::where('id_order', $id_order)->get();
        $id_order = urldecode($id_order);
    
        return view('admin.reportorder.view', compact('data'));
    }

    public function showSuperAdmin($id_order)
    {
        $data = Order::where('id_order', $id_order)->get();
        $id_order = urldecode($id_order);
    
        return view('super-admin.reportorder.view', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    public function filter(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $reportOrders = reportorder::whereBetween('tanggal_langganan', [$startDate, $endDate])->get();
        return view('reportorder.index', compact('reportorder'));
    }

    public function update(Request $request, string $id)
    {
        //
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}