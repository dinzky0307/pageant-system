<x-app-layout>
    <x-slot name="header">Rankings - {{ $segment->name }}</x-slot>

    <div class="p-6 space-y-6">
        <a href="{{ route('admin.segments.index') }}" style="padding:6px 10px;border:1px solid #ccc;display:inline-block;">
            ← Back to Segments
        </a>

        <div style="padding:10px;border:1px solid #e5e7eb;background:#f9fafb;">
            <div style="font-weight:bold;margin-bottom:6px;">Winners (Rank #1)</div>
            <div><b>Female Winner:</b>
                {{ $femaleWinner ? '#'.$femaleWinner['number'].' '.$femaleWinner['name'].' ('.$femaleWinner['total'].')' : 'N/A' }}
            </div>
            <div><b>Male Winner:</b>
                {{ $maleWinner ? '#'.$maleWinner['number'].' '.$maleWinner['name'].' ('.$maleWinner['total'].')' : 'N/A' }}
            </div>
        </div>

        <div>
            <h2 style="font-weight:bold;margin-bottom:8px;">Female Rankings</h2>
<table border="1" cellpadding="8" style="width:100%;border-collapse:collapse;">
    <thead>
        <tr>
            <th>Rank</th>
            <th>#</th>
            <th style="text-align:left;">Name</th>

            @foreach($judges as $j)
                <th>
                    {{ $j->judge_code ?? $j->name }}
                    @if($j->is_chairman) (C) @endif
                </th>
            @endforeach

            <th>Total</th>
            <th>Tie</th>
        </tr>
    </thead>

    <tbody>
        @foreach($female as $r)
            <tr>
                <td style="text-align:center;">{{ $r['rank'] }}</td>
                <td style="text-align:center;">{{ $r['number'] }}</td>
                <td>{{ $r['name'] }}</td>

                @foreach($judges as $j)
                    @php $val = $r['judge_scores'][$j->id] ?? null; @endphp
                    <td style="text-align:center;">
                        {{ $val === null ? '-' : number_format((float)$val, 1) }}
                    </td>
                @endforeach

                <td style="text-align:center;">{{ number_format((float)$r['total'], 1) }}</td>
                <td style="text-align:center;">{{ $r['tied'] ? '⚠️' : '' }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

        </div>

        <div>
            <h2 style="font-weight:bold;margin-bottom:8px;">Male Rankings</h2>
<table border="1" cellpadding="8" style="width:100%;border-collapse:collapse;">
    <thead>
        <tr>
            <th>Rank</th>
            <th>#</th>
            <th style="text-align:left;">Name</th>

            @foreach($judges as $j)
                <th>
                    {{ $j->judge_code ?? $j->name }}
                    @if($j->is_chairman) (C) @endif
                </th>
            @endforeach

            <th>Total</th>
            <th>Tie</th>
        </tr>
    </thead>

    <tbody>
        @foreach($male as $r)
            <tr>
                <td style="text-align:center;">{{ $r['rank'] }}</td>
                <td style="text-align:center;">{{ $r['number'] }}</td>
                <td>{{ $r['name'] }}</td>

                @foreach($judges as $j)
                    @php $val = $r['judge_scores'][$j->id] ?? null; @endphp
                    <td style="text-align:center;">
                        {{ $val === null ? '-' : number_format((float)$val, 1) }}
                    </td>
                @endforeach

                <td style="text-align:center;">{{ number_format((float)$r['total'], 1) }}</td>
                <td style="text-align:center;">{{ $r['tied'] ? '⚠️' : '' }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

        </div>
    </div>
</x-app-layout>
