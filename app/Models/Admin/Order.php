<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public function order_details()
    {
        return $this->hasMany(OderDetail::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    
}
