<?php

namespace App\Models\Msale;

use Illuminate\Database\Eloquent\Model;
use App\Models\MProduct\Product;
use App\Models\MSale\Transaction;

class TransactionDetail extends Model
{
    protected $primaryKey = 'td_id';

    protected $guarded = [];

    public function product() {
    	return $this->belongsTo(Product::class, 'p_id')->select('p_id', 'p_name')->orderBy('p_name');
    }

    public function transaction() {
    	return $this->belongsTo(Transaction::class, 't_id');
    }
}
