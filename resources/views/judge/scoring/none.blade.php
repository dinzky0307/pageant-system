<x-app-layout>
    <meta http-equiv="refresh" content="3">
    <x-slot name="header">
    </x-slot>

    <div class="py-16 px-6">
        <div class="max-w-2xl mx-auto">

            <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-10 text-center">

                <!-- Icon -->
                <div class="mb-6">
                    <div class="w-16 h-16 mx-auto rounded-full bg-red-500/20 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-8 w-8 text-red-400"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M12 8v4m0 4h.01M4.93 19h14.14c1.54 0 2.5-1.67 1.73-3L13.73 4c-.77-1.33-2.69-1.33-3.46 0L3.2 16c-.77 1.33.19 3 1.73 3z"/>
                        </svg>
                    </div>
                </div>

                <!-- Title -->
                <h2 class="text-xl font-bold text-gray-800 mb-2">
                    No Active Segment
                </h2>

                <!-- Message -->
                <p class="text-gray-600 text-sm leading-relaxed">
                    There is currently no segment open for scoring.
                    Please wait for the administrator to activate a segment.
                </p>

                <!-- Optional auto-refresh note -->
                <div class="mt-6 text-xs text-gray-400">
                    This page will refresh automatically once a segment becomes available.
                </div>

            </div>

        </div>
    </div>

</x-app-layout>