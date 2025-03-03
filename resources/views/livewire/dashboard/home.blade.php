<?php

use Livewire\Volt\Component;
use App\Models\Note;

new class extends Component {
    public function with(): array
    {
        return [
            'total_notes' => Auth::user()->notes()->count(),
            'total_published_notes' => Auth::user()->notes()->where('is_published', true)->count(),
            'total_heart_count' => Auth::user()->notes()->sum('heart_count'),
        ];
    }
}; ?>

<div class="grid grid-cols-3 gap-4">
    <div class="border-gray w-full rounded-xl border bg-white p-6 shadow-lg hover:cursor-pointer hover:shadow-xl">
        <div class="flex">
            <div class="me-1 flex w-1/4">
                <span class="flex items-center justify-center rounded-full bg-slate-900 px-4">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6 text-white">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                    </svg>
                </span>
            </div>
            <div>
                <p class="font-nichrome text-lg">Total Notes</p>
                {{ $total_notes }}
            </div>
        </div>
    </div>
    <div class="border-gray w-full rounded-xl border bg-white p-6 shadow-lg hover:cursor-pointer hover:shadow-xl">
        <div class="flex">
            <div class="me-1 flex w-1/4">
                <span class="flex items-center justify-center rounded-full bg-slate-900 px-4">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6 text-white">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5" />
                    </svg>

                </span>
            </div>
            <div>
                <p class="font-nichrome text-lg">Note Sent</p>
                {{ $total_published_notes }}
            </div>
        </div>
    </div>
    <div class="border-gray w-full rounded-xl border bg-white p-6 shadow-lg hover:cursor-pointer hover:shadow-xl">
        <div class="flex">
            <div class="me-1 flex w-1/4">
                <span class="flex items-center justify-center rounded-full bg-slate-900 px-4">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6 text-white">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                    </svg>

                </span>
            </div>
            <div>
                <p class="font-nichrome text-lg">Love Count</p>
                {{ $total_heart_count }}
            </div>
        </div>
    </div>
</div>
