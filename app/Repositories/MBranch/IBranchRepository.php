<?php

namespace App\Repositories\MBranch;

interface IBranchRepository {
    public function renderDataTable();

    public function store($request);

    public function update($request, $branch);

    public function destroy($branch);

    public function exportCSV();

    public function exportExcel();

    public function exportPDF();
}