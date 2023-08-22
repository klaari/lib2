<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Track;

class Tracks extends Component
{
    public $tracks;

    public function mount()
    {
        $this->tracks = Track::all();
    }

    public function render()
    {
        return view('livewire.tracks');
    }
}
