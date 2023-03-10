<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

// Model
use App\Models\Developer;
use App\Models\User;
use App\Models\Rating;
use App\Models\Technology;
use App\Models\Sponsor;
use DateTime;

class DeveloperSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */


    public function run()
    {
        $Users = User::all();

        foreach ($Users as $User) {
            // Developer
            $new_developer = Developer::factory()->make();

            $new_developer->user()->associate($User);
            // $new_developer['id'] = $User['id'];

            $new_developer->save();

            // Rating
            $ratings = Rating::inRandomOrder()->limit(rand(1, 5))->get();
            $new_developer->ratings()->attach($ratings);

            // Technologies
            $technologies = Technology::inRandomOrder()->limit(rand(1, 5))->get();
            $new_developer->technologies()->attach($technologies);

            // Sponsor
            $spon_number = rand(1, 5);
            for ($i = 0; $i < $spon_number; $i++) {
                $new_developer->addSponsorship(
                    // generate random DateTime
                    DateTime::createFromFormat('Y-m-d H:i:s', (fake()->date('Y-m-d') . ' ' . fake()->time('H:i:s'))),
                    rand(1, 3)
                );
            }
        }
    }
}
