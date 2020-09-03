<?php

namespace App\Services;

use App\Models\MSupplier\Supplier;
use App\Models\MSupplier\ProductSupplier;

class MSupplierService {
    function allSuppliers()
    {
        return Supplier::select('s_id', 's_name')->get();
    }

    function suppliersProducts()
    {
        return Supplier::with('products')->get(['s_id', 's_name']);
    }

    function searchsupplierProducts($request)
    {
        return ProductSupplier::with('supplier')
            ->where('ps_name', 'LIKE', '%'.$request->ps_name.'%')
            ->where('ps_code', 'LIKE', '%'.$request->ps_code.'%')
            ->where('s_id', $request->s_id)
            ->get(['ps_id', 'ps_code', 'ps_name', 'ps_price', 's_id']);
    }
}