<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Brand;
use Illuminate\Http\Request;
use Storage;

class BrandController extends Controller
{
    public function index()
    {
        $result['data'] = Brand::orderBy('id', 'DESC')->get();
        return view('admin/brand',$result);
    }

    public function manage_brand($id='')
    {
        if($id>0)
        {
            $arr = Brand::where(['id'=>$id])->get();
            $result['name'] = $arr[0]->name;
            $result['image'] = $arr[0]->image;
            $result['id'] = $arr[0]->id;
        }
        else
        {
            $result['name'] = "";
            $result['image'] = "";
            $result['id'] = "";
        }
        return view('admin/manage_brand', $result);
    }

    public function manage_brand_process(Request $req)
    {
        $brand = $req->post('brand');
        $brand_id = $req->post('brand_id');
        if($brand_id>0)
        {
            $brand_validation = 'required';
            $brand_image_validation = '';
        }
        else
        {
            $brand_validation ='required|unique:brands,name';
            $brand_image_validation='required|mimes:jpg,jpeg,png';
        }

        $req->validate([
            'brand'=>$brand_validation,
            'brand_image'=>$brand_image_validation,
        ]);


        
        if($brand_id>0)
        {
            $model = Brand::find($brand_id);
            $msg = "Brand Updated Successfully";
        }
        else
        {
            $model = new Brand();
            $model->status = 1;

            $msg = "Brand Inserted Successfully";
        }

        $model->name = $brand;
        if($req->hasfile('brand_image'))
        {
            if($brand_id>0)
            {
                $brand_img_arr = Brand::find($brand_id);
                $brand_img = $brand_img_arr->image;
                if(Storage::exists('/public/media/brand/'.$brand_img))
                {
                    Storage::delete('/public/media/brand/'.$brand_img);
                }
            }
            $brand_image = $req->file('brand_image');
            $extension = $brand_image->extension();
            $updated_brand_image = time().'.'.$extension;
            $brand_image->storeAs('/public/media/brand',$updated_brand_image);
            $model->image = $updated_brand_image;

        }
        $model->save();
        // return "success";
        $req->session()->flash('msg',$msg);
        return redirect('/admin/brand');
    }

    public function brand_status(Request $req, $status, $id)
    {
        $result = Brand::find($id);
        $result->status = $status;
        $result->save();
        $req->session()->flash('msg', 'Status Updated Successfully');
        return redirect('/admin/brand');
    }

    public function delete_brand($id)
    {
        $brand_id = $id;
        $record = Brand::find($brand_id);
        $brand_img = $record->image;
        if(Storage::exists('/public/media/brand/'.$brand_img))
        {
            Storage::delete('/public/media/brand/'.$brand_img);
        }
        $record->delete();
    }
}
