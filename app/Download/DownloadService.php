<?php

namespace App\Download;

use YoutubeDl\Options;
use YoutubeDl\YoutubeDl;
use YoutubeDl\Entity\Video;
use App\Models\Track;
use App\Download\Exceptions\DownloadFailedException;
use Illuminate\Support\Facades\Log;


class DownloadService
{
    private string $downloadPath;

    private string $ytBinPath;

    public function __construct(string $downloadPath, string $ytdlBinPath)
    {
        $this->downloadPath = $downloadPath;
        $this->ytdlBinPath = $ytdlBinPath;
    }

    public function download(Track $track): ?Track
    {
        $yt = new YoutubeDl();
        $yt->setBinPath($this->ytdlBinPath);

        $collection = $yt->download(
            Options::create()
                ->downloadPath($this->downloadPath)
                ->extractAudio(true)
                ->audioFormat('mp3')
                ->audioQuality('0') // best
                ->output('%(title)s.%(ext)s')
                ->url($track->source_url)
        );

        foreach ($collection->getVideos() as $video) {
            if ($video->getError() !== null) {
                throw new DownloadFailedException($video->getError());
            }

            $track->filename = $video->getFilename();
            $track->description = $video->getDescription();
            $track->title = $video->getTitle();

            $track->save();

            return $track;
        }

    }
}



