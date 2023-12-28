<?php

namespace App\Http\Controllers\Front;
use App\Models\Admin\HomeBanner;
use App\Models\Admin\Category;
use App\Models\Admin\Customer;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Cookie;
use Crypt;
use Mail;

class FrontController extends Controller
{
    public function index() {

        $result['banners'] = HomeBanner::all();

        $result['home_categories'] = Category::where(['status'=>1])
                                    ->where(['is_homepage'=>1])
                                    ->get();

        foreach($result['home_categories'] as $list)
        {
            // echo "<pre>"; print_r($list); echo "</pre>";
            $result['home_categories_product'][$list->id] = DB::table('products')
                                                    ->where(['status'=>1])
                                                    ->where(['category_id'=>$list->id])
                                                    ->get();
            foreach($result['home_categories_product'][$list->id] as $product_id)
            {
                $result['product_attr'][$product_id->id] = DB::table('product_attribute')
                ->leftJoin('sizes','sizes.id','=','product_attribute.size_id')
                ->leftJoin('colors','colors.id','=','product_attribute.color_id')
                ->where(['product_id'=>$product_id->id])
                ->get();
            }
        }
        // dd((array) $result);
        /* Featured Product Array */
        $result['home_featured_product'] = DB::table('products')
                                            ->where(['status'=>1])
                                            ->where(['is_featured'=>1])
                                            ->get();
        foreach($result['home_featured_product'] as $product)
        {
            $result['featured_product_attr'][$product->id] = DB::table('product_attribute')
            ->leftJoin('sizes','sizes.id','=','product_attribute.size_id')
            ->leftJoin('colors','colors.id','=','product_attribute.color_id')
            ->where(['product_id'=>$product->id])
            ->get();
        }

        /* Featured Product Array */
        $result['home_tranding_product'] = DB::table('products')
                                            ->where(['status'=>1])
                                            ->where(['is_tranding'=>1])
                                            ->get();
        foreach($result['home_tranding_product'] as $product)
        {
            $result['tranding_product_attr'][$product->id] = DB::table('product_attribute')
            ->leftJoin('sizes','sizes.id','=','product_attribute.size_id')
            ->leftJoin('colors','colors.id','=','product_attribute.color_id')
            ->where(['product_id'=>$product->id])
            ->get();
        }

        /* Discounted Product Array */
        $result['home_discounted_product'] = DB::table('products')
                                            ->where(['status'=>1])
                                            ->where(['is_discount'=>1])
                                            ->get();
        foreach($result['home_discounted_product'] as $product)
        {
            $result['discounted_product_attr'][$product->id] = DB::table('product_attribute')
            ->leftJoin('sizes','sizes.id','=','product_attribute.size_id')
            ->leftJoin('colors','colors.id','=','product_attribute.color_id')
            ->where(['product_id'=>$product->id])
            ->get();
        }
        
        /* Brand Array */
        $result['home_brand'] = DB::table('brands')
                                    ->where(['status'=>1])
                                    ->get();
        // echo "<pre>"; print_r($result); echo "</pre>";
        // die();
        return view('front.index',$result);
    }

    public function product($slug)
    {
        $result['product'] = DB::table('products')
                                            ->where(['status'=>1])
                                            ->where(['slug'=>$slug])
                                            ->get();
        foreach($result['product'] as $product)
        {
            $result['product_attr'][$product->id] = DB::table('product_attribute')
            ->leftJoin('sizes','sizes.id','=','product_attribute.size_id')
            ->leftJoin('colors','colors.id','=','product_attribute.color_id')
            ->where(['product_id'=>$product->id])
            ->get();
        }
        $category_id = $result['product'][0]->category_id;
        $curent_id = $result['product'][0]->id;

        $result['product_image'] = DB::table('product_image')
                                            ->where(['product_id'=>$curent_id])
                                            ->get();
        
        $result['related_product'] = DB::table('products')
        ->where("id","!=",$result['product'][0]->id)
                                            ->where(['status'=>1])
                                            ->where(['category_id'=>$result['product'][0]->category_id])
                                            ->get();
        foreach($result['related_product'] as $product)
        {
            $result['related_product_attr'][$product->id] = DB::table('product_attribute')
            ->Join('sizes','sizes.id','=','product_attribute.size_id')
            ->Join('colors','colors.id','=','product_attribute.color_id')
            ->where(['product_id'=>$product->id])
            ->get();
        }
        // echo "<pre>"; print_r($result); echo "</pre>";
        return view('front.product',$result);
    }

