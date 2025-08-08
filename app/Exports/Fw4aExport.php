<?php

namespace App\Exports;

use App\Models\Fw4a;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class Fw4aExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * Fetch the raw data
     */
    public function collection()
    {
        return Fw4a::with(['region', 'province', 'district', 'locality'])->get();
    }

    /**
     * Map each row of data to a formatted array
     */
    public function map($fw4a): array
    {
        return [
            $fw4a->site_code,
            $fw4a->ap_mac_address,
            $fw4a->site_name,
            $fw4a->region->region_code ?? '',
            $fw4a->province->province_name ?? '',
            $fw4a->district->district_name ?? '',
            $fw4a->locality->locality_name ?? '',
            $fw4a->contract_status,
            $fw4a->contract,
            $fw4a->category,
            $fw4a->contractor,
            $fw4a->latitude,
            $fw4a->longitude
        ];
    }

    /**
     * Define the column headers
     */
    public function headings(): array
    {
        return [
            'Site Code',
            'AP MAC Address',
            'Site Name',
            'Region',
            'Province',
            'District',
            'Locality',
            'Status',
            'Contract',
            'Category',
            'Contractor',
            'Latitude',
            'Longitude'
        ];
    }
}
