<?php

namespace App\Services;

use App\Models\MBranch\Branch;

class MBranchService {
    public function allBranches()
    {
        return Branch::get(['b_id', 'b_name']);
    }

    public function branchesProducts()
    {
        return Branch::has('products')
            ->with('products', 'products.category', 'products.unit')
            ->orderByDesc('b_name')
            ->get(['b_id', 'b_name', 'b_status']);
    }

    public function findActiveBranch($b_id)
    {
        return Branch::where('b_id', $b_id)
            ->where('b_status', 1)
            ->first();
    }

    public function findBranchProducts($id)
    {
        return Branch::with('products')->find($id);
    }

    public function destroyBranchProducts($id)
    {
        return Branch::find($id)->products()->detach();
    }
}