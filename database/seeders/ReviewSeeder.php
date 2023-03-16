<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

// Model
use App\Models\Review;
use App\Models\Developer;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Review::factory(1500)->make()->each(function ($d) {
            $developer = Developer::inRandomOrder()->first();

            $d->developer()->associate($developer);
            $d->save();
        });
    }
}
