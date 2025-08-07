<?php

namespace App\Http\Controllers;

use App\Models\EgovAssistances;
use Illuminate\Http\Request;
use App\Exports\EgovAssistancesExport;
use Maatwebsite\Excel\Facades\Excel;

class eGovAssistancesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = EgovAssistances::query();

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name_of_requestee', 'like', "%{$search}%")
                  ->orWhere('email_address', 'like', "%{$search}%")
                  ->orWhere('system', 'like', "%{$search}%")
                  ->orWhere('concern', 'like', "%{$search}%")
                  ->orWhere('province', 'like', "%{$search}%")
                  ->orWhere('lgu', 'like', "%{$search}%");
            });
        }

        // Filter by province
        if ($request->filled('province')) {
            $query->where('province', $request->province);
        }

        // Filter by lgu
        if ($request->filled('lgu')) {
            $query->where('lgu', $request->lgu);
        }

        $egovAssistances = $query->orderBy('date', 'desc')->paginate(10);

        // Get unique provinces and lgus for filters
        $provinces = EgovAssistances::distinct()->pluck('province')->filter()->sort()->values();
        $lgus = EgovAssistances::distinct()->pluck('lgu')->filter()->sort()->values();

        return view('innovate.egov.egov-assistances', compact('egovAssistances', 'provinces', 'lgus'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'province' => 'required|string|max:255',
            'lgu' => 'required|string|max:255',
            'name_of_requestee' => 'required|string|max:255',
            'email_address' => 'required|email|max:255',
            'contact_no' => 'nullable|string|max:255',
            'system' => 'required|string|max:255',
            'concern' => 'required|string',
            'received_by' => 'required|string|max:255',
            'status' => 'required|string|max:255',
        ]);

        EgovAssistances::create($request->all());

        return redirect()->route('egov-assistance.index')->with('success', 'eGov Assistance created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(EgovAssistances $egovAssistance)
    {
        return view('innovate.egov.egov-assistances-show', compact('egovAssistance'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EgovAssistances $egovAssistance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, EgovAssistances $egovAssistance)
    {
        $request->validate([
            'date' => 'required|date',
            'province' => 'required|string|max:255',
            'lgu' => 'required|string|max:255',
            'name_of_requestee' => 'required|string|max:255',
            'email_address' => 'required|email|max:255',
            'contact_no' => 'nullable|string|max:255',
            'system' => 'required|string|max:255',
            'concern' => 'required|string',
            'received_by' => 'required|string|max:255',
            'status' => 'required|string|max:255',
        ]);

        $egovAssistance->update($request->all());

        return redirect()->route('egov-assistance.index')->with('success', 'eGov Assistance updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EgovAssistances $egovAssistance)
    {
        $egovAssistance->delete();

        return redirect()->route('egov-assistance.index')->with('success', 'eGov Assistance deleted successfully!');
    }

    /**
     * Export eGov assistances in the specified format
     */
    public function export($format)
    {
        $fileName = 'egov_assistances_' . now()->format('Ymd_His') . '.' . $format;

        if (!in_array($format, ['xlsx', 'csv', 'pdf'])) {
            abort(400, 'Invalid export format.');
        }

        return Excel::download(new EgovAssistancesExport, $fileName, match($format) {
            'csv' => \Maatwebsite\Excel\Excel::CSV,
            'pdf' => \Maatwebsite\Excel\Excel::DOMPDF,
            default => \Maatwebsite\Excel\Excel::XLSX,
        });
    }
}
