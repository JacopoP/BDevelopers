<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

// Model
use App\Models\Message;
use App\Models\Developer;


class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Message::factory(1000)->make()->each(function($d){

            $developer = Developer::inRandomOrder() -> first();

            $d -> developer() -> associate($developer);
            $d -> save(); 
        });
    }
}
