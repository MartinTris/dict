<?php

namespace App\Exports;

use App\Models\EgovAssistances;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class EgovAssistancesExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * Fetch the raw data
     */
    public function collection()
    {
        return EgovAssistances::all();
    }

    /**
     * Map each row of data to a formatted array
     */
    public function map($assistance): array
    {
        return [
            $assistance->date->format('M d, Y'),
            $assistance->province,
            $assistance->lgu,
            $assistance->name_of_requestee,
            $assistance->email_address,
            $assistance->contact_no ?? 'No contact number',
            $assistance->system,
            $assistance->concern,
            $assistance->received_by,
            $assistance->status
        ];
    }

    /**
     * Define the column headers
     */
    public function headings(): array
    {
        return [
            'Date',
            'Province',
            'LGU',
            'Name of Requestee',
            'Email Address',
            'Contact No.',
            'System',
            'Concern',
            'Received by',
            'Status'
        ];
    }
} 