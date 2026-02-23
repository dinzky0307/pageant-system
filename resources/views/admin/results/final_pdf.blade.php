<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ $eventTitle }}</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; color: #111; }
        .header { text-align:center; margin-bottom: 10px; }
        .title { font-size: 16px; font-weight: bold; }
        .meta { margin-top: 4px; font-size: 11px; color: #444; }
        .row { display: flex; gap: 16px; }
        .col { width: 50%; }
        table { width:100%; border-collapse: collapse; margin-top: 8px; }
        th, td { border:1px solid #111; padding: 6px; }
        th { background: #f3f4f6; }
        .gold { background: #fde68a; font-weight: bold; }
        .tie { font-weight: bold; }
        .note { margin-top: 12px; font-size: 11px; color: #444; }
    </style>
</head>
<body>

    <div class="header">
        <div class="title">{{ $eventTitle }}</div>
        <div class="meta">Basis: {{ $basis }}</div>
        <div class="meta">Generated: {{ $generatedAt }}</div>
    </div>

    <div class="row">
        <div class="col">
            <h3>Top 5 Male</h3>
            <table>
                <thead>
                    <tr>
                        <th>Rank</th>
                        <th>No.</th>
                        <th>Name</th>
                        <th>Total</th>
                        <th>Tie</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($males as $r)
                        <tr class="{{ $r['rank'] == 1 ? 'gold' : '' }}">
                            <td style="text-align:center;">{{ $r['rank'] }}</td>
                            <td style="text-align:center;">{{ $r['number'] }}</td>
                            <td>{{ $r['name'] }}</td>
                            <td style="text-align:center;">{{ number_format((float)$r['total'], 1) }}</td>
                            <td style="text-align:center;" class="tie">{{ $r['tied'] ? 'TIE' : '' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="col">
            <h3>Top 5 Female</h3>
            <table>
                <thead>
                    <tr>
                        <th>Rank</th>
                        <th>No.</th>
                        <th>Name</th>
                        <th>Total</th>
                        <th>Tie</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($females as $r)
                        <tr class="{{ $r['rank'] == 1 ? 'gold' : '' }}">
                            <td style="text-align:center;">{{ $r['rank'] }}</td>
                            <td style="text-align:center;">{{ $r['number'] }}</td>
                            <td>{{ $r['name'] }}</td>
                            <td style="text-align:center;">{{ number_format((float)$r['total'], 1) }}</td>
                            <td style="text-align:center;" class="tie">{{ $r['tied'] ? 'TIE' : '' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="note">
        <b>Note:</b> Final placements are determined strictly by Final Q&amp;A totals. Ties must be resolved by the Chairman.
    </div>

</body>
</html>