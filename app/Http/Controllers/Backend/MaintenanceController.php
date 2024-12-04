<?php

namespace App\Http\Controllers\Backend;
use App\Models\Order;
use App\Models\Invoice;
use App\Mail\ReminderEmail;
use App\Models\Maintenance;
use Illuminate\Http\Request;
use App\Mail\NotificationMail;
use App\Models\TransaksiDetail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Mail\MaintenanceReminderMail;
use App\DataTables\MaintenanceDataTable;


class MaintenanceController extends Controller
{
    public function index()
    {
        // Ambil semua orders yang mendekati H-30
        $orders = Order::where('tanggal_habis', '<', DB::raw('DATE_ADD(NOW(), INTERVAL 30 DAY)'))->get();
        // Periksa apakah ada order yang mendekati H-30
        $hasOrdersNearExpiry = $orders->isNotEmpty(); // Cek jika tidak kosong
        return view('admin.maintenance.index', compact('orders', 'hasOrdersNearExpiry'));
    }

    // public function index()
    // {
    //     // Ambil semua orders yang mendekati H-30
    //     $orders = Order::where('tanggal_habis', '<', DB::raw('DATE_ADD(NOW(), INTERVAL 30 DAY)'))->get();
    //     // Periksa apakah ada order yang mendekati H-30

    //     $hasOrdersNearExpiry = $orders->isNotEmpty(); // Cek jika tidak kosong
    //     if ($hasOrdersNearExpiry) {
    //         foreach ($orders as $order) {
    //             // Ambil detail transaksi berdasarkan ID order
    //             $orderDetails = TransaksiDetail::where('id_order', $order->id)->get();
    //             foreach ($orderDetails as $detail) {
    //                 try {
    //                     // Kirim email ke PIC
    //                     Mail::to($detail->pic_email)->send(new NotificationMail($order));
    //                     // Log atau lakukan tindakan lain jika berhasil
    //                     Log::info('Email berhasil dikirim ke: ' . $detail->pic_email);
    //                 } catch (\Exception $e) {
    //                     // Log kesalahan jika pengiriman gagal
    //                     Log::error('Email gagal dikirim ke: ' . $detail->pic_email . ' Error: ' . $e->getMessage());
    //                 }
    //             }
    //         }
    //     }
    //     return view('admin.maintenance.index', compact('orders', 'hasOrdersNearExpiry'));
    // }
    
    public function indexSuperAdmin(MaintenanceDataTable $dataTable)
    {
        $orders = Order::where('tanggal_habis', '<', DB::raw('DATE_ADD(NOW(), INTERVAL 30 DAY)'))->get();
        // Periksa apakah ada order yang mendekati H-30
        $hasOrdersNearExpiry = $orders->isNotEmpty(); // Cek jika tidak kosong
        return view('super-admin.maintenance.index', compact('orders', 'hasOrdersNearExpiry'));
    }

    public function create($id_order)
    {
        $order = Order::findOrFail($id_order);
        $details = TransaksiDetail::all();
        $orders =  Order::with(['transaksiDetails.perusahaan'])->get();
        return view('admin.maintenance.perpanjang',compact('orders','details','order'));
    }

