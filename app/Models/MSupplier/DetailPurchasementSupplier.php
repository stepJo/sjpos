<?php

namespace App\Models\MSupplier;

use Illuminate\Database\Eloquent\Model;
use App\Models\MSupplier\ProductSupplier;
use App\Models\MSupplier\PurchasementSupplier;

class DetailPurchasementSupplier extends Model
{
    protected $primaryKey = 'dps_id';

    protected $guarded = [];

    public function product() {
        return $this->belongsTo(ProductSupplier::class, 'ps_id')
            ->select('ps_id', 'ps_code', 'ps_name', 'ps_price')
            ->orderBy('ps_name');
    }

    public function purchasement() {
    	return $this->belongsTo(PurchasementSupplier::class, 'pch_id');
    }
}
