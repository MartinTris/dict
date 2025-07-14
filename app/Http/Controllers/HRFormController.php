<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HRFormsCategory;
use App\Models\HRForm;
use Illuminate\Support\Facades\Storage;
class HRFormController extends Controller
{
    //
    public function index()
    {
        $categories = HRFormsCategory::with('forms')->get();
        return view('hrforms.index', compact('categories'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:hr_forms_categories,id',
            'file_path' => 'required|file|mimes:pdf,doc,docx,xls,xlsx',
        ]);
    
        $file = $request->file('file_path');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $path = $file->storeAs('hrforms', $fileName, 'public');
    
        HRForm::create([
            'title' => $request->title,
            'category_id' => $request->category_id,
            'file_path' => $path,
        ]);
    
        return redirect()->back()->with('success', 'HR Form added successfully!');
    }

    public function destroy($id)
    {
        $form = HRForm::findOrFail($id);

        // Delete the file from storage if it exists
        if (Storage::disk('public')->exists($form->file_path)) {
            Storage::disk('public')->delete($form->file_path);
        }
        $form->delete();

        return redirect()->back()->with('success', 'Form deleted successfully.');
    }
}
