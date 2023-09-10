 <div>
    <form wire:submit="save">
        <input type="text" wire:model="source_url" class="@error('source_url') is-invalid @enderror">
        <button type="submit">Save</button>
    </form>

    @error('source_url') {{ $message }} @enderror

</div>

