<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    protected $fillable = [
            'order_code',
            'order_id',
            'product_detail_id',
            'price',
            'quantity',
            'status',
        ];

    public function order()
    {
         return $this->belongsTo(Order::class);
    }

    public function productDetails()
    {
        return $this->hasMany(ProductDetail::class);
    }
}
