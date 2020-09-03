<?php

namespace App\Repositories\MBranch;

interface IBranchProductRepository {
    public function renderDataTable($branches);

    public function store($request);

    public function update($request);
}