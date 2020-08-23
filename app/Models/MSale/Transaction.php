<?php

namespace App\Models\MSale;

use Illuminate\Database\Eloquent\Model;
use App\Models\MSale\DetailTransaction;

class Transaction extends Model
{
    public $timestamps = FALSE;

    protected $primaryKey = 't_id';

    protected $fillable = [
        't_id',
        't_code',
        't_type',
        't_total',
        't_tax',
        't_disc',
        't_date'
    ];

    public function detailTransactions() 
    {
    	return $this->hasMany(DetailTransaction::class, 't_id');
    }
}
