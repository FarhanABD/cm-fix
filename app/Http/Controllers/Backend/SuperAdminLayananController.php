<?php

namespace App\Http\Controllers\Backend;

use App\Models\Layanan;
use Illuminate\Http\Request;
use App\DataTables\LayananDataTable;
use App\Http\Controllers\Controller;

class SuperAdminLayananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(LayananDataTable $dataTable)
    {
        return $dataTable->render('super-admin.layanan.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('super-admin.layanan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request ->validate([
            'jenis_paket' => ['required'],
            'jenis_layanan' => ['required'],
            'harga' => ['required'],
            'kuota' => ['nullable'],
         ]);

         $layanans = new Layanan();
         $layanans->jenis_paket = $request->jenis_paket;
        //  $layanans->nama_paket = $request->nama_paket;
         $layanans->jenis_layanan = $request->jenis_layanan;
         $layanans->harga = $request->harga;
         $layanans->kuota = $request->kuota;
         $layanans->save();
         
         toastr('Created Successfully','success');
         return redirect()->route('super-admin.layanan.index');
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
        $layanans = Layanan::findOrFail($id);
        return view('super-admin.layanan.edit',compact('layanans'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request ->validate([
            'jenis_paket' => ['required'],
            'jenis_layanan' => ['required'],
            'harga' => ['required'],
            'kuota' => ['nullable'],
         ]);

         $layanans = Layanan::findOrFail($id);
         $layanans->jenis_paket = $request->jenis_paket;
         $layanans->jenis_layanan = $request->jenis_layanan;
         $layanans->harga = $request->harga;
         $layanans->kuota = $request->kuota;
         $layanans->save();
         
         toastr('Updated Successfully','success');
         return redirect()->route('super-admin.layanan.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $layanans = Layanan::findOrFail($id);
        $layanans->delete();

        return response(['status'=>'success','message'=> 'Deleted Successfully']);
    }
}