    public function add_to_cart(Request $req)
    {
        if($req->session()->has('CART_USER_LOGIN'))
        {
            $userid = $req->session()->get('FRONT_CUSTOMER_ID');
            $usertype = "reg";
        }
        else
        {
            $userid = getusertempid();
            $usertype = "no-reg";
        }
        $size = $req->post('hidden_size');
        $color = $req->post('hidden_color');
        $qty = $req->post('hidden_qty');
        $product_id = $req->post('product_id');
        $result = DB::table('product_attribute')
            ->Join('sizes','sizes.id','=','product_attribute.size_id')
            ->Join('colors','colors.id','=','product_attribute.color_id')
            ->where(['product_id'=>$product_id])
            ->where(['sizes.size'=>$size])
            ->where(['colors.color'=>$color])
            ->select('product_attribute.id','sizes.id as size','colors.id as color')
            ->get();
        $product_attr_id = $result[0]->id;
        $product_cart_size = $result[0]->size;
        $product_cart_color = $result[0]->color;

        $check = DB::table('cart')
                ->where(['user_id'=>$userid])
                ->where(['user_type'=>$usertype])
                ->where(['product_id'=>$product_id])
                ->where(['product_attr_id'=>$product_attr_id])
                ->get();

        if(isset($check[0]))
        {
            $update_id = $check[0]->id;
            $update_qty = $check[0]->qty;
            DB::table('cart')
            ->where('id', $update_id)
            ->update([
                'qty'=>$update_qty+1,
                'product_id'=>$product_id,
                'product_attr_id'=>$product_attr_id
            ]);
            $msg = "updated";
        }
        else
        {
            DB::table('cart')->insert([
                'user_id'=>$userid,
                'user_type'=>$usertype,
                'qty'=>$qty,
                'product_id'=>$product_id,
                'product_attr_id'=>$product_attr_id
            ]);
            $msg = "added";
        }   
        $nav_cart = get_cart_detail();
        return response()->json(['msg'=>$msg,'nav_cart_detail'=>$nav_cart]);
    }

    public function cart(Request $req)
    {
        if($req->session()->has('CART_USER_LOGIN'))
        {
            $userid = $req->session()->get('FRONT_CUSTOMER_ID');
        }
        else
        {
            $userid = getusertempid();
        }
        $result['cart'] = DB::table('cart')
        ->Join('products','products.id','=','cart.product_id')
        ->Join('product_attribute','product_attribute.id','=','cart.product_attr_id')
        ->Join('sizes','sizes.id','=','product_attribute.size_id')
        ->Join('colors','colors.id','=','product_attribute.color_id')
        ->where(['cart.user_id'=>$userid])
        ->select('products.product_name','cart.product_id','cart.product_attr_id','product_attribute.price','product_attribute.attr_image','cart.qty', 'cart.id', 'sizes.size', 'colors.color')
        ->get();
        // prx($result);
        return view('front/cart',$result);
    }

    public function update_cart_qty(Request $req)
    {
        $qty = $req->post('hidden_qty');
        $product_id = $req->post('hidden_product_id');
        $product_attr_id = $req->post('hidden_product_attr_id');
        $price = $req->post('hidden_price');
        if($req->session()->has('CART_USER_LOGIN'))
        {
            $userid = $req->session()->get('FRONT_CUSTOMER_ID');
        }
        else
        {
            $userid = getusertempid();
        }
        $price = $qty*$price;
        if($qty != 0)
        {
            DB::table('cart')
                ->where('product_id', $product_id)
                ->where('product_attr_id', $product_attr_id)
                ->where('user_id', $userid)
                ->update([
                    'qty'=>$qty
                ]);
            $nav_cart = get_cart_detail();  
            return response()->json(['price'=>$price,'nav_cart_detail'=>$nav_cart]);
        }
        else
        {
            $cart_id = $req->post('hidden_cart_id');
            DB::table('cart')
                ->where('id', $cart_id)
                ->delete();
            $nav_cart = get_cart_detail();
            return response()->json(['msg'=>'deleted','nav_cart_detail'=>$nav_cart]); 
        }
    }

