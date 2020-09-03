<?php

namespace App\Models\MUser;

use Illuminate\Database\Eloquent\Model;
use App\Models\MUser\Menu;
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

    public function menus()
    {
        return $this->belongsToMany(Menu::class, 'menu_roles', 'role_id', 'menu_id')
            ->withPivot(['view', 'add', 'edit', 'delete']);
    }
}
