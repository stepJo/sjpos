<?php

namespace App\Exports\MSupplier;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use App\Models\MSupplier\Supplier;
use Utilities;

class SupplierExport implements FromCollection, WithCustomCsvSettings, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Supplier::all();
    }

    public function getCsvSettings(): array
    {
        return [
            'delimiter' => '|'
        ];
    }

    public function headings(): array
    {
        return [
            'Kode',
            'Nama',
            'Email',
            'Kontak',
            'Alamat'
        ];
    }

    public function map($supplier): array
    {
        return [
            $supplier->s_code,
            $supplier->s_name,
            $supplier->s_email,
            $supplier->s_contact,
            $supplier->s_address
        ];
    }
}
