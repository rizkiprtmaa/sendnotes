<?php

use Livewire\Volt\Component;

new class extends Component {
    public $noteTitle;
    public $noteBody;
    public $noteRecepient;
    public $noteSendDate;

    public function submit()
    {
        $validated = $this->validate([
            'noteTitle' => ['required', 'string', 'min:5'],
            'noteBody' => ['required', 'string', 'min:10'],
            'noteRecepient' => ['required', 'email'],
            'noteSendDate' => ['required', 'date'],
        ]);

        auth()
            ->user()
            ->notes()
            ->create([
                'title' => $this->noteTitle,
                'body' => $this->noteBody,
                'recepient' => $this->noteRecepient,
                'send_date' => $this->noteSendDate,
                'is_published' => false,
            ]);

        redirect(route('notes.index'));
    }
}; ?>

<div class="mx-auto w-1/2">
    <div class="flex flex-row justify-end">
        <a wire:navigate href="{{ route('notes.index') }}" class="mb-4 flex flex-row justify-end gap-1 text-slate-600">
            <span><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-5 text-slate-600">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75 3 12m0 0 3.75-3.75M3 12h18" />
                </svg>
            </span> All notes</a>
    </div>
    <form wire:submit.prevent='submit'>
        <div class="mb-4">
            <label for="noteTitle" class="ms-3 font-nichrome">Note Title</label>
            <input type="text" wire:model="noteTitle" placeholder="Title" class="block w-full rounded-3xl" />
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
        <div class="flex w-full justify-center">
            <button type="submit"
                class=":hover:bg-slate-800 flex rounded-3xl bg-slate-900 px-8 py-2 font-nichrome text-white shadow-lg hover:shadow-xl">
                Submit<span class="ms-1 flex items-center"><svg xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                    </svg></span></button>
        </div>
    </form>
</div>
