<?php

namespace App\Http\Controllers\Backend;
use Dompdf\Dompdf;
use App\Models\Order;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\TransaksiDetail;
use Barryvdh\DomPDF\Facade\Pdf;
use Barryvdh\Snappy\Facades\SnappyPdf;
use Illuminate\Support\Facades\DB;
use App\DataTables\InvoiceDataTable;
use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;

class InvoiceController extends Controller
{
    public function index(InvoiceDataTable $dataTable)
    {
        $invoices = Invoice::orderBy('created_at', 'asc')->get();
        return view('admin.invoice.index', compact('invoices'));
    }
    
    public function indexSuperAdmin(InvoiceDataTable $dataTable)
    {
        $invoices = Invoice::orderBy('created_at', 'asc')->get();
        return view('super-admin.invoice.index', compact('invoices'));
    }

    public function create()
    {
        $details = TransaksiDetail::all();
        $orders = Order::with(['transaksiDetails.perusahaan'])->get();
        return view('admin.invoice.create',compact('details','orders'));
    }
    public function createSuperAdmin()
    {
        $details = TransaksiDetail::all();
        $orders = Order::with(['transaksiDetails.perusahaan'])->get();
        return view('super-admin.invoice.create',compact('details','orders'));
    }

    //-------------------- METHOD STORE ADMIN ------------------//
    public function store(Request $request)
    {
        $request->validate([
            'id_invoice' => ['required'],
            'id_order' => ['required'],
            'tanggal_langganan' => ['required'],
            'tanggal_habis' => ['required'],
            'nama_perusahaan' => ['required'],
            'alamat' => ['required'],
            'kota' => ['required'],
            'provinsi' => ['required'],
            'country' => ['required'],
            'phone_pic' => ['required'],
            'nama_pic' => ['required'],
            'email_pic' => ['required'],
            'qty' => ['required'],
            'price' => ['required'],
            'ppn' => ['required'],
            'item_desc' => ['nullable'],
            'jenis_layanan' => ['required'],
            'jenis_paket' => ['required'],
            'total' => ['required'],
        ],
    
        [
            'id_invoice.required' => 'Masukkan ID Invoice',
            'id_order.required' => 'Masukkan ID Order',
            'tanggal_langganan.required' => 'Masukkan Tanggal Langganan',
            'tanggal_habis.required' => 'Masukkan Tanggal Habis',
            'nama_perusahaan.required' => 'Masukkan Nama Customer',
            'alamat.required' => 'Masukkan alamat',
            'kota.required' => 'Masukkan kota',
            'provinsi.required' => 'Masukkan Provinsi',
            'country.required' => 'Masukkan Negara',
            'phone_pic.required' => 'Masukkan no telepon PIC',
            'nama_pic.required' => 'Masukkan Nama PIC',
            'email_pic.required' => 'Masukkan email PIC',
            'qty.required' => 'Masukkan email PIC',
            'price.required' => 'Masukkan email PIC',
            'ppn.required' => 'Masukkan email PPN',
            'item_desc.required' => 'Masukkan item description',
            'jenis_layanan.required' => 'Masukkan Jenis Layanan',
            'jenis_paket.required' => 'Masukkan Jenis Paket',
            'total.required' => 'Masukkan total',
        ]
    );
    
        $total = str_replace(['Rp.', '.', ','], '', $request->total);
        $ppn = str_replace(['Rp.', '.', ','], '', $request->ppn);
        // $ppn = $this->formatRupiah($request->ppn);
       
        // Create a new invoice
        $invoice = new Invoice();

        $invoice->id_invoice = $request->id_invoice;
        $invoice->id_order = $request->id_order;
        $invoice->nama_perusahaan = $request->nama_perusahaan;
        $invoice->jenis_layanan = $request->jenis_layanan;
        $invoice->jenis_paket = $request->jenis_paket;
        $invoice->tanggal_langganan = $request->tanggal_langganan;
        $invoice->tanggal_habis = $request->tanggal_habis;
        $invoice->alamat = $request->alamat;
        $invoice->kota = $request->kota;
        $invoice->provinsi = $request->provinsi;
        $invoice->country = $request->country;
        $invoice->phone_pic = $request->phone_pic;
        $invoice->nama_pic = $request->nama_pic;
        $invoice->email_pic = $request->email_pic;
        $invoice->item_desc = $request->item_desc;
        $invoice->qty = $request->qty;
        $invoice->price = $request->price;
        $invoice->total_amount = $request->total_amount;
        $invoice->ppn = $ppn;
        $invoice->total = $total;
        $invoice->save();
        
        try {
            // Save the invoice
            toastr('Created Successfully', 'success');
        } catch (\Exception $e) {
            // Handle the error and flash the error message
            return redirect()->back()->withErrors(['msg' => 'Failed to create invoice: ' . $e->getMessage()]);
        }

    return redirect()->route('admin.invoice.index');
    }
    //-------------------- METHOD STORE SUPERADMIN ------------------//
    public function storeSuperAdmin(Request $request)
    {
        $request->validate([
            'id_invoice' => ['required'],
            'id_order' => ['required'],
            'tanggal_langganan' => ['required'],
            'tanggal_habis' => ['required'],
            'nama_perusahaan' => ['required'],
            'alamat' => ['required'],
            'kota' => ['required'],
            'provinsi' => ['required'],
            'country' => ['required'],
            'phone_pic' => ['required'],
            'nama_pic' => ['required'],
            'email_pic' => ['required'],
            'qty' => ['required'],
            'price' => ['required'],
            'ppn' => ['required'],
            'item_desc' => ['nullable'],
            'jenis_layanan' => ['required'],
            'jenis_paket' => ['required'],
            'total' => ['required'],
        ],
    
        [
            'id_invoice.required' => 'Masukkan ID Invoice',
            'id_order.required' => 'Masukkan ID Order',
            'tanggal_langganan.required' => 'Masukkan Tanggal Langganan',
            'tanggal_habis.required' => 'Masukkan Tanggal Habis',
            'nama_perusahaan.required' => 'Masukkan Nama Customer',
            'alamat.required' => 'Masukkan alamat',
            'kota.required' => 'Masukkan kota',
            'provinsi.required' => 'Masukkan Provinsi',
            'country.required' => 'Masukkan Negara',
            'phone_pic.required' => 'Masukkan no telepon PIC',
            'nama_pic.required' => 'Masukkan Nama PIC',
            'email_pic.required' => 'Masukkan email PIC',
            'qty.required' => 'Masukkan email PIC',
            'price.required' => 'Masukkan email PIC',
            'ppn.required' => 'Masukkan email PPN',
            'item_desc.required' => 'Masukkan item description',
            'jenis_layanan.required' => 'Masukkan Jenis Layanan',
            'jenis_paket.required' => 'Masukkan Jenis Paket',
            'total.required' => 'Masukkan total',
        ]
    );
    
        $total = str_replace(['Rp.', '.', ','], '', $request->total);
        $ppn = str_replace(['Rp.', '.', ','], '', $request->ppn);
        // $ppn = $this->formatRupiah($request->ppn);
       
        // Create a new invoice
        $invoice = new Invoice();

        $invoice->id_invoice = $request->id_invoice;
        $invoice->id_order = $request->id_order;
        $invoice->nama_perusahaan = $request->nama_perusahaan;
        $invoice->jenis_layanan = $request->jenis_layanan;
        $invoice->jenis_paket = $request->jenis_paket;
        $invoice->tanggal_langganan = $request->tanggal_langganan;
        $invoice->tanggal_habis = $request->tanggal_habis;
        $invoice->alamat = $request->alamat;
        $invoice->kota = $request->kota;
        $invoice->provinsi = $request->provinsi;
        $invoice->country = $request->country;
        $invoice->phone_pic = $request->phone_pic;
        $invoice->nama_pic = $request->nama_pic;
        $invoice->email_pic = $request->email_pic;
        $invoice->item_desc = $request->item_desc;
        $invoice->qty = $request->qty;
        $invoice->price = $request->price;
        $invoice->total_amount = $request->total_amount;
        $invoice->ppn = $ppn;
        $invoice->total = $total;
        $invoice->save();
        
        try {
            // Save the invoice
            toastr('Created Successfully', 'success');
        } catch (\Exception $e) {
            // Handle the error and flash the error message
            return redirect()->back()->withErrors(['msg' => 'Failed to create invoice: ' . $e->getMessage()]);
        }
    return redirect()->route('super-admin.invoice.indexSuperAdmin');
    }

