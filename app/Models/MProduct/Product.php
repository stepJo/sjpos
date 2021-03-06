<?php

namespace App\Models\MProduct;

use Illuminate\Database\Eloquent\Model;
use App\Models\MBranch\Branch;
use App\Models\MProduct\Category;
use App\Models\MProduct\Unit;
use App\Models\MSale\DiscountProduct;

class Product extends Model
{	
	protected $primaryKey = 'p_id';

	protected $fillable = [
        'p_id',
        'p_code',
        'cat_id',
        'p_name',
        'p_desc',
        'unit_id',
        'p_price',
        'p_image',
        'p_barcode',
        'p_status',
        'created_at',
        'updated_at'
    ];

    public function category()
    {
    	return $this->belongsTo(Category::class, 'cat_id')->select('cat_id', 'cat_name');
    }

    public function discount()
    {
        return $this->hasOne(DiscountProduct::class, 'p_id')
            ->select('p_id', 'dp_value', 'dp_status');
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class, 'unit_id')
            ->select('unit_id', 'unit_name');
    }

    public function branches()
    {
        return $this->belongsToMany(Branch::class, 'disable_products', 'p_id', 'p_id');
    }
}
