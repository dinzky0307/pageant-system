<x-app-layout>
    <x-slot name="header">Segments Control</x-slot>

    <div class="p-6 space-y-4">
        @if(session('status'))
            <div style="padding:10px;border:1px solid #d1fae5;background:#ecfdf5;">
                {{ session('status') }}
            </div>
        @endif

        <div style="color:#555;">
            Turn ON exactly one segment to allow judges to score. Locked segments cannot be reopened.
        </div>

        <style>
            .switch { position: relative; display: inline-block; width: 50px; height: 26px; }
            .switch input { opacity: 0; width: 0; height: 0; }
            .slider { position: absolute; cursor: pointer; top: 0; left: 0; right: 0; bottom: 0;
                      background-color: #ccc; transition: .2s; border-radius: 999px; }
            .slider:before { position: absolute; content: ""; height: 20px; width: 20px; left: 3px; bottom: 3px;
                             background-color: white; transition: .2s; border-radius: 50%; }
            input:checked + .slider { background-color: #16a34a; }
            input:checked + .slider:before { transform: translateX(24px); }
            input:disabled + .slider { background-color: #e5e7eb; cursor: not-allowed; }
        </style>

        <table style="width:100%;border-collapse:collapse;" border="1" cellpadding="10">
            <thead>
                <tr>
                    <th>Segment</th>
                    <th>Open (Toggle)</th>
                    <th>Locked</th>
                    <th>Visible to Judges</th>
                    <th>Action</th>
                    <th>Submissions</th>
                </tr>
            </thead>

           <tbody>
    @foreach($segments as $s)
    <tr>
        <td>{{ $s->name }}</td>

        <td>
            <form method="POST" action="{{ route('admin.segments.toggleOpen', $s) }}">
                @csrf
                <label class="switch">
                    <input
                        type="checkbox"
                        onchange="this.form.submit()"
                        {{ $s->is_open ? 'checked' : '' }}
                        {{ $s->is_locked ? 'disabled' : '' }}
                    >
                    <span class="slider"></span>
                </label>
            </form>
        </td>

        <td>{{ $s->is_locked ? 'Yes' : 'No' }}</td>
        <td>{{ $s->visible_to_judges ? 'Yes' : 'No' }}</td>
        <td>{{ $s->submitted_count }} / {{ $s->judge_count }}</td>

        <td>
            <a href="{{ route('admin.segments.rankings', $s) }}"
               style="padding:6px 10px;border:1px solid #ccc;display:inline-block;">
                View Rankings
            </a>
        </td>
    </tr>

    {{-- INSERT TOP 5 ROW AFTER EVENING GOWN --}}
    @if($s->name === 'Evening Gown and Formal Wear')
    <tr style="background:#f9fafb;">
        <td><strong>View Top 5 Candidates (Male & Female)</strong></td>

        <td class="text-center">—</td>
        <td class="text-center">—</td>
        <td class="text-center">—</td>
        <td class="text-center">—</td>

        <td>
            <a href="{{ route('admin.rankings.top5Candidates') }}"
               style="padding:6px 10px;border:1px solid #ccc;display:inline-block;background:#f3f4f6;">
                View Rankings
            </a>
        </td>
    </tr>
    @endif

    @endforeach
</tbody>
        </table>
    </div>
</x-app-layout>
