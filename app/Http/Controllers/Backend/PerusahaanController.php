<?php

namespace App\Http\Controllers\Backend;

use App\Models\Pic;
use App\Models\Perusahaan;
use Illuminate\Http\Request;
use App\Exports\ExportCustomer;
use App\Imports\Customerimport;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\DataTables\PerusahaanDataTable;
use Illuminate\Support\Facades\Storage;

class PerusahaanController extends Controller
{
   
    public function index(PerusahaanDataTable $dataTable)
    {
        return $dataTable->render('admin.perusahaan.index');
    }

    public function export_excel(){
        return Excel::download(new ExportCustomer,"data_customer.xlsx");
    }

    public function indexSuperAdmin(PerusahaanDataTable $dataTable)
    {
        return $dataTable->render('super-admin.perusahaan.index');
    }
    
    public function create()
    {
        $idPrefix = 'CS';
        $currentYear = date('Y'); // Tahun saat ini
        $currentMonth = date('m'); // Bulan saat ini
    
        // Cari jumlah customer untuk tahun dan bulan tertentu
        $lastNumber = DB::table('perusahaans')
            ->whereYear('created_at', $currentYear)
            ->whereMonth('created_at', $currentMonth)
            ->count(); // Hitung jumlah customer yang sudah ada di bulan ini
    
        // Increment untuk mendapatkan nomor urut berikutnya
        $nextNumber = str_pad($lastNumber + 1, 2, '0', STR_PAD_LEFT);
    
        // Gabungkan format ID
        $newIdPerusahaan = $idPrefix . '-' . $currentYear . '-' . $currentMonth . '-' . $nextNumber;
    
        $perusahaans = Perusahaan::all();
        return view('admin.perusahaan.create', compact('newIdPerusahaan', 'perusahaans'));
    }
    
    public function createSuperAdmin()
    {
         // Konfigurasi
         $idPrefix = 'CS';
         $currentYear = date('Y'); // Tahun saat ini
         $currentMonth = date('m'); // Bulan saat ini
     
         // Cari jumlah customer untuk tahun dan bulan tertentu
         $lastNumber = DB::table('perusahaans')
             ->whereYear('created_at', $currentYear)
             ->whereMonth('created_at', $currentMonth)
             ->count(); // Hitung jumlah customer yang sudah ada di bulan ini
     
         // Increment untuk mendapatkan nomor urut berikutnya
         $nextNumber = str_pad($lastNumber + 1, 2, '0', STR_PAD_LEFT);
     
         // Gabungkan format ID
         $newIdPerusahaan = $idPrefix . '-' . $currentYear . '-' . $currentMonth . '-' . $nextNumber;
     
         $perusahaans = Perusahaan::all();
         return view('super-admin.perusahaan.create', compact('newIdPerusahaan', 'perusahaans'));
    }
   
    public function store(Request $request)
    {
        $request->validate([
           'email' => 'required' ,
           'id_perusahaan' => 'required','unique:perusahaans,id_perusahaan',
           'nama_perusahaan' => 'required','max:200',
           'phone' => 'required',
           'kota' => 'required',
           'provinsi' => 'required',
           'negara' => 'required',
           'nama_website' => 'required',
           'keterangan' => 'required',
           'nama_pic' => 'required',
           'phone_pic' => 'required',
           'email_pic' => 'required',
           'keterangan_pic' => 'nullable',
        ],

        [
            'email.required' => 'Masukkan email customer',
            'nama_perusahaan.required' => 'Masukkan nama customer ',
            'phone.required' => 'Masukkan no Telepon customer ',
            'kota.required' => 'Masukkan Alamat Kota ',
            'provinsi.required' => 'Masukkan Alamat Provinsi ',
            'negara.required' => 'Masukkan Alamat Negara ',
            'nama_website.required' => 'Masukkan Nama Website customer ',
            'keterangan.required' => 'Masukkan Keterangan customer ',
            'nama_pic.required' => 'Masukkan Nama PIC ',
            'phone_pic.required' => 'Masukkan No Telepon PIC ',
            'email_pic.required' => 'Masukkan Email PIC ',
            'keterangan_pic.nullable' => 'Masukkan Keterangan PIC ',
        ]
    );

        $perusahaans = new Perusahaan();
        $perusahaans->email = $request->email;
        $perusahaans->id_perusahaan = $request->id_perusahaan;
        $perusahaans->nama_perusahaan = $request->nama_perusahaan;
        $perusahaans->phone = $request->phone;
        $perusahaans->kota = $request->kota;
        $perusahaans->provinsi = $request->provinsi;
        $perusahaans->negara = $request->negara;
        $perusahaans->nama_website = $request->nama_website;
        $perusahaans->keterangan = $request->keterangan;
        $perusahaans->nama_pic = $request->nama_pic;
        $perusahaans->phone_pic = $request->phone_pic;
        $perusahaans->email_pic = $request->email_pic;
        $perusahaans->keterangan_pic = $request->keterangan_pic;       
        $perusahaans->save();

        toastr('created successfully', 'success');
        return redirect()->route('admin.perusahaan.index');
        // return redirect()->route('admin.perusahaan.create')->with('activeTab','pic');
    }

