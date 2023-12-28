<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Admin\Customer;
use App\Models\Admin\Order;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $result = Order::with(['customer'])->get();
        // dd()
        // $result = Order::all();
        // dd($result->toArray());
        return view('admin/customer',compact('result'));
    }

    // public function customer_status(Request $req, $status, $id)
    // {
    //     $result = Customer::find($id);
    //     $result->status = $status;
    //     $result->save();
    //     $req->session()->flash('msg', 'Status Updated Successfully');
    //     return redirect('/admin/customer');
    // }
}
