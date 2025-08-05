<?php

namespace App\Exports;

use App\Models\Ibpls;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class IbplsExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return Ibpls::all();
    }

    public function map($row): array
    {
        return [
            $row->location,
            $row->district,
            $row->operation,
            $row->status ?? 'N/A',
        ];
    }

    public function headings(): array
    {
        return [
            'Location',
            'District',
            'Operation',
            'Status',
        ];
    }
}

