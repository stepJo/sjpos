<?php

namespace App\Repositories\MCustomer;

interface ICustomerRepository {
    public function renderDataTable($access);

    public function store($request);

    public function update($request, $customer);

    public function destroy($customer);

    public function exportCSV();

    public function exportExcel();

    public function exportPDF();
}