<x-app-layout>
    <x-slot name="header">
        Final Results (Final Q&A Based)
        <a href="{{ route('admin.results.final.pdf') }}"
   style="padding:6px 10px;border:1px solid #ccc;display:inline-block;">
    Download PDF
</a>
    </x-slot>

    <div class="p-6 space-y-6">

        <div style="display:flex; gap:40px;">

            {{-- MALE --}}
            <div style="width:50%;">
                <h2>Top 5 Male</h2>
                <table border="1" cellpadding="8" style="width:100%; border-collapse:collapse;">
                    <thead>
                        <tr>
                            <th>Rank</th>
                            <th>#</th>
                            <th>Name</th>
                            <th>Total</th>
                            <th>Tie</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($males as $r)
                        <tr style="{{ $r['rank'] == 1 ? 'background:#fde68a;' : '' }}">
                            <td>{{ $r['rank'] }}</td>
                            <td>{{ $r['number'] }}</td>
                            <td>{{ $r['name'] }}</td>
                            <td>{{ number_format($r['total'], 1) }}</td>
                            <td>{{ $r['tied'] ? '⚠️' : '' }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- FEMALE --}}
            <div style="width:50%;">
                <h2>Top 5 Female</h2>
                <table border="1" cellpadding="8" style="width:100%; border-collapse:collapse;">
                    <thead>
                        <tr>
                            <th>Rank</th>
                            <th>#</th>
                            <th>Name</th>
                            <th>Total</th>
                            <th>Tie</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($females as $r)
                        <tr style="{{ $r['rank'] == 1 ? 'background:#fde68a;' : '' }}">
                            <td>{{ $r['rank'] }}</td>
                            <td>{{ $r['number'] }}</td>
                            <td>{{ $r['name'] }}</td>
                            <td>{{ number_format($r['total'], 1) }}</td>
                            <td>{{ $r['tied'] ? '⚠️' : '' }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>

    </div>
</x-app-layout>