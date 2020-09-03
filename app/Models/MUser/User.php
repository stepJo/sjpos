<?php

namespace App\Models\MUser;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\MBranch\Branch;
use App\Models\MUser\Role;

class User extends Authenticatable
{
    use Notifiable;

    protected $primaryKey = 'u_id';

    protected $fillable = [
        'u_id',
        'u_name',
        'u_email',
        'u_contact',
        'u_password',
        'b_id',
        'role_id',
        'created_at',
        'updated_at',   
    ];

    protected $hidden = [
        'u_password',
    ];

    public function getAuthPassword()
    {
        return $this->u_password;
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class, 'b_id')
            ->select('b_id', 'b_name');
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id')
            ->select('role_id', 'role_name');
    }
}
