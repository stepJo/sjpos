<?php

namespace App\Exports\MSupplier;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use App\Models\MSupplier\PurchasementSupplier;
use Utilities;

class PurchasementSupplierExport implements FromCollection, WithCustomCsvSettings, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return PurchasementSupplier::with('supplier')->get();
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
            'Biaya',
            'Pajak',
            'Diskon',
            'Pengiriman',
            'Catatan',
            'Penyuplai',
        ];
    }

    public function map($purchasement): array
    {
        return [
            $purchasement->pch_code,
            Utilities::rupiahFormat($purchasement->pch_cost),
            Utilities::rupiahFormat($purchasement->pch_tax),
            Utilities::rupiahFormat($purchasement->pch_disc),
            Utilities::rupiahFormat($purchasement->pch_ship),
            Utilities::emptyFormat($purchasement->pch_note),
            $purchasement->supplier->s_name
        ];
    }
}