    public function category(Request $req, $slug)
    {
        $result['category'] = DB::table('categories')
                                ->where(['slug'=>$slug])
                                ->get();
        $sort = "";
        $color_filter = "";
        $color_filter_arr = array();
        if($req->get('sort_type'))
        {
            $sort = $req->get('sort_type');
        }
        if($req->get('color_filter'))
        {
            $color_filter = $req->get('color_filter');
        }
        if($req->get('price_range_start') !== null && $req->get('price_range_end') !== null)
        {
            $price_range_start = $req->get('price_range_start');
            $price_range_end = $req->get('price_range_end');
        }
        $query = DB::table('products');
        $query = $query->join('categories','products.category_id','=','categories.id');
        $query = $query->join('product_attribute','product_attribute.product_id','=','products.id');
        $query = $query->where(['products.status'=>1]);
        $query = $query->where(['categories.slug'=>$slug]);
        if($sort == 'name'){
            $query = $query->orderBy('products.product_name','asc');
        }
        if($sort == 'date'){
            $query = $query->orderBy('products.id','desc');
        }
        if($sort == 'price_asc'){
            $query = $query->orderBy('product_attribute.price','asc');
        }
        if($sort == 'price_desc'){
            $query = $query->orderBy('product_attribute.price','desc');
        }
        if($req->get('price_range_start') !== null && $req->get('price_range_end') !== null)
        {
            $price_range_start = $req->get('price_range_start');
            $price_range_end = $req->get('price_range_end');
            if($price_range_start !== 0 && $price_range_end !== 0){
                $query = $query->whereBetween('product_attribute.price',[$price_range_start,$price_range_end]);
            }
        }
        if($color_filter != ""){
            $colors = trim($color_filter,",");
            $color_filter_arr = explode(",",$colors);
            // prx($color_filter_arr);
            $query = $query->whereIn('product_attribute.color_id', $color_filter_arr);
        }
        $query = $query->distinct()->select('products.*');
        $query = $query->get();
        $result['category_product'] = $query;
        // prx($result['category_product']);
        foreach($result['category_product'] as $product)
        {
            $attr_query = DB::table('product_attribute');
            $attr_query = $attr_query->leftJoin('sizes','sizes.id','=','product_attribute.size_id');
            $attr_query = $attr_query->leftJoin('colors','colors.id','=','product_attribute.color_id');
            $attr_query = $attr_query->where(['product_attribute.product_id'=>$product->id]);
            $attr_query = $attr_query->get();
            $result['category_product_attr'][$product->id] = $attr_query;
        }
        $result['price_range'] = DB::table('categories')
        ->join('products','products.category_id', '=', 'categories.id')
        ->join('product_attribute','product_attribute.product_id','=','products.id')
        ->where(['categories.slug'=>$slug])
        ->distinct()->select('product_attribute.price')
        ->orderBy('product_attribute.price', 'DESC')
        ->get();
        // prx($result['price_range']);

        $result['colors'] = DB::table('colors')
                                ->where(['status'=>1])
                                ->get();
        $result['left_categories'] = DB::table('categories')
        ->where(['status'=>1])
        ->get();
        $result['color_id'] = $color_filter;
        $result['color_filter_arr'] = $color_filter_arr;
        return view('front/category',$result);
    }

