<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\Tech4edExport;
use Maatwebsite\Excel\Facades\Excel;


class Tech4edExportController extends Controller
{
    //
    public function export(Request $request, $format = 'xlsx')
    {
        $fileName = 'tech4ed_centers_' . now()->format('Ymd_His') . '.' . $format;

        if (!in_array($format, ['xlsx', 'csv', 'pdf'])) {
            abort(400, 'Invalid export format.');
        }

        return Excel::download(new Tech4edExport, $fileName, match($format) {
            'csv' => \Maatwebsite\Excel\Excel::CSV,
            'pdf' => \Maatwebsite\Excel\Excel::DOMPDF,
            default => \Maatwebsite\Excel\Excel::XLSX,
        });
    }
}
