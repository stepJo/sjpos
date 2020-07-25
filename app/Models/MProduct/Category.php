<?php

namespace App\Models\MProduct;

use Illuminate\Database\Eloquent\Model;
use App\Models\MProduct\Product;
use App\Models\MSale\DiscountProduct;

class Category extends Model
{
    protected $primaryKey = 'cat_id';

    protected $guarded = [];

    public function products()
    {
    	return $this->hasMany(Product::class, 'cat_id');
    }

    public function discounts()
    {
    	return $this->hasManyThrough(DiscountProduct::class, Product::class, 'cat_id', 'p_id', 'cat_id', 'p_id');
    }
}