    public function search($string)
    {
        $query = DB::table('products');
        $query = $query->join('categories','products.category_id','=','categories.id');
        $query = $query->join('product_attribute','product_attribute.product_id','=','products.id');
        $query = $query->where(['products.status'=>1]);
        $query = $query->where('products.product_name','like',"%$string%");
        $query = $query->orwhere('products.model','like',"%$string%");
        $query = $query->orwhere('products.description','like',"%$string%");
        $query = $query->orwhere('products.short_description','like',"%$string%");
        $query = $query->orwhere('products.keywords','like',"%$string%");
        $query = $query->orwhere('products.technical_specification','like',"%$string%");
        $query = $query->distinct()->select('products.*');
        $query = $query->get();
        $result['product'] = $query;
        // prx($result['category_product']);
        foreach($result['product'] as $product)
        {
            $attr_query = DB::table('product_attribute');
            $attr_query = $attr_query->leftJoin('sizes','sizes.id','=','product_attribute.size_id');
            $attr_query = $attr_query->leftJoin('colors','colors.id','=','product_attribute.color_id');
            $attr_query = $attr_query->where(['product_attribute.product_id'=>$product->id]);
            $attr_query = $attr_query->get();
            $result['product_attr'][$product->id] = $attr_query;
        }
        // prx($result);
        return view('front/search',$result);
    }

    public function registration(Request $req)
    {
        // echo $req->cookie('refferel_code');
        // die();
        if($req->session()->has('FRONT_CUSTOMER_ID'))
        {
            return redirect('/');
        }
        return view('front/register');
    }

    public function registration_process(Request $req)
    {
        // prx($req->all());
        $valid = Validator::make($req->all(),[
            'customer_name'=>'required',
            'customer_email'=>'required|email|unique:customers,email',
            'customer_password'=>'required',
            'customer_mobile'=>'required|string|min:10|max:10',
        ]);

        if(!$valid->passes())
        {
            return response()->json(['status'=>'error','error'=>$valid->errors()]);
        }
        else
        {
            $rand_id = rand(111111111,999999999);
            $refferal_code = rand(1111,9999);
            $refferer_id = NULL;
            if($req->hasCookie('refferel_code') == 1)
            {
                $result = Customer::where(['refferal_code'=>$req->cookie('refferel_code')])->get();
                $refferer_id = $result[0]->id;
            }
            $arr = array(
                "name"=>$req->post("customer_name"),
                "email"=>$req->post("customer_email"),
                "password"=>Crypt::encrypt($req->post("customer_password")),
                "mobile"=>$req->post("customer_mobile"),
                "status"=>0,
                "is_verified"=>0,
                "is_reset_password"=>1,
                "rand_id"=>$rand_id,
                "refferal_code"=>$refferal_code,
                "refferer_id"=>$refferer_id,
                "created_at"=>date("Y-m-d h:i:s"),
                "updated_at"=>date("Y-m-d h:i:s")
            );
            $query = DB::table('customers')->insert($arr);
            if($query)
            {

                $data = ['name'=>$req->post("customer_name"),'rand_id'=>$rand_id];
                $user['to'] = $req->post("customer_email");
                Mail::send('front/email_body',$data,function($messages) use ($user){
                    $messages->to($user['to']);
                    $messages->subject('Email Id Verification');
                });
                return response()->json(['status'=>'success','msg'=>"Registration Successfully. Please Check Your Mail To Verify Your Gmail ID"]);
            }
        }
    }

    public function login_process(Request $req)
    {
        $result = DB::table('customers')
        ->where(['email'=>$req->post('login_email')])
        ->get();
        if(isset($result[0]))
        {
            $decrypt_pass = Crypt::decrypt($result[0]->password);
            // if($result[0]->status == 0)
            // {
            //     return response()->json(['status'=>'error','error'=>'Your Account is Not Activated']);
            // }
            if($result[0]->is_verified == 0)
            {
                return response()->json(['status'=>'error','error'=>'Your Email Address is Not Verified']);
            }
            if($req->post('login_password') == $decrypt_pass)
            {
                $req->session()->put("CART_USER_LOGIN",true);
                $req->session()->put("FRONT_CUSTOMER_ID",$result[0]->id);
                $req->session()->put("FRONT_CUSTOMER_NAME",$result[0]->name);
                $temp_uder_id = getusertempid();
                
                DB::table('cart')
                ->where(['user_id'=>$temp_uder_id, 'user_type'=>'no-reg'])
                ->update(['user_id'=>$result[0]->id, 'user_type'=>'reg']);
                return response()->json(['status'=>'success']);
            }
            else
            {
                return response()->json(['status'=>'error','error'=>'Invalid Password']);
            }
        }
        else
        {
            return response()->json(['status'=>'error','error'=>'Invalid Email Address']);
        }
    
    }
    public function customer_verification($id)
    {
        $result = DB::table('customers')
        ->where(['rand_id'=>$id])
        ->get();
        
        if(isset($result[0]))
        {
            DB::table('customers')
            ->where(['id'=>$result[0]->id])
            ->update(['status'=>1,'is_verified'=>1]);
            return view('/front/email_verfication');
        }
        else
        {
            return redirect('/');
        }
    }

