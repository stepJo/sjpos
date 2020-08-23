<?php

namespace App\Exports\MProduct;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use App\Models\MProduct\Product;
use Utilities;

class ProductExport implements FromCollection, WithCustomCsvSettings, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Product::with('category', 'unit')->get();
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
            'Kategori',
            'Nama',
            'Satuan',
            'Harga'
        ];
    }

    public function map($product): array
    {
        return [
            $product->p_code,
            $product->category->cat_name,
            $product->p_name,
            $product->unit->unit_name,
            Utilities::rupiahFormat($product->p_price)
        ];
    }
}
