<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HRFormsCategory;
use App\Models\HRForm;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class HRFormController extends Controller
{
    public function index(Request $request)
    {
        // Get all categories for filter dropdown
        $categories = HRFormsCategory::with('forms')->get();

        // Initialize paginated forms for each category
        $paginatedForms = [];
        $perPage = $request->get('per_page', 10); // Default 10 items per page

        foreach ($categories as $category) {
            $query = HRForm::where('category_id', $category->id);

            // Search functionality within category
            if ($request->filled('search')) {
                $search = $request->search;
                $query->where(function ($q) use ($search) {
                    $q->where('title', 'like', "%$search%")
                        ->orWhere('file_path', 'like', "%$search%");
                });
            }

            // Paginate forms for this category
            $paginatedForms[$category->id] = $query->paginate($perPage);

            // Add category info to pagination
            $paginatedForms[$category->id]->category = $category;
        }

        // If category filter is applied, only show that category
        if ($request->filled('category_id')) {
            $filteredCategories = $categories->where('id', $request->category_id);
        } else {
            $filteredCategories = $categories;
        }

        return view('hrforms.index', compact('categories', 'paginatedForms', 'filteredCategories'));
    }

    public function store(Request $request)
    {
        // Validate file upload
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:hr_forms_categories,id',
            'file_path' => 'required|file|mimes:pdf,doc,docx,jpeg,png,xls,xlsx|max:50000', // 50MB
        ]);

        // Store the file
        $file = $request->file('file_path');
        $originalName = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
        $fileName = time() . '_' . Str::slug(pathinfo($originalName, PATHINFO_FILENAME)) . '.' . $extension;

        // Store in storage/app/public/hrforms
        $path = $file->storeAs('hrforms', $fileName, 'public');

        // Create HR Form record (no PDF conversion)
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

        // Delete the database record
        $form->delete();

        return redirect()->back()->with('success', 'Form deleted successfully.');
    }

    public function download($id)
    {
        $form = HRForm::findOrFail($id);

        // Check if file exists
        if (!Storage::disk('public')->exists($form->file_path)) {
            return redirect()->back()->with('error', 'File not found.');
        }

        // Download the file
        return Storage::disk('public')->download($form->file_path, $form->title);
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
