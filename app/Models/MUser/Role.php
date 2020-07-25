<?php

namespace App\Models\MUser;

use Illuminate\Database\Eloquent\Model;
use App\Models\MUser\User;

class Role extends Model
{
	protected $primaryKey = 'role_id';

	protected $casts = [
        'role_menu' => 'json',
     ];

    protected $guarded = [];

    public function users()
    {
    	return $this->belongsToMany(User::class, 'role_id');
    }
}
