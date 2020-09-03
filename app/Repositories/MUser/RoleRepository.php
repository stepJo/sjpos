<?php 

namespace App\Repositories\MUser;
use App\Repositories\MUser\IRoleRepository;
use App\Models\MUser\Role;

class RoleRepository implements IRoleRepository
{
    public function all()
    {
        return Role::with('users:role_id')
            ->get(['role_id', 'role_name']);
    }

    public function store($request)
    {
        $role = Role::create($request->validated());

        for($i = 0; $i < count($request->menus); $i++)
        {
            $role->menus()->attach($request->menus[$i], [
                'view'    => $request->views[$i],
                'add'     => $request->adds[$i],
                'edit'    => $request->edits[$i],
                'delete'  => $request->deletes[$i] 
            ]);
        }
    }

    public function update($request, $role)
    {
        $role->update($request->validated());

        for($i = 0; $i < count($request->menus); $i++)
        {
            $role->menus()->updateExistingPivot($request->menus[$i], [
                'view'    => $request->views[$i],
                'add'     => $request->adds[$i],
                'edit'    => $request->edits[$i],
                'delete'  => $request->deletes[$i] 
            ]);
        }
    }

    public function destroy($role)
    {
        return $role->delete();
    }
}