<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;

class NavbarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $currentDate = Carbon::now()->format('Y-m-d H:i:s')();   // Format: Sep 14, 2024
        // $currentTime = Carbon::now()->toFormattedDateTime();
        return view('navbar', ['currentDate' => $currentDate]);
       
    }

    public function indexSuperAdmin()
    {
        $currentDate = Carbon::now()->format('Y-m-d H:i:s')();   // Format: Sep 14, 2024
        return view('super-admin.layouts.navbar', ['currentDate' => $currentDate]);
        // return $dataTable->render('super-admin.perusahaan.index');
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}