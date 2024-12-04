<?php

namespace App\Http\Controllers\Backend;

use App\Models\Paket;
use App\Models\Layanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\DataTables\LayananDataTable;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Services\DataTable;

class LayananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(LayananDataTable $dataTable)
    {
        return $dataTable->render('admin.layanan.index');
    }
    public function indexSuperAdmin(LayananDataTable $dataTable)
    {
        return $dataTable->render('super-admin.layanan.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Konfigurasi
        $idPrefix = 'LYN-';
        $idLength = 2;

        // Ambil nomor urut terakhir dari database (lebih efisien dengan query builder)
        $lastNumber = DB::table('layanans')
        ->latest('id')
        ->value(DB::raw("SUBSTRING(id_layanan, LENGTH('$idPrefix') + 1)"));

        // Jika tidak ada data, mulai dari 1
        if ($lastNumber === null) {
            $lastNumber = 0;
        }

        $newIdLayanan = $idPrefix . str_pad($lastNumber + 1, $idLength, '0', STR_PAD_LEFT);
        return view('admin.layanan.create', compact('newIdLayanan'));
    }

    public function createSuperAdmin()
    {
        // Konfigurasi
        $idPrefix = 'LYN-';
        $idLength = 2;

        // Ambil nomor urut terakhir dari database (lebih efisien dengan query builder)
        $lastNumber = DB::table('layanans')
        ->latest('id')
        ->value(DB::raw("SUBSTRING(id_layanan, LENGTH('$idPrefix') + 1)"));

        // Jika tidak ada data, mulai dari 1
        if ($lastNumber === null) {
            $lastNumber = 0;
        }

        $newIdLayanan = $idPrefix . str_pad($lastNumber + 1, $idLength, '0', STR_PAD_LEFT);
        return view('super-admin.layanan.create', compact('newIdLayanan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_layanan' => 'required|unique:layanans,id_layanan',
            'jenis_layanan' => 'required',
            'deskripsi_layanan' => 'required',
        ], 
        [
            'jenis_layanan.required' => 'Jenis Layanan wajib diisi.',
            'deskripsi_layanan.required' => 'Deskripsi Layanan wajib diisi.',
        ]
    
    );
    
        $layanan = new Layanan();
        $layanan->id_layanan = $request->id_layanan;
        $layanan->deskripsi_layanan= $request->deskripsi_layanan;
        $layanan->jenis_layanan = $request->jenis_layanan;
        $layanan->save();
    
        toastr('Layanan created successfully', 'success');
        return redirect()->route('admin.layanan.index');
    }

    public function storeSuperAdmin(Request $request)
    {
        $request->validate([
            'id_layanan' => 'required|unique:layanans,id_layanan',
            'jenis_layanan' => 'required',
        ]);
    
        $layanan = new Layanan();
        $layanan->id_layanan = $request->id_layanan;
        $layanan->deskripsi_layanan = $request->deskripsi_layanan;
        $layanan->jenis_layanan = $request->jenis_layanan;
        $layanan->save();
    
        toastr('Layanan created successfully', 'success');
        return redirect()->route('super-admin.layanan.indexSuperAdmin');
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
        return view('admin.layanan.edit',compact('layanans'));

    }
    public function editSuperAdmin(string $id)
    {
        $layanans = Layanan::findOrFail($id);
        return view('super-admin.layanan.edit',compact('layanans'));

    }

    public function update(Request $request, string $id)
    {
        $request ->validate([
            
            'jenis_layanan' => ['nullable'],
            'deskripsi_layanan' => ['nullable'],
         ]);

         $layanans = Layanan::findOrFail($id);
         $layanans->jenis_layanan = $request->jenis_layanan;
         $layanans->deksripsi_layanan = $request->deskripsi_layanan;
         $layanans->save();
         
         toastr('Updated Successfully','success');
         return redirect()->route('admin.layanan.index');
    }
    public function updateSuperAdmin(Request $request, string $id)
    {
        $request ->validate([
            
            'jenis_layanan' => ['nullable'],
            'jenis_layanan' => ['nullable'],
         ]);

         $layanans = Layanan::findOrFail($id);
         $layanans->jenis_layanan = $request->jenis_layanan;
         $layanans->deskripsi_layanan = $request->deskripsi_layanan;
         $layanans->save();
         
         toastr('Updated Successfully','success');
         return redirect()->route('super-admin.layanan.indexSuperAdmin');
    }

    public function destroy(string $id)
    {
        $layanans = Layanan::findOrFail($id);
        $pakets = Paket::where('jenis_layanan',$layanans->jenis_layanan)->count();
        if($pakets > 0){
            return response(['status'=>'error','message'=> 'Item ini berelasi dengan paket']);  
        }
        $layanans->delete();
        return response(['status'=>'success','message'=> 'Deleted Successfully']);
    }
}