<?php

namespace App\Models\MSale;

use Illuminate\Database\Eloquent\Model;
use App\Models\MSale\DetailTransaction;

class Transaction extends Model
{
    public $timestamps = FALSE;

    protected $primaryKey = 't_id';

    protected $guarded = [];

    public function detailTransactions() 
    {
    	return $this->hasMany(DetailTransaction::class, 't_id');
    }
}
