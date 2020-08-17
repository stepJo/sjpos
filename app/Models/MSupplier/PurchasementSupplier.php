<?php

namespace App\Models\MSupplier;

use Illuminate\Database\Eloquent\Model;
use App\Models\MSupplier\DetailPurchasementSupplier;
use App\Models\MSupplier\Supplier;

class PurchasementSupplier extends Model
{
    public $timestamps = FALSE;

    protected $primaryKey = 'pch_id';

    protected $guarded = [];

    public function detailPurchasements() 
    {
    	return $this->hasMany(DetailPurchasementSupplier::class, 'pch_id');
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 's_id');
    }
}
