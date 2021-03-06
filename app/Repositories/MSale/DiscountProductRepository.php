<?php 

namespace App\Repositories\MSale;
use App\Repositories\MSale\IDiscountProductRepository;
use App\Models\MProduct\Product;
use App\Models\MSale\DiscountProduct;

class DiscountProductRepository implements IDiscountProductRepository
{
    public function all()
    {
        return DiscountProduct::with('product')->get();
    }

    public function store($request)
    {
        return DiscountProduct::create($request->validated());
    }

    public function update($request, $product)
    {
        return $product->update($request->validated());
    }

    public function destroy($product)
    {
        return $product->delete();
    }
}