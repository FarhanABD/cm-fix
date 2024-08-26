<?php

namespace App\Http\Controllers\Backend;

use App\Models\Perusahaan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\PerusahaanDataTable;

class SuperAdminPerusahaanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(PerusahaanDataTable $dataTable)
    {
        return $dataTable->render('super-admin.perusahaan.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('super-admin.perusahaan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store (Request $request)
    {
        $request->validate([
           'email' => ['required'] ,
           'nama_perusahaan' => ['required','max:200'],
           'jenis_perusahaan' => ['required'],
           'phone' => ['required'],
           'alamat' => ['required'],
           'nama_website' => ['required'],
           'keterangan' => ['required'],
           'nama_pic' => ['required'],
           'phone_pic' => ['required'],
           'email_pic' => ['required'],
           'keterangan_pic' => ['required'],
        ]);

        $perusahaans = new Perusahaan();
        $perusahaans->email = $request->email;
        $perusahaans->nama_perusahaan = $request->nama_perusahaan;
        $perusahaans->jenis_perusahaan = $request->jenis_perusahaan;
        $perusahaans->phone = $request->phone;
        $perusahaans->alamat = $request->alamat;
        $perusahaans->nama_website = $request->nama_website;
        $perusahaans->keterangan = $request->keterangan;
        $perusahaans->nama_pic = $request->nama_pic;
        $perusahaans->phone_pic = $request->phone_pic;
        $perusahaans->email_pic = $request->email_pic;
        $perusahaans->keterangan_pic = $request->keterangan_pic;
        $perusahaans->save();

        toastr('created successfully', 'success');
        return redirect()->route('super-admin.perusahaan.index');

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
        return view('super-admin.perusahaan.edit',compact('perusahaans'));
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

         $request->validate([
            'nama_pic' => ['required', 'max:100'],
            'phone' => ['required'],
            'email' => ['required', 'email'],
            'keterangan' => ['required'],
        ]);
 
         $perusahaans = Perusahaan::findOrFail($id);
         $perusahaans->email = $request->email;
         $perusahaans->nama_perusahaan = $request->nama_perusahaan;
         $perusahaans->jenis_perusahaan = $request->jenis_perusahaan;
         $perusahaans->phone = $request->phone;
         $perusahaans->alamat = $request->alamat;
         $perusahaans->nama_website = $request->nama_website;
         $perusahaans->keterangan = $request->keterangan;
         $perusahaans->nama_pic = $request->nama_pic;
         $perusahaans->phone_pic = $request->phone_pic;
         $perusahaans->email_pic = $request->email_pic;
         $perusahaans->keterangan_pic = $request->keterangan_pic;
         $perusahaans->save();

 
         toastr('updated successfully', 'success');
         return redirect()->route('super-admin.perusahaan.index');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $perusahaans = Perusahaan::findOrFail($id);
        $perusahaans->delete();

        return response(['status'=>'success','message'=> 'Deleted Successfully']);
    }
}