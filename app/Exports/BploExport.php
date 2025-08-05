<?php

namespace App\Exports;

use App\Models\Bplo;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class BploExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return Bplo::all();
    }

    public function map($row): array
    {
        return [
            $row->province,
            $row->municipality_city,
            $row->bpco_status,
            $row->congressional_district,
            $row->income_class,
            $row->remarks ?? 'N/A',
        ];
    }

    public function headings(): array
    {
        return [
            'Province',
            'Municipality/City',
            'BPCO Status',
            'Congressional District',
            'Income Class',
            'Remarks',
        ];
    }

}
