<x-guest-layout>
    <div class="gap-4 p-4">
        <div class="flex flex-col gap-4">
            <p class="font-nichrome text-2xl font-bold text-slate-900">{{ $note->title }}</p>
            <p class="text-md text-slate-600">{{ $note->body }}</p>
        </div>
        <div class="mt-8 flex flex-row items-center justify-between">
            <p>Sent from: <span
                    class="rounded-2xl bg-slate-900 bg-opacity-70 p-2 text-xs text-white">{{ $note->user->name }}</span>
            </p>
            <livewire:heart-react :note="$note" />
        </div>


    </div>
</x-guest-layout>
