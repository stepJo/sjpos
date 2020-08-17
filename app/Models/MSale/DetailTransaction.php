<?php

namespace App\Models\MSale;

use Illuminate\Database\Eloquent\Model;
use App\Models\MProduct\Product;
use App\Models\MSale\Transaction;

class DetailTransaction extends Model
{
    protected $primaryKey = 'dt_id';

    protected $guarded = [];

    public function product() {
    	return $this->belongsTo(Product::class, 'p_id')->select('p_id', 'p_name')->orderBy('p_name');
    }

    public function transaction() {
    	return $this->belongsTo(Transaction::class, 't_id');
    }
}
