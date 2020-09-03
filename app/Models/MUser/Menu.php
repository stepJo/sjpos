<?php

namespace App\Models\MUser;

use Illuminate\Database\Eloquent\Model;
use App\Models\MUser\Role;

class Menu extends Model
{
    protected $primaryKey = 'menu_id';

    protected $fillable = [
        'menu_id',
        'menu_name',
        'created_at',
        'updated_at'
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'menu_roles', 'menu_id', 'role_id')
            ->withPivot(['view', 'add', 'edit', 'delete'])
            ->orderBy('pivot_menu_id','asc');
    }
}
