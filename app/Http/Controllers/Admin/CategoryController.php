<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Admin\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Storage;
class CategoryController extends Controller
{
    
    public function index()
    {
        $result['data'] = Category::orderBy('id', 'DESC')->get();
        return view('admin/category',$result);
    }

    public function manage_category($id='')
    {
        if($id>0)
        {
            $arr = Category::where(['id'=>$id])->get();
            $result['category_name'] = $arr[0]->name;
            $result['category_slug'] = $arr[0]->slug;
            $result['parent_category_id'] = $arr[0]->parent_category_id;
            $result['category_image'] = $arr[0]->category_image;
            $result['is_homepage'] = $arr[0]->is_homepage;
            $result['parent_category'] = DB::table('categories')->where(['status'=>1])->where('id','!=',$id)->get();
            $result['category_id'] = $arr[0]->id;
        }
        else
        {
            $result['category_name'] = "";
            $result['category_slug'] = "";
            $result['parent_category_id'] = "";
            $result['category_image'] = "";
            $result['is_homepage'] = "";
            $result['parent_category'] = DB::table('categories')->where(['status'=>1])->get();
            $result['category_id'] = "";
        }
        return view('admin/manage_category', $result);
    }

    public function manage_category_process(Request $req)
    {
        if($req->post('category_id') != "")
        { 
            $req->validate([
                'category_name'=>'required',
                'category_image'=>'mimes:jpg,jpeg,png',
                'category_slug'=>'required',
            ]);
        }
        else
        {
            $req->validate([
                'category_name'=>'required',
                'category_image'=>'required|mimes:jpg,jpeg,png',
            ]);
        }
        $category_name = $req->post('category_name');
        $parent_category_id = $req->post('parent_category_id');
        
        $category_id = $req->post('category_id');
        if($req->post('category_id') != "")
        {
            $category_slug = $req->post('category_slug');
        }

        
        function slug_generator($cat_name)
        {
            $slug = "";
            $trim_cat_name = preg_replace('/[^a-z0-9]+/i', '-', trim(strtolower($cat_name)));
            $slug = $trim_cat_name;
            $slug_check = Category::where('slug', '=', $trim_cat_name)->get();
            $slug_count = $slug_check->count();
            if($slug_count > 0)
            {
                $max_id = Category::max('id');
                $slug = $trim_cat_name."-".$max_id;
            }
            return $slug;
        }

        if($category_id>0)
        {
            $model = Category::find($category_id);
            if($category_slug != $model->slug)
            {
                $model->slug = slug_generator($category_slug);
            }
            $msg = "Category Updated Successfully";
        }
        else
        {
            $model = new Category();
            $model->status = 1;
            $model->slug = slug_generator($category_name);
            $msg = "Category Inserted Successfully";
        }
        if($req->hasfile('category_image'))
        {
            if($category_id>0)
            {
                $cat_img_arr = DB::table('categories')->where(['id'=>$category_id])->get();
                $cat_img = $cat_img_arr[0]->category_image;
                if(Storage::exists('/public/media/category/'.$cat_img))
                {
                    Storage::delete('/public/media/category/'.$cat_img);
                }
            }
            $category_image = $req->file('category_image');
            $extension = $category_image->extension();
            $updated_category_image = time().'.'.$extension;
            $category_image->storeAs('/public/media/category',$updated_category_image);
            $model->category_image = $updated_category_image;
        }
        $model->is_homepage = 0;
        if($req->post('is_homepage')!==null)
        {
            $model->is_homepage = 1;
        }
        $model->name = $category_name;
        $model->parent_category_id = $parent_category_id;
        $model->save();
        $req->session()->flash('msg',$msg);
        return redirect('/admin/category');
    }

    public function category_status(Request $req, $status, $id)
    {
        $result = Category::find($id);
        $result->status = $status;
        $result->save();
        $req->session()->flash('msg', 'Status Updated Successfully');
        return redirect('/admin/category');
    }
    public function delete_category($id)
    {
        $cat_img_arr = DB::table('categories')->where(['id'=>$id])->get();
        $cat_img = $cat_img_arr[0]->category_image;
        if(Storage::exists('/public/media/category/'.$cat_img))
        {
            Storage::delete('/public/media/category/'.$cat_img);
        }
        $category_id = $id;
        $record = Category::find($category_id);
        $record->delete();
    }
}
