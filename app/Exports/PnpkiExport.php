<?php

namespace App\Exports;

use App\Models\Pnpki;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PnpkiExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return Pnpki::all();
    }

    public function map($pnpki): array
    {
        return [
            $pnpki->date_conducted,
            $pnpki->time_conducted,
            $pnpki->organizer,
            $pnpki->province,
            $pnpki->municipality ?? 'N/A',
            $pnpki->district ?? 'N/A',
            $pnpki->activity_title,
            $pnpki->type_of_activity,
            $pnpki->mode_of_implementation,
            $pnpki->zoom_link ?? 'N/A',
            $pnpki->male_participants,
            $pnpki->female_participants,
            $pnpki->total_participants,
            $pnpki->resource_person,
            $pnpki->fb_posting ?? 'N/A',
            $pnpki->number_of_engagement ?? 'N/A',
            $pnpki->list_of_engaged_partners ?? 'N/A',
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

