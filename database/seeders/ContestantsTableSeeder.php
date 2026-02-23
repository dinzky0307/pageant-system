<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Contestant;

class ContestantsTableSeeder extends Seeder
{
    public function run(): void
    {
        // Avoid FK truncate issue if scores already exist
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Contestant::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // FEMALE: 1-11
        for ($i = 1; $i <= 11; $i++) {
            Contestant::create([
                'number' => $i,
                'name' => 'Female Contestant ' . $i,
                'gender' => 'female',
            ]);
        }

        // MALE: 1-11 (separate numbering 1-11)
        for ($i = 1; $i <= 11; $i++) {
            Contestant::create([
                'number' => $i,
                'name' => 'Male Contestant ' . $i,
                'gender' => 'male',
            ]);
        }
    }
}
