<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Admin\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $result['data'] = Coupon::orderBy('id', 'DESC')->get();
        return view('admin/coupon',$result);
    }

    public function manage_coupon($id='')
    {
        if($id>0)
        {
            $arr = Coupon::where(['id'=>$id])->get();
            $result['title'] = $arr[0]->title;
            $result['code'] = $arr[0]->code;
            $result['value'] = $arr[0]->value;
            $result['type'] = $arr[0]->type;
            $result['min_order_amt'] = $arr[0]->min_order_amt;
            $result['is_onetime'] = $arr[0]->is_onetime;
            $result['coupon_id'] = $arr[0]->id;
        }
        else
        {
            $result['title'] = "";
            $result['code'] = "";
            $result['value'] = "";
            $result['type'] = "";
            $result['min_order_amt'] = "";
            $result['is_onetime'] = "";
            $result['coupon_id'] = "";
        }
        return view('admin/manage_coupon', $result);
    }

    public function manage_coupon_process(Request $req)
    {
        $req->validate([
            'title'=>'required',
            'code'=>'required',
            'value'=>'required',
        ]);
        $title = $req->post('title');
        $code = $req->post('code');
        $value = $req->post('value');
        $type = $req->post('type');
        $min_order_amt = $req->post('min_order_amt');
        $is_onetime = $req->post('is_onetime');
        $coupon_id = $req->post('coupon_id');

        if($coupon_id>0)
        {
            $model = Coupon::find($coupon_id);
            $msg = "Coupon Updated Successfully";
        }
        else
        {
            $model = new Coupon();
            $msg = "Coupon Inserted Successfully";
        }

        $model->title = $title;
        $model->code = $code;
        $model->value = $value;
        $model->type = $type;
        $model->min_order_amt = $min_order_amt;
        $model->is_onetime = $is_onetime;
        $model->save();
        $req->session()->flash('msg',$msg);
        return redirect('/admin/coupon');
    }

    public function delete_coupon($id)
    {
        $coupon_id = $id;
        $record = Coupon::find($coupon_id);
        $record->delete();
    }
}
