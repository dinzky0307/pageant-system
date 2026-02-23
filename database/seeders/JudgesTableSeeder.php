<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class JudgesTableSeeder extends Seeder
{
    public function run(): void
    {
        \App\Models\User::where('role', 'judge')->delete();; // Clear old judges

        $judges = [
            ['name' => 'Judge 1', 'judge_code' => 'J001', 'pin' => '1234', 'is_chairman' => false],
            ['name' => 'Judge 2', 'judge_code' => 'J002', 'pin' => '2345', 'is_chairman' => false],
            ['name' => 'Judge 3', 'judge_code' => 'J003', 'pin' => '3456', 'is_chairman' => false],
            ['name' => 'Judge 4', 'judge_code' => 'J004', 'pin' => '4567', 'is_chairman' => false],
            ['name' => 'Judge 5', 'judge_code' => 'J005', 'pin' => '5678', 'is_chairman' => false],
            ['name' => 'Chairman', 'judge_code' => 'J006', 'pin' => '6789', 'is_chairman' => true],
        ];

        foreach ($judges as $judge) {
            \App\Models\User::updateOrCreate(
                ['judge_code' => $judge['judge_code']],
                [
                    'name' => $judge['name'],
                    'role' => 'judge',
                    'pin' => bcrypt($judge['pin']),
                    'is_chairman' => $judge['is_chairman'],
                    'email' => strtolower(str_replace(' ', '', $judge['name'])) . '@pageant.local',
                    'password' => bcrypt('password123'),
                ]
            );
        }
    }
}
