<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductType extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_type_name',
        'category_id',
        'status',
    ];

    /**
     * Quan hệ: ProductType thuộc về một Category
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Quan hệ: ProductType có nhiều Product
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
