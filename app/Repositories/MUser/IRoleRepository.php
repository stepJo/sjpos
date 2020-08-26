<?php

namespace App\Repositories\MUser;

interface IRoleRepository {
    public function all();

    public function store($request);

    public function update($request, $role);

    public function destroy($role);
}