<?php

namespace App\Models\MSale;

use Illuminate\Database\Eloquent\Model;
use App\Models\MSale\TransactionDetail;

class Transaction extends Model
{
    public $timestamps = FALSE;

    protected $primaryKey = 't_id';

    protected $guarded = [];

    public function transactionDetails() 
    {
    	return $this->hasMany(TransactionDetail::class, 't_id');
    }
}
