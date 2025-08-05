<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\CybersecurityExport;
use Maatwebsite\Excel\Facades\Excel;

class CybersecurityExportController extends Controller
{
    public function export(Request $request, $format = 'xlsx')
    {
        $fileName = 'cybersecurity_records_' . now()->format('Ymd_His') . '.' . $format;

        if (!in_array($format, ['xlsx', 'csv', 'pdf'])) {
            abort(400, 'Invalid export format.');
        }

        return Excel::download(new CybersecurityExport, $fileName, match($format) {
            'csv' => \Maatwebsite\Excel\Excel::CSV,
            'pdf' => \Maatwebsite\Excel\Excel::DOMPDF,
            default => \Maatwebsite\Excel\Excel::XLSX,
        });
    }
}

