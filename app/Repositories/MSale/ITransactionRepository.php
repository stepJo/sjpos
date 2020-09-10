<?php

namespace App\Repositories\MSale;

interface ITransactionRepository {
    public function renderDataTable($request, $access);

    public function store($request);

    public function destroy($transaction);

    public function exportCSV();

    public function exportExcel();

    public function exportPDF();
}