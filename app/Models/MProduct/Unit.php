<?php

namespace App\Models\MProduct;

use Illuminate\Database\Eloquent\Model;
use App\Models\MProduct\Product;
use App\Models\MSale\DiscountProduct;

class Unit extends Model
{
    protected $primaryKey = 'unit_id';

    protected $guarded = [];
    
    public function products()
    {
    	return $this->hasMany(Product::class, 'unit_id');
    }

    public function discounts()
    {
    	return $this->hasManyThrough(DiscountProduct::class, Product::class, 'unit_id', 'p_id', 'unit_id', 'p_id');
    }
}
