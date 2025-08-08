<?php

namespace App\Http\Controllers;

use App\Models\Tech4ed;
use App\Models\Tech4edModule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Process\Process;

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
            // Store directly in tech4ed_modules folder, not nested
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
                // Store directly in tech4ed_modules folder, not nested
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

    public function preview(Tech4edModule $tech4edModule)
    {
        try {
            if (!Storage::disk('public')->exists($tech4edModule->file_path)) {
                return response()->json(['error' => 'File not found'], 404);
            }

            $filePath = storage_path('app/public/' . $tech4edModule->file_path);
            $extension = strtolower($tech4edModule->file_type);

            // For PDF files, return the file directly
            if ($extension === 'pdf') {
                return response()->file($filePath);
            }

            // For image files, return the file directly
            if (in_array($extension, ['png', 'jpeg', 'jpg'])) {
                return response()->file($filePath);
            }

            // For PPTX and PPT files, convert to PDF for preview
            if (in_array($extension, ['ppt', 'pptx'])) {
                $pdfPath = $this->convertToPdf($filePath, $extension);
                if ($pdfPath && file_exists($pdfPath)) {
                    return response()->file($pdfPath);
                } else {
                    return response()->json(['error' => 'Failed to convert file to PDF for preview'], 500);
                }
            }

            // For XLSX files, convert to PDF for preview
            if ($extension === 'xlsx') {
                $pdfPath = $this->convertToPdf($filePath, $extension);
                if ($pdfPath && file_exists($pdfPath)) {
                    return response()->file($pdfPath);
                } else {
                    return response()->json(['error' => 'Failed to convert file to PDF for preview'], 500);
                }
            }

            // For MP4 files, return error (video preview not supported in this implementation)
            if ($extension === 'mp4') {
                return response()->json(['error' => 'Video preview not supported. Please download the file to view.'], 400);
            }

            return response()->json(['error' => 'Unsupported file type for preview'], 400);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to generate preview: ' . $e->getMessage()], 500);
        }
    }

    private function convertToPdf($inputPath, $extension)
    {
        try {
            // Check if LibreOffice is available
            $libreOfficePath = $this->findLibreOffice();
            if (!$libreOfficePath) {
                \Log::error('LibreOffice not found on system');
                return null;
            }

            $outputDir = storage_path('app/public/tech4ed_modules/previews');
            
            // Create previews directory if it doesn't exist
            if (!file_exists($outputDir)) {
                mkdir($outputDir, 0755, true);
            }

            $outputPath = $outputDir . '/' . pathinfo($inputPath, PATHINFO_FILENAME) . '.pdf';

            // Check if PDF already exists and is recent (within 1 hour)
            if (file_exists($outputPath) && (time() - filemtime($outputPath)) < 3600) {
                return $outputPath;
            }

            // Command to convert using LibreOffice
            $process = new Process([
                $libreOfficePath,
                '--headless',
                '--convert-to',
                'pdf',
                '--outdir',
                $outputDir,
                $inputPath
            ]);

            $process->setTimeout(120); // 2 minutes timeout for larger files
            $process->run();

            if ($process->isSuccessful() && file_exists($outputPath)) {
                \Log::info('LibreOffice conversion successful', [
                    'input' => $inputPath,
                    'output' => $outputPath,
                    'extension' => $extension
                ]);
                return $outputPath;
            } else {
                \Log::error('LibreOffice conversion failed', [
                    'input' => $inputPath,
                    'output' => $outputPath,
                    'exit_code' => $process->getExitCode(),
                    'error_output' => $process->getErrorOutput(),
                    'output' => $process->getOutput()
                ]);
                return null;
            }

        } catch (\Exception $e) {
            \Log::error('LibreOffice conversion exception: ' . $e->getMessage(), [
                'input' => $inputPath,
                'extension' => $extension,
                'trace' => $e->getTraceAsString()
            ]);
            return null;
        }
    }

    private function findLibreOffice()
    {
        // Common LibreOffice paths
        $possiblePaths = [
            'soffice',
            'libreoffice',
            '/usr/bin/soffice',
            '/usr/bin/libreoffice',
            '/opt/libreoffice/program/soffice',
            'C:/Program Files/LibreOffice/program/soffice.exe',
            'C:/Program Files (x86)/LibreOffice/program/soffice.exe'
        ];

        foreach ($possiblePaths as $path) {
            $process = new Process(['which', $path]);
            $process->run();
            
            if ($process->isSuccessful()) {
                return $path;
            }
        }

        // Try direct execution
        foreach ($possiblePaths as $path) {
            $process = new Process([$path, '--version']);
            $process->setTimeout(10);
            $process->run();
            
            if ($process->isSuccessful()) {
                return $path;
            }
        }

        return null;
    }
}
