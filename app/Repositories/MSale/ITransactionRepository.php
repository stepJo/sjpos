<?php

namespace App\Repositories\MSale;

interface ITransactionRepository {
    public function renderDataTable($request);

    public function destroy($transaction);

    public function exportCSV();

    public function exportExcel();

    public function exportPDF();
}