<?php

namespace App\Models\MUser;

use Illuminate\Database\Eloquent\Model;
use App\Models\MUser\User;

class Role extends Model
{
	protected $primaryKey = 'role_id';

    protected $fillable = [
        'role_id',
        'role_name',
        'created_at',
        'updated_at',
    ];

    public function users()
    {
    	return $this->hasMany(User::class, 'role_id');
    }
}
