<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Admin\OderDetail;
use App\Models\Admin\Order;
use App\Models\Admin\ProductAttribute;
use App\Models\Admin\Color;
use App\Models\Admin\Size;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;

class PdfgenerateController extends Controller
{
    public function download_pdf($id)
    {
        // dd(OderDetail::all());
        // dd(Order::all());


        // $result = Order::with(['order_details.product_attr.product','order_details.product_attr.size','order_details.product_attr.color'])->find($id);
        $result = Order::with(['order_details.product_attr_with_size_color_product'])->find($id);
        // $result = ProductAttribute::with(['size'])->get();
        // $result = ProductAttribute::with(['product'])->get();

        // prx($result->toArray());
        // dd($result);

        // $result['order_details'] = OderDetail::
        //                             Join('product_attribute','product_attribute.id','=','orders_detail.products_attr_id')
        //                             ->Join('products','products.id','=','product_attribute.product_id')
        //                             ->Join('sizes','sizes.id','=','product_attribute.size_id')
        //                             ->Join('colors','colors.id','=','product_attribute.color_id')
        //                             ->where(['orders_id'=>$id])
        //                             ->get();
        // prx($result);
        $pdf = Pdf::loadView('billing_invoice', compact('result'));
        // return $pdf->stream('billing_invoice.pdf');
        return $pdf->download('billing_invoice.pdf');
    }
}
