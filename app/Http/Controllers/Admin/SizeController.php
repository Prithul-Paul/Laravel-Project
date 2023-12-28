<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Admin\Size;
use Illuminate\Http\Request;

class SizeController extends Controller
{
    public function index()
    {
        $result['data'] = Size::orderBy('id', 'DESC')->get();
        return view('admin/size',$result);
    }

    public function manage_size($id='')
    {
        if($id>0)
        {
            $arr = Size::where(['id'=>$id])->get();
            $result['size'] = $arr[0]->size;
            $result['status'] = $arr[0]->status;
            $result['size_id'] = $arr[0]->id;
        }
        else
        {
            $result['size'] = "";
            $result['status'] = "";
            $result['size_id'] = "";
        }
        return view('admin/manage_size', $result);
    }

    public function manage_size_process(Request $req)
    {
        $req->validate([
            'size'=>'required',
        ]);
        $size = $req->post('size');
        $size_id = $req->post('size_id');
        if($size_id>0)
        {
            $model = Size::find($size_id);
            $msg = "Size Updated Successfully";
        }
        else
        {
            $model = new Size();
            $model->status = 0;
            $msg = "Size Inserted Successfully";
        }

        $model->size = $size;
        $model->save();
        $req->session()->flash('msg',$msg);
        return redirect('/admin/size');
    }

    public function size_status(Request $req, $status, $id)
    {
        $result = Size::find($id);
        $result->status = $status;
        $result->save();
        $req->session()->flash('msg', 'Status Updated Successfully');
        return redirect('/admin/size');
    }

    public function delete_size($id)
    {
        $size_id = $id;
        $record = Size::find($size_id);
        $record->delete();
    }
    
}
