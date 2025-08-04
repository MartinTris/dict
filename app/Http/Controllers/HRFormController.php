<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HRFormsCategory;
use App\Models\HRForm;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Symfony\Component\Process\Process;
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
            'file_path' => 'required|file|mimes:pdf,doc,docx,jpeg,png,xls,xlsx',
        ]);

        $file = $request->file('file_path');
        $originalName = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
        $fileName = time() . '_' . Str::slug(pathinfo($originalName, PATHINFO_FILENAME)) . '.' . $extension;

        $path = $file->storeAs('hrforms', $fileName, 'public');

        $pdfPath = null;

        // Convert office files to PDF
        if (in_array($extension, ['doc', 'docx', 'xls', 'xlsx'])) {
            $inputPath = storage_path("app/public/hrforms/{$fileName}");
            $outputDir = storage_path("app/public/hrforms");

            // Command to convert using LibreOffice
            $process = new Process([
                'soffice',
                '--headless',
                '--convert-to',
                'pdf',
                '--outdir',
                $outputDir,
                $inputPath
            ]);
            $process->run();

            if ($process->isSuccessful()) {
                $pdfPath = 'hrforms/' . pathinfo($fileName, PATHINFO_FILENAME) . '.pdf';
            }
        }

        HRForm::create([
            'title' => $request->title,
            'category_id' => $request->category_id,
            'file_path' => $pdfPath ?? $path, // fallback to original if no conversion
            'original_file_path' => $path,
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

    public function download($id)
    {
        $form = HRForm::findOrFail($id);
        return response()->download(storage_path('app/public/' . $form->original_file_path));
    }

    public function storeCategory(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:hr_forms_categories,name',
        ]);

        $category = HRFormsCategory::create([
            'name' => $request->name,
        ]);

        return response()->json($category);
    }

    public function destroyCategory($id)
    {
        $category = HRFormsCategory::findOrFail($id);

        if ($category->forms()->count()) {
            return response()->json(['error' => 'Cannot delete category with forms.'], 400);
        }

        $category->delete();
        return response()->json(['success' => 'Category deleted successfully.']);
    }

}
