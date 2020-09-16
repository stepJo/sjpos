<?php

namespace App\Exports\MCustomer;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use App\Models\MCustomer\Customer;
use Utilities;
class CustomerExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Customer::all();
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
            'Email',
            'Kontak',
            'Alamat',
        ];
    }

    public function map($customer): array
    {
        return [
            $customer->c_name,
            Utilities::emptyFormat($customer->c_email),
            Utilities::emptyFormat($customer->c_contact),
            Utilities::emptyFormat($customer->c_address)
        ];
    }
}