    public function show($id_invoice)
    {
        $data = Invoice::where('id_invoice', $id_invoice)->get();
        $id_invoice = urldecode($id_invoice);
    
        return view('admin.invoice.view', compact('data'));
    }
    public function showSuperAdmin($id_invoice)
    {
        $data = Invoice::where('id_invoice', $id_invoice)->get();
        // $data = Invoice::where('id', $id)->get();
        $id_invoice = urldecode($id_invoice);
    
        return view('super-admin.invoice.view', compact('data'));
    }
    
    public function cari(Request $request)
    {
        $order = Order::all();
        $dari = $request->dari;
        $sampai = $request->sampai;
        $tanggalSampai = Carbon::parse($sampai)->addDays(1)->format('Y-m-d');
        
        // $transaksi = Order::whereBetween('created_at', [$dari, $tanggalSampai])->get();
        $transaksi = Invoice::whereBetween('created_at', [$dari, $tanggalSampai])->get();
        return view('admin.invoice.cari',compact('transaksi', 'dari', 'sampai','order'));
    }

    public function cariSuperAdmin(Request $request)
    {
        $order = Order::all();
        $dari = $request->dari;
        $sampai = $request->sampai;
        $tanggalSampai = Carbon::parse($sampai)->addDays(1)->format('Y-m-d');
        
        // $transaksi = Order::whereBetween('created_at', [$dari, $tanggalSampai])->get();
        $transaksi = Invoice::whereBetween('created_at', [$dari, $tanggalSampai])->get();
        return view('super-admin.invoice.cari',compact('transaksi', 'dari', 'sampai','order'));
    }

