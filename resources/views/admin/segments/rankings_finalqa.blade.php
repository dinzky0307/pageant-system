<x-app-layout>
    <x-slot name="header">
        Final Q&amp;A Rankings (Top 5 Only)
    </x-slot>

    <div class="p-6 space-y-6">
        <div style="color:#555;">
            Final placement is based ONLY on Final Q&amp;A totals.
        </div>

        <div style="display:flex; gap:30px;">

            <div style="width:50%;">
                <h3 style="font-weight:600;">Top 5 Male</h3>
                <table border="1" cellpadding="8" style="width:100%; border-collapse:collapse;">
                    <thead>
                        <tr>
                            <th>Rank</th>
                            <th>No.</th>
                            <th>Name</th>
                            <th>Total (Final Q&amp;A)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($males as $i => $c)
                        <tr style="{{ $i === 0 ? 'background:#fde68a;' : '' }}">
                            <td>{{ $i + 1 }}</td>
                            <td>{{ $c->number }}</td>
                            <td>{{ $c->name }}</td>
                            <td>{{ number_format($c->total, 1) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div style="width:50%;">
                <h3 style="font-weight:600;">Top 5 Female</h3>
                <table border="1" cellpadding="8" style="width:100%; border-collapse:collapse;">
                    <thead>
                        <tr>
                            <th>Rank</th>
                            <th>No.</th>
                            <th>Name</th>
                            <th>Total (Final Q&amp;A)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($females as $i => $c)
                        <tr style="{{ $i === 0 ? 'background:#fde68a;' : '' }}">
                            <td>{{ $i + 1 }}</td>
                            <td>{{ $c->number }}</td>
                            <td>{{ $c->name }}</td>
                            <td>{{ number_format($c->total, 1) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>