<?php

namespace App\Repositories\MSale;

interface IDiscountProductRepository {
    public function all();

    public function store($request);

    public function update($request, $product);

    public function destroy($product);
}