<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\PerusahaanDataTable;
use App\Models\Perusahaan;

class PerusahaanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(PerusahaanDataTable $dataTable)
    {
        return $dataTable->render('admin.perusahaan.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.perusahaan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
           'email' => ['required'] ,
           'nama_perusahaan' => ['required','max:200'],
           'jenis_perusahaan' => ['required'],
           'phone' => ['required'],
           'alamat' => ['required'],
           'nama_website' => ['required'],
           'keterangan' => ['required'],
        ]);

        $perusahaans = new Perusahaan();;
        $perusahaans->email = $request->email;
        $perusahaans->nama_perusahaan = $request->nama_perusahaan;
        $perusahaans->jenis_perusahaan = $request->jenis_perusahaan;
        $perusahaans->phone = $request->phone;
        $perusahaans->alamat = $request->alamat;
        $perusahaans->nama_website = $request->nama_website;
        $perusahaans->keterangan = $request->keterangan;
        $perusahaans->save();

        toastr('created successfully', 'success');
        return redirect()->route('admin.perusahaan.index');
        
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
        $perusahaans = Perusahaan::findOrFail($id);
        return view('admin.perusahaan.edit',compact('perusahaans'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'email' => ['nullable'] ,
            'nama_perusahaan' => ['','max:200'],
            'jenis_perusahaan' => [''],
            'phone' => [''],
            'alamat' => ['max:200'],
            'nama_website' => ['max:200'],
            'keterangan' => ['nullable'],
         ]);
 
         $perusahaans = Perusahaan::findOrFail($id);
         $perusahaans->email = $request->email;
         $perusahaans->nama_perusahaan = $request->nama_perusahaan;
         $perusahaans->jenis_perusahaan = $request->jenis_perusahaan;
         $perusahaans->phone = $request->phone;
         $perusahaans->alamat = $request->alamat;
         $perusahaans->nama_website = $request->nama_website;
         $perusahaans->keterangan = $request->keterangan;
         $perusahaans->save();
 
         toastr('updated successfully', 'success');
         return redirect()->route('admin.perusahaan.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}