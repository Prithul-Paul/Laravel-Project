<?php 
use Illuminate\Support\Facades\DB;
function prx($array)
{
    echo "<pre>"; print_r($array); echo "</pre>"; die();
}

function getusertempid()
{
    // return session()->has('USER_TEMP_ID');
    if(Session::has('USER_TEMP_ID'))
    {
        return Session::get('USER_TEMP_ID');
    }
    else
    {
        $rand = rand('11111','99999');
        Session::put('USER_TEMP_ID',$rand);
        return $rand;
    }
}

function get_cart_detail()
{
    if(Session::has('CART_USER_LOGIN'))
    {
        $userid = Session::get('FRONT_CUSTOMER_ID');
    }
    else
    {
        $userid = getusertempid();
    }
    $result = DB::table('cart')
        ->Join('products','products.id','=','cart.product_id')
        ->Join('product_attribute','product_attribute.id','=','cart.product_attr_id')
        ->Join('sizes','sizes.id','=','product_attribute.size_id')
        ->Join('colors','colors.id','=','product_attribute.color_id')
        ->where(['cart.user_id'=>$userid])
        ->select('products.product_name','cart.product_id','cart.product_attr_id','product_attribute.price','product_attribute.attr_image','cart.qty', 'cart.id', 'sizes.size', 'colors.color')
        ->get();
    return $result;
}

function apply_coupon($coupon_code)
{
    $totalprice = 0;
    $coupon_code_price = 0;
    $result = DB::table('coupons')
    ->where(['code'=>$coupon_code])
    ->get();
    if(isset($result[0]))
    {
        $value = $result[0]->value;
        $type = $result[0]->type;
        if($result[0]->is_onetime == 1)
        {
            $status = "error";
            $msg = "This is coupon is already used";
        }
        else
        {
            $min_order_amt = $result[0]->min_order_amt;
            $get_cart_detail = get_cart_detail();
            foreach($get_cart_detail as $item)
            {
                $totalprice = $totalprice + ($item->price * $item->qty);
            }
            if($min_order_amt != NULL)
            {
                if($min_order_amt < $totalprice)
                {
                    $status = "success";
                    $msg = "Coupon Code Applied.";
                }
                else
                {
                    $status = "error";
                    $msg = "Coupon Code Must be greater than".$min_order_amt.".";
                }
            }else{
                $status = "success";
                $msg = "Coupon Code Applied.";
            }
        }

        if($status = "success")
        {
            if($type == "percentage")
            {
                $newprice = ($value/100)*$totalprice;
                $totalprice = round($totalprice - $newprice);
                $coupon_code_price = $newprice;
            }
            elseif($type == "value")
            {
                $totalprice = $totalprice - $value;
                $coupon_code_price = $value;
            }
        }
        // return response()->json(['status'=>'success','msg'=>"Coupon Code Applied."]);
    }
    else
    {
        $status = "error";
        $msg = "Invalid Coupon Code.";
        // return response()->json(['status'=>'error','msg'=>"Invalid Coupon Code."]);
    }
    return json_encode(['status'=>$status,'msg'=>$msg, 'total_price'=>$totalprice, 'coupon_code_price'=>$coupon_code_price]);
}
?>