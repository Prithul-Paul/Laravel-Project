<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Admin\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Storage;

class ProductController extends Controller
{
    public function index()
    {
        $result['data'] = Product::orderBy('id', 'DESC')->get();
        return view('admin/product',$result);
    }


    public function manage_product($id='')
    {
        if($id>0)
        {
            $arr = Product::where(['id'=>$id])->get();
            $result['category_id'] = $arr[0]->category_id;
            $result['brand_id'] = $arr[0]->brand;
            $result['product_name'] = $arr[0]->product_name;
            $result['slug'] = $arr[0]->slug;
            $result['image'] = $arr[0]->image;
            $result['brand'] = $arr[0]->brand;
            $result['model'] = $arr[0]->model;
            $result['description'] = $arr[0]->description;
            $result['short_description'] = $arr[0]->short_description;
            $result['keywords'] = $arr[0]->keywords;
            $result['technical_specification'] = $arr[0]->technical_specification;
            $result['uses'] = $arr[0]->uses;
            $result['warrenty'] = $arr[0]->warrenty;
            $result['tax_id'] = $arr[0]->tax_id;
            $result['lead_time'] = $arr[0]->lead_time;
            $result['is_promo'] = $arr[0]->is_promo;
            $result['is_featured'] = $arr[0]->is_featured;
            $result['is_discount'] = $arr[0]->is_discount;
            $result['is_tranding'] = $arr[0]->is_tranding;


            $result['id'] = $arr[0]->id;

            $result['product_attr'] = DB::table('product_attribute')->where(['product_id'=>$id])->get();

            // $result['gallery_arr'] = DB::table('product_image')->where(['product_id'=>$id])->get();
            $image_gallery_array = DB::table('product_image')->where(['product_id'=>$id])->get();
            if(!isset($image_gallery_array[0]))
            {
                $result['gallery_arr'][0]['id'] = "";
                $result['gallery_arr'][0]['image_name'] = "";
                $result['gallery_arr'][0]['product_id'] = "";
            }else{
                $result['gallery_arr'] = $image_gallery_array;
            }
        }
        else
        {
            $result['category_id'] = "";
            $result['brand_id'] = "";
            $result['product_name'] = "";
            $result['slug'] = "";
            $result['image'] = "";
            $result['brand'] = "";
            $result['model'] = "";
            $result['description'] = "";
            $result['short_description'] = "";
            $result['keywords'] = "";
            $result['technical_specification'] = "";
            $result['uses'] = "";
            $result['warrenty'] = "";
            $result['lead_time'] = "";
            $result['tax_id'] = "";
            $result['is_promo'] = "";
            $result['is_featured'] = "";
            $result['is_discount'] = "";
            $result['is_tranding'] = "";
            $result['id'] = "";

            $result['product_attr'][0]['id'] = "";
            $result['product_attr'][0]['product_id'] = "";
            $result['product_attr'][0]['sku'] = "";
            $result['product_attr'][0]['attr_image'] = "";
            $result['product_attr'][0]['mrp'] = "";
            $result['product_attr'][0]['price'] = "";
            $result['product_attr'][0]['qty'] = "";
            $result['product_attr'][0]['size_id'] = "";
            $result['product_attr'][0]['color_id'] = "";

            $result['gallery_arr'][0]['id'] = "";
            $result['gallery_arr'][0]['image_name'] = "";
            $result['gallery_arr'][0]['product_id'] = "";


        }
        /* Category Dropdown */
        $result['categories'] = DB::table('categories')->where(['status'=>1])->get();

        /* Size Dropdown */
        $result['sizes'] = DB::table('sizes')->where(['status'=>1])->get();
        
        /* Color Dropdown */
        $result['colors'] = DB::table('colors')->where(['status'=>1])->get();

        /* Brand */
        $result['brands'] = DB::table('brands')->where(['status'=>1])->get();

        /* Tax */
        $result['taxes'] = DB::table('taxes')->where(['status'=>1])->get();
        // echo "<pre>"; print_r($result['gallery_arr']); echo "</pre>";
        // die();
        return view('admin/manage_product', $result);
    }
    public function manage_product_process(Request $req)
    {
        // echo "<pre>";
        // print_r($req->post());
        // echo "<pre>";
        // die();
        if($req->post('id') != "")
        {
            $req->validate([
                'product_name'=>'required',
                'image'=>'mimes:jpeg,jpg,png',
                'slug'=>'required',
                'attr_image.*'=>'mimes:jpeg,jpg,png',
                'gallery_image.*'=>'mimes:jpeg,jpg,png',
            ]);
        }
        else
        {
            $req->validate([
                'product_name'=>'required',
                'image'=>'required|mimes:jpeg,jpg,png',
                'attr_image.*'=>'mimes:jpeg,jpg,png',
                'gallery_image.*'=>'mimes:jpeg,jpg,png',
            ]);
        }

        $product_name = $req->post('product_name');
        $product_category = $req->post('category');
        $brand = $req->post('brand');
        $product_model = $req->post('model');
        $description = $req->post('description');
        $short_description = $req->post('short_description');
        $keywords = $req->post('keywords');
        $technical_specification = $req->post('technical_specification');
        $uses = $req->post('uses');
        $warrenty = $req->post('warrenty');

        $lead_time = $req->post('lead_time');
        $tax_id = $req->post('tax_id');
        $is_promo = $req->post('is_promo');
        $is_featured = $req->post('is_featured');
        $is_discount = $req->post('is_discount');
        $is_tranding = $req->post('is_tranding');

        $id = $req->post('id');
        if($req->post('id') != "")
        {
            $slug = $req->post('slug');
        }

        
        function slug_generator($string)
        {
            $slug = "";
            $trim_cat_name = preg_replace('/[^a-z0-9]+/i', '-', trim(strtolower($string)));
            $slug = $trim_cat_name;
            $slug_check = Product::where('slug', '=', $trim_cat_name)->get();
            $slug_count = $slug_check->count();
            if($slug_count > 0)
            {
                $max_id = Product::max('id');
                $slug = $trim_cat_name."-".$max_id;
            }
            return $slug;
        }

        if($id>0)
        {
            $model = Product::find($id);
            if($slug != $model->slug)
            {
                $model->slug = slug_generator($slug);
            }
            $msg = "Product Updated Successfully";
        }
        else
        {
            $model = new Product();
            $model->slug = slug_generator($product_name);
            $msg = "Product Inserted Successfully";
        }

        /* Product Main Image Upload Start */
        if($req->hasfile('image'))
        {
            if($id>0)
            {
                $product_iamge_arr = DB::table('products')->where(['id'=>$id])->get();
                $product_delete_image = $product_iamge_arr[0]->image;
                if(Storage::exists('/public/media/product/product_image/'.$product_delete_image))
                {
                    Storage::delete('/public/media/product/product_image/'.$product_delete_image);
                }
            }
            $product_image = $req->file('image');
            $extension = $product_image->extension();
            $updated_product_image = time().'.'.$extension;
            $product_image->storeAs('/public/media/product/product_image',$updated_product_image);
            $model->image = $updated_product_image;

        }
        /* Product Main Image Upload End */

        $model->product_name = $product_name;
        $model->category_id = $product_category;
        $model->brand = $brand;
        $model->model = $product_model;
        $model->description = $description;
        $model->short_description = $short_description;
        $model->keywords = $keywords;
        $model->technical_specification = $technical_specification;
        $model->warrenty = $warrenty;
        $model->uses = $uses;
        $model->lead_time = $lead_time;
        $model->tax_id = $tax_id;
        $model->is_promo = $is_promo;
        $model->is_featured = $is_featured;
        $model->is_discount = $is_discount;
        $model->is_tranding = $is_tranding;
        $model->status = 1;
        $model->save();
        $pid = $model->id;

        /* Atrribute Management Start */
        foreach($req->post('sku') as $key => $val)
        {
            $sku = $val;
            $mrp = $req->post('mrp')[$key];
            $price = $req->post('price')[$key];
            $qty = $req->post('qty')[$key];
            $size = $req->post('size')[$key];
            $colors = $req->post('colors')[$key];
            $product_id = $pid;
            $product_attr_id = $req->post('product_attr_id')[$key];
            $product_att_arr = [];
            $product_att_arr['product_id'] = $product_id;
            $product_att_arr['sku'] = $sku;
            $product_att_arr['mrp'] = $mrp;
            $product_att_arr['price'] = $price;
            $product_att_arr['qty'] = $qty;
            $product_att_arr['size_id'] = $size;
            $product_att_arr['color_id'] = $colors;

            if($req->hasFile("attr_image.$key"))
            {
                $rand = rand('111111111','999999999');
                $product_attr_image = $req->file("attr_image.$key");
                $extension = $product_attr_image->extension();
                $updated_product_attr_image = time().'-'.$rand.'.'.$extension;
                $product_attr_image->storeAs('/public/media/product/product_attr_image',$updated_product_attr_image);
                $product_att_arr['attr_image'] = $updated_product_attr_image;
                if($product_attr_id != "")
                {
                    $product_attr_img_arr = DB::table('product_attribute')->where(['id'=>$product_attr_id])->get();
                    $product_delete_attr_image = $product_attr_img_arr[0]->attr_image;
                    if(Storage::exists('/public/media/product/product_attr_image/'.$product_delete_attr_image))
                    {
                        Storage::delete('/public/media/product/product_attr_image/'.$product_delete_attr_image);
                    }
                }
            }
            if($product_attr_id != "")
                {
                    DB::table('product_attribute')->where(['id'=>$product_attr_id])->update($product_att_arr);
                }
                else
                {
                    DB::table('product_attribute')->insert($product_att_arr);
                }

            
        }
        /* Atrribute Management End */

        /* Gallery Management Start */
        foreach($req->post('product_image_id') as $key => $val)
        {
            $gallery_image_arr['product_id'] = $pid;
            $gallery_image_id = $req->post('product_image_id')[$key];
            if($req->hasFile("gallery_image.$key"))
            {
                $rand = rand('111111111','999999999');
                $gallery_image = $req->file("gallery_image.$key");
                $extension = $gallery_image->extension();
                $updated_gallery_image = time().'-'.$rand.'.'.$extension;
                $gallery_image->storeAs('/public/media/product/product_gallery_image',$updated_gallery_image);
                $gallery_image_arr['image_name'] = $updated_gallery_image;
                if($gallery_image_id != "")
                {
                    $product_gal_img_arr = DB::table('product_image')->where(['id'=>$gallery_image_id])->get();
                    $product_gal_img = $product_gal_img_arr[0]->image_name;
                    if(Storage::exists('/public/media/product/product_gallery_image/'.$product_gal_img))
                    {
                        Storage::delete('/public/media/product/product_gallery_image/'.$product_gal_img);
                    }
                    DB::table('product_image')->where(['id'=>$gallery_image_id])->update($gallery_image_arr);
                }
                else
                {
                    DB::table('product_image')->insert($gallery_image_arr);
                }
            }
        }

        /* Gallery Management Start */
        $req->session()->flash('msg',$msg);
        return redirect('/admin/product/manage_product/'.$pid);
    }
    public function product_status(Request $req, $status, $id)
    {
        $result = Product::find($id);
        $result->status = $status;
        $result->save();
        $req->session()->flash('msg', 'Status Updated Successfully');
        return redirect('/admin/product');
    }
    public function delete_product($id)
    {
        $product_id = $id;
        $record = Product::find($product_id);
        $record->delete();
    }

    public function delete_attribute($pid, $paid)
    {
        $attr_iamge_arr = DB::table('product_attribute')->where(['id'=>$paid])->get();
        // echo "<pre>"; print_r($attr_iamge_arr[0]->attr_image); echo "</pre>";
        // die();
        $attr_iamge_name = $attr_iamge_arr[0]->attr_image;
        if(Storage::exists('/public/media/product/product_attr_image/'.$attr_iamge_name))
        {
            Storage::delete('/public/media/product/product_attr_image/'.$attr_iamge_name);
        }
        $product_id = $pid;
        $product_attr_id = $paid;
        DB::table('product_attribute')->where(['id'=>$product_attr_id])->delete();
        return redirect('admin/product/manage_product/'.$product_id);
    }
    public function delete_gallery_image($pid, $piid, $gallery_image)
    {
        if(Storage::exists('/public/media/product/product_gallery_image/'.$gallery_image))
        {
            Storage::delete('/public/media/product/product_gallery_image/'.$gallery_image);
        }
        $product_id = $pid;
        $gallery_image_id = $piid;
        DB::table('product_image')->where(['id'=>$gallery_image_id])->delete();
        return redirect('admin/product/manage_product/'.$product_id);
    }
}
