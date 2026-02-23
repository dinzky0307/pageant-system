<x-app-layout>
    <x-slot name="header">Judge Dashboard</x-slot>

    <div class="p-6 space-y-4">
        <a href="{{ route('judge.scoring.index') }}" class="px-4 py-2 border inline-block">
            Start Scoring
        </a>
    </div>
</x-app-layout>