    public function reset_password_process(Request $req)
    {
        $result = DB::table('customers')
        ->where(['email'=>$req->post('lost_your_password_email')])
        ->get();
        $encrypt_id = Crypt::encrypt($result[0]->id);
        // return Crypt::decrypt($encrypt);
        // prx($result);
        if(isset($result[0]))
        {
            DB::table('customers')
            ->where(['email'=>$req->post('lost_your_password_email')])
            ->update(['is_reset_password'=>0]);
            $data = ['name'=>$result[0]->name,'customer_id'=>$encrypt_id];
            $user['to'] = $req->post("lost_your_password_email");
            Mail::send('front/reset_pass_email_body',$data,function($messages) use ($user){
                $messages->to($user['to']);
                $messages->subject('Reset Password');
            });
            return response()->json(['status'=>'success','msg'=>"Please Check Your Email To Reset Your Password"]);
        }
        else
        {
            return response()->json(['status'=>'error','error'=>'This Email Address is not registered']);
        }  
    }

    public function reset_password_form($id)
    {
        $customer_id = Crypt::decrypt($id);
        $result = DB::table('customers')
        ->where(['id'=>$customer_id])
        ->get();
        if($result[0]->is_reset_password == 0)
        {
            $is_reset_password = "not_expired";
        }
        elseif($result[0]->is_reset_password == 1)
        {
            $is_reset_password = "expired";
        }
        return view('front/reset_password', ['customer_id'=>$customer_id, 'expiry'=>$is_reset_password]);
    }

    public function forgot_password_process(Request $req)
    {
        $validation = Validator::make($req->all(),[
            'password'=>'required',
            'confirm_password'=>'required',
        ]);
        if(!$validation->passes())
        {
            return response()->json(['status'=>'error','error'=>$validation->errors()]);
        }
        else
        {
            if($req->post('password') !== $req->post('confirm_password'))
            {
                return response()->json(['status'=>'cofirmation_error']);
            }
            else
            {
                $new_password = Crypt::encrypt($req->post('password'));
                DB::table('customers')
                ->where(['id'=>$req->post('customer_id')])
                ->update(['password'=>$new_password, 'is_reset_password'=>1]);
                return response()->json(['status'=>'success','msg'=>"Your Password Successfully Updated."]);

            }

        }
    }

    public function checkout(Request $req)
    {
        $result['cart'] = get_cart_detail();
        
        if(isset($result['cart'][0]))
        {
            if($req->session()->has('CART_USER_LOGIN'))
            {
                $userid = $req->session()->get('FRONT_CUSTOMER_ID');
                $result['customer'] = DB::table('customers')
                ->where(['id'=>$userid])
                ->get();
                $result['customer']['name'] = $result['customer'][0]->name;
                $result['customer']['email'] = $result['customer'][0]->email;
                $result['customer']['mobile'] = $result['customer'][0]->mobile;
                $result['customer']['company'] = $result['customer'][0]->company;
                $result['customer']['city'] = $result['customer'][0]->city;
                $result['customer']['state'] = $result['customer'][0]->state;
                $result['customer']['zip'] = $result['customer'][0]->zip;
            }
            else
            {
                $result['customer']['name'] = "";
                $result['customer']['email'] = "";
                $result['customer']['mobile'] = "";
                $result['customer']['company'] = "";
                $result['customer']['city'] = "";
                $result['customer']['state'] = "";
                $result['customer']['zip'] = "";
            }
            return view('front/checkout', $result);
            // prx($result);
        }
        else
        {
            return redirect('/');
        }
        // prx($result);
    }

