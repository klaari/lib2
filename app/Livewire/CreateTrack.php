<?php

namespace App\Livewire;

use Livewire\Attributes\Rule;
use Livewire\Component;
use App\Models\Track;
use App\Jobs\DownloadTrack;
use App\Jobs\StoreTrack;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Log;



class CreateTrack extends Component
{
    #[Rule('required|url')]
    public $source_url = 'https://example.com';

    public function save()
    {
        $validated = $this->validate();

        $track = Track::create($validated);

        Bus::chain([
            new DownloadTrack($track),
            new StoreTrack($track),
        ])->dispatch();

        return $this->redirect('/');
    }


    public function render()
    {
        return view('livewire.create-track');
    }
}
