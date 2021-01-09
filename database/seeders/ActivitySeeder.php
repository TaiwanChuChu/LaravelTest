<?php

namespace Database\Seeders;

use App\Models\Activity;
use App\Models\ActivityType;
use Illuminate\Database\Seeder;

class ActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ActivityType::factory()
            ->times(10)
            ->has(Activity::factory()->count(5))
            ->create();
    }
}
