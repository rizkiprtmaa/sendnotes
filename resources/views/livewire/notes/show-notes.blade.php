<?php

use Livewire\Volt\Component;

new class extends Component {
    public function with(): array
    {
        return [
            'notes' => Auth::user()->notes()->orderBy('send_date', 'asc')->get(),
        ];
    }
}; ?>

<div>
    @if ($notes->isEmpty())
        <div class="flex h-96 flex-col items-center justify-center gap-3">
            <p class="font-nichrome text-xl text-slate-950">No notes found.</p>
            <p class="text-gray-500">Let's create some notes.</p>
            <button href="{{ route('notes.create') }}" wire:navigate
                class="mt-3 rounded-3xl bg-slate-900 px-4 py-2 font-nichrome text-white shadow-md hover:bg-slate-800 hover:shadow-lg">Create
                note</button>
        </div>
    @else
        <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
            @foreach ($notes as $note)
                <div class="mb-4 flex flex-col gap-4 rounded-lg border border-gray-200 bg-white p-4 shadow-sm hover:shadow-md"
                    wire:key="note-{{ $note->id }}">
                    <div class="flex justify-between">
                        <a href="#" class="font-nichrome text-lg text-slate-900">{{ $note->title }}</a>
                        <p class="flex items-center text-sm text-slate-600">
                            {{ Carbon\Carbon::parse($note->send_date)->format('M-d-Y') }}</p>
                    </div>
                    <p class="text-sm text-slate-600">{{ $note->body }}</p>
                    <div class="mt-auto flex flex-row items-center justify-between">
                        <p class="text-sm font-semibold text-slate-600">To: <span
                                class="rounded-2xl bg-slate-900 bg-opacity-70 p-2 text-xs text-white">{{ $note->recepient }}</span>
                        </p>

                        <div class="flex flex-row gap-2">
                            <span class="rounded-2xl border border-gray-200 p-2 shadow-sm hover:shadow-xl"><svg
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-4">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                </svg>

                            </span>
                            <span class="rounded-2xl border border-gray-200 p-2 shadow-sm hover:shadow-xl">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-4">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                </svg>

                            </span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
