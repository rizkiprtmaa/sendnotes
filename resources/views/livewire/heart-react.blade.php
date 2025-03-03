<?php

use Livewire\Volt\Component;
use App\Models\Note;

new class extends Component {
    public Note $note;
    public $heartCount;

    public function mount(Note $note)
    {
        $this->note = $note;
        $this->heartCount = $note->heart_count;
    }

    public function increaseHeartCount()
    {
        $this->heartCount++;
        $this->note->update([
            'heart_count' => $this->heartCount,
        ]);
    }
}; ?>

<div>
    <button x-on:click='$wire.increaseHeartCount()'
        class="flex gap-1 rounded-full bg-pink-500 px-3 py-3 font-nichrome text-xs text-white shadow-md hover:bg-pink-600 hover:shadow-lg"><span><svg
                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-4 text-white">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
            </svg>
        </span>{{ $heartCount }}</button>
</div>
