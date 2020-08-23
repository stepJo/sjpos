<?php

namespace App\Exports\MSale;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use App\Models\MSale\Transaction;
use Utilities;

class TransactionExport implements FromCollection, WithCustomCsvSettings, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Transaction::all();
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
            'Metode Bayar',
            'Total',
            'Pajak',
            'Diskon',
            'Tanggal'
        ];
    }

    public function map($transaction): array
    {
        return [
            $transaction->t_code,
            $transaction->t_type,
            Utilities::rupiahFormat($transaction->t_total),
            Utilities::rupiahFormat($transaction->t_tax),
            Utilities::rupiahFormat($transaction->t_disc),
            date('d F Y H:i:s', strtotime($transaction->t_date))
        ];
    }
}
