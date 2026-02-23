<?php

namespace App\Http\Controllers\Judge;

use App\Http\Controllers\Controller;
use App\Models\Contestant;
use App\Models\Score;
use App\Models\Segment;
use App\Models\SegmentJudgeSubmission;
use App\Models\CriterionScore;
use App\Services\SegmentLockService;
use Illuminate\Http\Request;

class ScoringController extends Controller
{
    /**
     * Show scoring page for currently open segment
     */
    public function index()
    {
        $segment = Segment::where('is_open', true)->first();

        if (!$segment) {
            return view('judge.scoring.none');
        }

        if ($segment->is_locked) {
            return view('judge.scoring.locked', compact('segment'));
        }

        $criteria = $segment->criteria()->get();

        $contestants = $this->resolveContestantsForSegment($segment);

        // Existing scores (for display safety)
        $existingRows = CriterionScore::where('segment_id', $segment->id)
            ->where('user_id', auth()->id())
            ->get(['contestant_id', 'criterion_id', 'score']);

        $existing = [];
        foreach ($existingRows as $row) {
            $existing[$row->contestant_id][$row->criterion_id] =
                number_format((float)$row->score, 1, '.', '');
        }

        return view('judge.scoring.index', compact(
            'segment',
            'contestants',
            'criteria',
            'existing'
        ));
    }

    /**
     * Submit scores for a segment
     */
    public function submit(
        Request $request,
        Segment $segment,
        SegmentLockService $lockService
    ) {
        abort_if(!$segment->is_open || $segment->is_locked, 403);

        // Prevent double submission
        $alreadySubmitted = SegmentJudgeSubmission::where('segment_id', $segment->id)
            ->where('user_id', auth()->id())
            ->exists();

        abort_if($alreadySubmitted, 403);

        $request->validate([
            'scores' => 'required|array',
            'scores.*' => 'required|array',
            'scores.*.*' => [
                'required',
                'numeric',
                'min:1',
                'max:10',
                'regex:/^\d{1,2}(\.\d)?$/'
            ],
        ]);

        $criteriaIds = $segment->criteria()->pluck('id')->toArray();

        // If Final Q&A → restrict to Top 5 only
        $allowedContestantIds = null;

        if ($segment->name === 'Final Q&A') {
            $allowedContestantIds = array_flip(
                $this->getTop5ContestantIds()
            );
        }

        foreach ($request->scores as $contestantId => $criterionScores) {

            if ($allowedContestantIds !== null &&
                !isset($allowedContestantIds[(int)$contestantId])) {
                abort(403);
            }

            $total = 0.0;

            foreach ($criterionScores as $criterionId => $value) {

                if (!in_array((int)$criterionId, $criteriaIds, true)) {
                    abort(403);
                }

                CriterionScore::updateOrCreate(
                    [
                        'contestant_id' => $contestantId,
                        'segment_id'    => $segment->id,
                        'criterion_id'  => $criterionId,
                        'user_id'       => auth()->id(),
                    ],
                    [
                        'score' => $value,
                    ]
                );

                $total += (float)$value;
            }

            // Update aggregate score
            Score::updateOrCreate(
                [
                    'contestant_id' => $contestantId,
                    'segment_id'    => $segment->id,
                    'user_id'       => auth()->id(),
                ],
                [
                    'score' => number_format($total, 1, '.', ''),
                ]
            );
        }

        // Mark submission
        SegmentJudgeSubmission::create([
            'segment_id'  => $segment->id,
            'user_id'     => auth()->id(),
            'submitted_at'=> now(),
        ]);

        // Auto-lock if all judges submitted
        $justLocked = $lockService->tryLock($segment);

        return redirect()
            ->route('judge.scoring.index')
            ->with(
                'status',
                $justLocked
                    ? 'Submitted. Segment is now LOCKED (all judges submitted).'
                    : 'Submitted successfully.'
            );
    }

    /**
     * Optional picker screen
     */
    public function picker()
    {
        $segment = Segment::where('is_open', true)->first();

        if (!$segment) {
            return view('judge.scoring.none');
        }

        if ($segment->is_locked) {
            return view('judge.scoring.locked', compact('segment'));
        }

        $criteria = $segment->criteria()->get();

        $contestants = $this->resolveContestantsForSegment($segment);

        $existingRows = CriterionScore::where('segment_id', $segment->id)
            ->where('user_id', auth()->id())
            ->get(['contestant_id', 'criterion_id', 'score']);

        $existing = [];
        foreach ($existingRows as $row) {
            $existing[$row->contestant_id][$row->criterion_id] =
                number_format((float)$row->score, 1, '.', '');
        }

        return view('judge.scoring.picker', compact(
            'segment',
            'criteria',
            'contestants',
            'existing'
        ));
    }

    /**
     * Resolve contestants depending on segment
     */
    private function resolveContestantsForSegment(Segment $segment)
    {
        // Final Q&A → only Top 5 M + F
        if ($segment->name === 'Final Q&A') {
            return Contestant::whereIn(
                'id',
                $this->getTop5ContestantIds()
            )
            ->orderBy('gender')
            ->orderBy('number')
            ->get();
        }

        // Respect gender scope if set
        $query = Contestant::query();

        if ($segment->gender_scope === 'male') {
            $query->where('gender', 'male');
        } elseif ($segment->gender_scope === 'female') {
            $query->where('gender', 'female');
        }

        return $query
            ->orderBy('gender')
            ->orderBy('number')
            ->get();
    }

    /**
     * Compute Top 5 Male + Top 5 Female
     */
    private function getTop5ContestantIds()
    {
        $includedSegments = Segment::whereIn('name', [
            'Production Number',
            'Swimwear',
            'Evening Gown and Formal Wear',
        ])->pluck('id');

        $totals = Score::selectRaw('contestant_id, SUM(score) as total_score')
            ->whereIn('segment_id', $includedSegments)
            ->groupBy('contestant_id')
            ->pluck('total_score', 'contestant_id');

        $topMaleIds = Contestant::where('gender', 'male')->get()
            ->map(fn($c) => [
                'id'    => $c->id,
                'total' => (float)($totals[$c->id] ?? 0),
            ])
            ->sortByDesc('total')
            ->take(5)
            ->pluck('id')
            ->toArray();

        $topFemaleIds = Contestant::where('gender', 'female')->get()
            ->map(fn($c) => [
                'id'    => $c->id,
                'total' => (float)($totals[$c->id] ?? 0),
            ])
            ->sortByDesc('total')
            ->take(5)
            ->pluck('id')
            ->toArray();

        return array_merge($topMaleIds, $topFemaleIds);
    }
}