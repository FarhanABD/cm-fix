<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Backend\CustomerimportController;
use App\Imports\Customerimport;
use Illuminate\Http\Request;
use App\Models\NamaModel; // Model sesuai tabel database Anda
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\NamaImport;
use App\Models\Perusahaan;
use Sabberworm\CSS\Property\Import;

class FileImportController extends Controller
{
//     public function showImportForm()
//     {
//         return view('import-form'); // Tampilkan form untuk upload file Excel
//     }

//     public function importExcel(Request $request)
//     {
//         $request->validate([
//             'file' => 'required|mimes:xlsx,xls,csv',
//         ]);

//         Excel::import(new Perusahaan(), $request->file('file'));

//         return redirect()->route('import.form')->with('success', 'Data berhasil diimpor!');
//     }

//     public function showData()
// {
//     $data = Perusahaan::all(); // Ambil semua data dari tabel
//     return view('data-tables', compact('data'));
// }

public function import(Request $request)
{
    $request->validate([
        'file' => 'required|mimes:xlsx,xls',
    ]);

    Excel::import(new Customerimport(), $request->file('file'));
    return redirect()->back()->with('success', 'Data imported successfully.');
}

}