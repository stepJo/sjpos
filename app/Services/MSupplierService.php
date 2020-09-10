<?php

namespace App\Services;

use App\Models\MSupplier\Supplier;
use App\Models\MSupplier\ProductSupplier;

class MSupplierService {
    public function allSuppliers()
    {
        return Supplier::get(['s_id', 's_name']);
    }

    public function suppliersProducts()
    {
        return Supplier::with('products')->get(['s_id', 's_name']);
    }

    public function searchsupplierProducts($request)
    {
        return ProductSupplier::with('supplier')
            ->where('ps_name', 'LIKE', '%'.$request->ps_name.'%')
            ->where('ps_code', 'LIKE', '%'.$request->ps_code.'%')
            ->where('s_id', $request->s_id)
            ->get(['ps_id', 'ps_code', 'ps_name', 'ps_price', 's_id']);
    }
}