    public function createSuperAdmin($id_order)
    {
        $order = Order::findOrFail($id_order);
        $details = TransaksiDetail::all();
        $orders =  Order::with(['transaksiDetails.perusahaan'])->get();
        return view('super-admin.maintenance.perpanjang',compact('orders','details','order'));
    }

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
            'ppn.required' => 'Masukkan PPN',
            'price.required' => 'Masukkan price',
            'item_desc.required' => 'Masukkan item description',
            'jenis_layanan.required' => 'Masukkan Jenis Layanan',
            'jenis_paket.required' => 'Masukkan Jenis Paket',
            'total.required' => 'Masukkan total',
        ]
    );

        $total = str_replace(['Rp.', '.', ','], '', $request->total);
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
        $invoice->ppn = $request->ppn;
        $invoice->total_amount = $request->total_amount;
        $invoice->price = $request->price;
        $invoice->total = $total;
        $invoice->save();
        
        try {
            $maintenanace = new Maintenance();
            $maintenanace->id_invoice = $request->id_invoice;
            $maintenanace->id_order = $request->id_order;
            $maintenanace->jenis_layanan = $request->jenis_layanan;
            $maintenanace->jenis_paket = $request->jenis_paket;
            $maintenanace->tanggal_langganan = $request->tanggal_langganan;
            $maintenanace->tanggal_habis = $request->tanggal_habis;
            $maintenanace->total = $total;
            $maintenanace->ppn = $request->ppn;
            $maintenanace->total_amount = $request->total_amount;
            $maintenanace->save();
            toastr('Data Berhasil Diperpanjang', 'success');
        } catch (\Exception $e) {
            // Handle the error and flash the error message
            return redirect()->back()->withErrors(['msg' => 'Gagal Perpanjang Data: ' . $e->getMessage()]);
        }

        return redirect()->route('admin.invoice.index');
    }

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
            'ppn.required' => 'Masukkan PPN',
            'price.required' => 'Masukkan price',
            'item_desc.required' => 'Masukkan item description',
            'jenis_layanan.required' => 'Masukkan Jenis Layanan',
            'jenis_paket.required' => 'Masukkan Jenis Paket',
            'total.required' => 'Masukkan total',
        ]
    );

        $total = str_replace(['Rp.', '.', ','], '', $request->total);
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
        $invoice->ppn = $request->ppn;
        $invoice->price = $request->price;
        $invoice->total = $total;
        $invoice->save();
        
        try {
            $maintenanace = new Maintenance();
            $maintenanace->id_invoice = $request->id_invoice;
            $maintenanace->id_order = $request->id_order;
            $maintenanace->jenis_layanan = $request->jenis_layanan;
            $maintenanace->jenis_paket = $request->jenis_paket;
            $maintenanace->tanggal_langganan = $request->tanggal_langganan;
            $maintenanace->tanggal_habis = $request->tanggal_habis;
            $maintenanace->total = $total;
            $maintenanace->ppn = $request->ppn;
            $maintenanace->save();
            toastr('Data Berhasil Diperpanjang', 'success');
        } catch (\Exception $e) {
            // Handle the error and flash the error message
            return redirect()->back()->withErrors(['msg' => 'Gagal Perpanjang Data: ' . $e->getMessage()]);
        }

        return redirect()->route('super-admin.invoice.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id_order)
    {
        $data = TransaksiDetail::where('id_order', $id_order)->get();
        $id_order = urldecode($id_order);
    
        return view('admin.maintenance.view', compact('data'));
    }

    public function showSuperAdmin($id_order)
    {
        $data = Order::where('id_order', $id_order)->get();
        $id_order = urldecode($id_order);
    
        return view('super-admin.maintenance.view', compact('data'));
    }

    public function cetak(string $id_invoice)
    {
        $data = Invoice::where('id_invoice', $id_invoice)->get();
        // $details = TransaksiDetail::where('id_order', $id_order)->get();
        $id_invoice = urldecode($id_invoice);
        return view('admin.invoice.cetak', compact('data','id_invoice'));
    }

    public function cetakSuperAdmin(string $id_invoice)
    {
        $data = Invoice::where('id_invoice', $id_invoice)->get();
        // $details = TransaksiDetail::where('id_order', $id_order)->get();
        $id_invoice = urldecode($id_invoice);
        return view('super-admin.invoice.cetak', compact('data','id_invoice'));
    }

    public function edit(string $id)
    {
        //
    }

    public function sendReminder(Request $request, $id_order)
    {
        $order = Order::findOrFail($id_order);
        // Validate request data (optional)
        $request->validate([
            'reminder_message' => 'nullable|string',
        ]);

        $email = $order->invoice->pic_email; // Assuming "pic_email" exists in the Invoice model
        $message = $request->get('reminder_message');

        try {
            Mail::to($email)->send(new MaintenanceReminderMail($order, $message));
            flash('success', 'Reminder email sent successfully!');
        } catch (\Exception $e) {
            report($e);
            flash('error', 'Failed to send reminder email!');
        }

        return back();
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