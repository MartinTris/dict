<?php

namespace App\Exports;

use App\Models\Cybersecurity;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class CybersecurityExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return Cybersecurity::all();
    }

    public function map($record): array
    {
        return [
            $record->date_conducted,
            $record->time_conducted,
            $record->organizer,
            $record->province,
            $record->municipality ?? 'N/A',
            $record->district ?? 'N/A',
            $record->activity_title,
            $record->type_of_activity,
            $record->mode_of_implementation,
            $record->zoom_link ?? 'N/A',
            $record->male_participants,
            $record->female_participants,
            $record->male_participants + $record->female_participants,
            $record->resource_person,
            $record->fb_posting ?? 'N/A',
            $record->number_of_engagement ?? 'N/A',
            $record->list_of_engaged_partners ?? 'N/A',
        ];
    }

    public function headings(): array
    {
        return [
            'Date Conducted',
            'Time Conducted',
            'Organizer',
            'Province',
            'Municipality',
            'District',
            'Activity Title',
            'Type of Activity',
            'Mode of Implementation',
            'Zoom Link',
            'Male Participants',
            'Female Participants',
            'Total Participants',
            'Resource Person',
            'FB Posting',
            'Number of Engagements',
            'List of Engaged Partners',
        ];
    }
}

