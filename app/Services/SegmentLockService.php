<?php

namespace App\Services;

use App\Models\Segment;
use App\Models\SegmentJudgeSubmission;
use App\Models\User;

class SegmentLockService
{
    public function tryLock(Segment $segment): bool
    {
        $judgeCount = User::where('role', 'judge')->count();
        $submittedCount = SegmentJudgeSubmission::where('segment_id', $segment->id)->count();

        if ($judgeCount > 0 && $submittedCount >= $judgeCount) {
            $segment->update([
                'is_locked' => true,
                'is_open' => false,
            ]);

            return true;
        }

        return false;
    }
}
