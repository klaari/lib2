<?php

namespace App\Livewire;

use Livewire\Attributes\Rule;
use Livewire\Component;
use App\Models\Track;
use App\Jobs\ProcessTrack;

use Illuminate\Support\Facades\Log;



class CreateTrack extends Component
{
    #[Rule('required|url')]
    public $source_url = 'https://example.com';

    public function save()
    {
        $validated = $this->validate();


        $track = Track::create($validated);

        ProcessTrack::dispatch($track);

        return $this->redirect('/');
    }


    public function render()
    {
        return view('livewire.create-track');
    }
}
