<?php

namespace App\Services;

use App\Models\MUser\Role;

class MUserService {
    function allRoles()
    {
        return Role::get(['role_id', 'role_name']);
    }
}