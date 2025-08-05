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
        $fileName = 'fw4a_sites.' . $format;

        switch ($format) {
            case 'xlsx':
                return Excel::download(new Fw4aExport, $fileName, \Maatwebsite\Excel\Excel::XLSX);
            case 'csv':
                return Excel::download(new Fw4aExport, $fileName, \Maatwebsite\Excel\Excel::CSV);
            case 'pdf':
                return Excel::download(new Fw4aExport, $fileName, \Maatwebsite\Excel\Excel::DOMPDF);
            default:
                return back()->with('error', 'Invalid export format selected.');
        }
    }
}
