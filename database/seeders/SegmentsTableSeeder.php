<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Segment;

class SegmentsTableSeeder extends Seeder
{
    public function run(): void
    {
       $segments = [
    'Production Number',
    'Swimwear',
    'Evening Gown and Formal Wear',
    'Final Q&A',
];


        foreach ($segments as $name) {
            \App\Models\Segment::updateOrCreate(['name' => $name]);
        }
    }
}
