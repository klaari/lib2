<div
    x-data="{
        activeTrack: null,
        play(track) {
            this.activeTrack = track
            console.log('play', track);

            this.$nextTick(() => {
                this.$refs.audio.play()
            })
        },
    }"
    x-show="activeTrack"
    x-transition.opacity.duration.500ms
    x-on:play.window="play($event.detail)"
    class="fixed inset-x-0 bottom-0 w-full border-t border-gray-200 bg-white"
    style="display: none"
>
    <div class="mx-auto max-w-xl p-6">
        <h3
            x-text="`${activeTrack?.title}`"
            class="text-center text-sm font-medium text-gray-600"
        ></h3>
        <audio
            x-ref="audio"
            class="mx-auto mt-3"
            :src="activeTrack?.url"
            controls
        ></audio>
    </div>
</div>
