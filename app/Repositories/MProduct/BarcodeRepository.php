<?php 

namespace App\Repositories\MProduct;
use App\Repositories\MProduct\IBarcodeRepository;
use App\Models\MProduct\Product;

class BarcodeRepository implements IBarcodeRepository
{
    public function all()
    {
        return Product::get(['p_id', 'p_code', 'p_name', 'p_barcode']);
    }

    public function get($id)
    {
        return Product::findOrFail($id);
    }
}