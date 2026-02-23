<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contestant;
use App\Models\Score;
use App\Models\Segment;
use App\Models\SegmentJudgeSubmission;
use App\Models\User;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class SegmentController extends Controller
{
    public function index()
    {
        $judgeCount = User::where('role', 'judge')->count();

        $segments = Segment::orderBy('display_order')->get();

        foreach ($segments as $s) {
            $s->judge_count = $judgeCount;
            $s->submitted_count = SegmentJudgeSubmission::where('segment_id', $s->id)->count();
        }

        return view('admin.segments.index', compact('segments'));
    }

    /**
     * Toggle open/close segment (your UI uses this)
     */
    public function toggleOpen(Segment $segment)
    {
        if ($segment->is_locked) {
            return back()->with('status', 'Cannot open a locked segment.');
        }

        // turning ON
        if (!$segment->is_open) {
            Segment::query()->update(['is_open' => false]);

            $segment->update([
                'is_open' => true,
                'visible_to_judges' => false, // rankings not auto-visible
            ]);

            return back()->with('status', "{$segment->name} is now OPEN for scoring.");
        }

        // turning OFF
        $segment->update(['is_open' => false]);

        return back()->with('status', "{$segment->name} is now CLOSED.");
    }

    /**
     * Release rankings to judges
     */
    public function release(Segment $segment)
    {
        $segment->update(['visible_to_judges' => true]);
        return back()->with('status', 'Rankings released to judges.');
    }

    /**
     * Rankings page
     * - Final Q&A: Top 5 only, ranked by FINAL Q&A totals (Option 1 confirmed)
     * - Other segments: show full rankings with per-judge columns & tie flags
     */
    public function rankings(Segment $segment)
    {
        // FINAL Q&A (Option 1: placement determined by Final Q&A only)
        if ($segment->name === 'Final Q&A') {

            $totals = Score::selectRaw('contestant_id, SUM(score) as total_score')
                ->where('segment_id', $segment->id)
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
                ->take(5)
                ->values();

            $females = Contestant::where('gender', 'female')->get()
                ->map(fn($c) => (object)[
                    'id' => $c->id,
                    'number' => $c->number,
                    'name' => $c->name,
                    'total' => (float)($totals[$c->id] ?? 0),
                ])
                ->sortByDesc('total')
                ->take(5)
                ->values();

            return view('admin.segments.rankings_finalqa', compact('segment', 'males', 'females'));
        }

        // OTHER SEGMENTS
        $judges = User::where('role', 'judge')
            ->orderBy('judge_code')
            ->get();

        $female = $this->buildDetailedRanking($segment->id, 'female', $judges);
        $male   = $this->buildDetailedRanking($segment->id, 'male', $judges);

        $femaleWinner = $female[0] ?? null;
        $maleWinner   = $male[0] ?? null;

        return view('admin.segments.rankings', compact(
            'segment',
            'judges',
            'female',
            'male',
            'femaleWinner',
            'maleWinner'
        ));
    }

    /**
     * Builds ranking rows exactly like rankings.blade.php expects:
     * [
     *   [
     *     'rank' => 1,
     *     'number' => 1,
     *     'name' => 'Candidate',
     *     'judge_scores' => [judge_id => score|null],
     *     'total' => 54.5,
     *     'tied' => true/false
     *   ],
     *   ...
     * ]
     */
    private function buildDetailedRanking(int $segmentId, string $gender, $judges): array
    {
        $judgeIds = $judges->pluck('id')->toArray();

        // Preload contestants for gender
        $contestants = Contestant::where('gender', $gender)
            ->orderBy('number')
            ->get(['id', 'number', 'name', 'gender']);

        // Load all score rows for this segment for those judges
        $scoreRows = Score::where('segment_id', $segmentId)
            ->whereIn('user_id', $judgeIds)
            ->get(['contestant_id', 'user_id', 'score']);

        // Map [contestant_id][judge_id] => score
        $map = [];
        foreach ($scoreRows as $r) {
            $map[$r->contestant_id][$r->user_id] = (float)$r->score;
        }

        $rows = [];

        foreach ($contestants as $c) {

            $judgeScores = [];
            $total = 0.0;

            foreach ($judges as $j) {
                $val = $map[$c->id][$j->id] ?? null;
                $judgeScores[$j->id] = $val;

                if ($val !== null) {
                    $total += (float)$val;
                }
            }

            $rows[] = [
                'rank' => null,
                'number' => $c->number,
                'name' => $c->name,
                'judge_scores' => $judgeScores,
                'total' => (float)number_format($total, 1, '.', ''),
                'tied' => false,
            ];
        }

        // Sort total desc, then contestant number asc for stable ordering
        usort($rows, function ($a, $b) {
            if ($a['total'] == $b['total']) {
                return $a['number'] <=> $b['number'];
            }
            return $b['total'] <=> $a['total'];
        });

        // Tie detection by total (1 decimal)
        $totalKeys = array_map(fn($r) => number_format((float)$r['total'], 1, '.', ''), $rows);
        $counts = array_count_values($totalKeys);

        // Assign rank + tied
        $rank = 1;
        foreach ($rows as &$r) {
            $key = number_format((float)$r['total'], 1, '.', '');
            $r['rank'] = $rank++;
            $r['tied'] = ($counts[$key] ?? 0) > 1;
        }
        unset($r);

        return $rows;
    }

    public function finalResults()
{
    $segment = Segment::where('name', 'Final Q&A')->firstOrFail();

    // Get totals strictly from Final Q&A
    $totals = Score::selectRaw('contestant_id, SUM(score) as total_score')
        ->where('segment_id', $segment->id)
        ->groupBy('contestant_id')
        ->pluck('total_score', 'contestant_id');

    $males = $this->buildFinalPlacement('male', $totals);
    $females = $this->buildFinalPlacement('female', $totals);

    return view('admin.results.final', compact('males', 'females'));
}

private function buildFinalPlacement(string $gender, $totals)
{
    $rows = Contestant::where('gender', $gender)->get()
        ->map(function ($c) use ($totals) {
            return [
                'id' => $c->id,
                'number' => $c->number,
                'name' => $c->name,
                'total' => (float)($totals[$c->id] ?? 0),
                'rank' => null,
                'tied' => false,
            ];
        })
        ->sortByDesc('total')
        ->take(5)
        ->values()
        ->all();

    // Assign rank
    foreach ($rows as $i => &$r) {
        $r['rank'] = $i + 1;
    }
    unset($r);

    // Tie detection
    $counts = [];
    foreach ($rows as $r) {
        $key = number_format($r['total'], 1, '.', '');
        $counts[$key] = ($counts[$key] ?? 0) + 1;
    }

    foreach ($rows as &$r) {
        $key = number_format($r['total'], 1, '.', '');
        $r['tied'] = ($counts[$key] ?? 0) > 1;
    }
    unset($r);

    return $rows;
}

public function resolveTie(Request $request)
{
    $user = auth()->user();

    if (!$user->is_chairman) {
        abort(403);
    }

    $request->validate([
        'contestant_id' => 'required|exists:contestants,id',
        'gender' => 'required|in:male,female',
    ]);

    // Add +0.1 bonus to break tie
    $segment = Segment::where('name', 'Final Q&A')->first();

    Score::where('segment_id', $segment->id)
        ->where('contestant_id', $request->contestant_id)
        ->update([
            'score' => \DB::raw('score + 0.1')
        ]);

    return back()->with('status', 'Tie resolved by Chairman.');
}

public function finalResultsPdf()
{
    $segment = Segment::where('name', 'Final Q&A')->firstOrFail();

    // Final placement = Final Q&A only
    $totals = Score::selectRaw('contestant_id, SUM(score) as total_score')
        ->where('segment_id', $segment->id)
        ->groupBy('contestant_id')
        ->pluck('total_score', 'contestant_id');

    $males = $this->buildFinalPlacement('male', $totals);
    $females = $this->buildFinalPlacement('female', $totals);

    $data = [
        'eventTitle' => 'Final Results',
        'basis' => 'Final Q&A Totals Only',
        'generatedAt' => now()->format('F d, Y h:i A'),
        'males' => $males,
        'females' => $females,
    ];

    $pdf = Pdf::loadView('admin.results.final_pdf', $data)
        ->setPaper('a4', 'portrait'); // change to 'landscape' if you want

    return $pdf->download('Final_Results_' . now()->format('Ymd_His') . '.pdf');
}

}