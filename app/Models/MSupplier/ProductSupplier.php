<?php

namespace App\Models\MSupplier;

use Illuminate\Database\Eloquent\Model;
use App\Models\MSupplier\PurchasementSupplier;
use App\Models\MSupplier\Supplier;

class ProductSupplier extends Model
{
    protected $primaryKey = 'ps_id';

    protected $guarded = [];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 's_id')
            ->select(['s_id', 's_name']);
    }
}
