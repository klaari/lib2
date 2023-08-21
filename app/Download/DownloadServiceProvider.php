<?php

namespace App\Download;

use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\Application;
use App\Download\DownloadService;

class DownloadServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $downloadPath = storage_path('downloads');
        $ytdlBinPath = config('download.ytdlBinPath');

        $this->app->singleton(DownloadService::class, function (Application $app) use ($downloadPath, $ytdlBinPath) {
            return new DownloadService($downloadPath, $ytdlBinPath);
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