    public function edit(string $id)
    {
        $invoice = Invoice::findOrFail($id);
        $orders = Order::with(['transaksiDetails.perusahaan'])->get();
        return view('admin.invoice.edit',compact('invoice','orders'));
    }
    public function editSuperAdmin(string $id)
    {
        $invoice = Invoice::findOrFail($id);
        $orders = Order::with(['transaksiDetails.perusahaan'])->get();
        return view('super-admin.invoice.edit',compact('invoice','orders'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'id_order' => ['nullable'],
            'tanggal_langganan' => ['nullable'],
            'tanggal_habis' => ['nullable'],
            'nama_perusahaan' => ['nullable'],
            'alamat' => ['nullable'],
            'kota' => ['nullable'],
            'provinsi' => ['nullable'],
            'country' => ['nullable'],
            'phone_pic' => ['nullable'],
            'nama_pic' => ['nullable'],
            'email_pic' => ['nullable'],
            'item_desc' => ['nullable'],
            'jenis_layanan' => ['nullable'],
            'jenis_paket' => ['nullable'],
            'price' => ['nullable'],
            'total' => ['nullable'],
            'qty' => ['nullable'],
        ]);

        $invoice = Invoice::findOrFail($id);
        $invoice->id_order = $request->id_order;
        $invoice->id_invoice = $request->id_invoice;
        $invoice->nama_perusahaan = $request->nama_perusahaan;
        $invoice->jenis_layanan = $request->jenis_layanan;
        $invoice->jenis_paket = $request->jenis_paket;
        $invoice->tanggal_langganan = $request->tanggal_langganan;
        $invoice->tanggal_habis = $request->tanggal_habis;
        $invoice->alamat = $request->alamat;
        $invoice->kota = $request->kota;
        $invoice->provinsi = $request->provinsi;
        $invoice->country = $request->country;
        $invoice->phone_pic = $request->phone_pic;
        $invoice->nama_pic = $request->nama_pic;
        $invoice->email_pic = $request->email_pic;
        $invoice->item_desc = $request->item_desc;
        $invoice->total = $request->total;
        $invoice->ppn = $request->ppn;
        $invoice->total_amount = $request->total_amount;
        $invoice->price = $request->price;
        $invoice->qty = $request->qty;
        $invoice->save();
        
        toastr('Updated Successfully','success');
        return redirect()->route('admin.invoice.index');
    }

