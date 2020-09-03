<?php

namespace App\Services;

use App\Models\MBranch\Branch;

class MBranchService {
    function allBranches()
    {
        return Branch::get(['b_id', 'b_name']);
    }

    function branchesProducts()
    {
        return Branch::has('products')
            ->with('products', 'products.category', 'products.unit')
            ->orderByDesc('b_name')
            ->get(['b_id', 'b_name', 'b_status']);
    }

    function findBranchProducts($id)
    {
        return Branch::with(['products' => function($query) {
            return $query->select('p_code', 'p_name', 'p_price');
        }])
        ->find($id, ['b_id', 'b_name']);
    }

    function destroyBranchProducts($id)
    {
        return Branch::find($id)->products()->detach();
    }
}