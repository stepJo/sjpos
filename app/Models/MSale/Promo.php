<?php

namespace App\Models\MSale;

use Illuminate\Database\Eloquent\Model;

class Promo extends Model
{
    protected $primaryKey = 'prom_id';

    protected $guarded = [];

    public function user()
    {
    	return $this->belongsTo(User::class, 'u_id');
    }
}
