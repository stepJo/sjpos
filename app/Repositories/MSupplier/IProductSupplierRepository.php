<?php

namespace App\Repositories\MSupplier;

interface IProductSupplierRepository {
    public function renderDataTable($request, $suppliers);

    public function store($request);

    public function update($request, $product);

    public function destroy($product);

    public function exportCSV();
    
    public function exportExcel();

    public function exportPDF();
}