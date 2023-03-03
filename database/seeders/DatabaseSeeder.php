<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            RatingSeeder::class,
            SponsorSeeder::class,
            TechnologySeeder::class,
            DeveloperSeeder::class,
            ReviewSeeder::class,
            MessageSeeder::class,
        ]);
    }
}