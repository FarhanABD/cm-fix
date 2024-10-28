<?php

namespace App\Http\Controllers\Backend;

use App\Models\Paket;
use App\Models\Layanan;
use Illuminate\Http\Request;
use App\DataTables\PaketDataTable;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PaketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(PaketDataTable $dataTable)
    {
        return $dataTable->render('admin.paket.index');
    }

    public function indexSuperAdmin(PaketDataTable $dataTable)
    {
        return $dataTable->render('super-admin.paket.index');
    }

    public function create()
    {

        // Konfigurasi
        $idPrefix = 'PKT-';
        $idLength = 4;
        $layanans = Layanan::all();
        // Ambil nomor urut terakhir dari database (lebih efisien dengan query builder)
        $lastNumber = DB::table('pakets')
        ->latest('id')
        ->value(DB::raw("SUBSTRING(id_paket, LENGTH('$idPrefix') + 1)"));

        // Jika tidak ada data, mulai dari 1
        if ($lastNumber === null) {
            $lastNumber = 0;
        }

        $newIdPaket = $idPrefix . str_pad($lastNumber + 1, $idLength, '0', STR_PAD_LEFT);
        return view('admin.paket.create', compact('newIdPaket','layanans'));
    }

    public function createSuperAdmin()
    {

        // Konfigurasi
        $idPrefix = 'PKT-';
        $idLength = 4;
        $layanans = Layanan::all();
        // Ambil nomor urut terakhir dari database (lebih efisien dengan query builder)
        $lastNumber = DB::table('pakets')
        ->latest('created_at')
        ->value(DB::raw("SUBSTRING(id_paket, LENGTH('$idPrefix') + 1)"));

        // Jika tidak ada data, mulai dari 1
        if ($lastNumber === null) {
            $lastNumber = 0;
        }

        $newIdPaket = $idPrefix . str_pad($lastNumber + 1, $idLength, '0', STR_PAD_LEFT);
        return view('super-admin.paket.create', compact('newIdPaket','layanans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        request()->validate([
            'id_paket' => ['required'],
            'jenis_layanan' => ['required', 'max:200',],
            'jenis_paket' => ['required'],
            'kuota' => ['required'],
            'harga' => ['required'],
        ],
        [
            'jenis_layanan.required' => 'Pilih Jenis Layanan',
            'jenis_paket.required' => 'Pilih Jenis Paket',
            'kuota.required' => 'Masukkan Kuota Custom',
            'harga.required' => 'Masukkan harga paket',
        ]
    
    );

        $pakets = new Paket();
        $pakets->id_paket = $request->id_paket; 
        $pakets->jenis_layanan = $request->jenis_layanan;
        $pakets->jenis_paket = $request->jenis_paket;
        $pakets->kuota = $request->kuota;
        $pakets->harga = $request->harga;
        $pakets->save();
        
        toastr('Created Successfully','success');
        return redirect()->route('admin.paket.index');
    }
    public function storeSuperAdmin(Request $request)
    {
        request()->validate([
            'id_paket' => ['required'],
            'jenis_layanan' => ['required', 'max:200',],
            'jenis_paket' => ['required'],
            'kuota' => ['required'],
            'harga' => ['required'],
        ],

        [
            'jenis_layanan.required' => 'Pilih Jenis Layanan',
            'jenis_paket.required' => 'Pilih Jenis Paket',
            'kuota.required' => 'Masukkan Kuota Custom',
            'harga.required' => 'Masukkan harga paket',
        ]
    );

        $pakets = new Paket();
        $pakets->id_paket = $request->id_paket; 
        $pakets->jenis_layanan = $request->jenis_layanan;
        $pakets->jenis_paket = $request->jenis_paket;
        $pakets->kuota = $request->kuota;
        $pakets->harga = $request->harga;
        $pakets->save();
        
        toastr('Created Successfully','success');
        return redirect()->route('super-admin.paket.indexSuperAdmin');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $pakets = Paket::findOrFail($id);
        $layanans = Layanan::all();
        return view('admin.paket.edit',compact('pakets','layanans'));
    }
    public function editSuperAdmin(string $id)
    {
        $pakets = Paket::findOrFail($id);
        $layanans = Layanan::all();
        return view('super-admin.paket.edit',compact('pakets','layanans'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request ->validate([
            'id_paket' => ['max:200'],
            'jenis_layanan' => ['nullable'],
            'jenis_paket' => ['nullable'],
            'kuota' => ['nullable'],
            'harga' => ['nullable'],    
         ]);

         $pakets = Paket::findOrFail($id);
         $pakets->id_paket = $request->id_paket;
         $pakets->jenis_layanan = $request->jenis_layanan;
         $pakets->jenis_paket = $request->jenis_paket;
         $pakets->kuota = $request->kuota;
         $pakets->harga = $request->harga;
         $pakets->save();
         
         toastr('Updated Successfully','success');
         return redirect()->route('admin.paket.index');
    }
    public function updateSuperAdmin(Request $request, string $id)
    {
        $request ->validate([
            'id_paket' => ['max:200'],
            'jenis_layanan' => ['nullable'],
            'jenis_paket' => ['nullable'],
            'kuota' => ['nullable'],
            'harga' => ['nullable'],    
         ]);

         $pakets = Paket::findOrFail($id);
         $pakets->id_paket = $request->id_paket;
         $pakets->jenis_layanan = $request->jenis_layanan;
         $pakets->jenis_paket = $request->jenis_paket;
         $pakets->kuota = $request->kuota;
         $pakets->harga = $request->harga;
         $pakets->save();
         
         toastr('Updated Successfully','success');
         return redirect()->route('super-admin.paket.indexSuperAdmin');
    }

    public function destroy(string $id)
    {
        $pakets = Paket::findOrFail($id);
        $pakets->delete();

        return response(['status'=>'success','message'=> 'Deleted Successfully']);
    }
}