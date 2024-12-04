<?php

namespace App\Http\Controllers\Backend;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Paket;
use App\Models\Layanan;
use App\Models\Perusahaan;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Helpers\RomanizeHelper;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\TransaksiDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    public function index()
    {
        $paket = Paket::all();
        $layanans = Layanan::all();
        $perusahaans = Perusahaan::all();
        $cart = Cart::all();
        $now = Carbon::now();
        $tahun_bulan = $now->year . $now->month;
        $cek = Order::count();

        if ($cek == 0) {
            $urut = 1;
            $nomor = str_pad($urut, 3, '0', STR_PAD_LEFT) . '/PO/CMI/' . RomanizeHelper::romanize($now->month) . '/' . $now->year;
        } else {
            $ambil = Order::latest()->first();
            $urut = (int)substr($ambil->id_order, 0, 3) + 1;
            $nomor = str_pad($urut, 3, '0', STR_PAD_LEFT) . '/PO/CMI/' . RomanizeHelper::romanize($now->month) . '/' . $now->year;
        }

        return view('admin.cart.index', compact( 'cart', 'nomor', 'perusahaans', 'paket', 'layanans'));
    }

    public function indexSuperAdmin()
    {
        $paket = Paket::all();
        $layanans = Layanan::all();
        $perusahaans = Perusahaan::all();
        $cart = Cart::all();
        $now = Carbon::now();
        $tahun_bulan = $now->year . $now->month;
        $cek = Order::count();

        if ($cek == 0) {
            $urut = 1;
            $nomor = str_pad($urut, 3, '0', STR_PAD_LEFT) . '/PO/CMI/' . RomanizeHelper::romanize($now->month) . '/' . $now->year;
        } else {
            $ambil = Order::latest()->first();
            $urut = (int)substr($ambil->id_order, 0, 3) + 1;
            $nomor = str_pad($urut, 3, '0', STR_PAD_LEFT) . '/PO/CMI/' . RomanizeHelper::romanize($now->month) . '/' . $now->year;
        }

        return view('super-admin.cart.index', compact( 'cart', 'nomor', 'perusahaans', 'paket', 'layanans'));
    }

    public function create()
    {
      
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $sub_total = $data['harga'] * $data['jumlah'];
        $paketAda = Cart::where('id_paket', $request->id_paket)->first();
        if($paketAda) {
            return redirect()->route('admin.cart.index')->with('warning', 'Paket Yang Sama Sudah Tersedia');
        }else{
            $cart = new Cart();
            $cart->id_order = $request->id_order;
            $cart->no_paket = $request->no_paket;
            $cart->id_paket = $request->id_paket;
            $cart->harga = $request->harga;
            $cart->jumlah = $request->jumlah;
            $cart->kuota = $request->kuota;
            $cart->total = $sub_total;
            $cart->save();
        }
        // return redirect('/' . $user->role . '/cart');
        return redirect()->route('admin.cart.index');
    }

    public function storeSuperAdmin(Request $request)
    {
        $data = $request->all();
        $sub_total = $data['harga'] * $data['jumlah'];
        $paketAda = Cart::where('id_paket', $request->id_paket)->first();
        if($paketAda) {
            return redirect()->route('super-admin.cart.indexSuperAdmin')->with('warning', 'Paket Yang Sama Sudah Tersedia');
        }else{
            $cart = new Cart();
            $cart->id_order = $request->id_order;
            $cart->no_paket = $request->no_paket;
            $cart->id_paket = $request->id_paket;
            $cart->harga = $request->harga;
            $cart->jumlah = $request->jumlah;
            $cart->kuota = $request->kuota;
            $cart->total = $sub_total;
            $cart->save();
        }
        // return redirect('/' . $user->role . '/cart');
        return redirect()->route('super-admin.cart.indexSuperAdmin');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
      
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

    }

    public function hapusSemua()
    {
        $user = Auth::user();
        Cart::truncate(); // Menghapus semua data dari tabel Transaksi
        return redirect('/' . $user->role . '/cart');
    }
   
    public function update(Request $request, $id, $id_paket)
    {
        $user = Auth::user();
        $data = $request->all();
        $paket = Paket::find($id_paket);
        $sub_total = ($data['harga'] - ($data['diskon'] * $data['harga'] / 100)) * $data['jumlah'];
      
        $cart = Cart::find($id);
        $cart->jumlah = $request->jumlah;
        $cart->total = $sub_total;
        $cart->update();
        
        return redirect('/' . $user->role . '/cart');
    }

    public function bayar(Request $request)
    {
        $cart = Cart::all();
        if($cart->isEmpty())
        {
            return redirect()->route('admin.cart.index')->with('gagal', 'Transaksi Gagal');
        }
        else
        {
            try{
                $request->validate([
                    'id_order' => 'required',
                    'total' => 'required',
                    'ppn' => 'required', // Pastikan field ppn tervalidasi
                    'tanggal_langganan' => 'required',
                    'tanggal_habis' => 'required',
                ]);
    
                // Simpan order ke dalam tabel Order
                $order = new Order();
                $order->id_order = $request->id_order;
                $order->total = $request->total; // Total termasuk PPN
                $order->ppn = $request->ppn; // Simpan nilai PPN
                $order->total_amount = $request->total_amount; // Simpan nilai total amount
                $order->status = false;
                $order->tanggal_langganan = $request->tanggal_langganan;
                $order->tanggal_habis = $request->tanggal_habis;
                $order->save();
    
                // Simpan Data detail transaksi
                foreach ($cart as $data) {
                    $pakets = Paket::find($data->no_paket);
                    $perusahaan = Perusahaan::find($request->no_perusahaan);

                    $details = new TransaksiDetail();
                    $totalPerItem = $data->harga * $data->jumlah + $request->ppn;
                    $details->id_order = $data->id_order;
                    $details->no_perusahaan = $request->no_perusahaan;
                    $details->id_perusahaan = $perusahaan->id_perusahaan;
                    $details->nama_perusahaan = $perusahaan->nama_perusahaan;
                    $details->nama_pic = $perusahaan->nama_pic;
                    $details->phone_pic = $perusahaan->phone_pic;
                    $details->email_pic = $perusahaan->email_pic;
                    $details->alamat = $perusahaan->kota;
                    $details->jenis_layanan = $pakets->jenis_layanan;
                    $details->jenis_paket = $pakets->jenis_paket;
                    $details->harga = $data->harga;
                    $details->jumlah = $data->jumlah;
                    $details->ppn = $request->ppn;
                    $details->total_amount = $request->total_amount;
                    $details->total = $totalPerItem; // Total termasuk PPN
                    $details->tanggal_langganan = $request->tanggal_langganan;
                    $details->tanggal_habis = $request->tanggal_habis;
                    $details->save();
                }
                // Kosongkan cart
                Cart::truncate();
    
            } catch (\Exception $e) {
                // Jika ada error, tangani
                dd($e->getMessage());
            }
            toastr('Berhasil', 'success');
            return redirect()->route('admin.invoice.index');
        }
    }

    public function bayarSuperAdmin(Request $request)
    {
        $cart = Cart::all();
        if($cart->isEmpty())
        {
            return redirect()->route('admin.cart.index')->with('gagal', 'Transaksi Gagal');
        }
        else
        {
            try{
                $request->validate([
                    'id_order' => 'required',
                    'total' => 'required',
                    'ppn' => 'required', // Pastikan field ppn tervalidasi
                    'tanggal_langganan' => 'required',
                    'tanggal_habis' => 'required',
                ]);
    
                // Simpan order ke dalam tabel Order
                $order = new Order();
                $order->id_order = $request->id_order;
                $order->total = $request->total; // Total termasuk PPN
                $order->ppn = $request->ppn; // Simpan nilai PPN
                $order->total_amount = $request->total_amount; // Simpan nilai total amount
                $order->status = false;
                $order->tanggal_langganan = $request->tanggal_langganan;
                $order->tanggal_habis = $request->tanggal_habis;
                $order->save();
    
                // Simpan detail transaksi
                foreach ($cart as $data) {
                    $pakets = Paket::find($data->no_paket);
                    $perusahaan = Perusahaan::find($request->no_perusahaan);

                    $details = new TransaksiDetail();
                    $totalPerItem = $data->harga * $data->jumlah + $request->ppn;

                    $details->id_order = $data->id_order;
                    $details->no_perusahaan = $request->no_perusahaan;
                    $details->id_perusahaan = $perusahaan->id_perusahaan;
                    $details->nama_perusahaan = $perusahaan->nama_perusahaan;
                    $details->nama_pic = $perusahaan->nama_pic;
                    $details->phone_pic = $perusahaan->phone_pic;
                    $details->email_pic = $perusahaan->email_pic;
                    $details->alamat = $perusahaan->alamat;
                    $details->jenis_layanan = $pakets->jenis_layanan;
                    $details->jenis_paket = $pakets->jenis_paket;
                    $details->harga = $data->harga;
                    $details->jumlah = $data->jumlah;
                    $details->ppn = $request->ppn;
                    $details->total_amount = $request->total_amount;
                    $details->total = $totalPerItem; // Total termasuk PPN
                    $details->tanggal_langganan = $request->tanggal_langganan;
                    $details->tanggal_habis = $request->tanggal_habis;
                    $details->save();
                }
                // Kosongkan cart
                Cart::truncate();
    
            } catch (\Exception $e) {
                // Jika ada error, tangani
                dd($e->getMessage());
            }
            toastr('Berhasil', 'success');
            return redirect()->route('super-admin.invoice.indexSuperAdmin');
        }
    }

    public function destroy($id)
    {
        $user = Auth::user();
        $cart = Cart::find($id);
        $cart->delete();

        // return redirect()->route('admin.cart.index');
        return redirect('/' . $user->role . '/cart');
    }
}