    public function apply_coupon_code(Request $req)
    {
        
        $arr = apply_coupon($req->post('coupon_code'));
        return $arr;


    }

    public function place_order(Request $req)
    {
        $checkout_url = "";
        $coupon_value = 0;
        $payment_id = 0;
        if($req->session()->has('CART_USER_LOGIN')){

        }else{
            $valid = Validator::make($req->all(),[
                'email'=>'required|email|unique:customers,email',
            ]);
    
            if(!$valid->passes())
            {
                return response()->json(['status'=>'required_error','error'=>$valid->errors()]);
            }else{
                $rand_id = rand(111111111,999999999);
                $arr = array(
                    "name"=>$req->post("customer_name"),
                    "email"=>$req->post("email"),
                    "password"=>Crypt::encrypt($rand_id),
                    "mobile"=>$req->post("phome_number"),
                    "company"=>$req->post("company_name"),
                    "state"=>$req->post("state"),
                    "city"=>$req->post("city_town"),
                    "zip"=>$req->post("zip"),
                    "status"=>1,
                    "is_verified"=>1,
                    "is_reset_password"=>1,
                    "rand_id"=>$rand_id,
                    "created_at"=>date("Y-m-d h:i:s"),
                    "updated_at"=>date("Y-m-d h:i:s")
                );
                $user_id = DB::table('customers')->insertGetId($arr);
                if($user_id)
                {
                    $data = ['name'=>$req->post("customer_name"),'rand_id'=>$rand_id];
                    $user['to'] = $req->post("email");
                    Mail::send('front/guest_checkout_email',$data,function($messages) use ($user){
                        $messages->to($user['to']);
                        $messages->subject('Your Password');
                    });
                }
                $req->session()->put("CART_USER_LOGIN",true);
                $req->session()->put("FRONT_CUSTOMER_ID",$user_id);
                $req->session()->put("FRONT_CUSTOMER_NAME",$req->post("customer_name"));
                $temp_uder_id = getusertempid();
                
                DB::table('cart')
                ->where(['user_id'=>$temp_uder_id, 'user_type'=>'no-reg'])
                ->update(['user_id'=>$user_id, 'user_type'=>'reg']);
            }
        }
            
            if($req->post('coupon_code') != "")
            {
                $arr = apply_coupon($req->post('coupon_code'));
                $arr = json_decode($arr, true);
                if($arr['status'] == "success")
                {
                    $coupon_value = $arr['coupon_code_price'];
                }
                else
                {
                    return response()->json(['status'=>'false','msg'=>$arr['msg']]);
                }
            }
            $userid = $req->session()->get('FRONT_CUSTOMER_ID');

            $totalprice = 0;
            $get_cart_detail = get_cart_detail();
            foreach($get_cart_detail as $item)
            {
                $totalprice = round($totalprice + ($item->price * $item->qty));
            }
            if($req->post("payment_type") == "cod"){
                $totalprice = $totalprice;
                $order_status = 2;
                $checkout_url ="";
            }else{
                $totalprice = $totalprice - $coupon_value;
                $order_status = 1;
                
            }
            $arr = array(
                "customer_id"=>$userid,
                "name"=>$req->post("customer_name"),
                "email"=>$req->post("email"),
                "mobile"=>$req->post("phome_number"),
                "company"=>$req->post("company_name"),
                "state"=>$req->post("state"),
                "city"=>$req->post("city_town"),
                "pincode"=>$req->post("zip"),
                "coupon_code"=>$req->post('coupon_code'),
                "coupon_value"=>$coupon_value,
                "order_status"=>$order_status,
                "payment_type"=>$req->post("payment_type"),
                "payment_status"=>0,
                "payment_id"=>0,
                "total_amt"=>$totalprice,
                "added_on"=>date("d/m/Y"),
                "created_at"=>date("Y-m-d h:i:s"),
                "updated_at"=>date("Y-m-d h:i:s")
            );

            $order_id = DB::table('orders')->insertGetId($arr);
            if($order_id > 0)
            {
                foreach($get_cart_detail as $item)
                {
                    $detail_arr = array(
                        'order_id' => $order_id,
                        'product_attr_id' => $item->product_attr_id,
                        'price' => $item->price,
                        'qty' => $item->qty,
                    );
                    $order_detail_query = DB::table('orders_detail')->insert($detail_arr);
                }

                /* Stripe Payment Gateway Integration */
                
                if($req->post("payment_type") == "gateway")
                {
                    \Stripe\Stripe::setApiKey(config('stripe.sk'));
                    $checkout_session = \Stripe\Checkout\Session::create([
                        'line_items' => [[
                          'price_data' => [
                                'currency' => 'INR',
                                'product_data' => [
                                    "name" => "Your order is placed, please make the payment",
                                ],
                                'unit_amount' => $totalprice * 100,
                            ],
                          'quantity' => 1,
                        ]],
                        'mode' => 'payment',
                        'success_url' => route('order_gateway_placed',[$order_id]),
                        'cancel_url' => route('checkout'),
                      ]);
                      $checkout_url = $checkout_session->url;
                      $payment_id = $checkout_session->id;
                      if($payment_id != 0)
                      {
                             $req->session()->put('GATEWAY_PAYMENT_ID', $payment_id);
                      }
                }
                // return response()->json(['status'=>'success', 'url'=>$checkout_session->url]);
                if($req->post("payment_type") == "cod")
                {
                    DB::table('cart')
                    ->where(['user_id'=>$userid, 'user_type'=>'reg'])
                    ->delete();
                }
                $req->session()->put('CUSTOMER_ORDER_ID', $order_id);

                $status = "success";
                $msg = "Order Placed Successfully";
            }
            else
            {
                $status = "false";
                $msg = "Something Went Wrong!";
            }
        
        return response()->json(['status'=>$status,'msg'=>$msg,'checkout_url' => $checkout_url]);
    }

