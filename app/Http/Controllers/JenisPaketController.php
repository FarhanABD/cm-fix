<?php

namespace App\Http\Controllers;

use App\Models\JenisPaket;
use Illuminate\Http\Request;
use App\DataTables\JenisPaketDataTable;

class JenisPaketController extends Controller
{
    public function index(JenisPaketDataTable $dataTable)
    {
        return $dataTable->render('admin.jenis-paket.index');
    }

    public function create()
    {
        return view('admin.jenis-paket.create');
    }

    public function store(Request $request)
    {
        request()->validate([
            'jenis_paket' => ['required'],
            'deskripsi_paket' => ['required', 'max:200',],
        ],
        [
            'jenis_paket.required' => 'Pilih Jenis Paket',
            'deskripsi_paket.required' => 'Masukkan Deskripsi Paket',
        ]
    );

        $jenispakets = new JenisPaket();
        $jenispakets->jenis_paket = $request->jenis_paket;
        $jenispakets->deskripsi_paket = $request->deskripsi_paket;
        $jenispakets->save();

        toastr('Created Successfully','success');
        return redirect()->route('admin.jenis-paket.index');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $Jenispakets = JenisPaket::findOrFail($id);
        return view('admin.jenis-paket.edit',compact('Jenispakets'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        request()->validate([
            'jenis_paket' => ['nullable'],
            'deskripsi_paket' => ['nullable', 'max:200',],
        ],
    );

        $jenispakets = JenisPaket::findOrFail($id);
        $jenispakets->jenis_paket = $request->jenis_paket;
        $jenispakets->deskripsi_paket = $request->deskripsi_paket;
        $jenispakets->save();

        toastr('Created Successfully','success');
        return redirect()->route('admin.jenis-paket.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}