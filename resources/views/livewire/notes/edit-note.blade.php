<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use App\Models\Note;

new #[Layout('layouts.app')] class extends Component {
    //

    public Note $note;

    public $noteTitle;
    public $noteBody;
    public $noteRecepient;
    public $noteSendDate;
    public $noteIsPublished;

    public function mount(Note $note)
    {
        $this->authorize('update', $note);
        $this->fill($note);
        $this->noteTitle = $note->title;
        $this->noteBody = $note->body;
        $this->noteRecepient = $note->recepient;
        $this->noteSendDate = $note->send_date;
        $this->noteIsPublished = $note->is_published;
    }

    public function saveNote()
    {
        $validated = $this->validate([
            'noteTitle' => ['required', 'string', 'min:5'],
            'noteBody' => ['required', 'string', 'min:10'],
            'noteRecepient' => ['required', 'email'],
            'noteSendDate' => ['required', 'date'],
        ]);

        $this->note->update([
            'title' => $this->noteTitle,
            'body' => $this->noteBody,
            'recepient' => $this->noteRecepient,
            'send_date' => $this->noteSendDate,
            'is_published' => $this->noteIsPublished,
        ]);

        $this->dispatch('noteSaved');
    }
};
?>


<div>
    <x-slot name="header">
        <div class="flex flex-row items-center justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('Edit Notes') }}
            </h2>

        </div>
    </x-slot>


    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">

            <div class="mx-auto w-1/2">
                <div class="flex flex-row justify-end">
                    <a wire:navigate href="{{ route('notes.index') }}"
                        class="mb-4 flex flex-row justify-end gap-1 text-slate-600">
                        <span><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="size-5 text-slate-600">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M6.75 15.75 3 12m0 0 3.75-3.75M3 12h18" />
                            </svg>
                        </span> Cancel</a>
                </div>
                <form wire:submit.prevent='saveNote'>
                    <div class="mb-4">
                        <label for="noteTitle" class="ms-3 font-nichrome">Note Title</label>
                        <input type="text" wire:model="noteTitle" placeholder="Title"
                            class="block w-full rounded-3xl" />
                        @error('noteTitle')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oops!</span>
                                {{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="noteBody" class="ms-3 font-nichrome">Your Note</label>
                        <textarea wire:model="noteBody" placeholder="Share all your thoughts" class="block w-full rounded-3xl"></textarea>
                        @error('noteBody')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oops!</span>
                                {{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="noteRecepient" class="ms-3 font-nichrome">Recepient</label>
                        <input type="text" wire:model="noteRecepient" placeholder="yourfriend@email.com"
                            class="block w-full rounded-3xl" />
                        @error('noteRecepient')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oops!</span>
                                {{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="noteSendDate" class="ms-3 font-nichrome">Send Date</label>
                        <input type="date" wire:model="noteSendDate" class="block w-full rounded-3xl" />
                        @error('noteSendDate')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oops!</span>
                                {{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-4 ms-3 flex items-center">
                        <input id="note-published" type="checkbox" wire:model="noteIsPublished"
                            class="h-4 w-4 rounded-sm border-gray-300 bg-gray-100 text-slate-900 focus:ring-2 focus:ring-slate-900 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-blue-600">
                        <label for="note-published"
                            class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Note Published</label>
                    </div>
                    <div class="flex w-full justify-center">
                        <button type="submit"
                            class=":hover:bg-slate-800 flex rounded-3xl bg-slate-900 px-8 py-2 font-nichrome text-white shadow-lg hover:shadow-xl">
                            Save Note</button>
                    </div>
                    <x-action-message on="noteSaved" class="mt-4 text-green-600" />
                </form>
            </div>
        </div>
    </div>
</div>
