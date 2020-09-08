<?php

namespace App\Services;

use App\Models\MProduct\Category;
use App\Models\MProduct\Unit;
use App\Models\MProduct\Product;
use DB;

class MProductService {
    public function allProducts()
    {
        return Product::get(['p_id', 'p_code', 'p_name']);
    }

    public function findProduct($id)
    {
        return Product::find($id);
    }

    public function disableProducts($request)
    {
        return DB::table('disable_products')
            ->where('b_id', $request->b_id)
            ->pluck('p_id');
    }

    public function searchProducts($request)
    {
        $disables = $this->disableProducts($request);

        return Product::where('p_name', 'LIKE', '%'.$request->p_name.'%')
            ->where('p_code', 'LIKE', '%'.$request->p_code.'%')
            ->whereNotIn('p_id', $disables)
            ->get(['p_id', 'p_code', 'p_name', 'p_price']);
    }

    public function searchProductsWithDiscounts($request)
    {
        return Product::with('discount')
            ->where('p_name', 'LIKE', '%'.$request->p_name.'%')
            ->where('p_code', 'LIKE', '%'.$request->p_code.'%')
            ->get(['p_id', 'p_code', 'p_name', 'p_price', 'p_status']);
    }

    public function searchProductsWithoutDiscounts($request)
    {
        return Product::where('p_name', 'LIKE', '%'.$request->p_name.'%')
            ->where('p_code', 'LIKE', '%'.$request->p_code.'%')
            ->doesntHave('discount')
            ->get(['p_id', 'p_code', 'p_name', 'p_price', 'p_status']);
    }

    public function categoriesProducts()
    {
        return Category::with('products')->get(['cat_id', 'cat_name']);
    }

    public function unitsProducts()
    {
        return Unit::with('products')->get(['unit_id', 'unit_name']);
    }

    public function discountsProducts()
    {
        return Product::with('discount')->get();
    }

    public function countNotActiveProducts()
    {
        return Product::where('p_status', 0)->count();
    }
}