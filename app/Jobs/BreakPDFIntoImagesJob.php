<?php

namespace App\Jobs;

use App\Services\PDFService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class BreakPDFIntoImagesJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $pdfService;
    private $subject;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($pdfService, $subject)
    {
        $this->pdfService = $pdfService;
        $this->subject = $subject;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->pdfService->explodePdfToImages($this->subject);
    }
}
