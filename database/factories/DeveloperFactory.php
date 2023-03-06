<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Developer>
 */
class DeveloperFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'address' => fake() -> boolean() ? fake() -> address() : NULL,
            'phone_number' => fake() -> boolean() ? fake() -> phoneNumber() : NULL,
            'profile_path' => fake() -> boolean() ? fake() -> imageUrl(640, 480, 'animals', true) : NULL,
            'cv_path' => fake() -> boolean() ? fake() -> url() : NULL,
            'portfolio_url' => fake() -> boolean() ? fake() -> url() : NULL,
            'about_me' => fake() -> boolean() ? fake() -> sentence() : NULL,
            'performances' => fake() -> boolean() ? fake() -> sentence() : NULL,
        ];
    }
}
