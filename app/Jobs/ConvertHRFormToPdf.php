<?php

namespace App\Jobs;

use App\Models\HRForm;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Symfony\Component\Process\Process;

class ConvertHRFormToPdf implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $hrForm;
    protected $fileName;
    protected $extension;

    /**
     * Create a new job instance.
     */
    public function __construct(HRForm $hrForm, string $fileName, string $extension)
    {
        $this->hrForm = $hrForm;
        $this->fileName = $fileName;
        $this->extension = $extension;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            // Only convert if the file needs conversion
            if (!in_array($this->extension, ['doc', 'docx', 'xls', 'xlsx'])) {
                // File doesn't need conversion, mark as completed
                $this->hrForm->update([
                    'conversion_status' => 'completed',
                ]);
                Log::info("HR Form {$this->hrForm->id} does not require conversion");
                return;
            }

            $inputPath = storage_path("app/public/hrforms/{$this->fileName}");
            $outputDir = storage_path("app/public/hrforms");

            // Verify input file exists
            if (!file_exists($inputPath)) {
                throw new \Exception("Input file not found: {$inputPath}");
            }

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

            // Set timeout to 60 seconds
            $process->setTimeout(60);
            $process->run();

            if (!$process->isSuccessful()) {
                throw new \Exception($process->getErrorOutput() ?: 'LibreOffice conversion failed');
            }

            // Verify PDF was created
            $pdfFileName = pathinfo($this->fileName, PATHINFO_FILENAME) . '.pdf';
            $pdfPath = "hrforms/{$pdfFileName}";
            $pdfFullPath = storage_path("app/public/{$pdfPath}");

            if (!file_exists($pdfFullPath)) {
                throw new \Exception("PDF file was not created at expected location: {$pdfFullPath}");
            }

            // Update the HR form with PDF path and mark as completed
            $this->hrForm->update([
                'file_path' => $pdfPath,
                'conversion_status' => 'completed',
            ]);

            Log::info("HR Form {$this->hrForm->id} successfully converted to PDF: {$pdfPath}");

        } catch (\Exception $e) {
            // Update the HR form to mark conversion as failed
            $this->hrForm->update([
                'conversion_status' => 'failed',
                'conversion_error' => $e->getMessage(),
            ]);

            Log::error("Failed to convert HR Form {$this->hrForm->id}: " . $e->getMessage());

            // Re-throw to mark job as failed in queue
            throw $e;
        }
    }

    /**
     * Handle a job failure.
     */
    public function failed(\Throwable $exception): void
    {
        Log::error("Job failed for HR Form {$this->hrForm->id}: " . $exception->getMessage());

        // Optional: Send notification about failed conversion
        // Notification::route('mail', 'admin@example.com')
        //     ->notify(new HRFormConversionFailed($this->hrForm, $exception));
    }
}
