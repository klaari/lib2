<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Contracts\Console\PromptsForMissingInput;
use Illuminate\Support\Facades\Validator;
use App\Download\DownloadService;
use App\Jobs\DownloadTrack;
use App\Jobs\StoreTrack;
use App\Models\Track;
use Illuminate\Support\Facades\Bus;


class Download extends Command implements PromptsForMissingInput
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:download {source_url}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Download a track from a URL';

    protected function promptForMissingArgumentsUsing(): array
    {
        return [
            'source_url' => 'Which url should be downloaded?',
        ];
    }

    /**
     * Execute the console command.
     */
    public function handle(DownloadService $downloadService): void
    {
        $source_url = $this->argument('source_url');

        $validator = Validator::make($this->arguments(), [
            'source_url' => 'required|url',
        ]);

        if ($validator->fails()) {
            echo 'Invalid URL';
            return;
        }

        $validated = $validator->validated();

        $track = Track::create($validated);

        Bus::chain([
            new DownloadTrack($track),
            new StoreTrack($track),
        ])->dispatch();

    }
}
