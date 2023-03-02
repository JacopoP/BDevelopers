<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Sponsor;

class SponsorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $plans = [
            [
                'plan_name' => 'Base', 
                'price' => 2.99,
                'length' => 24, 
            ],
            [
                'plan_name' => 'Medium', 
                'price' => 5.99,
                'length' => 72, 
            ],
            [
                'plan_name' => 'Advanced', 
                'price' => 9.99,
                'length' => 144, 
            ],
        ];
        foreach ($plans as $plan) {
            Sponsor::make($plan)->save();
        }
    }
}
