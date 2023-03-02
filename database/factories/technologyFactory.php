<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;


class technologyFactory extends Factory
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

            // 'name' => fake()->words(3, true),
            // 'version' => rand(1, 20),
            // 'logo_path' => fake()->url(),
            // 'description'  => fake()->words(20, true),
        ];



        // $names = [
        //     'Java',
        //     'JavaScript',
        //     'Php',
        //     'CSS',
        //     'Vue',
        //     'Vite',
        //     'Npm',
        //     'Html5',
        //     'Laravel',
        // ];
        // return [

        //     'name' => $names[rand(0, (count($names) - 1))],
        //     'version' => rand(1, 20),
        //     'logo_path' => fake()->url(),
        //     'description'  => fake()->words(20, true),
        // ];
    }
}
