<?php

use Livewire\Volt\Component;
use App\Models\Note;
use Livewire\WithPagination;

new class extends Component {
    use WithPagination;
    public function with(): array
    {
        return [
            'notes' => Auth::user()->notes()->orderBy('send_date', 'asc')->paginate(6),
        ];
    }

    public function placeholder()
    {
        return <<<'HTML'
        <div class="flex items-center justify-center h-96">

            <svg aria-hidden="true" class="w-8 h-8 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
            </svg>
            <span class="sr-only">Loading...</span>

        </div>
        HTML;
    }

    public function delete($noteId)
    {
        $note = Note::where('id', $noteId)->first();
        $this->authorize('delete', $note);
        $note->delete();
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
                    wire:key="{{ $note->id }}">
                    <div class="flex justify-between">
                        <a wire:navigate href="{{ route('notes.edit', $note) }}"
                            class="truncate font-nichrome text-lg text-slate-900">{{ $note->title }}</a>
                        <p class="flex items-center whitespace-nowrap text-sm text-slate-600">
                            {{ Carbon\Carbon::parse($note->send_date)->format('M-d-Y') }}</p>
                    </div>
                    <p class="text-sm text-slate-600">{{ Str::limit($note->body, 100, '...') }} </p>
                    <div class="mt-auto flex flex-row items-center justify-between">
                        <p class="text-sm font-semibold text-slate-600">To: <span
                                class="rounded-2xl bg-slate-900 bg-opacity-70 p-2 text-xs text-white">{{ $note->recepient }}</span>
                        </p>

                        <div class="flex flex-row gap-2">
                            <button wire:click="delete('{{ $note->id }}')"
                                class="rounded-2xl border border-gray-200 p-2 shadow-sm hover:shadow-xl">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-4">
                                    <path stroke-linecap="round" stroke-linejoin="round" <path stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                </svg>

                            </button>
                            <a wire:navigate href='{{ route('notes.view', $note->id) }}'
                                class="rounded-2xl border border-gray-200 p-2 shadow-sm hover:shadow-xl">
                                <span>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-4">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                    </svg>
                            </a>
                            </span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
    <div class="mt-4" wire:navigation>
        {{ $notes->links() }}
    </div>
</div>
