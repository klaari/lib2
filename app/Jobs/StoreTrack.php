<?php

namespace App\Jobs;

use App\Models\Track;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class StoreTrack implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public Track $track,
    ) {

        Log::alert("STORE JOB constr!");

    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $s3Path = Str::slug($this->track->title, '-') . '.mp3';

        if(Storage::put($s3Path, file_get_contents($this->track->filename))) {
            unlink($this->track->filename);
            $this->track->url = Storage::url($s3Path);
        }

        $this->track->save();

    }
}

