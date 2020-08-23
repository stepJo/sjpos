<?php

namespace App\Models\MSupplier;

use Illuminate\Database\Eloquent\Model;
use App\Models\MSupplier\DetailPurchasementSupplier;
use App\Models\MSupplier\Supplier;

class PurchasementSupplier extends Model
{
    public $timestamps = FALSE;

    protected $primaryKey = 'pch_id';

    protected $fillable = [
        'pch_id',
        'pch_code',
        'pch_cost',
        'pch_tax',
        'pch_disc',
        'pch_ship',
        's_id',
        'pch_note',
        'pch_date'
    ];

    public function detailPurchasements() 
    {
    	return $this->hasMany(DetailPurchasementSupplier::class, 'pch_id');
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 's_id');
    }
}
