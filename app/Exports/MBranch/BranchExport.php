<?php

namespace App\Exports\MBranch;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use App\Models\MBranch\Branch;
use Utilities;

class BranchExport implements FromCollection, WithCustomCsvSettings, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Branch::all();
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
            'Deskripsi',
            'Alamat',
            'Status'
        ];
    }

    public function map($branch): array
    {
        return [
            $branch->b_code,
            $branch->b_name,
            $branch->b_email,
            $branch->b_contact,
            Utilities::emptyFormat($branch->b_desc),
            Utilities::emptyFormat($branch->b_address),
            ($branch->b_status == 1) ? 'Aktif' : 'Tidak Aktif'
        ];
    }
}
