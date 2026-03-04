<x-app-layout>
    <x-slot name="header">
        <div style="text-align:center;font-size:30px;font-weight:900;">
            Scoring - {{ $segment->name }}
        </div>
            <a href="{{ route('judge.scoring.picker') }}"
    style="padding:8px 12px;border:1px solid #111;border-radius:8px;display:inline-block;margin-bottom:12px;">
    Switch to Number Picker Mode
    </a>

    </x-slot>

    <div style="padding:24px;">
        @if(session('status'))
            <div style="padding:10px;border:1px solid #d1fae5;background:#ecfdf5;margin-bottom:16px;">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('judge.scoring.submit', $segment) }}">
            @csrf

            <style>
                .grid2 { display:grid; grid-template-columns: 1fr 1fr; gap: 18px; }
                .colTitle { font-weight:900; font-size:18px; margin-bottom:10px; text-align:center; letter-spacing:0.5px; }
                .card { border:1px solid #e5e7eb; background:#fff; border-radius:10px; padding:12px; margin-bottom:12px; }
                .photoBox { width:100%; height:120px; border-radius:10px; background:#f3f4f6;
                            display:flex; align-items:center; justify-content:center; font-weight:900; font-size:24px; }
                .nameRow { margin-top:10px; display:flex; justify-content:space-between; gap:10px; align-items:center; }
                .contestantName { font-weight:800; font-size:16px; }
                .criteria { margin-top:10px; background:#f9fafb; border:1px solid #eee; border-radius:10px; padding:10px; }
                .criteriaTitle { font-weight:800; margin-bottom:8px; }
                .criteriaRow { display:flex; justify-content:space-between; gap:10px; align-items:center; margin:6px 0; }
                .critName { font-size:14px; }
                .scoreInput { width:120px; padding:8px; font-size:16px; }
                .note { margin-top:8px; font-size:12px; color:#666; }
                .submitBar { margin-top:18px; display:flex; justify-content:center; }
                .btn { padding:10px 18px; border:1px solid #111; background:#111; color:#fff; cursor:pointer; border-radius:8px; }
                .btn:disabled { opacity:0.6; cursor:not-allowed; }
                @media(max-width: 900px){
                    .grid2 { grid-template-columns: 1fr; }
                }
            </style>

            @php
                $maleContestants = $contestants->where('gender','male')->values();
                $femaleContestants = $contestants->where('gender','female')->values();
            @endphp

            @if(isset($criteria) && $criteria->count() === 0)
                <div style="padding:10px;border:1px solid #fde68a;background:#fffbeb;margin-bottom:16px;">
                    <b>No criteria found</b> for this segment. Please run:
                    <code>php artisan db:seed --class=SegmentCriteriaSeeder</code>
                </div>
            @endif

            <div class="grid2">
                <!-- MALE COLUMN -->
                <div>
                    <div class="colTitle">MALE</div>

                    @foreach($maleContestants as $c)
                        <div class="card">
                            <div class="photoBox">#{{ $c->number }}</div>

                            <div class="nameRow">
                                <div class="contestantName">{{ $c->name }}</div>
                            </div>

                            <div class="criteria">
                                <div class="criteriaTitle">Criteria</div>

                                @foreach($criteria as $crit)
                                    <div class="criteriaRow">
                                        <div class="critName">{{ $crit->name }}</div>

                                        <input
                                            class="scoreInput"
                                            type="number"
                                            name="scores[{{ $c->id }}][{{ $crit->id }}]"
                                            step="0.1"
                                            min="1"
                                            max="10"
                                            value="{{ $existing[$c->id][$crit->id] ?? '' }}"
                                            placeholder="1-10"
                                            required
                                        >
                                    </div>
                                @endforeach

                                <div class="note">
                                    Each criterion: 1–10 (one decimal allowed)
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- FEMALE COLUMN -->
                <div>
                    <div class="colTitle">FEMALE</div>

                    @foreach($femaleContestants as $c)
                        <div class="card">
                            <div class="photoBox">#{{ $c->number }}</div>

                            <div class="nameRow">
                                <div class="contestantName">{{ $c->name }}</div>
                            </div>

                            <div class="criteria">
                                <div class="criteriaTitle">Criteria</div>

                                @foreach($criteria as $crit)
                                    <div class="criteriaRow">
                                        <div class="critName">{{ $crit->name }}</div>

                                        <input
                                            class="scoreInput"
                                            type="number"
                                            name="scores[{{ $c->id }}][{{ $crit->id }}]"
                                            step="0.1"
                                            min="1"
                                            max="10"
                                            value="{{ $existing[$c->id][$crit->id] ?? '' }}"
                                            placeholder="1-10"
                                            required
                                        >
                                    </div>
                                @endforeach

                                <div class="note">
                                    Each criterion: 1–10 (one decimal allowed)
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="submitBar">
                <button class="btn" type="submit">
                    Submit Scores
                </button>
            </div>

            @if ($errors->any())
                <div style="margin-top:16px;padding:10px;border:1px solid #fecaca;background:#fef2f2;">
                    <b>Please fix the following:</b>
                    <ul style="margin:0;padding-left:18px;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </form>
    </div>
</x-app-layout>
