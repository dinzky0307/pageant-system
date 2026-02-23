<x-app-layout>
    <x-slot name="header">
        Top 5 Candidates (Running Scores)
    </x-slot>

    <div class="p-6 space-y-6">

        <div style="color:#555;">
            Based on: Production Number + Swimwear + Evening Gown and Formal Wear
        </div>

        <div style="display:flex; gap:40px;">

            <!-- MALE -->
            <div style="width:50%;">
                <h3>Male Rankings</h3>

                <table border="1" cellpadding="8" style="width:100%; border-collapse:collapse;">
                    <thead>
                        <tr>
                            <th>Rank</th>
                            <th>No.</th>
                            <th>Name</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($males as $i => $c)
                        <tr style="{{ $i < 5 ? 'background:#d1fae5;' : '' }}">
                            <td>{{ $i + 1 }}</td>
                            <td>{{ $c->number }}</td>
                            <td>{{ $c->name }}</td>
                            <td>{{ number_format($c->total, 1) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- FEMALE -->
            <div style="width:50%;">
                <h3>Female Rankings</h3>

                <table border="1" cellpadding="8" style="width:100%; border-collapse:collapse;">
                    <thead>
                        <tr>
                            <th>Rank</th>
                            <th>No.</th>
                            <th>Name</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($females as $i => $c)
                        <tr style="{{ $i < 5 ? 'background:#d1fae5;' : '' }}">
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