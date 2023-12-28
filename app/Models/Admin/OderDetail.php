<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class OderDetail extends Model
{
    use HasFactory;
    protected $table = "orders_detail";
    protected $fillable = array('order_id', 'product_attr_id');

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function product_attr()
    {
        return $this->belongsTo(ProductAttribute::class, 'product_attr_id', 'id');
    }

    public function product_attr_with_size_color_product()
    {
        return $this->belongsTo(ProductAttribute::class, 'product_attr_id', 'id')->with(['product','size','color']);
    }

    
}
