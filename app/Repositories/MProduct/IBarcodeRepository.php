<?php

namespace App\Repositories\MProduct;

interface IBarcodeRepository {
    public function all();

    public function get($id);
}