<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
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
            'address' => fake() -> address(),
            'phone_number' => fake() -> phoneNumber(),
            'profile_path' => fake() -> imageUrl(640, 480, 'animals', true),
            'cv_path' => fake() -> url(),
            'portfolio_url' => fake() -> url(),
            'about_me' => fake() -> sentence(),
            'performances' => fake() -> sentence(),
        ];
    }
}
