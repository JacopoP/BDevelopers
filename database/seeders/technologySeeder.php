<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


use App\Models\Technology;

class TechnologySeeder extends Seeder
{

    public function run()
    {
        Technology::factory()->count(100)->create();
    }
}
