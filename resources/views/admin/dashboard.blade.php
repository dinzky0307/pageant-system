<x-app-layout>
    <x-slot name="header">Admin Dashboard</x-slot>

    <div class="p-6 space-y-4">
        <div class="text-lg font-semibold">Pageant Control Panel</div>

        <div class="space-x-3">
            <a class="px-4 py-2 border inline-block" 
               href="{{ route('admin.segments.index') }}">
                Manage Segments
            </a>
        </div>
    </div>
</x-app-layout>