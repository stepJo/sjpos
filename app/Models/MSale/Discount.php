<?php

namespace App\Models\MSale;

use Illuminate\Database\Eloquent\Model;
use App\Models\MUser\User;

class Discount extends Model
{
    protected $primaryKey = 'dis_id';

    protected $guarded = [];

    public function user()
    {
    	return $this->belongsTo(User::class, 'u_id');
    }
}
