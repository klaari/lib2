<?php

namespace App\Jobs;

use App\Models\Track;
use App\Download\DownloadService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class DownloadTrack implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public Track $track,
    ) {}

    /**
     * Execute the job.
     */
    public function handle(DownloadService $downloadService): void
    {
        $downloadService->download($this->track);
    }
}
