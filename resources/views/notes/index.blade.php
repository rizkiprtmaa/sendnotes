<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row items-center justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                {{ __('Notes') }}
            </h2>
            <button href="{{ route('notes.create') }}" wire:navigate
                class="mt-3 rounded-3xl bg-slate-900 px-4 py-2 font-nichrome text-white shadow-md hover:bg-slate-800 hover:shadow-lg">Create
                note</button>
        </div>
    </x-slot>


    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">

            <div class="p-6 text-gray-900">
                <livewire:notes.show-notes lazy>
            </div>

        </div>
    </div>
</x-app-layout>
