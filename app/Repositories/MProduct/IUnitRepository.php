<?php

namespace App\Repositories\MProduct;

interface IUnitRepository {
    public function store($request);

    public function update($request, $unit);

    public function destroy($unit);
}