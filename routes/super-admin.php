<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\CartController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Backend\PaketController;
use App\Http\Controllers\Backend\SuperAdminController;
use App\Http\Controllers\Backend\reportorderController;
use App\Http\Controllers\Backend\reportinvoiceController;
use App\Http\Controllers\Backend\ProfileSuperAdminController;
use App\Http\Controllers\Backend\reportmaintenanceController;

Route::get('dashboard', [SuperAdminController::class, 'dashboard'])->name('dashboard');

//--------- PROFILE ROUTES -------------//
Route::get('profile',[ProfileSuperAdminController::class, 'index'])->name('profile');
Route::post('profile/update',[ProfileSuperAdminController::class, 'updateProfile'])->name('profile.update');
Route::post('profile/update/password',[ProfileSuperAdminController::class, 'updatePassword'])->name('password.update');

//--------- PERUSAHAAN ROUTES -------------//
// Route::resource('perusahaan', SuperAdminPerusahaanController::class);
Route::get('perusahaan','App\Http\Controllers\Backend\PerusahaanController@indexSuperAdmin')->name('perusahaan.indexSuperAdmin');
Route::get('perusahaan/create','App\Http\Controllers\Backend\PerusahaanController@createSuperAdmin')->name('perusahaan.createSuperAdmin');
Route::post('perusahaan/store','App\Http\Controllers\Backend\PerusahaanController@storeSuperAdmin')->name('perusahaan.storeSuperAdmin');
Route::put('perusahaan/update/{id}','App\Http\Controllers\Backend\PerusahaanController@updateSuperAdmin')->name('perusahaan.updateSuperAdmin');
Route::get('perusahaan/{id}/edit','App\Http\Controllers\Backend\PerusahaanController@editSuperAdmin')->name('perusahaan.editSuperAdmin');
Route::get('perusahaan/show','App\Http\Controllers\Backend\PerusahaanController@showSuperAdmin')->name('perusahaan.showSuperAdmin');
Route::delete('perusahaan/destroy/{id}', 'App\Http\Controllers\Backend\PerusahaanController@destroy')->name('perusahaan.destroy');
//============== ENDS OF PERUSAHAAN ROUTES ================//

//----------------------- SUPER ADMIN PAKET ROUTES ----------------------//
Route::get('paket', 'App\Http\Controllers\Backend\PaketController@indexSuperAdmin')->name('paket.indexSuperAdmin');
Route::get('paket/create', 'App\Http\Controllers\Backend\PaketController@createSuperAdmin')->name('paket.createSuperAdmin');
Route::post('paket/store', 'App\Http\Controllers\Backend\PaketController@storeSuperAdmin')->name('paket.storeSuperAdmin');
Route::get('paket/{id}/edit', 'App\Http\Controllers\Backend\PaketController@editSuperAdmin')->name('paket.editSuperAdmin');
Route::put('paket/update/{id}', 'App\Http\Controllers\Backend\PaketController@updateSuperAdmin')->name('paket.updateSuperAdmin');
Route::delete('paket/destroy/{id}', 'App\Http\Controllers\Backend\PaketController@destroy')->name('paket.destroy');
//======================= ENDS SUPER ADMIN PAKET ROUTES ==========================//

//----------------------- SUPER ADMIN LAYANAN ROUTES ----------------------------//
Route::get('layanan', 'App\Http\Controllers\Backend\LayananController@indexSuperAdmin')->name('layanan.indexSuperAdmin');
Route::get('layanan/create', 'App\Http\Controllers\Backend\LayananController@createSuperAdmin')->name('layanan.createSuperAdmin');
Route::post('layanan/store', 'App\Http\Controllers\Backend\LayananController@storeSuperAdmin')->name('layanan.storeSuperAdmin');
Route::get('layanan/{id}/edit', 'App\Http\Controllers\Backend\LayananController@editSuperAdmin')->name('layanan.editSuperAdmin');
Route::put('layanan/update/{id}', 'App\Http\Controllers\Backend\LayananController@updateSuperAdmin')->name('layanan.updateSuperAdmin');
Route::delete('layanan/destroy/{id}', 'App\Http\Controllers\Backend\LayananController@destroy')->name('layanan.destroy');
//========================= ENDS OF SUPER ADMIN LAYANAN ROUTES ================================ //

