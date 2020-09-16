<?php

namespace App\Models\MCustomer;

use Illuminate\Database\Eloquent\Model;
use App\Models\MSale\Transaction;

class Customer extends Model
{
    protected $primaryKey = 'c_id';

    protected $fillable = [
        'c_id',
        'c_name',
        'c_email',
        'c_contact',
        'c_address',
        'created_at',
        'updated_at'
    ];

    public function transactions()
    {
        return $this->hasMany(Transaction::class, 't_id');
    }
}
