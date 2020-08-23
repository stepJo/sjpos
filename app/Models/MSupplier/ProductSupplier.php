<?php

namespace App\Models\MSupplier;

use Illuminate\Database\Eloquent\Model;
use App\Models\MSupplier\PurchasementSupplier;
use App\Models\MSupplier\Supplier;

class ProductSupplier extends Model
{
    protected $primaryKey = 'ps_id';

    protected $fillable = [
        'ps_id',
        'ps_name',
        'ps_code',
        'ps_price',
        'ps_desc',
        's_id',
        'created_at',
        'updated_at'
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 's_id')
            ->select(['s_id', 's_name']);
    }
}