//--------------- CART ROUTES ---------------//
Route::get('cart','App\Http\Controllers\Backend\CartController@indexSuperAdmin')->name('cart.indexSuperAdmin');
Route::post('cart/store','App\Http\Controllers\Backend\CartController@storeSuperAdmin')->name('cart.storeSuperAdmin');
Route::post('cart/bayar', 'App\Http\Controllers\Backend\CartController@bayarSuperAdmin')->name('cart.bayarSuperAdmin');

Route::get('/cart/{id}', [CartController::class, 'destroy']);
Route::get('/cart/hapus/semua', [CartController::class, 'hapusSemua']);
//-------------- ENDS OF CART ROUTES ------------------//

// ----------- ORDER ROUTES ------------------ //
Route::get('order', 'App\Http\Controllers\Backend\OrderController@indexSuperAdmin')->name('order.indexSuperAdmin');
Route::get('order/{id_order}', 'App\Http\Controllers\Backend\OrderController@showSuperAdmin')->where('id_order', '.*')->name('order.showSuperAdmin');
Route::put('order/change-status', 'App\Http\Controllers\Backend\OrderController@changeStatusSuperAdmin')->name('order.changeStatusSuperAdmin');
Route::put('order/update-status', 'App\Http\Controllers\Backend\OrderController@updateStatusSuperAdmin')->name('order.updateStatusSuperAdmin');
Route::delete('order/destroy/{id}', 'App\Http\Controllers\Backend\OrderController@destroy')->name('order.destroy');
// ================= ENDS OF ORDER ROUTES ================== //


//------------- INVOICE ROUTES ---------------//
Route::get('invoice/{id}/edit', 'App\Http\Controllers\Backend\InvoiceController@editSuperAdmin')->name('invoice.editSuperAdmin');
Route::get('invoice/{id_invoice}/cetak', 'App\Http\Controllers\Backend\InvoiceController@cetakSuperAdmin')->name('invoice.cetakSuperAdmin');
Route::put('invoice/update/{id}', 'App\Http\Controllers\Backend\InvoiceController@updateSuperAdmin')->name('invoice.updateSuperAdmin');
Route::get('invoice/create', 'App\Http\Controllers\Backend\InvoiceController@createSuperAdmin')->name('invoice.createSuperAdmin');
Route::post('invoice/store', 'App\Http\Controllers\Backend\InvoiceController@storeSuperAdmin')->name('invoice.storeSuperAdmin');
Route::get('invoice/cari', 'App\Http\Controllers\Backend\InvoiceController@cariSuperAdmin')->name('invoice.cariSuperAdmin');
Route::get('invoice/{id_invoice}', 'App\Http\Controllers\Backend\InvoiceController@showSuperAdmin')->where('id_order', '.*')->name('invoice.showSuperAdmin');
Route::get('invoice', 'App\Http\Controllers\Backend\InvoiceController@indexSuperAdmin')->name('invoice.indexSuperAdmin');
//============== ENDS OF INVOICE ROUTES ==============//

//---------------------- REPORTORDER ROUTES ----------------------//
Route::get('reportorder', 'App\Http\Controllers\Backend\reportorderController@indexSuperAdmin')->name('reportorder.indexSuperAdmin');
Route::get('reportorder/cari', 'App\Http\Controllers\Backend\reportorderController@cariSuperAdmin')->name('reportorder.cariSuperAdmin');
Route::get('reportorder/export-excel', 'App\Http\Controllers\Backend\reportorderController@export_excelSuperAdmin')->name('reportorder.export_excelSuperAdmin');
Route::get('reportorder/{id_order}', 'App\Http\Controllers\Backend\reportorderController@showSuperAdmin')->where('id_order', '.*')->name('reportorder.showSuperAdmin');
//================== ENDS OF REPORTORDER ROUTES ===================//

