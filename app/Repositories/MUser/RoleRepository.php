<?php 

namespace App\Repositories\MUser;
use App\Repositories\MUser\IRoleRepository;
use App\Models\MUser\Role;

class RoleRepository implements IRoleRepository
{
    public function all()
    {
        return Role::all();
    }

    public function store($request)
    {
        return Role::create($request->validated());
    }

    public function update($request, $role)
    {
        return $role->update($request->validated());
    }

    public function destroy($role)
    {
        return $role->delete();
    }
}