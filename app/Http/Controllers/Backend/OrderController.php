<?php

namespace App\Http\Controllers\Backend;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Paket;
use App\Models\Perusahaan;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Helpers\RomanizeHelper;
use App\DataTables\OrderDataTable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\TransaksiDetail;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index(OrderDataTable $dataTable)
    {
        
        return $dataTable->render('admin.order.index');
    }
    public function indexSuperAdmin(OrderDataTable $dataTable)
    {
        
        return $dataTable->render('super-admin.order.index');
    }
   
    public function create(Request $request)
    {
      
    }

    public function store(Request $request)
    {

    }

    public function show($id_order)
    {
        $data = TransaksiDetail::where('id_order', $id_order)->get();
        $id_order = urldecode($id_order);
    
        return view('admin.order.view', compact('data'));
    }
    public function showSuperAdmin($id_order)
    {
        $data = TransaksiDetail::where('id_order', $id_order)->get();
        $id_order = urldecode($id_order);
    
        return view('super-admin.order.view', compact('data'));
    }

    public function changeStatus(Request $request)
    {
    try {
        $order = Order::findOrFail($request->id);
        $order->status = $request->status == 'true' ? 1 : 0;
        $order->save();

        return response(['message' => 'Status  Updated Successfully']);
        
    } catch (\Illuminate\Database\QueryException $e) {
        // Handle database-related errors
        Log::error('Database error: ' . $e->getMessage());
        return response(['message' => 'An error occurred while accessing the database'], 500);
    } catch (\Illuminate\Validation\ValidationException $e) {
        // Handle validation errors
        return response(['message' => 'Validation error: ' . $e->getMessage()], 422);
    } catch (\Exception $e) {
        // Handle other exceptions
        Log::error('General error: ' . $e->getMessage());
        return response(['message' => 'An unexpected error occurred'], 500);
    }}

    public function changeStatusSuperAdmin(Request $request)
    {
    try {
        $order = Order::findOrFail($request->id);
        $order->status = $request->status == 'true' ? 1 : 0;
        $order->save();

        return response(['message' => 'Status  Updated Successfully']);
        
    } catch (\Illuminate\Database\QueryException $e) {
        // Handle database-related errors
        Log::error('Database error: ' . $e->getMessage());
        return response(['message' => 'An error occurred while accessing the database'], 500);
    } catch (\Illuminate\Validation\ValidationException $e) {
        // Handle validation errors
        return response(['message' => 'Validation error: ' . $e->getMessage()], 422);
    } catch (\Exception $e) {
        // Handle other exceptions
        Log::error('General error: ' . $e->getMessage());
        return response(['message' => 'An unexpected error occurred'], 500);
    }}
    
    public function edit(string $id)
    {
        // $order = Order::findOrFail($id);
        // $cart = Cart::where('id_order', $id)->get();
        // $paket = Paket::all();
        // return view('admin.cart.edit',compact('order','cart','paket'));
    }
    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return response(['status'=>'success','message'=> 'Deleted Successfully']);
    }
}