<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contestant;
use App\Models\Score;
use App\Models\Segment;

class RankingController extends Controller
{
    public function top5Candidates()
    {
        // Segments included BEFORE Final Q&A
        $includedSegments = Segment::whereIn('name', [
            'Production Number',
            'Swimwear',
            'Evening Gown and Formal Wear'
        ])->pluck('id');

        // Total score per contestant
        $totals = Score::selectRaw('contestant_id, SUM(score) as total_score')
            ->whereIn('segment_id', $includedSegments)
            ->groupBy('contestant_id')
            ->pluck('total_score', 'contestant_id');

        $males = Contestant::where('gender', 'male')->get()
            ->map(fn($c) => (object)[
                'id' => $c->id,
                'number' => $c->number,
                'name' => $c->name,
                'total' => (float)($totals[$c->id] ?? 0),
            ])
            ->sortByDesc('total')
            ->values();

        $females = Contestant::where('gender', 'female')->get()
            ->map(fn($c) => (object)[
                'id' => $c->id,
                'number' => $c->number,
                'name' => $c->name,
                'total' => (float)($totals[$c->id] ?? 0),
            ])
            ->sortByDesc('total')
            ->values();

        return view('admin.rankings.top5_candidates', compact('males', 'females'));
    }
}