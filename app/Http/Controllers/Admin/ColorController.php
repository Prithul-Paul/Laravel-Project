<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Admin\Color;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    public function index()
    {
        $result['data'] = Color::orderBy('id', 'DESC')->get();
        return view('admin/colour',$result);
    }

    public function manage_colour($id='')
    {
        if($id>0)
        {
            $arr = Color::where(['id'=>$id])->get();
            $result['colour'] = $arr[0]->color;
            $result['status'] = $arr[0]->status;
            $result['colour_id'] = $arr[0]->id;
        }
        else
        {
            $result['colour'] = "";
            $result['status'] = "";
            $result['colour_id'] = "";
        }
        return view('admin/manage_colour', $result);
    }

    public function manage_colour_process(Request $req)
    {
        $req->validate([
            'colour'=>'required',
        ]);
        $colour = $req->post('colour');
        $colour_id = $req->post('colour_id');
        if($colour_id>0)
        {
            $model = Color::find($colour_id);
            $msg = "Colour Updated Successfully";
        }
        else
        {
            $model = new Color();
            $model->status = 0;
            $msg = "Colour Inserted Successfully";
        }

        $model->color = $colour;
        $model->save();
        $req->session()->flash('msg',$msg);
        return redirect('/admin/colour');
    }

    public function colour_status(Request $req, $status, $id)
    {
        $result = Color::find($id);
        $result->status = $status;
        $result->save();
        $req->session()->flash('msg', 'Status Updated Successfully');
        return redirect('/admin/colour');
    }

    public function delete_colour($id)
    {
        $colour_id = $id;
        $record = Color::find($colour_id);
        $record->delete();
    }
}
