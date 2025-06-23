<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_name',
        'status',
    ];

    /**
     * Quan hệ: Một danh mục có nhiều sản phẩm
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function productTypes()
    {
        return $this->hasMany(ProductType::class);
    }
}
