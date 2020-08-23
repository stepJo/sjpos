<?php

namespace App\Models\MSale;

use Illuminate\Database\Eloquent\Model;
use App\Models\MProduct\Product;

class DiscountProduct extends Model
{
    protected $primaryKey = 'dp_id';

    protected $fillable = [
        'dp_id',
        'p_id',
        'dp_value',
        'dp_status',
        'created_at',
        'updated_at'
    ];

    public function product()
    {
    	return $this->belongsTo(Product::class, 'p_id')->select('p_id', 'p_name', 'p_price');
    }
}
