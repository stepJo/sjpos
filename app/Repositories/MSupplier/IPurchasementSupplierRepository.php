<?php

namespace App\Repositories\MSupplier;

interface IPurchasementSupplierRepository {
    public function renderDataTable($request, $access);

    public function store($request);

    public function destroy($purchasement);
    
    public function exportCSV();
    
    public function exportExcel();

    public function exportPDF();
}