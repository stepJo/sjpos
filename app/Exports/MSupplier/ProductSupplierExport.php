<?php

namespace App\Exports\MSupplier;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use App\Models\MSupplier\ProductSupplier;
use Utilities;

class ProductSupplierExport implements FromCollection, WithCustomCsvSettings, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return ProductSupplier::with('supplier')->get();
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
            'Nama',
            'Kode',
            'Harga',
            'Penyuplai',
        ];
    }

    public function map($product): array
    {
        return [
            $product->ps_name,
            $product->ps_code,
            Utilities::rupiahFormat($product->s_price),
            $product->supplier->s_name
        ];
    }
}
