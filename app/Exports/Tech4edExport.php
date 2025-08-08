<?php

namespace App\Exports;

use App\Models\Tech4ed;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
class Tech4edExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return Tech4ed::all();
    }

    public function map($row): array
    {
        return [
            $row->congressional_district,
            $row->municipality,
            $row->specific_center_location,
            $row->center_name,
            $row->center_model,
            $row->cm_name,
            $row->cm_email,
            $row->cm_mobile,
            $row->cm_sex,
            $row->date_of_launching,
            $row->operational,
            $row->with_donation,
            $row->type_of_donation ?? 'N/A',
        ];
    }

    public function headings(): array
    {
        return [
            'Congressional District',
            'Municipality',
            'Specific Center Location',
            'Center Name',
            'Center Model',
            'CM Name',
            'CM Email',
            'CM Mobile',
            'CM Sex',
            'Date of Launching',
            'Operational',
            'With Donation',
            'Type of Donation',
        ];
    }
}
