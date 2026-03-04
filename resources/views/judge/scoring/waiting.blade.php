<x-app-layout>
    <meta http-equiv="refresh" content="3">
    <div class="flex items-center justify-center min-h-[70vh]">
        <div class="bg-white shadow-xl rounded-2xl p-10 text-center max-w-xl w-full">

            <div class="text-green-600 text-5xl mb-4">
                ✔
            </div>

            <h1 class="text-2xl font-bold mb-2">
                Submission Successful
            </h1>

            <p class="text-gray-600 mb-4">
                You have successfully submitted your scores for the current segment.
            </p>

            @if(session('justLocked'))
                <p class="text-sm text-red-600 font-medium mb-4">
                    All judges have submitted. This segment is now LOCKED.
                </p>
            @endif

            <div class="mt-6 border-t pt-6">
                <p class="text-gray-500 text-sm">
                    Please wait for the next segment to be enabled by the administrator.
                </p>

                <div class="mt-6 animate-pulse text-mccblue font-semibold">
                    Waiting for next segment...
                </div>
            </div>
        </div>
    </div>
</x-app-layout>