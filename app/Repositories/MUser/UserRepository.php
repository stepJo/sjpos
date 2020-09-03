<?php 

namespace App\Repositories\MUser;
use Illuminate\Support\Facades\Hash;
use App\Repositories\MUser\IUserRepository;
use App\Models\MUser\User;

class UserRepository implements IUserRepository
{
    public function all()
    {
        return User::with('branch', 'role')->get();
    }

    public function store($request)
    {
        return User::create([
            'u_name'     => $request->u_name,
            'u_email'    => $request->u_email,
            'u_contact'  => $request->u_contact,
            'u_password' => Hash::make($request->u_password),
            'b_id'       => $request->b_id,
            'role_id'    => $request->role_id
        ]);
    }

    public function update($request, $user)
    {
        return $user->update($request->validated());
    }

    public function updatePassword($request, $user)
    {
        return $user->update([
            'u_password' => Hash::make($request->u_password)
        ]);
    }

    public function destroy($user)
    {
        return $user->delete();
    }
}