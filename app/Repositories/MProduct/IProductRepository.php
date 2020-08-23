<?php

namespace App\Repositories\MProduct;

interface IProductRepository {
    public function renderDataTable();

    public function store($request);

    public function update($request, $id);

    public function destroy($product);

    public function exportCSV();

    public function exportExcel();

    public function exportPDF();
}