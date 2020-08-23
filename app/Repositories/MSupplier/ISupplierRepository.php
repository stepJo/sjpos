<?php

namespace App\Repositories\MSupplier;

interface ISupplierRepository {
    public function all();

    public function store($request);

    public function update($request, $supplier);

    public function destroy($supplier);

    public function exportCSV();
    
    public function exportExcel();

    public function exportPDF();
}