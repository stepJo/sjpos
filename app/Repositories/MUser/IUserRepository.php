<?php

namespace App\Repositories\MUser;

interface IUserRepository {
    public function all();

    public function store($request);

    public function update($request, $user);

    public function updatePassword($request, $user);

    public function destroy($user);
}