<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\PnpkiExport;
use Maatwebsite\Excel\Facades\Excel;

class PnpkiExportController extends Controller
{
    public function export(Request $request, $format = 'xlsx')
    {
        $fileName = 'pnpki_records_' . now()->format('Ymd_His') . '.' . $format;

        if (!in_array($format, ['xlsx', 'csv', 'pdf'])) {
            abort(400, 'Invalid export format.');
        }

        return Excel::download(new PnpkiExport, $fileName, match($format) {
            'csv' => \Maatwebsite\Excel\Excel::CSV,
            'pdf' => \Maatwebsite\Excel\Excel::DOMPDF,
            default => \Maatwebsite\Excel\Excel::XLSX,
        });
    }
}

