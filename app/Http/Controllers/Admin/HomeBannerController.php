<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\HomeBanner;
use Illuminate\Http\Request;
use Storage;

class HomeBannerController extends Controller
{
    public function index()
    {
        $result['data'] = HomeBanner::orderBy('id', 'DESC')->get();
        return view('admin/banner',$result);
    }

    public function manage_banner($id='')
    {
        if($id>0)
        {
            $arr = HomeBanner::where(['id'=>$id])->get();
            $result['banner_image'] = $arr[0]->banner_image;
            $result['offer_txt'] = $arr[0]->offer_txt;
            $result['main_heading'] = $arr[0]->main_heading;
            $result['short_content'] = $arr[0]->short_content;
            $result['link_txt'] = $arr[0]->link_txt;
            $result['url'] = $arr[0]->url;
            $result['id'] = $arr[0]->id;
        }
        else
        {
            $result['banner_image'] = "";
            $result['offer_txt'] = "";
            $result['main_heading'] = "";
            $result['short_content'] = "";
            $result['link_txt'] = "";
            $result['url'] = "";
            $result['id'] = "";
        }
        return view('admin/manage_banner', $result);
    }

    public function manage_banner_process(Request $req)
    {
        $regex = '/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/';
        if($req->post('banner_id') !="")
        {
            $req->validate([
                'banner_image'=>'mimes:jpg,jpeg,png',
                // 'banner_link'=>'regex:'.$regex,
            ]);
        }
        else
        {
            $req->validate([
                'banner_image'=>'required|mimes:jpg,jpeg,png',
                // 'banner_link'=>'regex:'.$regex,
            ]);
        }
        
        $banner_link_text = $req->post('banner_link_text');
        $banner_link = $req->post('banner_link');
        $offer_text = $req->post('offer_text');
        $main_heading = $req->post('main_heading');
        $short_description = $req->post('short_description');
        $banner_id = $req->post('banner_id');
        if($banner_id>0)
        {
            $model = HomeBanner::find($banner_id);
            $msg = "Tax Updated Successfully";
        }
        else
        {
            $model = new HomeBanner();
            $msg = "Tax Inserted Successfully";
        }
        $model->offer_txt = $offer_text;
        $model->main_heading = $main_heading;
        $model->short_content = $short_description;
        $model->link_txt = $banner_link_text;
        $model->url = $banner_link;
        if($req->hasfile('banner_image'))
        {
            if($banner_id>0)
            {
                $banner_img_arr = HomeBanner::find($banner_id);
                $banner_img = $banner_img_arr->banner_image;
                if(Storage::exists('/public/media/banner/'.$banner_img))
                {
                    Storage::delete('/public/media/banner/'.$banner_img);
                }
            }
            $banner_image = $req->file('banner_image');
            $extension = $banner_image->extension();
            $updated_banner_image = time().'.'.$extension;
            $banner_image->storeAs('/public/media/banner',$updated_banner_image);
            $model->banner_image = $updated_banner_image;

        }
        $model->save();
        $req->session()->flash('msg',$msg);
        return redirect('/admin/banner');
    }

    public function delete_banner($id)
    {
        $banner_id = $id;
        $record = HomeBanner::find($banner_id);
        $record->delete();
    }
}
