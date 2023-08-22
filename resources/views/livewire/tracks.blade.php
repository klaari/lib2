<div>
    @foreach ($tracks as $track)
        <div wire:key="{{ $track->id }}"> 
            {{ $track->title }}
            -
            {{ $track->url }}
            <!-- ... -->
        </div>
    @endforeach
</div>
