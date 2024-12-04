<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\FileImportController;
use App\Http\Controllers\JenisPaketController;
use App\Http\Controllers\Backend\CartController;
use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Backend\PaketController;
use App\Http\Controllers\Backend\NavbarController;
use App\Http\Controllers\reportCustomerController;
use App\Http\Controllers\Backend\InvoiceController;
use App\Http\Controllers\Backend\LayananController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\PerusahaanController;
use App\Http\Controllers\Backend\MaintenanceController;
use App\Http\Controllers\Backend\reportorderController;
use App\Http\Controllers\Backend\CetakInvoiceController;
use App\Http\Controllers\Backend\FiledownloadController;
use App\Http\Controllers\Backend\reportinvoiceController;
use App\Http\Controllers\Backend\reportmaintenanceController;

// ----------- ADMIN ROUTES -------------------//
Route::get('dashboard', 'App\Http\Controllers\Backend\AdminController@dashboard')->name('dashboard');

Route::get('error', [AdminController::class, 'error'])->name('error');
Route::get('/layouts', [NavbarController::class, 'navbar']);
Route::get('importcustomer', 'App\Http\Controllers\Backend\CustomerimportController@index')->name('importcustomer');

//--------- PROFILE ROUTES -------------//
Route::get('profile',[ProfileController::class, 'index'])->name('profile');
Route::post('profile/update',[ProfileController::class, 'updateProfile'])->name('profile.update');
Route::post('profile/update/password',[ProfileController::class, 'updatePassword'])->name('password.update');

//--------- ADMIN PERUSAHAAN ROUTES -------------//
// Route untuk export Excel
Route::post('admin/perusahaan/importexcel', [FileImportController::class, 'import'])->name('perusahaan.importexcel');
Route::get('perusahaan/download-file', [PerusahaanController::class, 'downloadFile'])->name('perusahaan.downloadFile');
Route::get('perusahaan/export-excel', [PerusahaanController::class, 'export_excel'])->name('perusahaan.export_excel');
// Route::post('perusahaan/import_proses', [PerusahaanController::class, 'import_proses'])->name('perusahaan.import_proses');
Route::resource('perusahaan', PerusahaanController::class);

//------------ LAYANAN ROUTES ----------//
Route::resource('layanan', LayananController::class);

//------------- CETAK INVOICE ROUTE -------------//
Route::resource('cetakInvoice', CetakInvoiceController::class);
//============= ENDS CETAK INVOICE ROUTE ================//

//--------------- CART ROUTES ---------------//
Route::get('cart','App\Http\Controllers\Backend\CartController@index')->name('cart.index');
Route::post('cart/store','App\Http\Controllers\Backend\CartController@store')->name('cart.store');
Route::post('cart/bayar', 'App\Http\Controllers\Backend\CartController@bayar')->name('cart.bayar');

Route::get('/cart/{id}', [CartController::class, 'destroy']);
Route::get('/cart/hapus/semua', [CartController::class, 'hapusSemua']);
//-------------- ENDS OF CART ROUTES ------------------//

//------------- INVOICE ROUTES ---------------//
Route::get('invoice/{id}/edit', 'App\Http\Controllers\Backend\InvoiceController@edit')->name('invoice.edit');
Route::put('invoice/update/{id}', 'App\Http\Controllers\Backend\InvoiceController@update')->name('invoice.update');
Route::get('invoice/create', 'App\Http\Controllers\Backend\InvoiceController@create')->name('invoice.create');
Route::post('invoice/store', 'App\Http\Controllers\Backend\InvoiceController@store')->name('invoice.store');
Route::get('invoice/cetak/{id_invoice}', 'App\Http\Controllers\Backend\InvoiceController@cetak')->name('invoice.cetak');
// Route::get('invoice/cetak/{id}', 'App\Http\Controllers\Backend\InvoiceController@cetak')->name('invoice.cetak');
Route::get('invoice/cari', 'App\Http\Controllers\Backend\InvoiceController@cari')->name('invoice.cari');
Route::get('invoice/{id_invoice}', 'App\Http\Controllers\Backend\InvoiceController@show')->where('id_order', '.*')->name('invoice.show');
Route::get('invoice', 'App\Http\Controllers\Backend\InvoiceController@index')->name('invoice.index');

// ----------- DOWNLOAD TEMPLATE ROUTE -----//
Route::get('/download-file', function () {
    $filePath = 'public/files/customer.xlsx'; // Path ke file
    return Storage::download($filePath);
});
Route::get('/download-file', [FiledownloadController::class, 'downloadFile']);
// Route::get('invoice');

// ----------- ORDER ROUTES ------------------ //
Route::get('order/{id_order}', 'App\Http\Controllers\Backend\OrderController@show')->where('id_order', '.*')->name('order.show');
Route::put('order/change-status', [OrderController::class, 'changeStatus'])->name('order.changeStatus');
Route::post('order/update-status', [OrderController::class, 'updateStatus'])->name('order.updateStatus');

Route::resource('order', OrderController::class);

//--------- PAKET ROUTES -----------------//
Route::post('get-deskripsi-paket', [PaketController::class, 'getDeskripsiPaket'])->name('get.deskripsi.paket');
Route::resource('paket',PaketController::class);

