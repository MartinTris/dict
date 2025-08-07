<?php

namespace App\Exports;

use App\Models\EgovOrientation;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class EgovOrientationExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * Fetch the raw data
     */
    public function collection()
    {
        return EgovOrientation::all();
    }

    /**
     * Map each row of data to a formatted array
     */
    public function map($orientation): array
    {
        return [
            $orientation->date->format('M d, Y'),
            $orientation->training_control_no,
            $orientation->event_name,
            $orientation->venue,
            $orientation->participants,
            $orientation->province,
            $orientation->municipality,
            $orientation->mode,
            $orientation->status,
            $orientation->no_of_attendees,
            $orientation->no_of_downloaded_and_verified,
            $orientation->male,
            $orientation->female,
            $orientation->link ?? 'No link'
        ];
    }

    /**
     * Define the column headers
     */
    public function headings(): array
    {
        return [
            'Date',
            'Training Control No.',
            'Event Name',
            'Venue',
            'Participants',
            'Province',
            'Municipality',
            'Mode',
            'Status',
            'No. of Attendees',
            'No. of Downloaded & Verified',
            'Male',
            'Female',
            'Link'
        ];
    }
} 