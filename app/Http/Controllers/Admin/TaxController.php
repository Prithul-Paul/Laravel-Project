<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Admin\Tax;
use Illuminate\Http\Request;

class TaxController extends Controller
{
    public function index()
    {
        $result['data'] = Tax::orderBy('id', 'DESC')->get();
        return view('admin/tax',$result);
    }

    public function manage_tax($id='')
    {
        if($id>0)
        {
            $arr = Tax::where(['id'=>$id])->get();
            $result['tax_name'] = $arr[0]->tax_name;
            $result['tax_value'] = $arr[0]->tax_value;
            $result['tax_id'] = $arr[0]->id;
        }
        else
        {
            $result['tax_name'] = "";
            $result['tax_value'] = "";
            $result['tax_id'] = "";
        }
        return view('admin/manage_tax', $result);
    }

    public function manage_tax_process(Request $req)
    {
        $req->validate([
            'tax_name'=>'required',
            'tax_value'=>'required',
        ]);
        $tax_name = $req->post('tax_name');
        $tax_value = $req->post('tax_value');
        $tax_id = $req->post('tax_id');
        if($tax_id>0)
        {
            $model = Tax::find($tax_id);
            $msg = "Tax Updated Successfully";
        }
        else
        {
            $model = new Tax();
            $model->status = 1;
            $msg = "Tax Inserted Successfully";
        }

        $model->tax_name = $tax_name;
        $model->tax_value = $tax_value;
        $model->save();
        $req->session()->flash('msg',$msg);
        return redirect('/admin/tax');
    }

    public function tax_status(Request $req, $status, $id)
    {
        $result = Tax::find($id);
        $result->status = $status;
        $result->save();
        $req->session()->flash('msg', 'Status Updated Successfully');
        return redirect('/admin/tax');
    }

    public function delete_tax($id)
    {
        $tax_id = $id;
        $record = Tax::find($tax_id);
        $record->delete();
    }
}
