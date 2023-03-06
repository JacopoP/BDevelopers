<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Technology>
 */
class TechnologyFactory extends Factory
{

    public function definition()
    {
        return [

            'name' => fake()->words(3, true),
            'version' =>  fake()->boolean()
                ?   rand(1, 20)
                :   null,
            'logo_path' =>  fake()->boolean()
                ?   fake()->url()
                :   null,
            'description' =>  fake()->boolean()
                ?   fake()->words(20, true)
                :   null,
        ];
    }
}

