<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
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

    public function disableProducts($b_id)
    {
        return DB::table('disable_products')
            ->where('b_id', $b_id)
            ->pluck('p_id');
    }

    public function searchProducts($request)
    {
        $disables = $this->disableProducts($request->b_id);

        return Product::where('p_name', 'LIKE', '%'.$request->p_name.'%')
            ->where('p_code', 'LIKE', '%'.$request->p_code.'%')
            ->whereNotIn('p_id', $disables)
            ->get();
    }

    public function searchProductsWithDiscounts($request, $disables = [])
    {
        return Product::with('discount')
            ->where('p_name', 'LIKE', '%'.$request->p_name.'%')
            ->where('p_code', 'LIKE', '%'.$request->p_code.'%')
            ->whereNotIn('p_id', $disables)
            ->get();
    }

    public function searchProductsWithoutDiscounts($request)
    {
        return Product::where('p_name', 'LIKE', '%'.$request->p_name.'%')
            ->where('p_code', 'LIKE', '%'.$request->p_code.'%')
            ->doesntHave('discount')
            ->get();
    }

    public function searchCategoryProducts($request, $disables = [])
    {
        return Category::with(['discounts', 'products' => function($product) use($disables) {
            $product->whereNotIn('p_id', $disables);
        }])
        ->find($request->cat_id);
    }

    public function searchunitProducts($request, $disables = [])
    {
        return Unit::with(['discounts', 'products' => function($product) use($disables) {
            $product->whereNotIn('p_id', $disables);
        }])
        ->find($request->unit_id);
    }

    public function categoriesProducts($disables = [])
    {
        return Category::with(['products' => function($product) use ($disables) {
            $product->whereNotIn('p_id', $disables);
        }])
        ->get(['cat_id', 'cat_name']);
    }

    public function unitsProducts($disables = [])
    {
        return Unit::with(['products' => function($product) use ($disables) {
            $product->whereNotIn('p_id', $disables);
        }])
        ->get(['unit_id', 'unit_name']);
    }

    public function discountsProducts($disables = [])
    {
        return Product::with('discount')->whereNotIn('p_id', $disables)->get();
    }

    public function countNotActiveProducts($disables)
    {
        return Product::where('p_status', 0)
            ->orWhereIn('p_id', $disables)
            ->distinct()
            ->count();
    }
}