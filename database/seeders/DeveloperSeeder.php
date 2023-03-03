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

        foreach( $Users as $User){
            // Developer
            $new_developer = Developer::factory()->make();

            $new_developer -> user() -> associate($User);
            // $new_developer['id'] = $User['id'];

            $new_developer -> save();

            // Rating
            $ratings = Rating::inRandomOrder() -> limit(rand(1,5)) -> get();
            $new_developer -> ratings() -> attach($ratings);
            
            // Technologies
            $technologies = Technology::inRandomOrder() -> limit(rand(1,5)) -> get();
            $new_developer -> technologies() -> attach($technologies);

            // Sponsor
            $sponsors = Sponsor::inRandomOrder() -> limit(rand(1,3)) -> get();
            $new_developer -> sponsors() -> attach($sponsors, ['date_start' => fake()->date(), 'date_end' => fake()->date()]);
        }

    }
}