    public function storeSuperAdmin(Request $request)
    {
        $request->validate([
          'email' => 'required' ,
           'id_perusahaan' => 'required','unique:perusahaans,id_perusahaan',
           'nama_perusahaan' => 'required','max:200',
           'phone' => 'required',
           'kota' => 'required',
           'provinsi' => 'required',
           'negara' => 'required',
           'nama_website' => 'required',
           'keterangan' => 'required',
           'nama_pic' => 'required',
           'phone_pic' => 'required',
           'email_pic' => 'required',
           'keterangan_pic' => 'nullable',
        ],

        [
            'email.required' => 'Masukkan email customer',
            'nama_perusahaan.required' => 'Masukkan nama customer ',
            'phone.required' => 'Masukkan no Telepon customer ',
            'kota.required' => 'Masukkan Alamat Kota ',
            'provinsi.required' => 'Masukkan Alamat Provinsi ',
            'negara.required' => 'Masukkan Alamat Negara ',
            'nama_website.required' => 'Masukkan Nama Website customer ',
            'keterangan.required' => 'Masukkan Keterangan customer ',
            'nama_pic.required' => 'Masukkan Nama PIC ',
            'phone_pic.required' => 'Masukkan No Telepon PIC ',
            'email_pic.required' => 'Masukkan Email PIC ',
            'keterangan_pic.nullable' => 'Masukkan Keterangan PIC ',
        ]
    );
        $perusahaans = new Perusahaan();
        $perusahaans->email = $request->email;
        $perusahaans->id_perusahaan = $request->id_perusahaan;
        $perusahaans->nama_perusahaan = $request->nama_perusahaan;
        $perusahaans->phone = $request->phone;
        $perusahaans->kota = $request->kota;
        $perusahaans->provinsi = $request->provinsi;
        $perusahaans->negara = $request->negara;
        $perusahaans->nama_website = $request->nama_website;
        $perusahaans->keterangan = $request->keterangan;
        $perusahaans->nama_pic = $request->nama_pic;
        $perusahaans->phone_pic = $request->phone_pic;
        $perusahaans->email_pic = $request->email_pic;
        $perusahaans->keterangan_pic = $request->keterangan_pic;       
        $perusahaans->save();


        toastr('created successfully', 'success');
        // return redirect()->route('super-admin.perusahaan.createSuperAdmin')->with('activeTab','pic');
        return redirect()->route('super-admin.perusahaan.indexSuperAdmin');
        
    }
   
    public function show(string $id_perusahaan)
    {
        $perusahaans = Perusahaan::findOrFail($id_perusahaan);
        return view('admin.perusahaan.view',compact('perusahaans'));
    }
    public function showSuperAdmin(string $id_perusahaan)
    {
        $perusahaans = Perusahaan::findOrFail($id_perusahaan);
        return view('super-admin.perusahaan.view',compact('perusahaans',));
    }
    
