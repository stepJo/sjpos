<?php

namespace App\Repositories\MProduct;

interface ICategoryRepository {
    public function store($request);

    public function update($request, $category);

    public function destroy($category);

    public function search($request);
}