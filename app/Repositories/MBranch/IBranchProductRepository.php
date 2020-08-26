<?php

namespace App\Repositories\MBranch;

interface IBranchProductRepository {
    public function renderDataTable();

    public function all();

    public function find($id);

    public function store($request);

    public function update($request);

    public function destroy($id);

    public function searchProduct($request);

    public function exportCSV();

    public function exportExcel();

    public function exportPDF();
}