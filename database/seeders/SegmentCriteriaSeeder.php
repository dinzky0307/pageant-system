<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Segment;
use App\Models\SegmentCriterion;

class SegmentCriteriaSeeder extends Seeder
{
    public function run(): void
    {
        $map = [
            'Production Number' => [
                'Mastery and Execution',
                'Gracefulness and Certainty',
                'Audience Impact',
                'Poise and Bearing',
            ],
            'Swimwear' => [
                'Fitness and Grace',
                'Confidence and Stage Presence',
                'Walk and Movements',
                'Overall Impact',
            ],
            'Evening Gown and Formal Wear' => [
                'Design and Fitting',
                'Stage Deportment',
                'Poise and Bearing',
                'Overall Impact',
            ],
            'Formal Wear' => [
                'Design and Fitting',
                'Stage Deportment',
                'Poise and Bearing',
                'Overall Impact',
            ],
            'Final Q&A' => [
                'Wit and Content',
                'Stage Presence and Confidence',
                'Projection and Delivery',
                'Overall Impact',
            ],
        ];

        foreach ($map as $segmentName => $criteria) {
            $segment = Segment::where('name', $segmentName)->first();
            if (!$segment) continue;

            foreach ($criteria as $i => $name) {
                SegmentCriterion::updateOrCreate(
                    ['segment_id' => $segment->id, 'name' => $name],
                    ['display_order' => $i + 1]
                );
            }
        }
    }
}