    public function edit(string $id)
    {
        $perusahaans = Perusahaan::findOrFail($id);
        return view('admin.perusahaan.edit',compact('perusahaans'));
    }
    public function editSuperAdmin(string $id)
    {
        $perusahaans = Perusahaan::findOrFail($id);
        return view('super-admin.perusahaan.edit',compact('perusahaans'));
    }
   
    public function update(Request $request, string $id)
    {
        $request->validate([
            'email' => ['nullable'] ,
            'id_perusahaan' => ['required'],
            'nama_perusahaan' => ['','max:200'],
            'phone' => [''],
            'kota' => ['max:200'],
            'provinsi' => ['max:200'],
            'negara' => ['max:200'],
            'nama_website' => ['max:200'],
            'keterangan' => ['nullable'],
            'nama_pic' => ['max:200'],
            'phone_pic' => ['nullable'],
            'email_pic' => ['nullable'],
            'keterangan_pic' => ['nullable'],
         ]);

         $perusahaans = Perusahaan::findOrFail($id);
         $perusahaans->email = $request->email;
         $perusahaans->id_perusahaan = $request->id_perusahaan;
         $perusahaans->nama_perusahaan = $request->nama_perusahaan;
         $perusahaans->phone = $request->phone;
         $perusahaans->kota = $request->kota;
         $perusahaans->provinsi = $request->provinsi;
         $perusahaans->negara = $request->negara;
         $perusahaans->nama_website = $request->nama_website;
         $perusahaans->keterangan = $request->keterangan;
         $perusahaans->nama_pic = $request->nama_pic;
         $perusahaans->phone_pic = $request->phone_pic;
         $perusahaans->email_pic = $request->email_pic;
         $perusahaans->keterangan_pic = $request->keterangan_pic; 
         $perusahaans->save();

         toastr('updated successfully', 'success');
         return redirect()->route('admin.perusahaan.index');
    }

    public function updateSuperAdmin(Request $request, string $id)
    {
        $request->validate([
            'email' => ['nullable'] ,
            'id_perusahaan' => ['required'],
            'nama_perusahaan' => ['','max:200'],
            'phone' => [''],
            'kota' => ['max:200'],
            'provinsi' => ['max:200'],
            'negara' => ['max:200'],
            'nama_website' => ['max:200'],
            'keterangan' => ['nullable'],
            'nama_pic' => ['max:200'],
            'phone_pic' => ['nullable'],
            'email_pic' => ['nullable'],
            'keterangan_pic' => ['nullable'],
         ]);

         $perusahaans = Perusahaan::findOrFail($id);
         $perusahaans->email = $request->email;
         $perusahaans->id_perusahaan = $request->id_perusahaan;
         $perusahaans->nama_perusahaan = $request->nama_perusahaan;
         $perusahaans->phone = $request->phone;
         $perusahaans->kota = $request->kota;
         $perusahaans->provinsi = $request->provinsi;
         $perusahaans->negara = $request->negara;
         $perusahaans->nama_website = $request->nama_website;
         $perusahaans->keterangan = $request->keterangan;
         $perusahaans->nama_pic = $request->nama_pic;
         $perusahaans->phone_pic = $request->phone_pic;
         $perusahaans->email_pic = $request->email_pic;
         $perusahaans->keterangan_pic = $request->keterangan_pic; 
         $perusahaans->save();

         toastr('updated successfully', 'success');
         return redirect()->route('super-admin.perusahaan.indexSuperAdmin');
    }

    public function downloadFile()
    {
        $filePath = 'public/files/customer.xlsx';
        return Storage::download($filePath, 'data_customer.xlsx');
    }

    public function import_proses(Request $request){
        Excel::import(new Customerimport(), $request->file('file')); 
        return redirect()->back();
    }

    public function destroy(string $id)
    {
        $perusahaans = Perusahaan::findOrFail($id);
        $perusahaans->delete();
        return response(['status'=>'success','message'=> 'Deleted Successfully']);
    }
}