    public function updateSuperAdmin(Request $request, string $id)
    {
        $request->validate([
            'id_order' => ['nullable'],
            'tanggal_langganan' => ['nullable'],
            'tanggal_habis' => ['nullable'],
            'nama_perusahaan' => ['nullable'],
            'alamat' => ['nullable'],
            'kota' => ['nullable'],
            'provinsi' => ['nullable'],
            'country' => ['nullable'],
            'phone_pic' => ['nullable'],
            'nama_pic' => ['nullable'],
            'email_pic' => ['nullable'],
            'item_desc' => ['nullable'],
            'jenis_layanan' => ['nullable'],
            'jenis_paket' => ['nullable'],
            'price' => ['nullable'],
            'total' => ['nullable'],
            'qty' => ['nullable'],
        ]);

        $invoice = Invoice::findOrFail($id);
        $invoice->id_order = $request->id_order;
        $invoice->id_invoice = $request->id_invoice;
        $invoice->nama_perusahaan = $request->nama_perusahaan;
        $invoice->jenis_layanan = $request->jenis_layanan;
        $invoice->jenis_paket = $request->jenis_paket;
        $invoice->tanggal_langganan = $request->tanggal_langganan;
        $invoice->tanggal_habis = $request->tanggal_habis;
        $invoice->alamat = $request->alamat;
        $invoice->kota = $request->kota;
        $invoice->provinsi = $request->provinsi;
        $invoice->country = $request->country;
        $invoice->phone_pic = $request->phone_pic;
        $invoice->nama_pic = $request->nama_pic;
        $invoice->email_pic = $request->email_pic;
        $invoice->item_desc = $request->item_desc;
        $invoice->total = $request->total;
        $invoice->ppn = $request->ppn;
        $invoice->total_amount = $request->total_amount;
        $invoice->price = $request->price;
        $invoice->qty = $request->qty;
        $invoice->save();
        
        toastr('Updated Successfully','success');
        return redirect()->route('super-admin.invoice.indexSuperAdmin');
    }

    public function cetakSuperAdmin(string $id_invoice)
    {
        $data = Invoice::where('id_invoice', $id_invoice)->get();
        $id_invoice = urldecode($id_invoice);
        return view('super-admin.invoice.cetak', compact('data','id_invoice'));
    }

    // public function cetak(string $id_invoice)
    // {
    //     $data = Invoice::where('id_invoice', $id_invoice)->get();
    //     $id_invoice = urldecode($id_invoice);

    //     $dompdf = new Dompdf();
    //     $dompdf->loadHtml(view('admin.invoice.cetak', compact('data', 'id_invoice'))->render());
    //     $dompdf->setPaper('A4', 'portrait');  // Optional: Set paper size and orientation

    //     return $dompdf->stream('invoice.pdf', ['Attachment' => true]);
    // }
    public function cetak(string $id_invoice)
    {
        $data = Invoice::where('id_invoice', $id_invoice)->get();
        $id_invoice = urldecode($id_invoice);
        return view('admin.invoice.cetak', compact('data','id_invoice'));
    }
    
    public function destroy(string $id)
    {
        //
    }
}