// ----------- JENIS PAKET ROUTES ------------------ //
Route::resource('jenis-paket', JenisPaketController::class);

//--------------- MAINTENANCE ROUTES -----------//
Route::get('maintenance/create/{id_order}', 'App\Http\Controllers\Backend\MaintenanceController@create')->name('maintenance.perpanjang');
Route::post('maintenance/store', 'App\Http\Controllers\Backend\MaintenanceController@store')->name('maintenance.store');
Route::post('maintenance/email/{id_order}', 'App\Http\Controllers\Backend\MaintenanceController@sendReminder')->name('maintenance.send-email');
Route::get('maintenance/{id_order}', 'App\Http\Controllers\Backend\MaintenanceController@show')->where('id_order', '.*')->name('maintenance.show');
Route::get('maintenance', 'App\Http\Controllers\Backend\MaintenanceController@index')->name('maintenance.index');
//--------------- ENDS MAINTENANCE ROUTES -----------//

//---------------- REPORT ORDER ROUTE ----------------//
Route::get('reportorder/cari', 'App\Http\Controllers\Backend\reportorderController@cari')->name('reportorder.cari');
Route::get('/reportorder', [ReportOrderController::class, 'index'])->name('reportorder.index');
Route::get('/reportorder/export-excel', [ReportorderController::class, 'exportExcel'])->name('reportorder.export_excel');
Route::get('/reportorder/export_pdf', [ReportorderController::class, 'exportPdf'])->name('reportorder.export_pdf');
Route::get('/reportorder/diagram', 'App\Http\Controllers\Backend\reportorderController@showDiagram' )->name('reportorder.diagram');
Route::get('/reportorder/diagram/print', [reportorderController::class, 'printDiagram'])->name('reportorder.diagram_print');
Route::get('reportorder/{id_order}', 'App\Http\Controllers\Backend\reportorderController@show')->where('id_order', '.*')->name('reportorder.show');
//---------------- ENDS OF REPORT ORDER ----------------//

//--------- REPORT INVOICE ROUTE -----------------//
Route::get('reportinvoice/cari', 'App\Http\Controllers\Backend\reportinvoiceController@cari')->name('reportinvoice.cari');
Route::get('reportinvoice/export-excel', 'App\Http\Controllers\Backend\reportinvoiceController@exportExcel')->name('reportinvoice.export_excel');
Route::get('reportinvoice/diagram', 'App\Http\Controllers\Backend\reportinvoiceController@showDiagram' )->name('reportinvoice.diagram');
Route::get('/reportinvoice/diagram/print', [reportinvoiceController::class, 'printDiagram'])->name('reportinvoice.diagram_print');
Route::get('reportinvoice/exportpdf', 'App\Http\Controllers\Backend\reportinvoiceController@exportPdf')->name('reportinvoice.export_pdf');
Route::get('reportinvoice/{id_invoice}', 'App\Http\Controllers\Backend\reportInvoiceController@show')->where('id_order', '.*')->name('reportinvoice.show');
Route::get('reportinvoice/cetak/{id_invoice}', 'App\Http\Controllers\Backend\reportinvoiceController@cetak')->name('reportinvoice.cetak');
Route::resource('reportinvoice', reportinvoiceController::class);
//================== ENDS OF REPORT INVOICE ROUTE ====================//

//--------------- REPORT CUSTOMER ROUTE ------------------//
Route::get('reportcustomer', 'App\Http\Controllers\Backend\reportcustomerController@index')->name('reportcustomer.index');
Route::get('reportcustomer/diagram', 'App\Http\Controllers\Backend\reportcustomerController@showDiagram' )->name('reportcustomer.diagram');
Route::get('reportcustomer/exportpdf', 'App\Http\Controllers\Backend\reportcustomerController@exportPdf')->name('reportcustomer.exportpdf');
Route::get('reportcustomer/exporexcel', 'App\Http\Controllers\Backend\reportcustomerController@exportExcel')->name('reportcustomer.exportexcel');
//================= ENDS REPORT CUSTOMER ROUTE =================//

// ----------REPORT MAINTENANCE ROUTE -----------------//
Route::get('reportmaintenance', 'App\Http\Controllers\Backend\reportmaintenanceController@index')->name('reportmaintenance.index');
Route::get('reportmaintenance/diagram', [reportmaintenanceController::class, 'showDiagram'] )->name('reportmaintenance.diagram');
Route::get('reportmaintenance/export-excel', 'App\Http\Controllers\Backend\reportmaintenanceController@exportExcel')->name('reportmaintenance.export_excel');
Route::get('/reportmaintenance/export_pdf', [ReportmaintenanceController::class, 'exportPdf'])->name('reportmaintenance.export_pdf');
Route::get('reportmaintenance/{id}', 'App\Http\Controllers\Backend\reportmaintenanceController@show')->where('id', '.*')->name('reportmaintenance.show');
// Route::get('reportmaintenance/diagram/export-pdf','App\Http\Controllers\Backend\reportmaintenanceController@exportPdf')->name('reportmaintenance.export_pdf');
Route::get('reportmaintenance/diagram/print', [reportmaintenanceController::class, 'printDiagram'])->name('reportmaintenance.diagram_print');
//==================================================/?

// Route::group(['middleware' => ['admin']], function () {
//     Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
// });