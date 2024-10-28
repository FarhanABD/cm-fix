<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Imports\Customerimport as ImportsCustomerimport;
// use App\Models\Customerimport;
use App\Imports\customerimport;
use App\Models\Perusahaan;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class CustomerimportController extends Controller
{
    public function index ()
    {
    $customer = Perusahaan::all();
    return view('admin.customer.index', compact('customer'));
    }

    public function customerimportExcel(Request $request){
        $file = $request->file('file');
        $nameFile = $file->getClientOriginalName();
        $file->move(public_path('/uploads'), $nameFile);

        Excel::import(new Customerimport, public_path('/uploads/'.$nameFile));
        return redirect()->back()->with('success', 'Excel file imported successfully!');

    }
}