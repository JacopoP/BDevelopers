<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Rating;

class RatingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ratings = [
            [
                'value' => 1
            ],
            [
                'value' => 2
            ],
            [
                'value' => 3
            ],
            [
                'value' => 4
            ],
            [
                'value' => 5
            ],
        ];
        foreach ($ratings as $rating) {
            Rating::make($rating)->save();
        }
    }
}
