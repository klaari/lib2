 <?php

use App\Models\Track;
use Illuminate\Support\Stringable;
use function Livewire\Volt\computed;
use function Livewire\Volt\state;

$tracks = computed(fn () => Track::get());


$formatDuration = function ($seconds) {

    return str(date('G\h i\m s\s', $seconds))
        ->trim('0h ')
        ->explode(' ')
        ->mapInto(Stringable::class)
        ->each->ltrim('0')
        ->join(' ');
};

?>

<x-layout>
    @volt
        <div class="rounded-xl border border-gray-200 bg-white shadow">
            <ul class="divide-y divide-gray-100">
                @foreach ($this->tracks as $track)
                    <li
                        wire:key="{{ $track->id }}"
                        class="flex flex-col items-start gap-x-6 gap-y-3 px-6 py-4 sm:flex-row sm:items-center sm:justify-between"
                    >
                        <div>
                            <h2>
                                {{ $track->title }}
                            </h2>
                            <div
                                class="mt-1 flex flex-wrap items-center gap-x-3 gap-y-1 text-sm text-gray-500"
                            >
                                <p>
                                    Duration:
                                    {{ $this->formatDuration($track->duration_in_seconds) }}
                                </p>
                            </div>
                        </div>
                        <button
                            type="button"
                            class="flex shrink-0 items-center gap-1 text-sm font-medium text-[#444] transition hover:opacity-60"
                            x-data
                            x-on:click="$dispatch('play', @js($track))"
                        >
                            <img
                                src="/images/play.svg"
                                alt="Play"
                                class="h-8 w-8 transition hover:opacity-60"
                            />
                        </button>
                    </li>
                @endforeach
            </ul>
        </div>
    @endvolt
</x-layout>
