<?php

namespace App\Http\Controllers;

use App\Models\Tech4ed;
use App\Models\Tech4edModule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class Tech4edModuleController extends Controller
{
    public function index(Request $request)
    {
        $query = Tech4edModule::query();

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('file_type', 'like', "%{$search}%");
            });
        }

        // File type filter
        if ($request->filled('file_type')) {
            $query->where('file_type', $request->file_type);
        }

        // Sorting
        switch ($request->get('sort', 'latest')) {
            case 'oldest':
                $query->orderBy('created_at', 'asc');
                break;
            case 'title_asc':
                $query->orderBy('title', 'asc');
                break;
            case 'title_desc':
                $query->orderBy('title', 'desc');
                break;
            default: // latest
                $query->orderBy('created_at', 'desc');
                break;
        }

        $modules = $query->paginate(10)->withQueryString();
        return view('harness.tech4ed.tech4ed-modules', compact('modules'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'title' => 'required|string|max:255',
                'file' => 'required|file|mimes:mp4,pdf,ppt,pptx,png,jpeg,jpg,xlsx|max:20480',
            ]);

            $file = $request->file('file');
            $path = $file->store('tech4ed_modules', 'public');

            Tech4edModule::create([
                'title' => $request->title,
                'file_path' => $path,
                'file_type' => $file->getClientOriginalExtension(),
            ]);

            return redirect()->route('tech4ed-modules.index')->with('success', 'Module uploaded successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to upload module. Please try again.')->withInput();
        }
    }

    public function update(Request $request, Tech4edModule $tech4edModule)
    {
        try {
            $request->validate([
                'title' => 'required|string|max:255',
                'file' => 'nullable|file|mimes:mp4,pdf,ppt,pptx,png,jpeg,jpg,xlsx|max:20480',
            ]);

            $data = $request->only('title');

            if ($request->hasFile('file')) {
                // Delete old file
                if ($tech4edModule->file_path) {
                    Storage::disk('public')->delete($tech4edModule->file_path);
                }
                
                $file = $request->file('file');
                $path = $file->store('tech4ed_modules', 'public');
                $data['file_path'] = $path;
                $data['file_type'] = $file->getClientOriginalExtension();
            }

            $tech4edModule->update($data);

            return redirect()->route('tech4ed-modules.index')->with('success', 'Module updated successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update module. Please try again.')->withInput();
        }
    }

    public function destroy(Tech4edModule $tech4edModule)
    {
        try {
            // Delete file from storage
            if ($tech4edModule->file_path) {
                Storage::disk('public')->delete($tech4edModule->file_path);
            }
            
            $tech4edModule->delete();
            return redirect()->back()->with('success', 'Module deleted successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete module. Please try again.');
        }
    }

    public function download(Tech4edModule $tech4edModule)
    {
        try {
            if (!Storage::disk('public')->exists($tech4edModule->file_path)) {
                return redirect()->back()->with('error', 'File not found. It may have been deleted.');
            }
            
            return Storage::disk('public')->download($tech4edModule->file_path);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to download file. Please try again.');
        }
    }
}
