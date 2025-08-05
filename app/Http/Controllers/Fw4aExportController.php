<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\Fw4aExport;
use Maatwebsite\Excel\Facades\Excel;

class Fw4aExportController extends Controller
{
    //
    public function export($format)
    {
        $fileName = 'fw4a_sites_' . now()->format('Ymd_His') . '.' . $format;

        if (!in_array($format, ['xlsx', 'csv', 'pdf'])) {
            abort(400, 'Invalid export format.');
        }

        return Excel::download(new Fw4aExport, $fileName, match($format) {
            'csv' => \Maatwebsite\Excel\Excel::CSV,
            'pdf' => \Maatwebsite\Excel\Excel::DOMPDF,
            default => \Maatwebsite\Excel\Excel::XLSX,
        });

    }
}