    public function order_placed(Request $req)
    {
        if($req->session()->has('CUSTOMER_ORDER_ID'))
        {
            $req->session()->forget('CUSTOMER_ORDER_ID');
            return view('front/order_placed');
        }
        else
        {
            return redirect('/');
        }
    }
    public function order_gateway_placed(Request $req, $order_id)
    {
        if($req->session()->has('CUSTOMER_ORDER_ID'))
        {
            DB::table('orders')
            ->where('id', $order_id)
            ->update([
                'order_status'=>2,
            ]);
            if($req->session()->has('GATEWAY_PAYMENT_ID'))
            {
                $payment_id = $req->session()->get('GATEWAY_PAYMENT_ID');
                DB::table('orders')
                ->where('id', $order_id)
                ->update([
                    'payment_id'=>$payment_id,
                ]);
            }

            $userid = $req->session()->get('FRONT_CUSTOMER_ID');
            DB::table('cart')
            ->where(['user_id'=>$userid, 'user_type'=>'reg'])
            ->delete();
            $req->session()->forget('CUSTOMER_ORDER_ID');
            return view('front/order_gateway_placed');
        }
        else
        {
            return redirect('/');
        }
    }

    public function reffer_friend()
    {
        return view('front.refferal');
    }

    public function reffer_friend_process(Request $req)
    {

        if($req->session()->has('FRONT_CUSTOMER_ID'))
        {
            $userid = $req->session()->get('FRONT_CUSTOMER_ID');
            $result = Customer::where(['id'=>$userid])->get();
            // prx($result);
            $refferal_code = $result[0]->refferal_code;
            $name = $result[0]->name;
            $data = ['name'=>$name,'refferal_code'=>$refferal_code];
            $user['to'] = $req->reffer_email;
            Mail::send('front/reffer_email_body',$data,function($messages) use ($user){
                $messages->to($user['to']);
                $messages->subject('Reffer Code');
            });
            return redirect("/reffer_friend");
        }
    }
   
}