//--------- REPORT INVOICE ROUTE -----------------//
Route::get('reportinvoice', 'App\Http\Controllers\Backend\reportinvoiceController@indexSuperAdmin')->name('reportinvoice.indexSuperAdmin');
Route::get('reportinvoice/cetak/{id_invoice}', 'App\Http\Controllers\Backend\reportinvoiceController@cetakSuperAdmin')->name('reportinvoice.cetakSuperAdmin');
Route::get('reportinvoice/export-excel', 'App\Http\Controllers\Backend\reportinvoiceController@exportExcel')->name('reportinvoice.export_excelSuperAdmin');
Route::get('/reportinvoice/export-pdf', [reportinvoiceController::class, 'exportPDFSuperAdmin'])->name('reportinvoice.exportPDFSuperAdmin');
Route::get('reportinvoice/diagram', 'App\Http\Controllers\Backend\reportinvoiceController@showDiagramSuperAdmin' )->name('reportinvoice.diagramSuperAdmin');
Route::get('reportinvoice/diagram/print', [reportinvoiceController::class, 'printDiagramSuperAdmin'])->name('reportinvoice.diagram_printSuperAdmin');
Route::get('reportinvoice/{id_invoice}', 'App\Http\Controllers\Backend\reportInvoiceController@showSuperAdmin')->where('id_order', '.*')->name('reportinvoice.showSuperAdmin');
//================== ENDS OF REPORT INVOICE ROUTE ====================//

//--------------- MAINTENANCE ROUTES -----------//
Route::get('maintenance/create/{id_order}', 'App\Http\Controllers\Backend\MaintenanceController@createSuperAdmin')->name('maintenance.perpanjang');
Route::post('maintenance/store', 'App\Http\Controllers\Backend\MaintenanceController@store')->name('maintenance.storeSuperAdmin');
Route::get('maintenance/{id_order}', 'App\Http\Controllers\Backend\MaintenanceController@showSuperAdmin')->where('id_order', '.*')->name('maintenance.showSuperAdmin');
Route::get('maintenance', 'App\Http\Controllers\Backend\MaintenanceController@indexSuperAdmin')->name('maintenance.indexSuperAdmin');
//--------------- ENDS MAINTENANCE ROUTES -----------//

// ----------REPORT MAINTENANCE ROUTE -----------------//
Route::get('reportmaintenance', 'App\Http\Controllers\Backend\reportmaintenanceController@indexSuperAdmin')->name('reportmaintenance.indexSuperAdmin');
Route::get('reportmaintenance/diagram', [reportmaintenanceController::class, 'showDiagramSuperAdmin'] )->name('reportmaintenance.diagramSuperAdmin');
Route::get('reportmaintenance/export-excel', 'App\Http\Controllers\Backend\reportmaintenanceController@exportExcel')->name('reportmaintenance.export_excel');
Route::get('/reportmaintenance/export_pdf', [ReportmaintenanceController::class, 'exportPdfSuperAdmin'])->name('reportmaintenance.export_pdfSuperAdmin');
Route::get('reportmaintenance/{id_maintenance}', 'App\Http\Controllers\Backend\reportmaintenanceController@showSuperAdmin')->where('id_maintenance', '.*')->name('reportmaintenance.showSuperAdmin');
// Route::get('reportmaintenance/diagram/export-pdf','App\Http\Controllers\Backend\reportmaintenanceController@exportPdf')->name('reportmaintenance.export_pdf');
Route::get('reportmaintenance/diagram/print', [reportmaintenanceController::class, 'printDiagramSuperAdmin'])->name('reportmaintenance.diagram_printSuperAdmin');
//==================================================//

//--------------- REPORT CUSTOMER ROUTE ------------------//
Route::get('reportcustomer', 'App\Http\Controllers\Backend\reportcustomerController@indexSuperAdmin')->name('reportcustomer.indexSuperAdmin');
Route::get('reportcustomer/diagram', 'App\Http\Controllers\Backend\reportcustomerController@showDiagramSuperAdmin' )->name('reportcustomer.diagramSuperAdmin');
Route::get('reportcustomer/exportpdf', 'App\Http\Controllers\Backend\reportcustomerController@exportPDFSuperAdmin')->name('reportcustomer.exportpdfSuperAdmin');
Route::get('reportcustomer/exporexcel', 'App\Http\Controllers\Backend\reportcustomerController@exportExcel')->name('reportcustomer.exportexcel');
//================= ENDS REPORT CUSTOMER ROUTE =================//

// Route::group(['middleware' => ['superadmin']], function () {
//     Route::get('/superadmin/dashboard', [SuperAdminController::class, 'index'])->name('superadmin.dashboard');
// });