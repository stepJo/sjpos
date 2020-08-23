<?php

namespace App\Models\MSupplier;

use Illuminate\Database\Eloquent\Model;
use App\Models\MSupplier\ProductSupplier;
use App\Models\MSupplier\PurchasementSupplier;

class Supplier extends Model
{
    protected $primaryKey = 's_id';

    protected $fillable = [
        's_id',
        's_code',
        's_name',
        's_email',
        's_contact',
        's_bank',
        's_bank_num',
        's_address',
        'created_at',
        'updated_at',
    ];

    public function products()
    {
        return $this->hasMany(ProductSupplier::class, 's_id')
            ->select('ps_name', 'ps_code', 'ps_price', 's_id');
    }

    public function pruchasements()
    {
    	return $this->hasMany(PurchasementSupplier::class, 'pch_id');
    }
}
